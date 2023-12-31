<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerencimento de Igrejas</title>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>

    <div class="conteiner-geral">

        <div class="conteiner-titulo">

            <h1>Igreja Prebiteriana da Renovação
            </h1>
        </div>

        <main class="conteiner-menu-pesquisa-conteudo">
            
            <div class="menu-esquerdo">
                <h1 class="h1-menu">Menu</h1>
                <a href="/">Home</a>
                <a href="/cadastro/membro">Cadastro Membro</a>
                <a href="/oferta">Cadastro Oferta</a>
                <a href="/despesas">Cadastro Despesas</a>
                <a href="/caixa">Caixa</a>
                <a href="/relatorio">Relatorios</a>
            </div>

            <div class="conteiner-navtable">






                <div class="conteiner-tabela">


                    {{ $slot }}


                </div>
            </div>

        </main>

        <div class="barrainferior">@Copyright</div>

    </div>

    </div>






</body>

</html>