<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Ingrediente - PratoCerto</title>
</head>
<body>
    <nav>
        <a href="{{ url('/') }}">Início</a> |
        <a href="{{ route('ingredientes.index') }}">Ingredientes</a> |
        <a href="{{ route('pratos.index') }}">Pratos</a> |
        <a href="{{ route('fichas-tecnicas.index') }}">Ficha Técnica</a>
    </nav>

    <hr>
    <h1>Cadastrar novo ingrediente</h1>

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

    <form action="{{ route('ingredientes.store') }}" method="POST">
        @csrf

        <label for="nome">Nome:</label><br>
        <input type="text" name="nome" id="nome" value="{{ old('nome') }}">
        <br><br>

        <label for="unidade_medida">Unidade de medida:</label><br>
        <input type="text" name="unidade_medida" id="unidade_medida" value="{{ old('unidade_medida') }}" placeholder="Ex: kg, g, L, ml, un">
        <br><br>

        <label for="quantidade_estoque">Quantidade em estoque:</label><br>
        <input type="number" step="0.01" name="quantidade_estoque" id="quantidade_estoque" value="{{ old('quantidade_estoque') }}">
        <br><br>

        <label for="custo_unitario">Custo unitário:</label><br>
        <input type="number" step="0.01" name="custo_unitario" id="custo_unitario" value="{{ old('custo_unitario') }}">
        <br><br>

        <label for="estoque_minimo">Estoque mínimo:</label><br>
        <input type="number" step="0.01" name="estoque_minimo" id="estoque_minimo" value="{{ old('estoque_minimo') }}">
        <br><br>

        <button type="submit">Salvar ingrediente</button>
    </form>

    <br>

    <a href="{{ route('ingredientes.index') }}">Voltar para a lista</a>
</body>
</html>