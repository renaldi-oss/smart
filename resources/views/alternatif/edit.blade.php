@extends('layouts.main')
@section('content')
    <x-breadcrumb title="Ubah Data Alternatif" link="{{ route('alternatif.index') }}" item="Alternatif" subItem="Ubah Data" />
    <div class="card mb-3">
      <div class="card-body">
        <form action="{{ route('alternatif.update', [$alternatif->id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('alternatif.form', ['tombol' => 'Ubah'])
        </form>
      </div>
    </div>
@endsection
