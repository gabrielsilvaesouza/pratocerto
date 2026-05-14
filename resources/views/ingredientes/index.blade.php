<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>PratoCerto - Ingredientes</title>
</head>
<body>
    <nav>
        <a href="{{ url('/') }}">Início</a> |
        <a href="{{ route('ingredientes.index') }}">Ingredientes</a> |
        <a href="{{ route('pratos.index') }}">Pratos</a> |
        <a href="{{ route('fichas-tecnicas.index') }}">Ficha Técnica</a>
    </nav>

    <hr>
    <h1>Ingredientes cadastrados</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('ingredientes.create') }}">
        Cadastrar novo ingrediente
    </a>

    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Unidade</th>
                <th>Quantidade em estoque</th>
                <th>Custo unitário</th>
                <th>Estoque mínimo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($ingredientes as $ingrediente)
                <tr>
                    <td>{{ $ingrediente->nome }}</td>
                    <td>{{ $ingrediente->unidade_medida }}</td>
                    <td>{{ $ingrediente->quantidade_estoque }}</td>
                    <td>R$ {{ number_format($ingrediente->custo_unitario, 2, ',', '.') }}</td>
                    <td>{{ $ingrediente->estoque_minimo }}</td>

                    <td>
                        @if ($ingrediente->quantidade_estoque <= $ingrediente->estoque_minimo)
                            <span style="color: red;">Estoque baixo</span>
                        @else
                            <span style="color: green;">Ok</span>
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('ingredientes.edit', $ingrediente->id) }}">
                            Editar
                        </a>

                        <form action="{{ route('ingredientes.destroy', $ingrediente->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este ingrediente?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Nenhum ingrediente cadastrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>