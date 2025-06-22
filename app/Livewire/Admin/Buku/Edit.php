<?php

namespace App\Livewire\Admin\Buku;

use App\Models\Rak;
use App\Models\Buku;
use Livewire\Component;
use App\Models\Kategori;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
#[Title(('Edit Buku'))]
class Edit extends Component
{
    public $bukuId;
    public $judul;
    public $penulis;
    public $tahun_terbit;
    public $kategori_id;
    public $rak_id;
    public $listKategori = [];
    public $listRak = [];

    public function mount($id)
    {
        $buku = Buku::findOrFail($id);

        $this->bukuId = $buku->id;
        $this->judul = $buku->judul;
        $this->penulis = $buku->penulis;
        $this->tahun_terbit = $buku->tahun_terbit;
        $this->kategori_id = $buku->kategori_id;
        $this->rak_id = $buku->rak_id;

        $this->listKategori = Kategori::all();
        $this->listRak = Rak::all();
    }

    public function update()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|regex:/^[0-9]{0,4}$/',
            'kategori_id' => 'required|exists:kategoris,id',
            'rak_id' => 'required|exists:raks,id',
        ], [
            'tahun_terbit.regex' => 'Sekarang belum mencapai tahun tersebut.',
        ]);

        $buku = Buku::findOrFail($this->bukuId);
        $buku->update([
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'tahun_terbit' => $this->tahun_terbit,
            'kategori_id' => $this->kategori_id,
            'rak_id' => $this->rak_id,
        ]);

        session()->flash('message', 'Buku berhasil diperbarui.');
        return redirect()->route('admin.buku');
    }

    public function render()
    {
        return view('livewire.admin.buku.edit');
    }
}
