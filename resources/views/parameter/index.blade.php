@extends('layouts.main')
@push('style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<x-breadcrumb title="Tampil Data Parameter" link="{{ route('kriteria.index') }}" item="Kreteria" subItem="Tampil Data" />
<div class="card mb-3">
    @if (auth()->user()->level === 'admin')
        <div class="card-header d-flex flex-row align-items-end justify-content-end">
            <a href="{{ route('parameter.create') }}" class="btn btn-primary">Tambah Parameter</a>
        </div>
    @endif
    <div class="table-responsive px-3 pb-3">
        <table class="table align-items-center table-hover table-bordered" id="parameter">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama Kriteria</th>
                    <th>Nama Sub Kriteria</th>
                    <th>Bobot Kriteria</th>
                    @if (auth()->user()->level === 'admin')
                        <th data-orderable="false">Opsi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($parameter_ as $parameter)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $parameter->nama_kriteria }}</td>
                    <td>{{ $parameter->nama }}</td>
                    <td>{{ $parameter->bobot }}%</td>
                    @if (auth()->user()->level === 'admin')
                        <td class="d-flex justify-content-around">
                            <a href="{{ route('parameter.edit', [$parameter->id]) }}" class="btn btn-sm btn-info">Ubah</a>
                            <form method="POST" action="{{ route('parameter.destroy', [$parameter->id]) }}">
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
        $('#parameter').DataTable({
            info: false,
            paging: false,
            searching: false
        });
    });
</script>
@endpush
