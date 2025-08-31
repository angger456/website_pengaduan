<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan';

    protected $fillable = [
        'nama_pengadu',
        'nik',
        'bidang',
        'kecamatan',
        'kelurahan',
        'rt',
        'rw',
        'judul',
        'deskripsi',
        'lampiran',
        'status'
    ];

    // Relasi ke tabel tindak lanjut
    public function tindaklanjut()
    {
        return $this->hasMany(\App\Models\PengaduanTindaklanjut::class, 'pengaduan_id')
            ->orderBy('created_at', 'desc');
    }

    /* Scope bidang case-insensitive */
    public function scopeBidang($q, string $bidang)
    {
        return $q->whereRaw('LOWER(bidang) = ?', [strtolower($bidang)]);
    }

    /* Helper count per-bidang */
    public static function countByBidang(string $bidang): int
    {
        return static::bidang($bidang)->count();
    }

    /* Helper progress % selesai per-bidang */
    public static function progressByBidang(string $bidang): int
    {
        $total   = static::bidang($bidang)->count();
        if ($total === 0) return 0;

        $selesai = static::bidang($bidang)->where('status', 'selesai')->count();
        return (int) round(($selesai / $total) * 100);
    }

    /* (Opsional) ambil semua agregat sekali jalan */
    public static function aggregates(): array
    {
        $rows = static::select(
            DB::raw('LOWER(bidang) as bidang'),
            DB::raw('COUNT(*) as total'),
            DB::raw("SUM(CASE WHEN status='selesai' THEN 1 ELSE 0 END) as selesai")
        )
            ->groupBy(DB::raw('LOWER(bidang)'))
            ->get()
            ->keyBy('bidang');

        $get = fn($b, $k) => (int) ($rows[$b][$k] ?? 0);

        return [
            'rehsos'    => ['total' => $get('rehsos', 'total'),   'progress' => self::calc($get('rehsos', 'selesai'), $get('rehsos', 'total'))],
            'ppkg'      => ['total' => $get('ppkg', 'total'),     'progress' => self::calc($get('ppkg', 'selesai'),   $get('ppkg', 'total'))],
            'dayasos'   => ['total' => $get('dayasos', 'total'),  'progress' => self::calc($get('dayasos', 'selesai'), $get('dayasos', 'total'))],
            'linjamsos' => ['total' => $get('linjamsos', 'total'), 'progress' => self::calc($get('linjamsos', 'selesai'), $get('linjamsos', 'total'))],
        ];
    }

    private static function calc(int $a, int $b): int
    {
        return $b > 0 ? (int) round(($a / $b) * 100) : 0;
    }


    public static function progressByBidangAndStatus(string $bidang): array
    {
        $total = static::whereRaw('LOWER(bidang) = ?', [strtolower($bidang)])->count();
        if ($total === 0) {
            return [
                'dikirim'      => 0,
                'diverifikasi' => 0,
                'diproses'     => 0,
                'selesai'      => 0,
            ];
        }

        $rows = static::select('status', DB::raw('COUNT(*) as jumlah'))
            ->whereRaw('LOWER(bidang) = ?', [strtolower($bidang)])
            ->groupBy('status')
            ->pluck('jumlah', 'status');

        return [
            'dikirim'      => isset($rows['dikirim'])      ? round(($rows['dikirim'] / $total) * 100) : 0,
            'diverifikasi' => isset($rows['diverifikasi']) ? round(($rows['diverifikasi'] / $total) * 100) : 0,
            'diproses'     => isset($rows['diproses'])     ? round(($rows['diproses'] / $total) * 100) : 0,
            'selesai'      => isset($rows['selesai'])      ? round(($rows['selesai'] / $total) * 100) : 0,
        ];
    }
}
