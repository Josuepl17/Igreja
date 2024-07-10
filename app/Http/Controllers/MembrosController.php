<?php

namespace App\Http\Controllers;


use App\Models\caixas;
use App\Models\despesas;
use App\Models\ofertas;
use App\Models\membros;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\dizimos;
use App\Models\empresas;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Object_;

class MembrosController extends Controller
{
    /*membros*/

    public function Atualizar(Request $request){
        
        User::where('id', auth()->id())->update(['empresa_id' => $request->id]);

        return redirect('/');
    }

    public function index(Request $request)
    {


        $dados = $request->pesquisa;
        $empresa_id = auth()->user()->empresa_id;
       
        $razao_empresa = empresas::where('id', $empresa_id)->value('razao');

        if ($dados != null) {
            $index = membros::whereRaw('LOWER(nome) LIKE ?', ["%" . strtolower($dados) . "%"])->get();
            $indexbusca = membros::whereRaw('LOWER(nome) LIKE ?', ["%" . strtolower($dados) . "%"])->first();

            return view('pagina.index', compact('index', 'razao_empresa', 'dados'));

        } else {
            $index = membros::where('empresa_id', $empresa_id)->get();
            return view('pagina.index', compact('index', 'razao_empresa'));
        }
    }

    public function cadastro_membro()
    {
        $empresa_id = auth()->user()->empresa_id;
        $razao_empresa = empresas::where('id', $empresa_id)->value('razao');
        return view('pagina.formulario', compact('razao_empresa'));
    }

    public function botao_inserir_membro(request $request)
    {
        $user_id = Auth::id();
        $empresa_id = auth()->user()->empresa_id;
        $dados = $request->all();
        $dados['user_id'] = $user_id;
        $dados['empresa_id'] = $empresa_id;
        $dados =  array_map('strtoupper', array_map('strval', $dados));
        membros::create($dados);
        return redirect('/');
    }


    public function excluir_membro(request $request)
    {
        $destroy = $request->id;
        membros::destroy($destroy);
        return redirect('/');
    }
}
