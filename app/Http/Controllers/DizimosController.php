<?php
// Arquivo Documentado em "OfertasController.php"
namespace App\Http\Controllers;


use App\Models\caixas;
use App\Models\despesas;
use App\Models\ofertas;
use App\Models\membros;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\dizimos;
use App\Models\empresas;
use App\Services\MeuServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Auth;

class DizimosController extends Controller
{
    /*Dizimos Por Usuario*/

//......................................................Parte 1................................................//
    public function filter_page(Request $request)
    {
        $dataIni = $request->dataini ?? '1900-01-01';
        $dataFi = $request->datafi ?? '5000-01-01';
        $empresa_id = Auth::user()->empresa_id;
        $membro_id = $request->membro_id;

        $dados = [
            'dizimos' => dizimos::where('empresa_id' , $empresa_id)->where('membro_id', $membro_id)->whereBetween('data', [$dataIni, $dataFi])->get(),
            'totaldizimos' => dizimos::where('empresa_id', $empresa_id)->whereBetween('data', [$dataIni, $dataFi])->get()->sum('valor'),
            'datanow' => Carbon::now()->format('Y-m-d'),
            'dataini' => $request->dataini,
            'datafi' => $request->datafi,
            'membro_id' => $request->membro_id,
            'nome' => $request->nome, // Nome Dizimista
            'razao_empresa' => empresas::where('id', $empresa_id)->value('razao')
        ];

        if ($dataIni == '1900-01-01' && $dataFi == '5000-01-01') {
            unset($dados['dataini'], $dados['datafi']);
            return view('pagina.dizimo', $dados);
        }
            return view('pagina.dizimo', $dados);
    }

//......................................................Parte 2................................................//

    public function botao_registrar_dizimo(request $request)
    {
        if (MeuServico::Verificar($request->data) == true) {
            $dados = $request->only('id', 'data', 'valor', 'membro_id');
            $dados['user_id'] = Auth::id();
            $dados['empresa_id'] = Auth::user()->empresa_id;
            $dados['valor'] = str_replace(',', '.', $dados['valor']);
            dizimos::create($dados);
            Session()->flash('sucesso', 'Item criado com Sucesso');
        } else {
            Session()->flash('falha',  'Falha ao criar item, Caixa Fechado');
        }
            return $this->filter_page(MeuServico::post_filter($request));
        }

//......................................................Parte 3................................................//

    public function botao_excluir_dizimo(request $request)
    {
        if (MeuServico::Verificar($request->data)) {
            $destroy = $request->id;
            dizimos::destroy($destroy);
            Session()->flash('sucesso',  'Item Apagado com Sucesso');
        } else {
            Session()->flash('falha',  'Falha ao apagar item, Caixa Fechado');
        }
        return $this->filter_page(MeuServico::post_filter($request));
    }
}



