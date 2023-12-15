'       <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <main class="d-flex flex-nowrap">

        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark __web-inspector-hide-shortcut__" style="width: 280px; height: 1000px">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-5">Sistema de Abastecimento</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active" aria-current="page">
                        <svg class="bi pe-none me-2" width="16" height="16">
                            <use xlink:href="#home"></use>
                        </svg>
                        Painel
                    </a>
                </li>
            </ul>
        </div>

        <div class="b-example-divider b-example-vr"></div>

        <div class="container mt-5 px-5">
            <h1>
                Controle de Abastecimento
            </h1>
            <hr class="mb-5">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Qtd. ml</th>
                        <th scope="col">Veículo</th>
                        <th scope="col">Funcionário</th>
                        <th scope="col">Data de Abastecimento</th>
                    </tr>
                </thead>
                <tbody style="max-height: 30px; overflow-y: scroll;">
                        @foreach ($dados as $dado)
                        <tr>
                            <th scope="row">1</th>
                            <td>{{ $dado->Quantidade_ML }}</td>
                            <td>{{ $dado->uid_funcionario }}</td>
                            <td>{{ $dado->uid_veiculo }}</td>
                            <td>{{ $dado->data_formatada }}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>


        <div class="b-example-divider b-example-vr"></div>
    </main>
</body>

</html>