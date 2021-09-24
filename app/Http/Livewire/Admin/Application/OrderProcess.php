<?php

namespace App\Http\Livewire\Admin\Application;

use Session;
use App\Models\Application;
use App\Models\Process;
use Livewire\Component;

class OrderProcess extends Component
{
    public $data = [];
    public $process_id = [];

    public function changeOrder() {
        $index = 1;
        $application_id = '';
        
        foreach ($this->process_id as $id) {
            $process = Process::where('id', $id)->first();
            $process->order = $index;
            $process->save();

            $application_id = $process->application_id;
            $index++;
        }
        Session::flash('success', 'Berhasil dirubah urutannya');
        return redirect()->route('application.detail', ['id' => $application_id]);
    }

    public function mount($application_id) {
        $this->data = Process::where('application_id', $application_id)->orderBy('order', 'asc')->get();

        foreach($this->data as $key => $val) {
            array_push($this->process_id, $val->id);
        }
    }

    public function render()
    {
        return view('livewire.admin.application.order-process');
    }
}
