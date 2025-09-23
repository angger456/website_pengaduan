<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;
use App\Models\PengaduanTindaklanjut;
use Barryvdh\DomPDF\Facade\Pdf;


class PengaduanController extends Controller
{
    // tampilkan form
    public function create()
    {
        return view('welcome');
    }

    // simpan data ke DB
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pengadu' => 'required|string|max:100',
            'nik' => 'required|digits:16',
            'no_hp'        => 'required|numeric|digits_between:10,15',
            'kecamatan' => 'required|string|max:100',
            'kelurahan' => 'required|string|max:100',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'bidang' => 'required|string',
            'bukti.*' => 'nullable|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        // Upload file jika ada
        $lampiran = null;
        if ($request->hasFile('bukti')) {
            $files = [];
            foreach ($request->file('bukti') as $file) {
                $path = $file->store('lampiran', 'public');
                $files[] = $path;
            }
            $lampiran = json_encode($files);
        }

        // Simpan ke DB
        $pengaduan = Pengaduan::create([
            'nama_pengadu' => $request->nama_pengadu,
            'nik'          => $request->nik,
            'no_hp'        => $request->no_hp,
            'bidang'       => $request->bidang,
            'kecamatan'    => $request->kecamatan,
            'kelurahan'    => $request->kelurahan,
            'rt'           => $request->rt,
            'rw'           => $request->rw,
            'judul'        => $request->judul,
            'deskripsi'    => $request->deskripsi,
            'bukti'        => $lampiran,
            'status'       => 'dikirim'
        ]);

        return redirect()->route('pengaduan.create')->with([
            'success' => 'Pengaduan berhasil dikirim!',
            'id' => $pengaduan->id
        ]);
    }

    public function destroy($id)
    {
        $pengaduan = Pengaduan::find($id);
        if (!$pengaduan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }
        $pengaduan->delete();
        return redirect()->route('pengaduan.index')->with('success', 'Data berhasil dihapus');
    }

    public function updateStatus(Request $request, $id)
    {
        // 1. Cari aduan
        $pengaduan = Pengaduan::findOrFail($id);

        // 2. Update status aduan
        $pengaduan->status = $request->status;
        $pengaduan->save();

        // 3. Simpan keterangan tindak lanjut
        if ($request->filled('keterangan')) {
            PengaduanTindaklanjut::create([
                'pengaduan_id' => $pengaduan->id,
                'keterangan'   => $request->keterangan,
            ]);
        }

        return redirect()->back()->with('success', 'Aduan berhasil diproses!');
    }

    public function rehsos()
    {
        $pengaduan = Pengaduan::where('bidang', 'rehsos')
            ->latest()
            ->get();
        return view('rehsos', compact('pengaduan'));
    }

    public function ppkg()
    {
        $pengaduan = Pengaduan::where('bidang', 'ppkg')
            ->latest()
            ->get();
        return view('ppkg', compact('pengaduan'));
    }

    public function linjamsos()
    {
        $pengaduan = Pengaduan::where('bidang', 'linjamsos')
            ->latest()
            ->get();
        return view('linjamsos', compact('pengaduan'));
    }

    public function dayasos()
    {
        $pengaduan = Pengaduan::where('bidang', 'dayasos')
            ->latest()
            ->get();
        return view('dayasos', compact('pengaduan'));
    }

    public function cekStatus($id)
    {
        // ambil pengaduan + tindaklanjut (latest pertama)
        $pengaduan = \App\Models\Pengaduan::with(['tindaklanjut' => function ($q) {
            $q->latest(); // pastikan order by created_at desc
        }])
            ->where('id', $id)
            ->orWhere('nik', $id)
            ->first();

        if (!$pengaduan) {
            return response()->json([
                'success' => false,
                'message' => 'Data pengaduan tidak ditemukan.'
            ]);
        }

        // ambil tindaklanjut terbaru (jika ada)
        $tindak = $pengaduan->tindaklanjut->first();

        // tanggal dasar
        $tgl_kirim = optional($pengaduan->created_at)->format('d-m-Y H:i');
        $tgl_updated = optional($pengaduan->updated_at)->format('d-m-Y H:i');

        // tgl_verif: jika status >= diverifikasi
        $tgl_verif = in_array($pengaduan->status, ['diverifikasi', 'diproses', 'selesai']) ? $tgl_updated : null;

        // tgl_proses: pakai created_at tindaklanjut kalau ada, jika tidak fallback ke updated_at (jika status menuntut)
        $tgl_proses = $tindak && $tindak->created_at
            ? optional($tindak->created_at)->format('d-m-Y H:i')
            : (in_array($pengaduan->status, ['diproses', 'selesai']) ? $tgl_updated : null);

        // tgl_selesai: hanya kalau status = selesai (pakai updated_at)
        $tgl_selesai = $pengaduan->status === 'selesai' ? $tgl_updated : null;

        return response()->json([
            'success' => true,
            'data' => [
                'id'         => $pengaduan->id,
                'nama'       => $pengaduan->nama_pengadu,
                'status'     => $pengaduan->status,
                'tgl_kirim'  => $tgl_kirim,
                'tgl_verif'  => $tgl_verif,
                'tgl_proses' => $tgl_proses,
                'tgl_selesai' => $tgl_selesai,
                // ambil keterangan dari tindaklanjut terbaru (jika ada)
                'keterangan' => $tindak?->keterangan ?? null,
            ]
        ]);
    }

    public function dashboard()
    {
        return view('dashboard_admin', [
            'countRehsos'     => Pengaduan::countByBidang('rehsos'),
            'countPPKG'       => Pengaduan::countByBidang('ppkg'),
            'countDayasos'    => Pengaduan::countByBidang('dayasos'),
            'countLinjamsos'  => Pengaduan::countByBidang('linjamsos'),

            'progressRehsos'   => Pengaduan::progressByBidangAndStatus('rehsos'),
            'progressPPKG'     => Pengaduan::progressByBidangAndStatus('ppkg'),
            'progressDayasos'  => Pengaduan::progressByBidangAndStatus('dayasos'),
            'progressLinjamsos' => Pengaduan::progressByBidangAndStatus('linjamsos'),
        ]);
    }

public function previewPdf()
    {
        $data = [
            'judul'            => 'Ringkasan Bidang',                     // <-- pastikan ada
            'tanggal'          => now()->format('d-m-Y'),

            'countRehsos'      => Pengaduan::countByBidang('rehsos'),
            'countPPKG'        => Pengaduan::countByBidang('ppkg'),
            'countDayasos'     => Pengaduan::countByBidang('dayasos'),
            'countLinjamsos'   => Pengaduan::countByBidang('linjamsos'),

            'progressRehsos'   => Pengaduan::progressByBidangAndStatus('rehsos'),
            'progressPPKG'     => Pengaduan::progressByBidangAndStatus('ppkg'),
            'progressDayasos'  => Pengaduan::progressByBidangAndStatus('dayasos'),
            'progressLinjamsos'=> Pengaduan::progressByBidangAndStatus('linjamsos'),
        ];

        $pdf = Pdf::loadView('ringkasan_pdf', $data)->setPaper('a4', 'portrait');

        return $pdf->stream('ringkasan-bidang.pdf');
    }

}
