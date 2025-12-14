<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perkara extends Model
{
    use HasFactory, SoftDeletes, LogsActivity;

    protected $table = 'perkaras';

    protected $fillable = [
        // Informasi Dasar
        'nomor_perkara',
        'jenis_perkara',
        'nama',
        'deskripsi',
        'kategori_id',
        'tanggal_masuk',
        'tanggal_perkara',
        'tanggal_selesai',
        'tanggal_pendaftaran',
        'klasifikasi_perkara',

        // Status & Priority
        'status',
        'priority',
        'deadline',
        'progress',
        'estimated_days',

        // Assignment
        'assigned_to',

        // Para Pihak
        'oditur',
        'terdakwa',

        // Pasal
        'pasal_dakwaan',

        // Informasi Surat
        'nomor_surat_pelimpahan',
        'tanggal_surat_pelimpahan',
        'nomor_surat_dakwaan',
        'tanggal_surat_dakwaan',
        'nomor_skeppera',
        'tanggal_skeppera',
        'pejabat_skeppera',
        'nomor_bap_penyidik',
        'tanggal_bap_penyidik',

        // Kejadian
        'tanggal_kejadian',
        'tempat_kejadian',

        // Notes & Files
        'keterangan',
        'internal_notes',
        'tags',
        'file_dokumentasi',
        'is_public',
    ];

    protected $casts = [
        // Dates
        'tanggal_masuk' => 'date',
        'tanggal_perkara' => 'date',
        'tanggal_selesai' => 'date',
        'tanggal_pendaftaran' => 'date',
        'tanggal_surat_pelimpahan' => 'date',
        'tanggal_surat_dakwaan' => 'date',
        'tanggal_skeppera' => 'date',
        'tanggal_bap_penyidik' => 'date',
        'tanggal_kejadian' => 'date',
        'deadline' => 'date',

        // Boolean
        'is_public' => 'boolean',

        // Arrays/JSON
        'tags' => 'array',
        'oditur' => 'array',
        'terdakwa' => 'array',

        // Integers
        'progress' => 'integer',
        'estimated_days' => 'integer',
    ];

    // Relationships
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function personels()
    {
        return $this->belongsToMany(Personel::class, 'perkara_personel')
                    ->withPivot('peran')
                    ->withTimestamps();
    }

    public function dokumens()
    {
        return $this->hasMany(DokumenPerkara::class, 'perkara_id');
    }

    public function riwayats()
    {
        return $this->hasMany(RiwayatPerkara::class, 'perkara_id');
    }

    // Scopes
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function scopeSelesai($query)
    {
        return $query->where('status', 'Selesai');
    }

    public function scopeProses($query)
    {
        return $query->where('status', 'Proses');
    }

    public function scopePriority($query, $priority)
    {
        return $query->where('priority', $priority);
    }

    public function scopeUrgent($query)
    {
        return $query->where('priority', 'Urgent');
    }

    public function scopeHighPriority($query)
    {
        return $query->whereIn('priority', ['High', 'Urgent']);
    }

    public function scopeOverdue($query)
    {
        return $query->whereNotNull('deadline')
                    ->where('deadline', '<', now())
                    ->where('status', '!=', 'Selesai');
    }

    public function scopeUpcomingDeadline($query, $days = 7)
    {
        return $query->whereNotNull('deadline')
                    ->whereBetween('deadline', [now(), now()->addDays($days)])
                    ->where('status', '!=', 'Selesai');
    }

    public function scopeAssignedTo($query, $assignee)
    {
        return $query->where('assigned_to', $assignee);
    }

    // Accessors
    public function getStatusBadgeAttribute()
    {
        return $this->status === 'Selesai'
            ? 'bg-green-100 text-green-800'
            : 'bg-yellow-100 text-yellow-800';
    }

    public function getKategoriBadgeAttribute()
    {
        $colors = [
            'Disiplin' => 'bg-purple-100 text-purple-800',
            'Administrasi' => 'bg-blue-100 text-blue-800',
            'Pidana' => 'bg-red-100 text-red-800',
        ];

        return $colors[$this->kategori->nama] ?? 'bg-gray-100 text-gray-800';
    }

    public function getPriorityBadgeAttribute()
    {
        $badges = [
            'Low' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">🟢 Rendah</span>',
            'Medium' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">🔵 Sedang</span>',
            'High' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">🟠 Tinggi</span>',
            'Urgent' => '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">🔴 Mendesak</span>',
        ];

        return $badges[$this->priority] ?? $badges['Medium'];
    }

    public function getPriorityColorAttribute()
    {
        $colors = [
            'Low' => 'text-gray-600',
            'Medium' => 'text-blue-600',
            'High' => 'text-orange-600',
            'Urgent' => 'text-red-600',
        ];

        return $colors[$this->priority] ?? 'text-gray-600';
    }

    public function getProgressBadgeAttribute()
    {
        $progress = $this->progress ?? 0;

        if ($progress >= 75) {
            $color = 'bg-green-500';
        } elseif ($progress >= 50) {
            $color = 'bg-blue-500';
        } elseif ($progress >= 25) {
            $color = 'bg-yellow-500';
        } else {
            $color = 'bg-gray-400';
        }

        return "<div class='w-full bg-gray-200 rounded-full h-2'>
                    <div class='{$color} h-2 rounded-full' style='width: {$progress}%'></div>
                </div>
                <span class='text-xs text-gray-600 mt-1'>{$progress}%</span>";
    }

    public function getDaysUntilDeadlineAttribute()
    {
        if (!$this->deadline) {
            return null;
        }

        $now = now()->startOfDay();
        $deadline = $this->deadline->startOfDay();

        return $now->diffInDays($deadline, false);
    }

    public function getDeadlineStatusAttribute()
    {
        $days = $this->days_until_deadline;

        if ($days === null) {
            return null;
        }

        if ($days < 0) {
            return 'overdue';
        } elseif ($days <= 3) {
            return 'urgent';
        } elseif ($days <= 7) {
            return 'warning';
        }

        return 'normal';
    }

    public function getDeadlineBadgeAttribute()
    {
        $days = $this->days_until_deadline;

        if ($days === null) {
            return '<span class="text-xs text-gray-500">Tidak ada deadline</span>';
        }

        if ($days < 0) {
            return sprintf(
                '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">⏰ Terlambat %d hari</span>',
                abs($days)
            );
        } elseif ($days === 0) {
            return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">⏰ Hari ini!</span>';
        } elseif ($days <= 3) {
            return sprintf(
                '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">⚠️ %d hari lagi</span>',
                $days
            );
        } elseif ($days <= 7) {
            return sprintf(
                '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">📅 %d hari lagi</span>',
                $days
            );
        }

        return sprintf(
            '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">✓ %d hari lagi</span>',
            $days
        );
    }

    // Static Methods
    public static function generateNomorPerkara()
    {
        $year = date('Y');
        $lastPerkara = self::whereYear('created_at', $year)
                          ->orderBy('id', 'desc')
                          ->first();

        $nextNumber = $lastPerkara
            ? (int) substr($lastPerkara->nomor_perkara, -3) + 1
            : 1;

        return sprintf('PERK/DIV2/%s/%03d', $year, $nextNumber);
    }

    // Methods
    public function isOverdue()
    {
        return $this->deadline &&
               $this->deadline->isPast() &&
               $this->status !== 'Selesai';
    }

    public function isDeadlineApproaching()
    {
        return $this->deadline &&
               $this->deadline->isFuture() &&
               $this->deadline->diffInDays(now()) <= 7 &&
               $this->status !== 'Selesai';
    }
}
