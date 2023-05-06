@extends('layouts.main')
@section('content')
    <x-breadcrumb title="Tambah Data Parameter" link="{{ route('parameter.index') }}" item="Kreteria" subItem="Tambah Data" />
    <div class="card mb-3">
        <div class="card-body">
            <form action="{{ route('parameter.store') }}" method="post">
            {{ csrf_field() }}
                @include('parameter.form', ['tombol' => 'Tambah'])
            </form>
        </div>
    </div>
@endsection
