<div class="form-group">
    <label for="input-nama">Nama Alternatif</label>
    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="input-nama" name="nama" placeholder="Masukkan Nama Alternatif" value="{{ old('nama', $alternatif->nama ?? '') }}" autofocus>
    <x-errormessage error="nama" />
</div>
<button type="reset" class="btn btn-primary">Reset</button>
<button type="submit" class="btn btn-primary">{{ $tombol }}</button>

