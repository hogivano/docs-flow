<?php

namespace App\Http\Livewire\Admin\Roles;

use Session;
use App\Models\Role;
use Livewire\Component;

class Index extends Component
{
    public $data = [];

    public function destroy($id) {
        Role::find($id)->delete();
        Session::flash('success', 'Berhasil menghapus data!');
        return redirect()->route('roles.index');
    }

    public function mount() {
        $this->data = Role::all();
    }

    public function render()
    {
        return view('livewire.admin.roles.index');
    }
}
