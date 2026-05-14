<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Item - Ficha Técnica</title>
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
        <h1>Adicionar ingrediente à ficha técnica</h1>

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

        <form action="{{ route('fichas-tecnicas.store') }}" method="POST">
            @csrf

            <label for="prato_id">Prato:</label><br>
            <select name="prato_id" id="prato_id">
                <option value="">Selecione um prato</option>
                @foreach ($pratos as $prato)
                    <option value="{{ $prato->id }}" {{ old('prato_id') == $prato->id ? 'selected' : '' }}>
                        {{ $prato->nome }}
                    </option>
                @endforeach
            </select>
            <br><br>

            <label for="ingrediente_id">Ingrediente:</label><br>
            <select name="ingrediente_id" id="ingrediente_id">
                <option value="">Selecione um ingrediente</option>
                @foreach ($ingredientes as $ingrediente)
                    <option value="{{ $ingrediente->id }}" {{ old('ingrediente_id') == $ingrediente->id ? 'selected' : '' }}>
                        {{ $ingrediente->nome }} - R$ {{ number_format($ingrediente->custo_unitario, 2, ',', '.') }} / {{ $ingrediente->unidade_medida }}
                    </option>
                @endforeach
            </select>
            <br><br>

            <label for="quantidade_utilizada">Quantidade utilizada:</label><br>
            <input type="number" step="0.001" name="quantidade_utilizada" id="quantidade_utilizada" value="{{ old('quantidade_utilizada') }}">
            <br><br>

            <button type="submit" class="btn">
                Adicionar à ficha técnica
            </button>

            <a href="{{ route('fichas-tecnicas.index') }}" class="btn btn-secondary">
                Voltar para a ficha técnica
            </a>
        </form>
    </div>
</body>
</html>