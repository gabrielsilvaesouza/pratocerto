<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Ficha Técnica - PratoCerto</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .modal-overlay {
            display: none;
            position: fixed;
            z-index: 999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(17, 24, 39, 0.65);
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-content {
            background-color: #ffffff;
            width: 90%;
            max-width: 900px;
            max-height: 85vh;
            overflow-y: auto;
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.25);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-bottom: 16px;
        }

        .modal-header h2 {
            margin: 0;
        }

        .modal-close {
            background-color: #dc2626;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .modal-close:hover {
            background-color: #b91c1c;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ url('/') }}">Início</a>
        <a href="{{ route('ingredientes.index') }}">Ingredientes</a>
        <a href="{{ route('pratos.index') }}">Pratos</a>
        <a href="{{ route('fichas-tecnicas.index') }}">Ficha Técnica</a>
    </nav>

    <div class="container">
        <h1>Ficha Técnica dos Pratos</h1>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('fichas-tecnicas.create') }}" class="btn">
            Criar ficha técnica
        </a>

        <h2>Resumo de custos por prato</h2>

        <table>
            <thead>
                <tr>
                    <th>Prato</th>
                    <th>Preço de venda</th>
                    <th>Custo total</th>
                    <th>Margem estimada</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($pratos as $prato)
                    @php
                        $custoTotal = 0;

                        foreach ($prato->fichaTecnicas as $item) {
                            $custoTotal += $item->quantidade_utilizada * $item->ingrediente->custo_unitario;
                        }

                        $margemEstimada = $prato->preco_venda - $custoTotal;

                        $primeiroItemFicha = $prato->fichaTecnicas->first();
                    @endphp

                    <tr>
                        <td>{{ $prato->nome }}</td>
                        <td>R$ {{ number_format($prato->preco_venda, 2, ',', '.') }}</td>
                        <td>R$ {{ number_format($custoTotal, 2, ',', '.') }}</td>

                        <td>
                            @if ($margemEstimada < 0)
                                <span class="status-baixo">
                                    R$ {{ number_format($margemEstimada, 2, ',', '.') }}
                                </span>
                            @else
                                <span class="status-ok">
                                    R$ {{ number_format($margemEstimada, 2, ',', '.') }}
                                </span>
                            @endif
                        </td>

                        <td>
                            @if ($primeiroItemFicha)
                                <a href="{{ route('fichas-tecnicas.edit', $primeiroItemFicha->id) }}" class="btn btn-secondary">
                                    Editar
                                </a>

                                <button type="button" class="btn" onclick="abrirModal('{{ $prato->id }}')">
                                    Detalhes
                                </button>
                            @else
                                <a href="{{ route('fichas-tecnicas.create') }}" class="btn">
                                    Criar ficha
                                </a>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Nenhum prato cadastrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @foreach ($pratos as $prato)
        @if ($prato->fichaTecnicas->count() > 0)
            <div id="modal-{{ $prato->id }}" class="modal-overlay">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Detalhes da ficha técnica: {{ $prato->nome }}</h2>

                        <button type="button" class="modal-close" onclick="fecharModal('{{ $prato->id }}')">
                            Fechar
                        </button>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Ingrediente</th>
                                <th>Quantidade utilizada</th>
                                <th>Custo unitário</th>
                                <th>Custo do ingrediente no prato</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($prato->fichaTecnicas as $item)
                                @php
                                    $custoIngrediente = $item->quantidade_utilizada * $item->ingrediente->custo_unitario;
                                @endphp

                                <tr>
                                    <td>{{ $item->ingrediente->nome }}</td>
                                    <td>{{ $item->quantidade_utilizada }} {{ $item->ingrediente->unidade_medida }}</td>
                                    <td>R$ {{ number_format($item->ingrediente->custo_unitario, 2, ',', '.') }}</td>
                                    <td>R$ {{ number_format($custoIngrediente, 2, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    @endforeach

    <script>
        function abrirModal(pratoId) {
            const modal = document.getElementById('modal-' + pratoId);
            modal.style.display = 'flex';
        }

        function fecharModal(pratoId) {
            const modal = document.getElementById('modal-' + pratoId);
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal-overlay')) {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>
</html>