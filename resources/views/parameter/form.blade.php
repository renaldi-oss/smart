<div class="form-group">
    <label for="input-kriteria">Pilih Kriteria</label>
    <select name="kriteria_id" id="input-kriteria" class="form-control @error('kriteria_id') is-invalid @enderror">
        <option value="">Pilih</option>
        @foreach ($kriteria as $kriteria)
            <option {{ old('kriteria_id', ($parameter->kriteria_id ?? '')) == $kriteria->id ? 'selected' : '' }} value="{{ $kriteria->id }}">{{ $kriteria->nama }}</option>
        @endforeach
    </select>
    <x-errormessage error="kriteria_id" />
</div>
<div class="form-group">
    <label for="input-nama">Kondisi Parameter</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="input-nama" name="nama" placeholder="Masukkan Nama Parameter" value="{{ old('nama', ($parameter->nama ?? '')) }}">
    <x-errormessage error="nama" />
</div>
<div class="form-group">
    <label for="input-bobot">Bobot Parameter</label>
    <div class="input-group">
        <input type="text" class="form-control @error('bobot') is-invalid @enderror" id="input-bobot" name="bobot" placeholder="Masukkan Bobot Parameter" value="{{ old('bobot', ($parameter->bobot ?? '')) }}" onkeypress="return checkNumber(event)">
        <x-errormessage error="bobot" />
    </div>
</div>
<button type="reset" class="btn btn-primary">Reset</button>
<button type="submit" class="btn btn-primary">{{ $tombol }}</button>

@push('script')
<script>
    function checkNumber(value) {
        return /(^\d+$)/.test(value.key);
    }
</script>
@endpush
