<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Ingrediente - PratoCerto</title>
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
        <h1>Editar ingrediente</h1>

        @if ($errors->any())
            <div class="alert-error">
                <p>Existem erros no formulário:</p>

                <ul>
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('ingredientes.update', $ingrediente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="nome">Nome:</label><br>
            <input type="text" name="nome" id="nome" value="{{ old('nome', $ingrediente->nome) }}">
            <br><br>

            <label for="unidade_medida">Unidade de medida:</label><br>
            <input type="text" name="unidade_medida" id="unidade_medida" value="{{ old('unidade_medida', $ingrediente->unidade_medida) }}">
            <br><br>

            <label for="quantidade_estoque">Quantidade em estoque:</label><br>
            <input type="number" step="0.01" name="quantidade_estoque" id="quantidade_estoque" value="{{ old('quantidade_estoque', $ingrediente->quantidade_estoque) }}">
            <br><br>

            <label for="custo_unitario">Custo unitário:</label><br>
            <input type="number" step="0.01" name="custo_unitario" id="custo_unitario" value="{{ old('custo_unitario', $ingrediente->custo_unitario) }}">
            <br><br>

            <label for="estoque_minimo">Estoque mínimo:</label><br>
            <input type="number" step="0.01" name="estoque_minimo" id="estoque_minimo" value="{{ old('estoque_minimo', $ingrediente->estoque_minimo) }}">
            <br><br>

            <button type="submit" class="btn">
                Atualizar ingrediente
            </button>

            <a href="{{ route('ingredientes.index') }}" class="btn btn-secondary">
                Voltar para a lista
            </a>
        </form>
    </div>
</body>
</html>