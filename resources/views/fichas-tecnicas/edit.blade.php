<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Item - Ficha Técnica</title>
</head>
<body>
    <h1>Editar item da ficha técnica</h1>

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

    <form action="{{ route('fichas-tecnicas.update', $fichaTecnica->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="prato_id">Prato:</label><br>
        <select name="prato_id" id="prato_id">
            @foreach ($pratos as $prato)
                <option value="{{ $prato->id }}" {{ old('prato_id', $fichaTecnica->prato_id) == $prato->id ? 'selected' : '' }}>
                    {{ $prato->nome }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label for="ingrediente_id">Ingrediente:</label><br>
        <select name="ingrediente_id" id="ingrediente_id">
            @foreach ($ingredientes as $ingrediente)
                <option value="{{ $ingrediente->id }}" {{ old('ingrediente_id', $fichaTecnica->ingrediente_id) == $ingrediente->id ? 'selected' : '' }}>
                    {{ $ingrediente->nome }} - R$ {{ number_format($ingrediente->custo_unitario, 2, ',', '.') }} / {{ $ingrediente->unidade_medida }}
                </option>
            @endforeach
        </select>
        <br><br>

        <label for="quantidade_utilizada">Quantidade utilizada:</label><br>
        <input type="number" step="0.001" name="quantidade_utilizada" id="quantidade_utilizada" value="{{ old('quantidade_utilizada', $fichaTecnica->quantidade_utilizada) }}">
        <br><br>

        <button type="submit">Atualizar item</button>
    </form>

    <br>

    <a href="{{ route('fichas-tecnicas.index') }}">Voltar para a ficha técnica</a>
</body>
</html>