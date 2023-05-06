@foreach ($result->groupBy("nama_kriteria") as $key => $value)
<div class="form-group">
    <input type="hidden" value="{{ $value[0]->id_kriteria }}" name="id_kriteria[]">
    <label for="parameter">Pilih Kriteria <strong>{{ $key }}</strong></label>
    <select name="id_parameter[{{ $value[0]->id_kriteria }}]" id="parameter"
        class="form-control @error('id_parameter.'.$value[0]->id_kriteria) is-invalid @enderror">
        <option value="">Pilih</option>
        @foreach ($value as $parameter)
        <option value="{{ $parameter->id }}"
            {{ (old('id_parameter.'.$value[0]->id_kriteria) ?? in_array($parameter->id, isset($id_parameter) ? $id_parameter->toArray() : [])) == $parameter->id ? 'selected' : '' }}>{{ $parameter->nama_parameter }}</option>
        @endforeach
    </select>
    <x-errormessage error="id_parameter.{{ $value[0]->id_kriteria }}" />
</div>
@endforeach
<div class="mt-3">
    <button type="reset" class="btn btn-primary">Reset</button>
    <button type="submit" class="btn btn-primary">{{ $tombol }}</button>
</div>
