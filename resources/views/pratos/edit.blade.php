<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Prato - PratoCerto</title>
</head>
<body>
    <h1>Editar prato: {{ $prato->nome }}</h1>

    @if ($errors->any())
        <div style="color: red;">
            <p>Existem erros no formulário:</p>

            <ul>
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pratos.update', $prato->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="nome">Nome do prato:</label><br>
        <input type="text" name="nome" id="nome" value="{{ old('nome', $prato->nome) }}">
        <br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea name="descricao" id="descricao" rows="4" cols="40">{{ old('descricao', $prato->descricao) }}</textarea>
        <br><br>

        <label for="preco_venda">Preço de venda:</label><br>
        <input type="number" step="0.01" name="preco_venda" id="preco_venda" value="{{ old('preco_venda', $prato->preco_venda) }}">
        <br><br>

        <button type="submit">Atualizar prato</button>
    </form>

    <br>

    <a href="{{ route('pratos.index') }}">Voltar para a lista</a>
</body>
</html>