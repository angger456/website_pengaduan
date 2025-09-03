<x-header></x-header>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <x-navbar></x-navbar>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-item active">
          <img src="assets/img/carrousel1.jpg" alt="">
          <div class="carousel-container">
            <h2 style="text-align:center;">Sistem Informasi Gerakan Aduan Pelayanan Sosial</h2>
            <p style="text-align:center;">PANTAU ADUAN, PASTIKAN TINDAKAN.</p>
            <a href="#call-to-action" class="btn-get-started">Lapor Sekarang!</a>
            <a href="#cek-pengaduan" class="btn-get-started">Cek Status Lapor</a>
          </div>
        </div><!-- End Carousel Item -->
      </div>

    </section><!-- /Hero Section -->



    <!-- Input Data Pelaporan Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

    <img src="assets/img/cta-bg.jpg" alt="">

    <div class="container">
        <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
        <div class="col-xl-10">
            <div class="text-center text-light">
            <h3>Form Pengaduan</h3>
            <p>Silakan isi data berikut untuk membuat pengaduan Anda. Pastikan data benar agar laporan dapat ditindaklanjuti.</p>

            <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="p-4 rounded bg-dark bg-opacity-75">
            @csrf

                <!-- Pilih Bidang Laporan -->
                <div class="mb-4 text-start">
                  <label class="form-label fw-bold">Pilih Bidang Laporan</label>
                  <div class="row g-3">

                    <!-- Rehsos -->
                    <div class="col-md-3">
                      <input type="radio" class="btn-check" name="bidang" id="bidang1" value="Rehsos" autocomplete="off" required>
                      <label class="btn btn-outline-success w-100 p-4 h-100 d-flex flex-column justify-content-center text-center" for="bidang1">
                        <i class="bi bi-person-heart fs-1 mb-2"></i>
                        <h6 class="fw-bold">Rehsos</h6>
                        <p class="small mb-0">Perlindungan Anak & Pelayanan Rehabilitasi Sosial</p>
                      </label>
                    </div>

                    <!-- PPKG -->
                    <div class="col-md-3">
                      <input type="radio" class="btn-check" name="bidang" id="bidang2" value="PPKG" autocomplete="off">
                      <label class="btn btn-outline-primary w-100 p-4 h-100 d-flex flex-column justify-content-center text-center" for="bidang2">
                        <i class="bi bi-gender-ambiguous fs-1 mb-2"></i>
                        <h6 class="fw-bold">PPKG</h6>
                        <p class="small mb-0">Pemberdayaan Perempuan & Kesetaraan Gender</p>
                      </label>
                    </div>

                    <!-- Dayasos -->
                    <div class="col-md-3">
                      <input type="radio" class="btn-check" name="bidang" id="bidang3" value="Dayasos" autocomplete="off">
                      <label class="btn btn-outline-warning w-100 p-4 h-100 d-flex flex-column justify-content-center text-center" for="bidang3">
                        <i class="bi bi-people-fill fs-1 mb-2"></i>
                        <h6 class="fw-bold">Dayasos</h6>
                        <p class="small mb-0">Penanganan, Pemberdayaan Sosial & Kepahlawanan</p>
                      </label>
                    </div>

                    <!-- Linjamsos -->
                    <div class="col-md-3">
                      <input type="radio" class="btn-check" name="bidang" id="bidang4" value="Linjamsos" autocomplete="off">
                      <label class="btn btn-outline-danger w-100 p-4 h-100 d-flex flex-column justify-content-center text-center" for="bidang4">
                        <i class="bi bi-shield-check fs-1 mb-2"></i>
                        <h6 class="fw-bold">Linjamsos</h6>
                        <p class="small mb-0">Perlindungan & Jaminan Sosial</p>
                      </label>
                    </div>

                </div>
                </div>

                <!-- Nama -->
                <div class="mb-3 text-start">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama_pengadu" name="nama_pengadu" required>
                </div>

                <!-- NIK -->
                <div class="mb-3 text-start">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control" id="nik" name="nik" maxlength="16" required>
                </div>

                <!-- Kecamatan & Kelurahan -->
                <div class="row">
                <div class="col-md-6 mb-3 text-start">
                    <label for="kecamatan" class="form-label">Kecamatan</label>
                    <input type="text" class="form-control" id="kecamatan" name="kecamatan" required>
                </div>
                <div class="col-md-6 mb-3 text-start">
                    <label for="kelurahan" class="form-label">Kelurahan</label>
                    <input type="text" class="form-control" id="kelurahan" name="kelurahan" required>
                </div>
                </div>

                <!-- RT & RW -->
                <div class="row">
                <div class="col-md-6 mb-3 text-start">
                    <label for="rt" class="form-label">RT</label>
                    <input type="text" class="form-control" id="rt" name="rt" required>
                </div>
                <div class="col-md-6 mb-3 text-start">
                    <label for="rw" class="form-label">RW</label>
                    <input type="text" class="form-control" id="rw" name="rw" required>
                </div>
                </div>

                <!-- Judul Laporan -->
                <div class="mb-3 text-start">
                <label for="judul" class="form-label">Judul Laporan</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
                </div>

                <!-- Isi Laporan -->
                <div class="mb-3 text-start">
                <label for="isi" class="form-label">Deskripsi Laporan</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" rows="4" required></textarea>
                </div>

                <!-- Bukti Pendukung -->
                <div class="mb-3 text-start">
                    <label for="bukti" class="form-label">Upload Bukti Pendukung (Opsional)</label>
                    <input type="file" class="form-control" id="bukti" name="bukti[]" accept=".jpg,.jpeg,.png,.pdf" multiple>
                    <small class="text-light">Format: JPG, PNG, PDF. Maksimal 5 MB per file.</small>
                </div>


                <!-- Tombol Submit -->
                <button type="submit" class="btn btn-success w-100">Kirim Pengaduan</button>

            </form>

            @if(session('success') && session('id'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        html: `
                            <p>{{ session('success') }}</p>
                            <hr>
                            <p><strong>ID Laporan Anda:</strong> 
                            <span style="color:blue">{{ session('id') }}</span>
                            <button onclick="navigator.clipboard.writeText('{{ session('id') }}')" 
                                    style="margin-left:10px; padding:3px 8px; border:none; background:#3498db; color:#fff; border-radius:5px; cursor:pointer;">
                                Copy
                            </button>
                            </p>
                            <p style="color:red; font-size:14px;">⚠️ Harap simpan ID laporan ini untuk melihat status laporan Anda di kemudian hari.</p>
                        `,
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif




            </div>
        </div>
        </div>
    </div>

    </section>
    <!-- /Input Data Pengaduan Section -->



    <!-- Cek Progres Pengaduan Section -->
    <section id="cek-pengaduan" class="contact section py-5 bg-light">

      <!-- Section Title -->
      <div class="container text-center mb-5" data-aos="fade-up">
        <h2 class="fw-bold text-success">
          <i class="bi bi-search"></i> Cek Progres Pengaduan
        </h2>
        <p class="text-muted">Lacak status pengaduan Anda secara real-time dibawah ini.</p>
      </div>
      <!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row justify-content-center">

          <!-- Form Input -->
          <div class="col-lg-8">
            <form id="cek-status-form" class="p-4 border rounded bg-white shadow-sm">
              <div class="row g-3 align-items-center justify-content-center">
                <div class="col-md-8">
                  <input type="text" id="input-id-laporan" class="form-control form-control-lg"
                        placeholder="Masukkan ID Laporan atau NIK" required>
                </div>
                <div class="col-md-4 text-center">
                  <button type="submit" class="btn btn-success btn-lg w-100">
                    <i class="bi bi-search"></i> Cek Status
                  </button>
                </div>
              </div>
            </form>
          </div>

          <!-- Hasil Progres -->
          <div class="col-lg-10 mt-5">
            <div id="hasil-pengaduan" class="card shadow-lg border-0" style="display:none;">
              <div class="card-body text-center">
                <h4 class="fw-bold text-success mb-3">
                  <i class="bi bi-clipboard-check"></i> Status Pengaduan Anda
                </h4>
                <hr>
                <div class="row mb-3">
                  <div class="col-md-4"><p><strong>ID Laporan:</strong> <span id="text-id-laporan">-</span></p></div>
                  <div class="col-md-4"><p><strong>Nama:</strong> <span id="nama-pelapor">-</span></p></div>
                  <div class="col-md-4"><p><strong>Tanggal Lapor:</strong> <span id="tanggal-lapor">-</span></p></div>
                </div>

                <!-- Tracking Progress -->
                <div class="d-flex justify-content-between align-items-start mt-4">
                  <!-- Step 1 -->
                  <div class="text-center flex-fill" id="step-kirim">
                    <i class="bi bi-send-fill fs-3"></i>
                    <p class="fw-semibold mb-1">Laporan Dikirim</p>
                    <small class="text-muted d-block" id="tgl-kirim">-</small>
                    <small class="text-muted">Pengaduan berhasil dikirim.</small>
                  </div>

                  <!-- Step 2 -->
                  <div class="text-center flex-fill" id="step-verif">
                    <i class="bi bi-shield-check fs-3"></i>
                    <p class="fw-semibold mb-1">Diverifikasi</p>
                    <small class="text-muted d-block" id="tgl-verif">-</small>
                    <small class="text-muted">Petugas telah memverifikasi laporan.</small>
                  </div>

                  <!-- Step 3 -->
                  <div class="text-center flex-fill" id="step-proses">
                    <i class="bi bi-hourglass-split fs-3"></i>
                    <p class="fw-semibold mb-1">Diproses</p>
                    <small class="text-muted d-block" id="tgl-proses">-</small>
                    <small class="text-muted">Laporan sedang ditindaklanjuti petugas.</small>
                    <!-- 🔹 Keterangan khusus -->
                  <small class="d-block text-primary fst-italic fw-semibold" id="ket-proses">Tidak ada keterangan</small>
                  </div>

                  <!-- Step 4 -->
                  <div class="text-center flex-fill" id="step-selesai">
                    <i class="bi bi-check-circle fs-3"></i>
                    <p class="fw-semibold mb-1">Selesai</p>
                    <small class="text-muted d-block" id="tgl-selesai">-</small>
                    <small class="text-muted">Menunggu proses penyelesaian.</small>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- proses cek status -->
    <script>
document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById('cek-status-form');

  function setStepState(id, state) {
    const el = document.getElementById('step-' + id);
    const icon = el.querySelector('i');
    const text = el.querySelector('p');

    icon.classList.remove('text-muted','text-success','text-warning','text-primary');
    text.classList.remove('text-muted','text-success','text-warning','text-primary');

    if (state === 'done') {
      icon.classList.add('text-success');
      text.classList.add('text-success');
    } else if (state === 'current') {
      icon.classList.add('text-primary');  // 🔵 warna biru
      text.classList.add('text-primary');  // 🔵 warna biru
    } else {
      icon.classList.add('text-muted');
      text.classList.add('text-muted');
    }
  }

  const statusMapping = {
    "dikirim": "kirim",
    "diverifikasi": "verif",
    "diproses": "proses",
    "selesai": "selesai"
  };

  function applyStatus(status, dates) {
    // fallback bila status tidak dikenali
    const stepKey = statusMapping[status] || 'kirim';
    const steps = ['kirim','verif','proses','selesai'];
    const idx = steps.indexOf(stepKey);

    steps.forEach((s, i) => {
      if (i < idx) setStepState(s, 'done');
      else if (i === idx) setStepState(s, 'current');
      else setStepState(s, 'pending');
    });

    // isi tanggal jika ada
    if (dates) {
      if (dates.kirim)  document.getElementById('tgl-kirim').innerText   = dates.kirim;
      if (dates.verif)  document.getElementById('tgl-verif').innerText   = dates.verif;
      if (dates.proses) document.getElementById('tgl-proses').innerText  = dates.proses;
      if (dates.selesai)document.getElementById('tgl-selesai').innerText = dates.selesai;
    }
  }

  form.addEventListener('submit', async function(e) {
    e.preventDefault();

    // reset tampilan keterangan default sebelum fetch
    document.getElementById('ket-proses').innerText = 'Tidak ada keterangan';

    const val = document.getElementById('input-id-laporan').value.trim();
    if (!val) { alert('Masukkan ID laporan atau NIK'); return; }

    try {
      const res = await fetch(`/cek-status/${encodeURIComponent(val)}`);
      const payload = await res.json();
      console.log('Response cek-status:', payload); // debug

      if (!payload.success) { alert(payload.message); return; }

      const d = payload.data;
      document.getElementById('hasil-pengaduan').style.display = 'block';
      document.getElementById('text-id-laporan').innerText = d.id;
      document.getElementById('nama-pelapor').innerText   = d.nama;
      // tanggal lapor = tgl_kirim
      document.getElementById('tanggal-lapor').innerText = d.tgl_kirim ?? '-';

      // update progress steps & tanggal
      applyStatus((d.status || '').toLowerCase(), {
        kirim:  d.tgl_kirim,
        verif:  d.tgl_verif,
        proses: d.tgl_proses,
        selesai:d.tgl_selesai
      });

      // tampilkan keterangan jika ada, dan jika status sudah sampai proses
      const statusLower = (d.status || '').toLowerCase();
      if (d.keterangan && (statusLower === 'diproses' || statusLower === 'selesai')) {
        document.getElementById('ket-proses').innerText = d.keterangan;
      } else {
        document.getElementById('ket-proses').innerText = 'Tidak ada keterangan';
      }

    } catch (err) {
      console.error(err);
      alert('Terjadi kesalahan server');
    }
  });
});
</script>





    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">


    <!-- About Section -->
    <section id="about" class="about section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Tentang Kami</h2>
        <p>SIGAP SOSIAL (Sistem Informasi Gerakan Aduan Pelayanan Sosial) adalah inovasi digital yang dirancang untuk meningkatkan efektivitas, transparansi, dan akuntabilitas 
          layanan publik di bidang kesejahteraan sosial bagi PPKS (Pemerlu Pelayanan Kesejahteraan Sosial). Aplikasi ini hadir sebagai jawaban atas kebutuhan masyarakat 
          untuk memperoleh pelayanan yang cepat, tepat, dan mudah diakses, sekaligus mendukung transformasi digital di lingkungan Dinas Sosial, Pemberdayaan Perempuan dan 
          Perlindungan Anak.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            <p class="who-we-are">Siapakah kita?</p>
            <h3>SIGAP Sosial: Menjawab Tantangan Sosial dengan Solusi Digital</h3>
            <p class="fst-italic">
              Kami adalah penggerak di balik SIGAP Sosial, sebuah tim yang berdedikasi untuk menciptakan perubahan positif di masyarakat. Kami percaya bahwa setiap orang berhak mendapatkan akses yang adil terhadap pelayanan sosial, dan teknologi adalah alat yang kuat untuk mewujudkannya.
              Misi kami adalah menjembatani kesenjangan antara masyarakat yang membutuhkan dan lembaga penyedia layanan. Kami merancang platform ini untuk memberikan suara kepada mereka yang sering kali tidak terdengar, memastikan setiap aduan ditangani, dan setiap permasalahan sosial mendapat perhatian yang layak.
            </p>
            <a href="/" class="read-more"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
          </div>

          <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">
              <div class="col-lg-6">
                <img src="assets/img/tagana.jpg" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6">
                <div class="row gy-4">
                  <div class="col-lg-12">
                    <img src="assets/img/dwpdinsos.jpg" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-12">
                    <img src="assets/img/kursiroda.jpg" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section><!-- /About Section -->

  </main>

  <x-footer></x-footer>

</body>

</html>