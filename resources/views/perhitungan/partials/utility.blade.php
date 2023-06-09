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
            <strong>Alternatif A1</strong> memiliki nilai kriteria <strong>4</strong> dengan
            <strong>kriteria maximal</strong> : <strong>4</strong> dan <strong>kriteria minimal</strong> : <strong>3</strong><br>
            {{-- perhitungan  --}}
            <strong>C<small>out</small></strong> = (4 - 3) / (4 - 3) <br>
            <strong>C<small>out</small></strong> = 1 / 1 <br>
            <strong>C<small>out</small></strong> = 1 <br>
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
                    @php
                        $i = 1;
                    @endphp
                    @foreach ($kriteria_ as $kriteria)
                    <th data-orderable="false">{{ $kriteria->nama }} (C{{ $i++ }})</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($nilai as $value)
                <tr>
                    <th>{{ $value['nama_alternatif'] }} (A{{ $i++ }})</th>
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