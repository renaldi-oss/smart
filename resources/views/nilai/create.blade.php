@extends('layouts.main')
@section('content')
    <x-breadcrumb title="Daftarkan Alternatif {{ $nama_alternatif }}" link="{{ route('nilai.index') }}" item="Nilai" subItem="Daftar" />
    <div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('nilai.store') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" value="{{ request('alternatif_id') }}" name="alternatif_id">
            @include('nilai.form', ['tombol' => 'Daftar'])
        </form>
      </div>
    </div>
@endsection
