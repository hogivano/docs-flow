<?php

namespace App\Http\Livewire\Admin\Application;

use Session;
use App\Models\Application;
use Livewire\Component;

class Index extends Component
{
    public $data = [];

    public function mount() {
        $this->data = Application::all();
    }

    public function destroy($id) {
        Application::find($id)->delete();
        Session::flash('success', 'Berhasil menghapus data!');
        return redirect()->route('application.index');
    }

    public function render()
    {
        return view('livewire.admin.application.index');
    }
}
