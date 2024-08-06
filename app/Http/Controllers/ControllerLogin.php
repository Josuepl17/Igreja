<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormFilial;
use App\Http\Requests\FormFilialUsers;
use App\Jobs\EnvioEmail;
use App\Mail\EnvioEmail as MailEnvioEmail;
use App\Models\caixas;
use App\Models\despesas;
use App\Models\ofertas;
use App\Models\membros;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\dizimos;
use App\Models\empresa;
use App\Models\empresas;
use App\Models\Relacionamento;
use App\Models\Relacionamentos;
use App\Models\user_empresas as ModelsRelacionamentos;
use App\Models\user_empresas;
use App\Models\User;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\FuncCall;

class ControllerLogin extends Controller
{

    //......................................................LOGIN E AUTH................................................//

    public function login()
    {
        return view('usuario-filial/login.login');
    }

    public function formulario_usuario_empresa()
    {
        return view('usuario-filial/login.cadastro-user-filial');
    }

    public function cadastro_usuario_empresa(FormFilialUsers $request)
    {
        $dados = $request->all();

        if (MeuServico::verificar_login($request)) {
            return back()->withInput()->withErrors(['email' => 'Esse Email Já Está Cadastrado']);
        }

        if (MeuServico::verificar_empresa($request)) {
            return back()->withInput()->withErrors(['email' => 'Esse CNPJ Já Está Cadastrado']);
        }

        $empresa = empresas::create([
            'razao' => $request->razao,
            'cnpj' => $request->cnpj
        ]);

        $user = new User();
        $user->nome = $request->nome;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->empresa_id = $empresa->id;
        $user->nivel = 'admin';
        $user->save();

        $user_empresas = new user_empresas();
        $user_empresas->user_id = $user->id;
        $user_empresas->empresa_id = $empresa->id;
        $user_empresas->save();
        return redirect('/login');
    }

