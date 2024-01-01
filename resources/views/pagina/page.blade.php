<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 0px;
            padding: 0px;
        }

        :root {
    
    --titulos: #0A1626 ; 
    --subtitulos:#023859 ;
    --fundos:#0D8AA6 ;
    --cor-secundaria:#5353533d ;
}


body{
    background-color: var(--cor-secundaria);
}

    .titulo{
        border: 1px solid black;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 10vh;
        background-color: #0A1626;
        color: white;
    }

    nav{
        border: 1px solid black;
        display: flex;
        width: 100%;
        height: 5vh;
        justify-content: flex-start;
        align-items: center;
        background-color: var(--subtitulos);
        
    }

    .conteiner-colunas {
        border: 1px solid black;
        width: 100%;
        height: 80vh;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: self-start;
        
        
    }

    .box{
        border: 1px solid black;
        width: 20%;
        height: 25%;
        margin-top: 40px;
        

        
    }

    .box-1{
        display: flex;
        width: 100%;
        height: 15%;
        border: 1px solid black;
        justify-content: center;
        align-items: center;
        background-color: #0A1626;
        color: white;
    }

    .box-2{
        display: flex;
        width: 100%;
        height: 65%;
        border: 1px solid black;
        background-color: white;
        justify-content: center;
        align-items: center;
    }

    .box-3{
        display: flex;
        width: 100%;
        height: 18%;
        border: 1px solid black;
        justify-content: center;
        align-items: center;
        background-color: var(--subtitulos);
        color: white;
    }

    a{
        font-size: 20px;
        text-decoration: none;
        color: black;
        border: 1px solid black;
        padding: 6px;
        color: white;
    }

    a:hover{
        background-color: var(--titulos);
        color: white;
    }






    </style>
</head>
<body>

<div class="conteiner">
<div class="titulo"> <h1>Igreja Presbiteriana da Renovação</h1> </div>

<nav> <a href="#">Dashboard</a></nav>

<div class="conteiner-colunas">
  <div class="box">
  <div class="box-1" > <p>Membros</p> </div>
    <div class="box-2" ><h1>{{ $qtymembros }}</h1></div>
    <div class="box-3" > <p>Relatorio => </p> </div>
  </div>

  <div class="box">
    <div class="box-1" > <p>Dizimos</p> </div>
    <div class="box-2" ><h1>R${{$totaldizimos}}</h1></div>
    <div class="box-3" > <p>Relatorio => </p> </div>
  </div>

  <div class="box">
    <div class="box-1" > <p>Ofertas</p> </div>
    <div class="box-2" ><h1>R${{$totalofertas}}</h1></div>
    <div class="box-3" > <p>Relatorio =></p> </div>
  </div>

  <div class="box">
    <div class="box-1" > <p>Despesas</p> </div>
    <div class="box-2" ><h1>R${{$totaldespesas}}</h1></div>
    <div class="box-3" > <p>Relatorio =></p> </div>
  </div>




</div>

</div>
</body>
</html>