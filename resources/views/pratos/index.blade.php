<h1>Lista de Pratos</h1>

<a href="{{ route('pratos.create') }}">Cadastrar Novo Prato</a>

<table border="1">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th> <!-- Nova coluna -->
        </tr>
    </thead>
    <tbody>
        @foreach($pratos as $prato)
        <tr>
            <td>{{ $prato->nome }}</td>
            <td>{{ $prato->descricao }}</td>
            <td>R$ {{ number_format($prato->preco_venda, 2, ',', '.') }}</td>
            <td>
                <!-- Botão Editar -->
                <a href="{{ route('pratos.edit', $prato->id) }}">Editar</a>

                <!-- Botão Excluir -->
                <form action="{{ route('pratos.destroy', $prato->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>