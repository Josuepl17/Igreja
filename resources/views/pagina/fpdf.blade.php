<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        h1 {
            text-align: center;
        }

        .conteiner {
            display: flex;
            margin: auto;
            width: 50%;
            justify-content: center;
        }

        table {
            border-collapse: collapse;
            


            margin: auto;

            width: 100%;
            background-color: white;
            margin-top: 0px;
            color: black;

        }

        td {

            border: 1px solid black;
            text-align: center;
            font-size: 18px;
            margin-top: 0px;
            margin-bottom: 0px;
        }

        th {
            border: 1px solid black;
            font-size: 20px;
            color: rgb(0, 0, 0);
            background-color: var(--subtitulos);

            top: -1px;
            padding-top: 5px;

        }

        tr {
            border: 1px solid black;
        }

        p{
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Relatorio Mensal Dizimos</h1>
    <hr>

    <div class="conteiner">


        <table>



            <tr style="border-bottom: 1px solid black;" >
                <th>ID</th>
                <th>DATA</th>
                <th>VALOR</th>
                



            </tr>


            @foreach ($dizimos as $dizimo)


            <tr>
                <td>{{ $dizimo->id}}</td>


                <td>{{ \Carbon\Carbon::parse($dizimo->data)->format('d/m/Y') }}</td>
                <td>R$ {{ number_format($dizimo->valor, 2, ',', '.') }}</td>
                


            </tr>



            @endforeach

            
             <tr>
                <td colspan="3" style="font-weight: bold;" >TOTAL: R$ {{ number_format($totaldizimos, 2, ',', '.') }}</td>
                
             </tr>   
            

        </table>


    </div>

    <br>
    <br>

    <p>__________________________</p>
                <p>Ass</p>







    

</body>

</html>