<?php

namespace App\Http\Livewire\Admin\User;

use Session;
use App\Models\User;
use App\Models\UserRole;
use Livewire\Component;

class Index extends Component
{
    public $data = [];

    public function mount() {
        $this->data = User::with('userRole.role')->get();
    }

    public function destroy($id) {
        User::find($id)->delete();
        Session::flash('success', 'Berhasil menghapus data!');
        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.admin.user.index');
    }
}
