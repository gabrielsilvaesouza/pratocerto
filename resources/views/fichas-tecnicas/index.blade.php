<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ficha Técnica - PratoCerto</title>
</head>
<body>
    <h1>Ficha Técnica dos Pratos</h1>

    @if (session('success'))
        <p style="color: green;">
            {{ session('success') }}
        </p>
    @endif

    <a href="{{ route('fichas-tecnicas.create') }}">
        Adicionar ingrediente à ficha técnica
    </a>

    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>Prato</th>
                <th>Ingrediente</th>
                <th>Quantidade utilizada</th>
                <th>Custo unitário</th>
                <th>Custo do ingrediente no prato</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($fichasTecnicas as $ficha)
                @php
                    $custoIngrediente = $ficha->quantidade_utilizada * $ficha->ingrediente->custo_unitario;
                @endphp

                <tr>
                    <td>{{ $ficha->prato->nome }}</td>
                    <td>{{ $ficha->ingrediente->nome }}</td>
                    <td>{{ $ficha->quantidade_utilizada }} {{ $ficha->ingrediente->unidade_medida }}</td>
                    <td>R$ {{ number_format($ficha->ingrediente->custo_unitario, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($custoIngrediente, 2, ',', '.') }}</td>

                    <td>
                        <a href="{{ route('fichas-tecnicas.edit', $ficha->id) }}">
                            Editar
                        </a>

                        <form action="{{ route('fichas-tecnicas.destroy', $ficha->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" onclick="return confirm('Tem certeza que deseja remover este item da ficha técnica?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Nenhum item cadastrado na ficha técnica.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>