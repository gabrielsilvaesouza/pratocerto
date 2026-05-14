<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>PratoCerto</title>
</head>
<body>
    <h1>PratoCerto</h1>

    <p>
        Sistema simples para controle de ingredientes, pratos, fichas técnicas
        e cálculo de custo para restaurantes.
    </p>

    <hr>

    <h2>Módulos do sistema</h2>

    <ul>
        <li>
            <a href="{{ route('ingredientes.index') }}">
                Gerenciar Ingredientes
            </a>
        </li>

        <li>
            <a href="{{ route('pratos.index') }}">
                Gerenciar Pratos
            </a>
        </li>

        <li>
            <a href="{{ route('fichas-tecnicas.index') }}">
                Gerenciar Fichas Técnicas
            </a>
        </li>
    </ul>

    <hr>

    <h2>Objetivo do sistema</h2>

    <p>
        O PratoCerto ajuda pequenos restaurantes a entenderem melhor seus custos,
        evitando decisões baseadas apenas no achismo. A partir do cadastro de
        ingredientes e pratos, o sistema permite montar fichas técnicas e calcular
        o custo estimado de produção de cada prato.
    </p>
</body>
</html>