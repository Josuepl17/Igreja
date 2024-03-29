@extends('components.layout')

@section('conteudo')  
@section('titulo', 'FORMULÁRIO' )
@section('titulo-nav', 'Formulário' )

    <style>
        :root {
            --titulos: #10233b;
            --titulos: #0A1626 ; 
            --subtitulos: #023859;
            --fundos: #0D8AA6;

            --cor-secundaria: #5353533d;
        }

        #geral {
            display: flex;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;
            background-color: rgba(71, 69, 69, 0.298);

        }

        form {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            width: 50%;
            height: 90%;
            padding-bottom: 5px;
            border: 1px solid black;
            align-items: center;
            border-radius: 5px;
            box-shadow: #10233b 0px 0px 5px;
            background-color: white;



        }

        select {
            width: 62%;
            height: 30px;
            border-radius: 5px;
            text-align: center;

        }

        label {
            font-size: 20px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            padding-bottom: 5px;

        }



        .cad {
            width: 60%;
            height: 5%;
            text-transform: uppercase;
            font-size: 14px;
            padding: 2px;
            border: 1px solid black;
            text-align: center;


        }

        .h1m {
            color: black;
            font-size: 30px;
        }

        .btn {
            margin-top: 10px;
            color: black;
            text-decoration: none;
            margin-top: 10px;
            padding-bottom: 0;
            font-size: 18px;
            width: 190px;
            height: 40px;
            border: 3px solid black;
            background-color: var(--titulos);
            color: white;
            margin-bottom: 9px;



        }

        .btn:hover {
            background-color: var(--titulos);
            color: white;
            border: 1px solid black;
            transition: 0.6s;

        }
    </style>

    <div id="geral">
        <form action="/inserir/membro" method="post">
            @csrf
            <h1 class="h1m">Cadastro de Membros</h1>
            <label for="nome">Nome:</label>
            <input class="cad" type="text" name="nome" id="nome" autocomplete="off" required>
            <label for="funcao">Função</label>
            <select name="funcao" id="funcao">
                <Option disabled selected></Option>
                <option value="MEMBRO">MEMBRO</option>
                <option value="MUSICO">MUSICO</option>
                <option value="PASTOR">PASTOR</option>
                <option value="DIACONO">DIACONO</option>
                <option value="OBREIRO">OBREIRO</option>
            </select>

            <label for="endereco">Endereço:</label>
            <input class="cad" type="text" name="endereco" id="endereco" autocomplete="off" required>

            <label for="telefone">Telefone:</label>
            <input class="cad" type="number" name="telefone" id="telefone" autocomplete="off" required>

            <br>


            <button class="btn" type="submit">Cadastrar</button>
        </form>
    </div>

    @endsection