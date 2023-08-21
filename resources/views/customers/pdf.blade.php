<!DOCTYPE html>
<html>
<head>
    <title>Clientes PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>
</head>
<body>
    <h1>Lista de Clientes</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>CPF</th>
                <th>Nome Completo</th>
                <th>Data de Nascimento</th>
                <th>Sexo</th>
                <th>Endereço</th>
                <th>Estado</th>
                <th>Cidade</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>{{ $cliente->getCpfFormatado() }}</td>
                <td>{{ $cliente->nome_completo }}</td>
                <td>{{ $cliente->dataNascimento() }}</td>
                <td>{{ $cliente->getSexo()  }}</td>
                <td>{{ $cliente->endereco }}</td>
                <td>{{ $cliente->estado }}</td>
                <td>{{ $cliente->cidade }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
