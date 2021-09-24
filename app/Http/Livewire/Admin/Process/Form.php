<?php

namespace App\Http\Livewire\Admin\Process;

use Session;
use App\Models\Process;
use App\Models\Application;
use Livewire\Component;

class Form extends Component
{
    public $titleRoute = 'Process Baru';
    public $title = '';
    public $description = '';
    public $message_pending = '';
    public $message_failure = '';
    public $message_success = '';
    public $application_id;
    public $applications = [];
    public $data = null;
    public $disableOption = false;

    protected $rules = [
        'title' => 'required|min:3|max:100',
        'description' => 'required|min:3|max:100',
        'message_pending' => 'required|min:3|max:100',
        'message_failure' => 'required|min:3|max:100',
        'message_success' => 'required|min:3|max:100',
    ];

    public function mount($id = null, $application_id = null) {
        $this->applications = Application::all();
        
        if ($application_id) {
            $this->disableOption = true;
            $this->application_id = $application_id;
        }

        if ($id) {
            $this->titleRoute = 'Process Edit';
            $this->data = Process::find($id);

            if (!$this->data) {
                Session::flash('error', 'Data process tidak ditemukan');
                return redirect()->back();
            } 

            $this->title = $this->data->title;
            $this->description = $this->data->description;
            $this->message_pending = $this->data->message_pending;
            $this->message_failure = $this->data->message_failure;
            $this->message_success = $this->data->message_success;
            $this->application_id = $this->data->application_id;
            $this->disableOption = true;
        }
    }

    public function getPosOrder() {
        $orderApp = Process::where('application_id', $this->application_id)->orderBy('order', 'DESC')->first();
        if ($orderApp) {
            return $orderApp->order + 1;
        }
        return 1;
    }

    public function store() {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        $validatedData['application_id'] = $this->application_id;
        $validatedData['order'] = $this->getPosOrder();

        Process::create($validatedData);
        Session::flash('success', 'Berhasil menambahkan data');

        if ($this->disableOption) {
            return redirect()->route('application.detail', ['id' => $this->application_id]);
        }
        return redirect()->route('process.index');
    }

    public function update($id) {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        $process = Process::find($id);
        $process->update($validatedData);
        Session::flash('success', 'Berhasil mengubah data');
        return redirect()->route('application.detail', ['id' => $process->application_id]);
    }

    public function render()
    {
        return view('livewire.admin.process.form');
    }
}
