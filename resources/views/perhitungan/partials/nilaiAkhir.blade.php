<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Nilai Akhir </h4>
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
