<?php

namespace App\Http\Livewire\Admin\Permohonan;

use Session;
use App\Models\Submission;
use Livewire\Component;

class Index extends Component
{
    public $data = [];

    public function mount() {
        $this->data = Submission::with('application', 'createUser', 'updateUser')->get();
    }

    public function destroy($id) {
        Submission::find($id)->delete();
        
        Session::flash('success', 'Berhasil mengahapus data!');
        return redirect()->route('permohonan.index');
    }

    public function render()
    {
        return view('livewire.admin.permohonan.index');
    }
}
