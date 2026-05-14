<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Ficha Técnica - PratoCerto</title>
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
        <h1>Criar ficha técnica do prato</h1>

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

        <form action="{{ route('fichas-tecnicas.store') }}" method="POST" id="formFichaTecnica">
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

            <h2>Adicionar ingredientes</h2>

            <p>
                Selecione um ingrediente, informe a quantidade utilizada no prato e clique em
                <strong>Adicionar ingrediente</strong>. Depois salve a ficha técnica.
            </p>

            <div class="card">
                <label for="ingrediente_select">Ingrediente:</label><br>
                <select id="ingrediente_select">
                    <option value="">Selecione um ingrediente</option>
                    @foreach ($ingredientes as $ingrediente)
                        <option
                            value="{{ $ingrediente->id }}"
                            data-nome="{{ $ingrediente->nome }}"
                            data-custo="{{ $ingrediente->custo_unitario }}"
                            data-unidade="{{ $ingrediente->unidade_medida }}"
                        >
                            {{ $ingrediente->nome }} - R$ {{ number_format($ingrediente->custo_unitario, 2, ',', '.') }} / {{ $ingrediente->unidade_medida }}
                        </option>
                    @endforeach
                </select>

                <br><br>

                <label for="quantidade_input">Quantidade utilizada:</label><br>
                <input
                    type="number"
                    step="0.001"
                    id="quantidade_input"
                    placeholder="Ex: 0.150"
                >

                <br><br>

                <button type="button" class="btn" onclick="adicionarIngrediente()">
                    Adicionar ingrediente
                </button>
            </div>

            <h2>Ingredientes da ficha técnica</h2>

            <table id="tabelaIngredientes">
                <thead>
                    <tr>
                        <th>Ingrediente</th>
                        <th>Custo unitário</th>
                        <th>Unidade</th>
                        <th>Quantidade utilizada</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <tr id="linhaVazia">
                        <td colspan="5">Nenhum ingrediente adicionado ainda.</td>
                    </tr>
                </tbody>
            </table>

            <br>

            <button type="submit" class="btn">
                Salvar ficha técnica
            </button>

            <a href="{{ route('fichas-tecnicas.index') }}" class="btn btn-secondary">
                Voltar para a ficha técnica
            </a>
        </form>
    </div>

    <script>
        let contadorIngredientes = 0;

        function adicionarIngrediente() {
            const select = document.getElementById('ingrediente_select');
            const quantidadeInput = document.getElementById('quantidade_input');
            const tabela = document.querySelector('#tabelaIngredientes tbody');
            const linhaVazia = document.getElementById('linhaVazia');

            const ingredienteId = select.value;
            const quantidade = quantidadeInput.value;

            if (!ingredienteId) {
                alert('Selecione um ingrediente.');
                return;
            }

            if (!quantidade || quantidade <= 0) {
                alert('Informe uma quantidade válida.');
                return;
            }

            const optionSelecionada = select.options[select.selectedIndex];
            const nome = optionSelecionada.getAttribute('data-nome');
            const custo = optionSelecionada.getAttribute('data-custo');
            const unidade = optionSelecionada.getAttribute('data-unidade');

            if (linhaVazia) {
                linhaVazia.remove();
            }

            const linha = document.createElement('tr');

            linha.innerHTML = `
                <td>
                    ${nome}
                    <input type="hidden" name="ingredientes[${contadorIngredientes}][ingrediente_id]" value="${ingredienteId}">
                </td>

                <td>
                    R$ ${Number(custo).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}
                </td>

                <td>
                    ${unidade}
                </td>

                <td>
                    ${quantidade}
                    <input type="hidden" name="ingredientes[${contadorIngredientes}][quantidade_utilizada]" value="${quantidade}">
                </td>

                <td>
                    <button type="button" class="btn btn-danger" onclick="removerLinha(this)">
                        Remover
                    </button>
                </td>
            `;

            tabela.appendChild(linha);

            contadorIngredientes++;

            select.value = '';
            quantidadeInput.value = '';
        }

        function removerLinha(botao) {
            const linha = botao.closest('tr');
            const tabela = document.querySelector('#tabelaIngredientes tbody');

            linha.remove();

            if (tabela.children.length === 0) {
                tabela.innerHTML = `
                    <tr id="linhaVazia">
                        <td colspan="5">Nenhum ingrediente adicionado ainda.</td>
                    </tr>
                `;
            }
        }
    </script>
</body>
</html>