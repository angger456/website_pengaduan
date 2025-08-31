<x-layout>

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Proses Pengaduan</h1>
    <p class="mb-4">
        Silakan tambahkan keterangan proses untuk pengaduan yang sedang diproses.
    </p>

    <!-- Form untuk menambahkan keterangan proses -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan Proses</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="4" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status Pengaduan</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Keterangan</button>
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

</x-layout>