<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Normalisasi Kriteria</h4>
    </div>
    <div class="table-responsive px-3 pb-3">
        <table class="table align-items-center table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($kriteria_ as $kriteria)
                    <th>{{ $kriteria->nama }} (C{{ $i++ }})</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($kriteria_ as $kriteria)
                    <td>{{ $kriteria->bobot }}</td>
                    @endforeach
                </tr>
                <tr class="thead-light">
                    <th colspan="{{ count($kriteria_) }}">Nilai Ternomalisasi</th>
                </tr>
                <tr>
                    @foreach($kriteria_ as $kriteria)
                    <td>{{ round($kriteria->normalisasi, 2) }}</td>
                    @endforeach
                </tr>
            </tbody>
            <caption>Total : {{ $kriteria_->pluck('normalisasi')->sum() }}</caption>
        </table>
    </div>
</div>