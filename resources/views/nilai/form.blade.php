{{-- @foreach ($result->groupBy("nama_kriteria") as $key => $value)
    <div class="form-group">
        <input type="hidden" value="{{ $value[0]->kriteria_id }}" name="kriteria_id[]">
        <label for="parameter">Pilih Kriteria <strong>{{ $key }}</strong></label>
        <div class="d-flex align-items-center">
            <input type="text" class="form-control mr-2" placeholder="nilai" value="" >
            <select name="parameter_id[{{ $value[0]->kriteria_id }}]" id="parameter"
                class="form-control @error('parameter_id.'.$value[0]->kriteria_id) is-invalid @enderror">
                <option value="">Pilih</option>
                @foreach ($value as $parameter)
                    <option value="{{ $parameter->id }}"
                        {{ (old('parameter_id.'.$parameter->kriteria_id) ?? in_array($parameter->id, isset($parameter_id) ? $parameter_id->toArray() : [])) ? 'selected' : '' }}>
                        {{ $parameter->nama_parameter }}
                    </option>
                @endforeach
            </select>
        </div>
        <x-errormessage error="parameter_id.{{ $value[0]->kriteria_id }}" />
    </div>
@endforeach --}}
@foreach ($result->groupBy("nama_kriteria") as $key => $value)
    <div class="form-group">
        <input type="hidden" value="{{ $value[0]->kriteria_id }}" name="kriteria_id[]">
        <label for="parameter">Pilih Kriteria <strong>{{ $key }}</strong></label>
        <div class="d-flex align-items-center">
            @if(isset($nilai))
                @foreach ($nilai as $n)
                    @if ($n->kriteria_id == $value[0]->kriteria_id)
                        <input type="text" name="nilai.[{{ $n->id }}]" class="form-control mr-2" placeholder="nilai" value="{{ isset($n->nilai) ? $n->nilai : '' }}" >
                        @break
                    @endif
                @endforeach
            @else
                <input type="text" class="form-control mr-2" placeholder="nilai" value="" name="nilai">
            @endif
            <select name="parameter_id[{{ $value[0]->kriteria_id }}]" id="parameter"
                class="form-control @error('parameter_id.'.$value[0]->kriteria_id) is-invalid @enderror">
                <option value="">Pilih</option>
                @foreach ($value as $parameter)
                    <option value="{{ $parameter->id }}"
                        {{ (old('parameter_id.'.$parameter->kriteria_id) ?? in_array($parameter->id, isset($parameter_id) ? $parameter_id->toArray() : [])) ? 'selected' : '' }}>
                        {{ $parameter->nama_parameter }}
                    </option>
                @endforeach
            </select>
        </div>
        <x-errormessage error="parameter_id.{{ $value[0]->kriteria_id }}" />
    </div>
@endforeach
<div class="mt-3">
    <button type="reset" class="btn btn-primary">Reset</button>
    <button type="submit" class="btn btn-primary">{{ $tombol }}</button>
</div>
