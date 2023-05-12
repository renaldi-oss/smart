@extends('layouts.main')
@push('style')
<link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('content')
<x-breadcrumb title="Data Parameter" link="{{ route('kriteria.index') }}" item="Kreteria" subItem="Parameter" />
<div class="card mb-3">
    @if (auth()->user()->level === 'admin')
        <div class="card-header d-flex flex-row align-items-end justify-content-end">
            <a href="{{ route('parameter.create') }}" class="btn btn-primary">Tambah Parameter</a>
        </div>
    @endif
    <div class="table-responsive px-3 pb-3">
        @foreach ($parameter->groupby('nama_kriteria') as $param)
            <h4 class="mb-2 mt-2 font-weight-bold text-primary">Kriteria : {{ $param[0]->nama_kriteria }}</h4>
            <table class="table align-items-center table-hover table-bordered" id="parameter">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Parameter</th>
                        <th>Bobot Nilai</th>
                        @if (auth()->user()->level === 'admin')
                            <th data-orderable="false">Opsi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($param as $p)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->bobot }}</td>
                        @if (auth()->user()->level === 'admin')
                            <td class="d-flex justify-content-center">
                                <a href="{{ route('parameter.edit', [$p->id]) }}" class="btn btn-sm btn-info mr-2">Edit</a>
                                <form method="POST" action="{{ route('parameter.destroy', [$p->id]) }}">
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
        @endforeach
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
