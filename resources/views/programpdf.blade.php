<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Programas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            position: relative;
            min-height: 100vh;
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header img {
            width: 150px;
            display: block;
            margin: 0 auto;
        }

        header h1 {
            font-size: 24px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-transform: uppercase;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            width: 100%;
            text-align: center;
            font-size: 12px;
            color: #555;
        }

        footer a {
            color: #555;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        footer img {
            width: 150px;
            display: block;
            margin: 10px auto 0;
        }

        /* Numeración de páginas */
        @page {
            margin: 0;
            size: auto;
        }

        footer:after {
            content: "Página " counter(page) " de " counter(pages);
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('images/LOGOCTI.png') }}" alt="Logo">
        <h1>Lista de Programas</h1>
    </header>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Título</th>
                <th>Creador</th>
                <th>Coordinador</th>
                <th>Fecha de Creación</th>
                <th>Cantidad Beneficiarios</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($adminprogram as $programa)
                <tr>
                    <td>{{ $programa->id }}</td>
                    <td>{{ $programa->title }}</td>
                    <td>{{ $programa->creator ? $programa->creator->name : '' }}</td>
                    <td>{{ $programa->coordinator ? $programa->coordinator->name : '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($programa->created_at)->format('d/m/Y H:i') }}</td>
                    <td>{{ $programa->users->count() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <footer>
        <p>
            <span>Para más información, consulta nuestros <a href="../terms-conditions" target="_blank">Términos y Condiciones</a>.</span>
        </p>
        <img src="{{ public_path('images/LOGOCTI.png') }}" alt="Logo">
    </footer>

</body>

</html>
