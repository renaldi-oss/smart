@foreach ($result->groupBy("nama_kriteria") as $key => $value)
{{-- <div class="form-group">
    <input type="hidden" value="{{ $value[0]->kriteria_id }}" name="kriteria_id[]">
    <label for="parameter">Pilih Kriteria <strong>{{ $key }}</strong></label>
    <select name="parameter_id[{{ $value[0]->kriteria_id }}]" id="parameter"
        class="form-control @error('parameter_id.'.$value[0]->kriteria_id) is-invalid @enderror">
        <option value="">Pilih</option>
        @foreach ($value as $parameter)
        <option value="{{ $parameter->id }}"
            {{ (old('parameter_id.'.$value[0]->kriteria_id) ?? in_array($parameter->id, isset($parameter_id) ? $parameter_id->toArray() : [])) == $parameter->id ? 'selected' : '' }}>{{ $parameter->nama_parameter }}</option>
        @endforeach
    </select>
    <x-errormessage error="parameter_id.{{ $value[0]->kriteria_id }}" />
</div> --}}
{{-- buat text center untuk $key --}}
<div class="text-center">
    <h4>{{ $key }}</h4>
</div>
<div class="form-group row">
    <div class="col">
        <input type="text" placeholder="Nilai" name="nilai[{{ $value[0]->kriteria_id }}]" id="nilai" class="form-control @error('nilai.'.$value[0]->kriteria_id) is-invalid @enderror" value="{{ old('nilai.'.$value[0]->kriteria_id) }}" required/>
        <x-errormessage error="nilai.{{ $value[0]->kriteria_id }}" />
    </div>
    <div class="col">
        <input type="hidden" value="{{ $value[0]->kriteria_id }}" name="kriteria_id[]">
        <select name="parameter_id[{{ $value[0]->kriteria_id }}]" id="parameter"
            class="form-control @error('parameter_id.'.$value[0]->kriteria_id) is-invalid @enderror">
            <option>Pilih</option>
            @foreach ($value as $parameter)
            <option value="{{ $parameter->id }}"
                {{ (old('parameter_id.'.$value[0]->kriteria_id) ?? in_array($parameter->id, isset($parameter_id) ? $parameter_id->toArray() : [])) == $parameter->id ? 'selected' : '' }}>{{ $parameter->nama_parameter }}</option>
            @endforeach
        </select>
        <x-errormessage error="parameter_id.{{ $value[0]->kriteria_id }}" /> 
    </div>
</div>


@endforeach
<div class="mt-3">
    <button type="reset" class="btn btn-primary">Reset</button>
    <button type="submit" class="btn btn-primary">{{ $tombol }}</button>
</div>
