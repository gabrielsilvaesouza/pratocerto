<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pratos - PratoCerto</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav>
        <a href="{{ url('/') }}">Início</a>
        <a href="{{ route('ingredientes.index') }}">Ingredientes</a>
        <a href="{{ route('pratos.index') }}">Pratos</a>
        <a href="{{ route('fichas-tecnicas.index') }}">Ficha Técnica</a>
    </nav>

    <div class="container">
        <h1>Pratos cadastrados</h1>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('pratos.create') }}" class="btn">
            Cadastrar novo prato
        </a>

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Preço de venda</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pratos as $prato)
                    <tr>
                        <td>{{ $prato->nome }}</td>
                        <td>{{ $prato->descricao ?? 'Sem descrição' }}</td>
                        <td>R$ {{ number_format($prato->preco_venda, 2, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('pratos.edit', $prato->id) }}" class="btn btn-secondary">
                                Editar
                            </a>

                            <form action="{{ route('pratos.destroy', $prato->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este prato?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nenhum prato cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>