<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>PratoCerto</title>
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
        <h1>PratoCerto</h1>

        <p>
            Sistema simples para controle de ingredientes, pratos, fichas técnicas
            e cálculo de custo para restaurantes.
        </p>

        <div class="home-links">
            <a href="{{ route('ingredientes.index') }}" class="btn">
                Gerenciar Ingredientes
            </a>

            <a href="{{ route('pratos.index') }}" class="btn">
                Gerenciar Pratos
            </a>

            <a href="{{ route('fichas-tecnicas.index') }}" class="btn">
                Gerenciar Fichas Técnicas
            </a>
        </div>

        <div class="card">
            <h2>Objetivo do sistema</h2>

            <p>
                O PratoCerto ajuda pequenos restaurantes a entenderem melhor seus custos,
                evitando decisões baseadas apenas no achismo. A partir do cadastro de
                ingredientes e pratos, o sistema permite montar fichas técnicas e calcular
                o custo estimado de produção de cada prato.
            </p>
        </div>

        <div class="card">
            <h2>Funcionalidades principais</h2>

            <ul>
                <li>Cadastro e controle de ingredientes.</li>
                <li>Cadastro de pratos com preço de venda.</li>
                <li>Montagem de ficha técnica por prato.</li>
                <li>Cálculo automático do custo de produção.</li>
                <li>Estimativa de margem entre custo e preço de venda.</li>
                <li>Alerta visual para ingredientes com estoque baixo.</li>
            </ul>
        </div>
    </div>
</body>
</html>