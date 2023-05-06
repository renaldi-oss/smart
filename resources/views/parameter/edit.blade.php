@extends('layouts.main')
@section('content')
    <x-breadcrumb title="Ubah Data Parameter" link="{{ route('parameter.index') }}" item="Kriteria" subItem="Ubah Data" />
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('parameter.update', ['parameter' => $parameter->id]) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                @include('parameter.form', ['tombol' => 'Ubah'])
            </form>
        </div>
    </div>
@endsection
