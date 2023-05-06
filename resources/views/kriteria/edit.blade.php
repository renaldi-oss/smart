@extends('layouts.main')
@section('content')
    <x-breadcrumb title="Ubah Data Kriteria" link="{{ route('kriteria.index') }}" item="Kriteria" subItem="Ubah Data" />
    <div class="card mb-3">
      <div class="card-body">
        <form action="{{ route('kriteria.update', ['kriterium' =>$kriteria->id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            @include('kriteria.form', ['tombol' => 'Ubah'])

        </form>
      </div>
    </div>
@endsection