    public function autenticar_usuario(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']]) || Auth::attempt(['email' => strtoupper($credentials['email']), 'password' => $credentials['password']])) {
            return redirect('/selecionar/filial');
        }
        Session()->flash('falha',  'Login Incorreto');
        return redirect('/login');
    }


    //......................................................Usuario................................................//

    public function tela_usuarios()
    {
        $user_id = auth()->user()->id;
        $relacionamentos = user_empresas::where('user_id', $user_id)->pluck('empresa_id'); // peguei as empresas relacionadas ao meu usuario.
        $empresas = user_empresas::whereIn('empresa_id', $relacionamentos)->pluck('user_id'); // peguei todos os usuarios relacionados as empresas
        $users = User::whereIn('id', $empresas)
            ->where('id', '!=', auth()->user()->id)
            ->get(); // busquei

        //$razao_empresa = empresas::where('id', auth()->user()->empresa_id)->value('razao');
        return view('usuario-filial/usuario.tela-user', compact('users'));
    }

    public function formulario_adicionar_usuario()
    {
        $user_id = auth()->user()->id;
        $dados = user_empresas::where('user_id', $user_id)->pluck('empresa_id');
        $empresas = empresas::whereIn('id', $dados)->get();
        return view('usuario-filial/usuario.adicionar_user', compact('empresas'));
    }

    public function adicionar_usuario(FormFilialUsers $request)
    {
        if (MeuServico::verificar_login($request)) {

            return back()->withInput()->withErrors(['email' => 'Esse Email Já Está Cadastrado']);
        }
        $user = new User();
        $user->nome = $request->user;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->empresa_id = auth()->user()->empresa_id;
        $user->save();


        if ($empresasMarcadas = $request->input('empresas')) {
            foreach ($empresasMarcadas as $emp) {
                $user_empresas = new user_empresas();
                $user_empresas->user_id = $user->id;
                $user_empresas->empresa_id = $emp;
                $user_empresas->save();
            }
        }

        return redirect('/user/profile');
    }




    public function formulario_editar_usuario(Request $request)
    {
        $user_id = auth()->user()->id;
        $dados = user_empresas::where('user_id', $user_id)->pluck('empresa_id');
        $empresas = empresas::whereIn('id', $dados)->get();
        $user_editar = User::find($request->user_id);
        $empresasSelecionadas = user_empresas::where('user_id', $user_editar->id)->pluck('empresa_id')->toArray();
        return view('usuario-filial/usuario.editar_user', compact('empresas', 'user_editar', 'empresasSelecionadas'));
    }

    public function editar_usuario(FormFilialUsers $request)
    {
        $user = User::find($request->user_id);
    
        // Verifica se o email atual é diferente do novo email
        if ($user->email != $request->email) {
            // Verifica se o novo email já está cadastrado no banco
            
    
            if (MeuServico::verificar_login($request)) {
                // Se o novo email já está cadastrado, retorna um erro
                return back()->withInput()->withErrors(['email' => 'Esse Novo Email Já Está Cadastrado']);
            } else {
                // Se o novo email não está cadastrado, atualiza o usuário
                user_empresas::where('user_id', $request->user_id)->delete(); // nunca pode ser do adm
    
                $user->nome = $request->nome;
                $user->email = $request->email;
                $user->save();
    
                if ($empresasMarcadas = $request->empresas) {
                    foreach ($empresasMarcadas as $emp) {
                        $user_empresas = new user_empresas();
                        $user_empresas->user_id = $user->id;
                        $user_empresas->empresa_id = $emp;
                        $user_empresas->save();
                    }
                }
            }
        } else {
            // Se o email é igual, apenas atualiza os outros dados
            $user->nome = $request->nome;
            $user->save();
    
            if ($empresasMarcadas = $request->empresas) {
                foreach ($empresasMarcadas as $emp) {
                    $user_empresas = new user_empresas();
                    $user_empresas->user_id = $user->id;
                    $user_empresas->empresa_id = $emp;
                    $user_empresas->save();
                }
            }
        }
    
        return redirect('/user/profile');
    }


    //......................................................EMPRESAS................................................//

    public function selecionar_filial()
    {
        $user_id = auth()->user()->id;
        $relacionamentos = user_empresas::where('user_id', $user_id)->pluck('empresa_id');
        $empresas = empresas::whereIn('id', $relacionamentos)->get();
        return view('usuario-filial/filial.selecionar-filial', compact('empresas'));
    }


    public function formulario_adicionar_empresa()
    {
        $user_id = auth()->user()->id;
        $relacionamentos = user_empresas::where('user_id', $user_id)->pluck('empresa_id'); // peguei as empresas relacionadas ao meu usuario.
        $users_id = user_empresas::whereIn('empresa_id', $relacionamentos)->pluck('user_id'); // peguei todos os usuarios relacionados as empresas
        $users = User::whereIn('id', $users_id)
            ->where('id', '!=', auth()->user()->id)
            ->get(); // busquei

        return view('usuario-filial/filial.cadastro-filial', compact('users'));
    }

    public function adicionar_empresa(FormFilialUsers $request)
    {

        if (MeuServico::verificar_empresa($request)) {
            return back()->withInput()->withErrors(['cnpj' => 'Esse CNPJ Já Está Cadastrado']);
        }

        $empresa = empresas::create([
            'razao' => $request->razao,
            'cnpj' => $request->cnpj
        ]);

        if ($usuariosMarcados = $request->input('user')) { // se existir dados
            foreach ($usuariosMarcados as $user) {
                $user_empresas = new user_empresas();
                $user_empresas->user_id = $user;
                $user_empresas->empresa_id = $empresa->id;
                $user_empresas->save();
            }
        }

        //relacionando usuario ADM
        $user_empresas = new user_empresas();
        $user_empresas->user_id = auth()->user()->id;
        $user_empresas->empresa_id = $empresa->id;
        $user_empresas->save();

        return redirect('/selecionar/filial');
    }

    //......................................................RECUPERA................................................//


    public function esqueci_senha(){

        return view('usuario-filial/atualiza-usuario.envia-codigo');
    }

    public function gera_codigo(Request $request)
    {
        $usuario = User::where('email', $request->email)->first();
        $user_id = $usuario->id;

        if ($usuario) {
            $codigo = rand(100000, 999999);
            Mail::send(new MailEnvioEmail($codigo, $request->email));
            return redirect('/recebe/codigo');
        } else {
            dd('Não existe esse email');
        }
    }

    public function recebe_codigo(){
        return view('usuario-filial/atualiza-usuario.confirma-codigo');
    }

    public function confirma_codigo(Request $request)
    {
        if ($request->codigo == $request->codigo_email) {
            $user_id = $request->usuario;
            $user = User::find($user_id);
            return redirect('/form/atualiza/usuario');
            
        } else {
            dd('deu errado');
        }
    }

    public function form_atualiza_usuario(){
        return view('usuario-filial/atualiza-usuario.atualizar_usuario');
    }



    public function atualizar_usuario(Request $request)
    {
        $user = User::find($request->user_id);

        $user->nome = $request->user;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/login');
    }

    //......................................................LOGIN................................................//

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
