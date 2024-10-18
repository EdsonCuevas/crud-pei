<script setup>
    import AuthenticatedLayout from '@/Layouts/Admin/AuthenticatedLayout.vue';
    import {
        Head,
        useForm
    } from '@inertiajs/vue3';
    import NavLink from '@/Components/NavLink.vue';
    import Pagination from '@/Components/Pagination.vue';
    import Modal from '@/Components/Modal.vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import SecondaryButton from '@/Components/SecondaryButton.vue';
    import WarningButton from '@/Components/WarningButton.vue';
    import DarkButton from '@/Components/DarkButton.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import {
        ref
    } from 'vue';
</script>

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


</body>

</html>
