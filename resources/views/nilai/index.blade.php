@extends('layouts.main')
@section('content')
@push('style')
<style>
    tr,
    td {
        white-space: pre;
    }
</style>
@endpush
<x-breadcrumb title="Tampil Data Nilai" link="{{ route('nilai.index') }}" item="Nilai" subItem="Tampil Data" />
<div class="row">
    <div class="col-lg-6">
        <div class="card mb-4">
            <div class="card-body">
                <h6 class="m-0 font-weight-bold text-primary">Alternatif yang tidak terdaftar : {{ $alternatif->whereNotIn('nama', $result->groupBy('nama_alternatif')->keys())->count() }}</h6>
                <form action="{{ route('nilai.create') }}" method="GET" class="mt-3">
                    <div class="form-group">
                        <select name="alternatif_id" class="form-control" id="namaAlternatif">
                            <option value="">Pilih</option>
                            
                            @foreach ($alternatif->whereNotIn('nama', $result->groupBy('nama_alternatif')->keys()) as
                            $alternatif)
                            <option value="{{ $alternatif->id }}">{{ $alternatif->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" @if ($alternatif->whereNotIn('nama',
                        $result->groupBy('nama_alternatif')->keys())->count() == 0) disabled
                        @endif>Daftar</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card mb-4" id="daftar-alternatif">
            <div class="card-body">
                <h4 class="mb-2 font-weight-bold text-primary">Alternatif yang sudah terdaftar : {{ $result->groupBy('nama_alternatif')->count() }}</h4>
                <div class="list-group" style="max-height: 250px; overflow-y: auto;">
                    @foreach ($result->groupBy('nama_alternatif')->keys() as $value)
                    <a href="#{{ str_replace(' ', '-', $value) }}" class="list-group-item list-group-item-action">
                        {{ $value }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 mb-4">
    <!-- Simple Tables -->
    @php
        $i = 1;
    @endphp
    @foreach ($result->groupBy('nama_alternatif') as $key => $value)
    <div class="card mb-4" id="{{ str_replace(' ', '-', $key) }}">
        <div class="card-header py-3 row">
            <h4 class="col-md-6 mb-2 font-weight-bold text-primary">{{ $i++ }}.Alternatif : {{ $key }}</h4>
            <div class="col-md-6 d-flex justify-content-end">
                <a href="#daftar-alternatif">
                    <button class="btn btn-sm btn-primary mr-2">Ke Daftar</button>
                </a>
                <a href="{{ route('nilai.edit', $key) }}">
                    <button class="btn btn-sm btn-info mr-2">Ubah</button>
                </a>
                <form method="POST" action="{{ route('nilai.destroy', $key) }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-sm btn-danger"
                        onclick="return confirm('Hapus data ini?')">Hapus</button>
                </form>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr>
                        {{-- {{ dd($value) }} --}}
                        @foreach ($value as $v)
                        <th class="text-center">{{ $v->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach ($value as $v)
                        <td class="text-center">{{ $v->nilai }}</td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>
@endsection
