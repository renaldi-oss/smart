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
            <strong>Alternatif Ibnu Hajar</strong><br>
            <strong>N<small>akhir</small></strong> = (0.5 * 0.12) + (0 * 0.1) + (0 * 0.12) + (1 * 0.1) + (0.5 * 0.12) + (0.5 * 0.1) + (1 * 0.08) + (0.5 * 0.08) + (1 * 0.08) + (1 * 0.1)<br>
            <strong>N<small>akhir</small></strong> = (0.06) + (0) + (0) + (0.1) + (0.06) + (0.05) + (0.08) + (0.04) + (0.08) + (0.1) <br>
            <strong>N<small>akhir</small></strong> = 0.57
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
                @foreach ($nilaiAkhir as $i)
                <tr>
                    <td>{{ $i['nama_alternatif'] }}</td>
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
