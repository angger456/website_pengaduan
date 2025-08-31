<x-layout>
    <div class="container">
        <h1>Proses Aduan</h1>
        <form action="{{ route('pengaduan.updateProses', $pengaduan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="diproses" {{ $pengaduan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="form-group mt-2">
                <label for="catatan">Catatan</label>
                <textarea name="catatan" id="catatan" class="form-control">{{ $pengaduan->catatan }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Update</button>
        </form>
    </div>
</x-layout>
