<?php

namespace App\Http\Livewire\Admin\SubmissionCreated;

use Session;
use App\Models\Role;
use App\Models\SubmissionCreated;
use Livewire\Component;

class Index extends Component
{
    public $data = [];
    public $roles = [];
    public $role_id;

    public function submit() {
        if ($this->role_id) {
            
        } else {
            Session::flash('error', 'Gagal submit role');
            return redirect()->route('permohonan-hak.index');
        }
    }

    public function destroy($id) {
        SubmissionCreated::where('role_id', $id)->delete();
        Session::flash('success', 'Berhasil menghapus data');
        return redirect()->route('permohonan-hak.index');
    }
    
    public function getRole() {
        $roles = Role::all();

        foreach ($roles as $key => $role) {
            if (in_array($role->id, array_map(function ($v) {
                return $v['role_id'];
            }, $this->data->toArray()))) {
                unset($roles[$key]);
            }
        }
    }

    public function mount() {
        $this->data = SubmissionCreated::with('role')->get();
        $this->getRole();
    }

    public function render()
    {
        return view('livewire.admin.submission-created.index');
    }
}
