@extends('layouts.main')
@section('content')
    <x-breadcrumb title="Tambah Data Kreteria" link="{{ route('kriteria.index') }}" item="Kriteria" subItem="Tambah Data" />
    <div class="card mb-3">
      <div class="card-body">
        <form action="{{ route('kriteria.store') }}" method="post">
            {{ csrf_field() }}
            @include('kriteria.form', ['tombol' => 'Tambah'])
        </form>
      </div>
    </div>
@endsection
