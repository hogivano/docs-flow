<?php

namespace App\Http\Livewire\Admin\BaseAction;

use Session;
use App\Models\BaseAction;
use Livewire\Component;

class Index extends Component
{
    public $data = [];

    public function mount() {
        $this->data = BaseAction::all();
    }

    public function destroy($id) {
        BaseAction::find($id)->delete();
        Session::flash('success', 'Berhasil menghapus data!');
        return redirect()->route('base-action.index');
    }

    public function render()
    {
        return view('livewire.admin.base-action.index');
    }
}
