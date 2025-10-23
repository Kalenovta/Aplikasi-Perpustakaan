<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\pengembalian;
use App\Models\pinjam;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class PengembalianGuruComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $user_id, $buku_id, $tgl_kembali;
    public $availableBooks = [];
    public function render()
    {
        // Ambil semua user yang punya pinjaman aktif
        $data['users'] = User::whereHas('pinjam', function($q) {
            $q->where('status', 'dipinjam')
              ->whereDoesntHave('pengembalian');
        })->get();

        $data['pengembalian'] = pengembalian::with(['pinjam.user', 'pinjam.buku'])
            ->latest()
            ->paginate(10);

        $layout['title'] = 'Kelola Pengembalian Buku';
        return view('livewire.pengembalian-guru-component', $data)->layoutData($layout)->layout('components.layouts.guru');
    }
    public function updatedUserId($value)
    {
        // Reset buku_id ketika user berubah
        $this->buku_id = null;
        
        if ($value) {
            // Ambil buku yang sedang dipinjam oleh user ini
            $this->availableBooks = Buku::whereHas('pinjam', function($q) use ($value) {
                $q->where('user_id', $value)
                  ->where('status', 'dipinjam')
                  ->whereDoesntHave('pengembalian');
            })->get();
        } else {
            $this->availableBooks = [];
        }
    }

    public function store()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tgl_kembali' => 'required|date',
        ], [
            'user_id.required' => 'Pilih user terlebih dahulu',
            'buku_id.required' => 'Pilih buku yang dikembalikan',
            'tgl_kembali.required' => 'Tanggal pengembalian harus diisi',
        ]);

        // Cari data pinjaman berdasarkan user dan buku
        $pinjam = pinjam::where('user_id', $this->user_id)
            ->where('buku_id', $this->buku_id)
            ->where('status', 'dipinjam')
            ->whereDoesntHave('pengembalian')
            ->first();

        if (!$pinjam) {
            session()->flash('error', 'Data pinjaman tidak ditemukan atau sudah dikembalikan.');
            return;
        }

        $tgl_batas = Carbon::parse($pinjam->tgl_batas);
        $tgl_kembali = Carbon::parse($this->tgl_kembali);

        // hitung denda jika terlambat
        $denda = 0;
        if ($tgl_kembali->gt($tgl_batas)) {
            $selisih = $tgl_batas->diffInDays($tgl_kembali);
            $denda = $selisih * 1000;
        }

        Pengembalian::create([
            'pinjam_id' => $pinjam->id,
            'tgl_kembali' => $this->tgl_kembali,
            'denda' => $denda,
        ]);

        session()->flash('success', 'Pengembalian buku berhasil dicatat. ' . ($denda > 0 ? 'Denda: Rp ' . number_format($denda, 0, ',', '.') : ''));
        $this->reset(['user_id', 'buku_id', 'tgl_kembali', 'availableBooks']);
        
        $this->dispatch('closeModal');
    }
}
