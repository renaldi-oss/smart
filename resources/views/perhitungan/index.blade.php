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


@include('perhitungan.partials.kriteria')
@include('perhitungan.partials.dataAsli')
@include('perhitungan.partials.kriteriaAlternatif')
@include('perhitungan.partials.utility')
@include('perhitungan.partials.nilaiAkhir')

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
