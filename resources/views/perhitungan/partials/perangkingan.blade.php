<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Perankingan Alternatif</h4>
    </div>
    <div class="table-responsive px-3 pb-3">
        <table class="table align-items-center table-hover table-bordered" id="hasil" data-order="[]">
            <thead class="thead-light">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($kriteria_ as $kriteria)
                    <th data-orderable="false">{{ $kriteria->nama }}</th>
                    @endforeach
                    <th>Total</th>
                    <th>Peringkat</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($nilai->sortByDesc('total', SORT_NATURAL) as $value)
                <tr @once class="bg-primary text-white" @endonce>
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
    </div>
</div>