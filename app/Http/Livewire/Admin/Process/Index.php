<?php

namespace App\Http\Livewire\Admin\Process;

use Session;
use App\Models\Application;
use App\Models\Process;
use Livewire\Component;

class Index extends Component
{
    public $data = [];

    public function mount() {
        $this->data = Process::with('application')->get();
    }

    public function destroy($id) {
        Process::find($id)->delete();
        Session::flash('success', 'Berhasil menghapus data!');
        return redirect()->route('process.index');
    }

    public function render()
    {
        return view('livewire.admin.process.index');
    }
}
