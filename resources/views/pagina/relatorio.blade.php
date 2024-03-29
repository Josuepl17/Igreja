<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatorio</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
        }

        :root {

            --titulos: #0A1626;
            --subtitulos: #023859;
            --fundos: #0D8AA6;
            --cor-secundaria: #5353533d;
        }


        body {
            background-color: var(--cor-secundaria);
        }

        .titulo {
            border: 1px solid black;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 10vh;
            background-color: #0A1626;
            color: white;
        }

        nav {
            border: 1px solid black;
            display: flex;
            width: 100%;
            height: 5vh;
            justify-content: flex-start;
            align-items: center;
            background-color: var(--subtitulos);

        }

        .conteiner-colunas {

            width: 100%;
            height: 30vh;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            align-items: self-start;


        }

        .box {
            border: 1px solid black;
            width: 19%;
            height: 55%;
            margin-top: 40px;
            box-shadow: 1px 1px 2px black;



        }

        .box-1 {
            display: flex;
            width: 100%;
            height: 20%;

            font-size: 20px;
            justify-content: center;
            align-items: center;
            background-color: #0d1c31f6;
            color: white;
        }

        .box-2 {
            display: flex;
            width: 100%;
            height: 65%;

            background-color: white;
            justify-content: center;
            align-items: center;
        }

        .box-3 {
            display: flex;
            width: 100%;
            height: 15%;

            justify-content: center;
            align-items: center;
            background-color: var(--subtitulos);

        }

        nav a {


            font-size: 17px;
            text-decoration: none;
            color: black;
            border: 1px solid black;
            padding: 6px;
            color: white;
            background-color: var(--cor-secundaria);

        }



        nav a:hover {
            background-color: var(--titulos);
            color: white;
        }

        .box-3 a {
            text-decoration: none;
            color: white;
        }

        .box-3 a:hover {
            background-color: var(--fundos);
        }

        .filtro {
            padding-top: 10px;
            display: flex;
            justify-content: center;
            align-items: center;


        }

        input {
            font-size: 20px;
            border-radius: 10px;
        }

        .botao {
            display: flex;
            width: 100%;
            height: 10%;
            justify-content: center;


        }

        .botao a {
            padding: 20px;
            border: #0A1626 solid 1px;
            font-size: 20px;
            text-decoration: none;
            background-color: var(--titulos);
            color: white;
            border-radius: 10px;
        }

        .botao a:hover {
            background-color: var(--fundos);

            transition: 0.4s;


        }

        #Caixaregistrar {
            display: flex;
            width: 99%;
            height: 10%;
            justify-content: flex-end;

        }

        #caixa {


            width: 100%;
            height: 100%;
            margin-right: 100px;
        }

        #botao2 {
            width: 100%;
            height: 100%;
            font-size: 25px;
            padding: 8px;
            background-color: red;
            color: white;

        }
    </style>
</head>

<body>

    <div class="conteiner">
        <div class="titulo">
            <h1>Igreja Presbiteriana da Renovação</h1>
        </div>

        <nav> <a href="/">MENU PRINCIPAL</a></nav>

        <div class="filtro">
            <form action="/filtro/pdf" method="post" require>
                @csrf

                <input type="date" name="dataini" id="dataini" value="{{ isset($dataIni) ? $dataIni : '' }}" required>
                <input type="date" name="datafi" id="datafi" value="{{ isset($dataFi) ? $dataFi : '' }}" required>

                <input style="border-radius: 0px;" type="submit" value="Filtrar" require>
            </form>
        </div>

        <div class="conteiner-colunas">
            <div class="box">
                <div class="box-1">
                    <p>Membros</p>
                </div>
                <div class="box-2">
                    <h1>{{ $qtymembros }}</h1>
                </div>
                <div class="box-3"></div>
            </div>

            <div class="box">
                <div class="box-1">
                    <p style="color: rgb(0, 254, 0);">Dizimos</p>
                </div>
                <div class="box-2">
                    <h1>R${{ number_format($totaldizimos, 2, ',', '.') }}</h1>
                </div>
                <div class="box-3"></div>
            </div>

            <div class="box">

                <div class="box-1">
                    <p style="color: rgb(0, 254, 0);">Ofertas</p>
                </div>
                <div class="box-2">
                    <h1>R${{ number_format($totalofertas, 2, ',', '.') }}</h1>
                </div>
                <div class="box-3"></div>
            </div>

            <div class="box">
                <div class="box-1">
                    <p style="color:red;">Despesas</p>
                </div>
                <div class="box-2">
                    <h1>R${{ number_format($totaldespesas, 2, ',', '.') }}</h1>
                </div>
                <div class="box-3"></div>
            </div>

            <div class="box">
                <div class="box-1">
                    <p style="color:blue;">Saldo Atual</p>
                </div>
                <div class="box-2">
                    <h1>R${{ number_format($saldo, 2, ',', '.') }}</h1>
                </div>
                <div class="box-3"></div>
            </div>

        </div>

        <div class="botao">
            <a target="_blank" href="/gerar/{{ isset($dataIni) ? $dataIni : '1000-01-01' }}/{{ isset($dataFi) ? $dataFi : '5000-01-01' }}">Gerar Relatorio</a>

        </div>

        <div id="Caixaregistrar">
            <form action="/fechar" onsubmit="return minhaFuncao()" method="post">
                <input type="hidden" name="dataini" value="{{ isset($dataIni) ? $dataIni : '' }}">
                <input type="hidden" name="datafi" value="{{ isset($dataFi) ? $dataFi : '' }}">
                <input type="hidden" name="totaldespesas" value="{{$totaldespesas}}">
                <input type="hidden" name="totaldizimos" value="{{$totaldizimos}}">
                <input type="hidden" name="totalofertas" value="{{$totalofertas}}">
                <input type="hidden" name="saldo" value="{{$saldo}}">
                @csrf
                <input id="botao2" class="botao" type="submit" value="Fechar Caixa">
            </form>
        </div>




        <script>
            function minhaFuncao() {
                var resposta = confirm("Você Quer fechar o Caixa Na Data Informada ??");
                if (resposta == true) {


                } else {
                    // Usuário clicou em "Cancelar"
                    alert("Você clicou em Não");
                    // O formulário não será enviado
                    return false;
                }
            }
        </script>




    </div>



    <script>
        var alertMessage = "{{ session('alert') }}";
        if (alertMessage) {
            alert(alertMessage);
        }
    </script>


</body>

</html>