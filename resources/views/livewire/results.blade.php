<div>


<table> <!-- Tabela Não necessita de Div pois so Existe ela dentro do #conteudo do Layout -->
    <tr>
        <th class="remover">ID</th>
        <th>NOME</th>
        <th class="remover">ENDEREÇO</th>
        <th>FUNÇÃO</th>
        <th>TELEFONE</th>
        <th>PRESENÇA %</th>
        <th>X</th>
        <th>X</th>
    </tr>
    @foreach ($index as $ind)
    <tr>
        <td class="remover" style="background-color:#0A1626 ; color:white">{{ $ind->id }}</td>
        <td>{{ $ind->nome }}</td>
        <td class="remover">{{ $ind->endereco }}</td>
        <td>{{ $ind->funcao }}</td>
        <td>{{ $ind->telefone }}</td>
        <td>
    {{ isset($ind->presenca) && $qtdEventos > 0 ? round(($ind->presenca / $qtdEventos) * 100) : 0 }}%
</td>
        <td id="inserir-verde">
            <form action="/inserir/dizimos" method="post">
                @csrf
                <input type="hidden" name="membro_id" value="{{$ind->id}}">
                <input type="hidden" name="nome" value="{{$ind->nome}}">
                <input style="width: 100%; height: 100%; color:white;" type="submit" value="Inserir">
            </form>
        </td>
        <td id="X">
            <a style="color: white; text-decoration: none;" href="/destroy/{{$ind->id}}">X</a>
        </td>
    </tr>
    @endforeach
</table>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.links-1');
        links.forEach(link => {
            link.style.backgroundColor = 'rgb(228, 228, 228)';
            link.style.color = 'black';
        });
    });
</script>


</div>