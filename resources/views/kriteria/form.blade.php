<div class="form-group">
    <label for="input-nama">Nama Kriteria</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="input-nama" name="nama" placeholder="Masukkan Nama Kriteria" value="{{ old('nama', ($kriteria->nama ?? '')) }}" autofocus>
    <x-errormessage error="nama" />
</div>
<div class="form-group">
    <label for="input-bobot">Bobot Kriteria</label>
    <div class="input-group">
        <input type="text" class="form-control @error('bobot') is-invalid @enderror" id="input-bobot" name="bobot" placeholder="Masukkan Bobot Kriteria" value="{{ old('bobot', ($kriteria->bobot ?? '')) }}" onkeypress="return checkNumber(event)">
        <div class="input-group-append">
            <span class="input-group-text"></span>
        </div>
        <x-errormessage error="bobot" />
    </div>
</div>
<div class="form-group">
    <label for="input-tipe">Tipe Kriteria</label>
    <select name="tipe" id="input-tipe" class="form-control @error('tipe') is-invalid @enderror">
        <option value="">Pilih</option>
        <option {{ old('tipe', ($kriteria->tipe ?? '')) == 'benefit' ? 'selected' : '' }} value="benefit">Benefit</option>
        <option {{ old('tipe', ($kriteria->tipe ?? '')) == 'cost' ? 'selected' : '' }} value="cost">Cost</option>
    </select>
    <x-errormessage error="tipe" />
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
