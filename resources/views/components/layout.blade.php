<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('tela')</title>
    <style>
        :root {
            --CorBase: #00042a;
            --CorBase2: #222326;
            --Corbase3: #034159;
            --Corbase4: #03030394;
        }

        :root {

            --titulos: #0a1727;
            --subtitulos: #012841;
            --fundos: #37383842;
            --cor-secundaria: #5353533d;
        }

        body {
            padding: 0px;
            margin: 0px;
        }

        * {
            padding: 0;
            margin: 0;
        }

        #conteiner-geral {

            width: 100%;
            height: 98vh;

        }


        #conteiner-nav {
            display: flex;
            background-color: var(--titulos);
            height: 08%;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255, 255, 255, 0.271);
            border-top: 1px solid rgba(255, 255, 255, 0.314);


        }

        #conteiner-nav h1 {
            color: white;
            margin-left: 15px;
        }

        #conteiner-nav p {
            color: white;
            margin-right: 15px;
        }

        /*......................................................*/


        #menu-subtable {
            display: flex;
            flex-direction: row;
            width: 100%;
            height: 92%;

        }

        #menu {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 16%;
            height: 100%;
            min-width: 150px;
            /*importante para Responsividade*/
            /*determina o tanto que o menu pode se diminuir para que a tabela não caia no overflow*/

        }

        .links {
            display: flex;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            border-bottom: 1px solid rgba(0, 0, 0, 0.211);
            width: 100%;
            height: 5%;
            color: black;


        }



        .links:hover {
            background-color: var(--subtitulos);
            color: white;
            transition: 0.4s;
        }

        #menu h1 {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 16px;
            background-color: var(--titulos);
            color: white;
            height: 04%;
            width: 100%;
            border-bottom: 1px solid black;
            white-space: nowrap;
        }

        #subtabela {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            width: 100%;
            height: 07%;
            background-color: var(--subtitulos);
            border-bottom: 1px solid rgba(255, 255, 255, 0.445);

        }


        /*...................................................................*/

        #subtabela-conteudo {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: var(--fundos);

        }

        /*atenção*/
        #subtabela form {
            display: flex;
            height: 100%;
            justify-content: flex-end;
            align-items: center;
        }

        #subtabela form input {
            margin-right: 15px;
            font-size: 16px;
            border: 1px solid black;
            padding: 2px;
            height: 70%;

        }

        #subtabela a {
            margin-right: 15px;
        }


        #open-menu {
            display: none;
        }

        /*..........................................................*/

        #conteudo {
            overflow: auto; /*rolagem tela de membros,as demais telas tem suas propiasrolagem */
            height: 88%;
            width: 97%;
            margin-top: 0.5%;
            background-color: white;
            border-radius: 5px;
            background-color: var(--cor-secundaria);


        }

        /*............... mudanças Telefone................*/

        @media (max-width: 700px) {
            /* Para diminuir tem que cortar texto */
            /*importante para Responsividade*/

            #open-menu {
                display: block;
                position: fixed;
                top: 08px;
                left: 20px;
                cursor: pointer;
                color: #fff;
                font-size: 24px;
            }

            #menu {
                width: 250px;
                height: 100%;
                position: fixed;
                top: 0;
                left: -250px;
                transition: left 0.3s ease;
                background-color: var(--CorBase);
                z-index: 1;

            }

            #menu a {
                color: white;

            }

            #menu h1 {
                background-color: white;
                color: black;
                height: 7%;
            }

            #conteiner-nav h1 {
                display: none;
                text-align: end;
            }

            #conteiner-nav {
                display: flex;
                justify-content: flex-end;
            }

            .remover {
                /* CSS criado para remover itens da Tela para Celular*/
                display: none;
                /*importante para Responsividade*/
            }

            #subtabela form {
                display: flex;
                height: 100%;
                justify-content: flex-end;
                align-items: center;
            }

            #subtabela form input {
                margin-right: 15px;
                font-size: 14px;
                border: 1px solid black;
                padding: 2px;
                height: 60%;
            }
        }
    </style>
</head>

<body>
    <div id="conteiner-geral">

        <nav id="conteiner-nav">
            <h1> @yield('nome_igreja') </h1>
            <p>Bem Vindo {{ Auth::User()->user }} !</p>
        </nav> <!--conteiner-nav-->

        <div id="menu-subtable">
            <div id="menu">
                <h1>Menu</h1>
                <a class="links" href="/">Home</a>
                <a class="links" href="/oferta">Ofertas</a>
                <a class="links" href="/despesas">Despesas</a>
                <a class="links" href="/relatorio">Relatorios</a>
                <a class="links" href="/indexcaixa">Caixa</a>
                <a class="links" href="/user/profile">Usuarios</a>
                <a class="links" href="/cadastro/login/novo">Novo Usuario</a>
                <a class="links" href="/logout"><img src="{{ asset('\sair.png') }}" alt="">&nbspLogout</a>
                <div id="open-menu">&#9776;</div>
            </div> <!--menu-->

            <div id="subtabela-conteudo">
                <div id="subtabela">
                    @yield('botao-tabela')
                </div> <!--subtabela-->
                <div id="conteudo">


                    @yield('conteudo')




                </div> <!--conteudo-->

                <div id="valor-registrar">
                    @yield('valor-registrar')
                </div>

            </div> <!--subtabela-conteudo-->

        </div> <!--conteiner-nav-->

    </div> <!--menu-subtable-->
</body>
<script>
    const menu = document.querySelector('#menu');
    const openMenuButton = document.getElementById('open-menu');

    openMenuButton.addEventListener('click', () => {
        menu.style.left = menu.style.left === '0px' ? '-250px' : '0px';
    });
</script>

</html>