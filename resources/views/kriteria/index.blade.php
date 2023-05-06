@extends('layouts.main')
@push('style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<x-breadcrumb title="Tampil Data Kriteria" link="{{ route('kriteria.index') }}" item="Kriteria" subItem="Tampil Data" />
<div class="card mb-3">
    @if (auth()->user()->level === 'admin')
        <div class="card-header d-flex flex-row align-items-end justify-content-end">
            <a href="{{ route('kriteria.create') }}" class="btn btn-primary">Tambah Kriteria</a>
        </div>
    @endif
    <div class="table-responsive px-3 pb-3">
        <table class="table align-items-center table-hover table-bordered" id="kriteria">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot Kriteria</th>
                    @if (auth()->user()->level === 'admin')
                        <th data-orderable="false">Opsi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($kriteria_ as $kriteria)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>C{{ str_pad($kriteria->id, 2, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $kriteria->nama }}</td>
                    <td>{{ $kriteria->bobot }}%</td>
                    @if (auth()->user()->level === 'admin')
                        <td class="d-flex justify-content-around">
                            <a href="{{ route('kriteria.edit', [$kriteria->id]) }}" class="btn btn-sm btn-info">Ubah</a>
                            <form method="POST" action="{{ route('kriteria.destroy', ['kriterium' => $kriteria->id]) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Hapus data ini?')" value="Hapus">
                            </form>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('script')
<script src="{{ asset('assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $(document).ready(function ()   {
        $('#kriteria').DataTable({
            info: false,
            paging: false,
            searching: false
        });
    });
</script>
@endpush
