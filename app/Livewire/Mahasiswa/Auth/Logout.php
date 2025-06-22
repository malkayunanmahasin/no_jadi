<?php

namespace App\Livewire\Mahasiswa\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Logout extends Component
{
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login');
    }
    public function render()
    {
        return view('livewire.mahasiswa.auth.logout');
    }
}
