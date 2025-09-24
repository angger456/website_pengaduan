<x-layout>

    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Data Pengaduan Rehsos</h1>
                    <p class="mb-4">
                     Berikut adalah data pengaduan masyarakat. Gunakan tombol aksi untuk melihat detail atau menghapus data.
                    </p>

                    <a href="" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel"></i> Export Excel
                    </a>

                    <!-- DataTables Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="pengaduanTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kecamatan</th>
                                            <th>Judul Laporan</th>
                                            <th>Bidang Laporan</th>
                                            <th>Status Pengaduan</th>
                                            <th>Tanggal Lapor</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($pengaduan as $item)
                                            <tr>
                                                <td>{{ $item->nama_pengadu }}</td>
                                                <td>{{ $item->kecamatan }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>{{ $item->bidang }}</td>
                                                <td>
                                                    @if($item->status == 'dikirim')
                                                        <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                                                    @elseif($item->status == 'diverifikasi')
                                                        <span class="badge bg-primary">Diverifikasi</span>
                                                    @elseif($item->status == 'diproses')
                                                        <span class="badge bg-info text-dark">Diproses</span>
                                                    @elseif($item->status == 'selesai')
                                                        <span class="badge bg-success">Selesai</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at->format('Y-m-d') }}</td>
                                                <td>
                                                <!-- Tombol Detail -->
                                                <button 
                                                    class="btn btn-info btn-sm" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#detailModal{{ $item->id }}">
                                                    Detail
                                                </button>

                                                @if($item->status == 'diverifikasi' || $item->status == 'diproses')
                                                    <!-- Tombol untuk buka modal proses -->
                                                    <button 
                                                        class="btn btn-sm btn-warning text-white mt-2" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#prosesModal{{ $item->id }}">
                                                        Proses Aduan
                                                    </button>
                                                @elseif($item->status == 'selesai')
                                                    <!-- Tombol untuk buka modal detail selesai -->
                                                    <button 
                                                        class="btn btn-sm btn-success mt-2" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#detailSelesaiModal{{ $item->id }}">
                                                        Detail Selesai
                                                    </button>
                                                @endif

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('pengaduan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                </form>

                                                <!-- notif sukses -->
                                                @if(session('success'))
                                                <script>
                                                    Swal.fire({
                                                        icon: 'success',
                                                        title: 'Sukses!',
                                                        text: '{{ session('success') }}',
                                                        timer: 2000,
                                                        showConfirmButton: false
                                                    });
                                                </script>
                                                @endif
                                            </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <!-- Loop untuk modals -->
                                @foreach($pengaduan as $item)

                                <!-- Modal Detail Selesai -->
                                <div class="modal fade" id="detailSelesaiModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailSelesaiModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-success text-white">
                                                <h5 class="modal-title" id="detailSelesaiModalLabel{{ $item->id }}">Detail Aduan Selesai - {{ $item->nama_pengadu }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Judul:</strong> {{ $item->judul }}</p>
                                                <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>

                                                <hr>
                                                <h6>Log Tindak Lanjut</h6>
                                                @forelse($item->tindaklanjut as $log)
                                                    <div class="alert alert-secondary mb-2">
                                                        <small>{{ $log->created_at->format('d/m/Y H:i') }}</small><br>
                                                        {{ $log->keterangan }}
                                                    </div>
                                                @empty
                                                    <p class="text-muted">Belum ada tindak lanjut</p>
                                                @endforelse
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal Proses Aduan -->
                                <div class="modal fade" id="prosesModal{{ $item->id }}" tabindex="-1" aria-labelledby="prosesModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="prosesModalLabel{{ $item->id }}">
                                                    Proses Aduan - {{ $item->nama_pengadu }}
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                            </div>
                                            <form action="{{ route('pengaduan.updateStatus', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    
                                                    <!-- Textarea Keterangan -->
                                                    <div class="mb-3">
                                                        <label for="keterangan{{ $item->id }}" class="form-label">Keterangan Tindak Lanjut</label>
                                                        <textarea name="keterangan" id="keterangan{{ $item->id }}" class="form-control" rows="3" required></textarea>
                                                    </div>

                                                    <!-- Dropdown Status -->
                                                    <div class="mb-3">
                                                        <label for="status{{ $item->id }}" class="form-label">Status</label>
                                                        <select name="status" id="status{{ $item->id }}" class="form-select" required>
                                                            <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                                        </select>
                                                    </div>

                                                    <!-- Log Tindak Lanjut -->
                                                    @if($item->tindaklanjut->count())
                                                        <div class="mb-3">
                                                            <label class="form-label">Riwayat Tindak Lanjut</label>
                                                            <ul class="list-group">
                                                                @foreach($item->tindaklanjut as $log)
                                                                    <li class="list-group-item">
                                                                        <small class="text-muted">{{ $log->created_at->format('d/m/Y H:i') }}</small><br>
                                                                        {{ $log->keterangan }}
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-info">Simpan</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel{{ $item->id }}">Detail Pengaduan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <!-- Kolom kiri: Informasi pengaduan -->
                                                    <div class="col-md-8">
                                                        <p><strong>Nama Pengadu:</strong> {{ $item->nama_pengadu }}</p>
                                                        <p><strong>NIK:</strong> {{ $item->nik }}</p>
                                                        <p><strong>NO HP WhatsApp:</strong> {{ $item->no_hp }}</p>
                                                        <p><strong>Kecamatan:</strong> {{ $item->kecamatan }}</p>
                                                        <p><strong>Judul:</strong> {{ $item->judul }}</p>
                                                        <p><strong>Bidang:</strong> {{ $item->bidang }}</p>
                                                        <p><strong>Deskripsi:</strong> {{ $item->deskripsi }}</p>
                                                        
                                                        <p><strong>Status:</strong> 
                                                            @if($item->status == 'dikirim')
                                                                <span class="badge bg-warning text-dark">Menunggu Verifikasi</span>
                                                            @elseif($item->status == 'diverifikasi')
                                                                <span class="badge bg-primary">Diverifikasi</span>
                                                            @elseif($item->status == 'diproses')
                                                                <span class="badge bg-info text-dark">Diproses</span>
                                                            @elseif($item->status == 'selesai')
                                                                <span class="badge bg-success">Selesai</span>
                                                            @endif
                                                        </p>

                                                        <p><strong>Tanggal Lapor:</strong> {{ $item->created_at->format('d-m-Y H:i') }}</p>

                                                        {{-- Tombol ubah status --}}
                                                        @if($item->status == 'dikirim')
                                                            <!-- Tombol Ubah ke Diverifikasi -->
                                                            <form action="{{ route('pengaduan.updateStatus', $item->id) }}" method="POST" class="mt-2">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="diverifikasi">
                                                                <button type="submit" class="btn btn-sm btn-primary">
                                                                    Ubah ke Diverifikasi
                                                                </button>
                                                            </form>


                                                        @elseif($item->status == 'diproses')
                                                            <!-- Tombol Selesaikan Aduan -->
                                                            <form action="" method="POST" class="mt-2">
                                                                @csrf
                                                                @method('PUT')
                                                                <input type="hidden" name="status" value="selesai">
                                                                <button type="submit" class="btn btn-sm btn-success">
                                                                    Selesaikan Aduan
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>

                                                    <!-- Kolom kanan: Gambar bukti -->
                                                    <div class="col-md-4 text-center">
                                                        <p><strong>Bukti Pendukung:</strong></p>
                                                        @if($item->lampiran)
                                                            <img src="{{ asset('storage/'.$item->lampiran) }}" alt="Bukti Pendukung" class="img-fluid rounded" style="max-height:250px;">
                                                        @else
                                                            <img src="{{ asset('assets/img/DefaultImage.png') }}" alt="Tidak ada bukti" class="img-fluid rounded" style="max-height:250px;">
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>
                    </div>

</x-layout>

                    