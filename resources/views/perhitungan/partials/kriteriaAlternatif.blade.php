<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Nilai Kriteria Setiap Alternatif</h4>
    </div>
    <div class="table-responsive px-3 pb-3">
        <table class="table align-items-center table-hover table-bordered" id="alternatif" data-order="[]">
            <thead class="thead-light">
                <tr>
                    <th>Alternatif</th>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($kriteria_ as $kriteria)
                    <th data-orderable="false">{{ $kriteria->nama }} (C{{ $i++ }})</th>
                    @endforeach
                    @php
                        $i = 1;
                    @endphp
                </tr>
            </thead>
            <tbody>
                @foreach ($nilai as $value)
                <tr>
                    <th>{{ $value['nama_alternatif'] }} (A{{ $i++ }})</th>
                    @foreach ($value['bobot_parameter'] as $item)
                    <td>{{ $item }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>