<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Utility</h4>
    </div>
    <div class="card-body">
        <p class="mb-0">
            Utility adalah nilai yang didapatkan dari hasil perkalian nilai kriteria setiap alternatif dengan bobot
            kriteria yang telah dinormalisasi.
        </p>
        <div class="text-center">
            <img src="{{ asset('assets/img/perhitungan/utility.png') }}" alt="utility" class="img-fluid">
        </div>
        <p class="mb-0">
            Contoh : <br>
            <strong>Alternatif A</strong> memiliki nilai kriteria <strong>0.5</strong> dan <strong>0.8</strong> dengan
            bobot kriteria <strong>0.2</strong> dan <strong>0.8</strong>. <br>
            Maka, nilai utility dari <strong>Alternatif A</strong> adalah <strong>0.5 x 0.2 + 0.8 x 0.8 = 0.74</strong>
        </p>

        <p class="mb-0">
            Setelah mendapatkan nilai utility, maka nilai utility tersebut akan dihitung dengan rumus
            <strong>Utility / Total Utility</strong> untuk mendapatkan nilai utility yang telah dinormalisasi.
        </p>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Nilai Utility</h4>
    </div>
    <div class="table-responsive px-3 pb-3">
        <table class="table align-items-center table-hover table-bordered" id="alternatif" data-order="[]">
            <thead class="thead-light">
                <tr>
                    <th>Alternatif</th>
                    @foreach ($kriteria_ as $kriteria)
                    <th data-orderable="false">{{ $kriteria->nama }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($nilai as $value)
                <tr>
                    <th>{{ $value['nama_alternatif'] }}</th>
                    @foreach ($utility as $util)

                        @if($util['nama_alternatif'] == $value['nama_alternatif'])
                        <td>{{ $util['nilai_utility'] }}</td>
                        @endif
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>