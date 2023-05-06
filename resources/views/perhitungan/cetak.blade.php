<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Data | {{ config('app.name')}}</title>
    <style>
        .print-doc {
            color: black !important;
            font-family: "Times New Roman", Times, serif !important;
        }

        .header {
            font-weight: bold;
            text-align: center;
            text-decoration: underline solid black auto;
            margin: 25px;
        }

        table {
            width: 100%;
            border-spacing: 0px;
            border-collapse: collapse;
            margin: auto;
        }

        tr,
        th {
            border: thin solid black;
            vertical-align: middle;
            text-align: center;
            padding: 10px;
        }

        tr,
        td {
            border: thin solid black;
            padding: 10px;
            padding: 5px;
        }
    </style>
</head>

<body>
    <h4 class="header">Normalisasi Kriteria</h4>
    <table>
        <thead>
            <tr>
                @foreach ($kriteria_ as $kriteria)
                <th>{{ $kriteria->nama }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($kriteria_ as $kriteria)
                <td>{{ $kriteria->bobot }}</td>
                @endforeach
            </tr>
            <tr>
                <th colspan="{{ count($kriteria_) }}">Nilai Ternomalisasi</th>
            </tr>
            <tr>
                @foreach($kriteria_ as $kriteria)
                <td>{{ round($kriteria->normalisasi, 3) }}</td>
                @endforeach
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="{{ count($kriteria_) }}">
                    Jumlah : {{ $kriteria_->pluck('normalisasi')->sum() }}
                </th>
            </tr>
        </tfoot>
    </table>
    <h4 class="header">Data Alternatif</h4>
    <table>
        <thead>
            <tr>
                <th>Alternatif</th>
                @foreach ($kriteria_ as $kriteria)
                <th><?= str_replace(' ', '<br>', $kriteria->nama) ?></th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($nilai as $value)
            <tr>
                <th>{{ $value['nama_alternatif'] }}</th>
                @foreach ($value['bobot_parameter'] as $item)
                <td>{{ $item }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    <h4 class="header">Normalisasi Data Alternatif</h4>
    <table>
        <thead>
            <tr>
                <th>Alternatif</th>
                @foreach ($kriteria_ as $kriteria)
                <th><?= str_replace(' ', '<br>', $kriteria->nama) ?></th>
                @endforeach
                <th>Total</th>
                <th>Peringkat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($nilai->sortByDesc('total', SORT_NATURAL) as $value)
            <tr @once style="font-weight: bold" @endonce>
                <th>{{ $value['nama_alternatif'] }}</th>
                @foreach ($value['nilai_parameter'] as $item)
                <td>{{ round($item, 2) }}</td>
                @endforeach
                <td>{{ round($value['total'], 3) }}</td>
                <td>{{ $loop->iteration }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
