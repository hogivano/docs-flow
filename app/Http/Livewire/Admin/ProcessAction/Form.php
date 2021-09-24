<?php

namespace App\Http\Livewire\Admin\ProcessAction;

use Session;
use App\Models\Process;
use App\Models\ProcessAction;
use App\Models\BaseAction;
use Livewire\Component;

class Form extends Component
{
    public $baseAction = [];
    public $process = [];
    public $relatedProcessAction = [];
    public $processAction = [];

    public $data;
    public $titleRoute = 'Process Action Baru';
    public $disableOption = false;
    public $process_id;
    public $title;
    public $description;
    public $label_input;
    public $is_required;
    public $process_show;
    public $related_process_action_id;
    public $base_action_id;
    public $message_pending = '';
    public $message_failure = '';
    public $message_success = '';

    protected $rules = [
        'process_id' => 'required',
        'label_input' => 'required|max:100',
        'base_action_id' => 'required',
    ];

    public function store() {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        $validatedData['is_required'] = ($this->is_required) ? $this->is_required : 0;
        $validatedData['process_show'] = ($this->process_show) ? $this->process_show : 0;
        $new = ProcessAction::create($validatedData);
        Session::flash('success', 'Berhasil menambahkan data');

        return redirect()->route('process.detail', ['id' => $this->process_id]);
    }

    public function update($id) {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        $validatedData['is_required'] = ($this->is_required) ? $this->is_required : 0;
        $validatedData['process_show'] = ($this->process_show) ? $this->process_show : 0;
        $process = ProcessAction::find($id);
        $process->update($validatedData);
        Session::flash('success', 'Berhasil mengubah data');

        return redirect()->route('process.detail', ['id' => $this->process_id]);
    }

    public function generateDataRelated($id, $process_id) {
        if ($id) {
            $this->relatedProcessAction = ProcessAction::where('id', '!=', $id)
                ->where('process_id', $process_id)->get();
        } else {
            $this->relatedProcessAction = ProcessAction::where('process_id', $process_id)->get();
        }
    }

    public function mount($id = null, $process_id = null) {
        $this->baseAction = BaseAction::all();
        $this->process = Process::all();

        $this->generateDataRelated($id, $process_id);
        if ($process_id) {
            $this->process_id = $process_id;
            $this->disableOption = true;
        }

        if ($id) {
            $this->titleRoute = 'Process Action Edit';

            $this->data = ProcessAction::where('id', $id)->first();

            if (!$this->data) {
                Session::flash('error', 'Data process tidak ditemukan');
                return redirect()->back();
            }

            $this->title = $this->data->title;
            $this->description = $this->data->description;
            $this->label_input = $this->data->label_input;
            $this->is_required = $this->data->is_required;
            $this->process_show = $this->data->process_show;
            $this->related_process_action_id = $this->data->related_process_action_id;
            $this->base_action_id = $this->data->base_action_id;
            $this->message_pending = $this->data->message_pending;
            $this->message_failure = $this->data->message_failure;
            $this->message_success = $this->data->message_success;
        }
    }

    public function render()
    {
        return view('livewire.admin.process-action.form');
    }
}
