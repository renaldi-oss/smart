@extends('layouts.main')
@section('content')
    <x-breadcrumb title="Memperbarui Alternatif {{ $nama_alternatif }}" link="{{ route('nilai.index') }}" item="Nilai" subItem="Ubah" />
    <div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('nilai.update', [$alternatif_id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" value="{{ request('alternatif_id') }}" name="alternatif_id">
            @include('nilai.form', ['tombol' => 'Ubah'])
        </form>
      </div>
    </div>
@endsection
