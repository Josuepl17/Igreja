@extends('components.layout')

@section('conteudo')  
@section('titulo', 'OFERTAS' )
@section('titulo-nav', 'Ofertas' )


    <style>
        :root {
            --titulos: #0A1626;
            --subtitulos: #023859;
            --fundos: #0D8AA6;

            --cor-secundaria: #313131e7;
        }

        .table2 {
            display: flex;
            flex-direction: column;
            width: 100%;
            height: 80%;
            




        }

        .id {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 15px;





        }

        label {
            font-size: 20px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            padding: 10px;

        }



        .cad {
            width: 30%;
            text-transform: uppercase;
            font-size: 20px;
            padding: 2px;
            border: 1px solid black;
            text-align: center;


        }

        .h1m {
            color: black;
            font-size: 50px;
        }

        .id button {
            margin: 0px;
            color: black;
            text-decoration: none;

            padding-bottom: 0;
            font-size: 20px;
            width: 180px;
            height: 40px;
            border: 3px solid black;
            background-color: var(--subtitulos);
            color: white;


        }

        .id button:hover {
            background-color: var(--titulos);
            color: white;

            transition: 0.6s;

        }

        .excluir {
            margin: auto;
            background-color: red;
            font-size: 20px;
            height: 100%;
            width: 100%;
            margin-top: -2px;


        }


        .excluir:hover {
            color: aliceblue;

            background-color: red;
            transition: 0.6;
        }

        table {
            border-collapse: collapse;


            overflow: auto;
            margin: auto;
            border-radius: 50px;
            width: 100%;

            background-color: white;
            margin-top: 0px;
            color: black;

        }

        td {

            border: 1px solid rgba(0, 0, 0, 0.34);
            text-align: center;
            font-size: 18px;
            margin-top: 0px;
            margin-bottom: 0px;
        }


        td:hover {
            color: white;
        }




        th {
            border: 1px solid black;
            border-top: none;
            border-left: none;

            font-size: 20px;
            color: white;
            background-color: var(--subtitulos);
            position: sticky;
            top: 0px;
            padding-top: 5px;

        }

        tr:hover {
            background-color: var(--fundos);
            color: white;
            transition: 0.1s;
        }



        .formx {

            display: flex;
            width: 100%;
            flex-direction: none;
            align-items: none;
            margin-top: none;
            justify-content: none;



        }

        .valortotal {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            height: 9%;
            width: 100%;
            background-color: var(--titulos);

        }

        .valortotal p {
            color: black;
            padding-right: 10px;

            background-color: white;



        }

        .filtro {
            display: flex;
            width: 100%;
            background-color: var(--titulos);
            padding-top: 5px;
            padding-bottom: 5px;
            height: 7%;
        }

        .filtro form {
            width: 100%;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            border-radius: 0px;
            margin-top: -3px;


        }

        /*.relatorio{
            display: flex;
            width: 40%;
            
        }*/

        .conteudo {
            display: flex;
            width: 100%;
            height: 100%;
            overflow: auto;
        }
    </style>


    <div class="table2">
        <div class="filtro">
            <form action="/filtrar/ofertas" method="get">
                <input type="date" name="dataini" id="dataini" value="{{ isset($dataIni) ? $dataIni : '' }}" required>
                <input type="date" name="datafi" id="datafi" value="{{ isset($dataFi) ? $dataFi : '' }}" required>
                <input type="submit" value="Filtrar" style="width: 5%; font-size: 15px; border-radius: 0px; ">
            </form>



        </div>

        <div class="conteudo">
            <table>
                <tr>
                    <th style="width: 4%;">ID</th>
                    <th>DATA</th>
                    <th>VALOR</th>
                    <th style="width: 4%;">X</th>

                </tr>
                @foreach ($ofertas->reverse() as $oferta)

                <tr>
                    <td style="background-color: var(--titulos) ; color:white">{{ $oferta->id}}</td>
                    <td>{{\Carbon\Carbon::parse($oferta->data)->format('d/m/Y')}}</td>
                    <td>R$ {{ number_format($oferta->valor, 2, ',', '.') }}</td>
                    <td>
                        <form method="post" class="formx" action="/destroy/ofertas/id"><button class="excluir">X</button>
                            <input type="hidden" name="data" value="{{$oferta->data}}">
                            <input type="hidden" name="id" value="{{$oferta->id}}">
                            @csrf
                        </form>
                    </td>

                </tr>
                <br>

                @endforeach
            </table>
        </div>

        <div class="valortotal">
            <p>VALOR TOTAL: R$
            <p style="color: green; font-weight: bold;">{{ number_format($totalofertas, 2, ',', '.') }}</p>
            </p>
        </div>


    </div>


    <form class="id" action="/registrar/oferta" method="post">
        @csrf
        <label for="data">Data:</label>
        <input class="cad" type="date" name="data" id="data" value="{{ $datanow }}" autocomplete="off" required>

        <label for="valor">Valor:</label>
        <input class="cad" type="text" name="valor" id="valor" autocomplete="off" required>

        <br>

        <button type="submit">Registar Oferta</button>
    </form>






@endsection