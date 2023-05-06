@extends('layouts.main')
@section('content')
    <x-breadcrumb title="Memperbarui Alternatif {{ $nama_alternatif }}" link="{{ route('nilai.index') }}" item="Nilai" subItem="Ubah" />
    <div class="card mb-3">
    <div class="card-body">
        <form action="{{ route('nilai.update', [$id_alternatif]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" value="{{ request('id_alternatif') }}" name="id_alternatif">
            @include('nilai.form', ['tombol' => 'Ubah'])
        </form>
      </div>
    </div>
@endsection
