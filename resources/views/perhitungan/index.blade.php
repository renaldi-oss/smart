@extends('layouts.main')
@push('style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<x-breadcrumb title="Tampil Data Perhitungan" link="#" item="Perhitungan" subItem="Tampil Data" />
@if (auth()->user()->level === 'admin')
<div class="mb-3 d-flex flex-row align-items-end justify-content-end d-print-none">
    <button onclick="{{ 'window.location.href=\''.route('perhitungan.cetak').'\'' }}" class="btn btn-danger">
        <i class="fas fa-file-pdf"></i> Cetak Data
    </button>
</div>
@endif
<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Normalisasi Kriteria</h4>
    </div>
    <div class="table-responsive px-3 pb-3">
        <table class="table align-items-center table-hover table-bordered">
            <thead class="thead-light">
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
                <tr class="thead-light">
                    <th colspan="{{ count($kriteria_) }}">Nilai Ternomalisasi</th>
                </tr>
                <tr>
                    @foreach($kriteria_ as $kriteria)
                    <td>{{ round($kriteria->normalisasi, 3) }}</td>
                    @endforeach
                </tr>
            </tbody>
            <caption>Jumlah : {{ $kriteria_->pluck('normalisasi')->sum() }}</caption>
        </table>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h4 class="m-0 font-weight-bold text-primary">Data Alternatif</h4>
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
                    @foreach ($value['bobot_parameter'] as $item)
                    <td>{{ $item }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
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
@endsection
@push('script')
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#alternatif').DataTable({
            info: false,
            paging: false,
            searching: false,
        });
        $('#hasil').DataTable({
            info: false,
            paging: false,
            searching: false,
        }).columns(-1).order('asc').draw();
    });
</script>
@endpush
