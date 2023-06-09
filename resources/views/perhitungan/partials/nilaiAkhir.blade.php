<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Nilai Akhir</h4>
    </div>
    <div class="card-body">
        <p class="mb-0">
            Nilai akhir adalah nilai yang didapatkan dari hasil perkalian nilai utility setiap alternatif dengan normalisasi bobot kriteria.
        </p>
        <div class="text-center">
            <img src="{{ asset('assets/img/perhitungan/nakhir.png') }}" alt="nilai akhir" class="img-fluid">
        </div>
        <p class="mb-0">
            Contoh : <br>
            <strong>Alternatif A1</strong><br>
            <strong>N<small>akhir</small></strong> = (1 * 0.25) + (0.3333333333 * 0.15) + (1 * 0.10) + (1 * 0.10) + (1 * 0.10) + (1 * 0.10) + (0 * 0.05) + (1 * 0.05) + (0.25 * 0.05) + (0.5 * 0.05)<br> 
            <strong>N<small>akhir</small></strong> = 0.25 + 0.05 + 0.10 + 0.10 + 0.10 + 0.10 + 0 + 0.05 + 0.0125 + 0.025<br> 
            <strong>N<small>akhir</small></strong> = 0.78750
        </p>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Nilai Akhir & Ranking</h4>
    </div>
    <div class="table-responsive px-3 pb-3">
        <table class="table align-items-center table-hover table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Alternatif</th>
                    <th>Nilai Akhir</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $a = 1;
                @endphp
                @foreach ($nilaiAkhir as $i)
                <tr>
                    <td>{{ $i['nama_alternatif'] }} (A{{ $a++ }})</td>
                    <td>{{ $i['nilai_akhir'] }}</td>
                    @foreach ($ranking as $r)
                        @if($r['nama_alternatif'] == $i['nama_alternatif'])
                        <td>{{ $r['ranking'] }}</td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
