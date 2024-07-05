@extends('components.layout')

@section('conteudo')
@section('titulo', 'DIZIMOS' )
@section('titulo-pagina', 'Dizimos do ' .  $nome )

<link href="{{ asset('css/oferta-dizimo-despesas.css') }}" rel="stylesheet">

@section('botao-tabela')
        <form action="/filtrar/dizimo" method="post">
        @csrf
            <input type="hidden" name="membro_id" value="{{ $membro_id }}">
            <input type="hidden" name="nome" value="{{ $nome }}">
            <input  type="date" name="dataini" id="dataini" value="{{ isset($dataini) ? $dataini : '' }}" required>
            <input  type="date" name="datafi" id="datafi" value="{{ isset($datafi) ? $datafi : '' }}" required>
            <input  type="submit" value="Filtrar">
        </form>
@endsection

  

@section('conteudo')
<div id="tabela-dados">
        <table>
            <tr>
                <th style="width: 4%; ">ID</th>
                <th>DATA</th>
                <th>VALOR</th>
                <th style="width: 4%;">X</th>
            </tr>
            @foreach ($dizimos->reverse() as $dizimo)

            <tr>
                <td style="background-color: var(--titulos);; color:white">{{ $dizimo->id}}</td>
                <td>{{ \Carbon\Carbon::parse($dizimo->data)->format('d/m/Y') }}</td>
                <td>R${{ number_format($dizimo->valor, 2, ',', '.') }}</td>
                <td style="background-color: red; color:white" > 
                    <form method="post" class="formx" action="/dizimos/destoy/id"><button class="excluir">X</button>
                        <input type="hidden" name="data" value="{{$dizimo->data}}">
                        <input type="hidden" name="id" value="{{$dizimo->id}}">
                        <input type="hidden" name="membro_id" value="{{$dizimo->membro_id}}">
                        <input type="hidden" name="dataini" value="{{ isset($dataini) ? $dataini : '' }}">
                        <input type="hidden" name="datafi" value="{{ isset($datafi) ? $datafi : '' }}">
                        <input type="hidden" name="nome" value="{{ $nome }}">

                        @csrf
                    </form>
                </td>
            </tr>

            @endforeach
        </table>
</div>

    <div id="valor-total">
        <p>VALOR TOTAL: R$
        <p style="color: green; font-weight: bold;">{{ number_format($totaldizimos, 2, ',', '.') }}</p>
        </p>
    </div>




<div id="formulario-registro" >
<form action="/registrar/dizimo" method="post">
    @csrf
    <input type="hidden" name="membro_id" value="{{ $membro_id}}">
    <input type="hidden" name="nome" value="{{ $nome }}">
    <input  type="date" name="data" id="data" value="{{$datanow}}" autocomplete="off" required>

    
    <input  type="number" name="valor" id="valor" autocomplete="off" required placeholder="Valor:" >
    <input type="hidden" name="dataini" value="{{ isset($dataini) ? $dataini : '' }}">
    <input type="hidden" name="datafi" value="{{ isset($datafi) ? $datafi : '' }}">
    <button type="submit">Registar Dizimo</button>
</form>

</div>

@if (Session::has('sucesso'))
    <div class="flash-message" style="background-color: rgb(0, 77, 0);" class="msg">
        <p>{{ Session::get('sucesso') }}</p>
    </div>
    {{ Session::forget('sucesso') }}
@endif

@if (Session::has('falha'))
    <div class="flash-message" style="background-color: red;" class="msg">
        <p>{{ Session::get('falha') }}</p>
    </div>
    {{ Session::forget('falha') }}
@endif 

@endsection





