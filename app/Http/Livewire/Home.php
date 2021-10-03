<?php

namespace App\Http\Livewire;

use App\Models\Process;
use App\Models\Submission;
use Livewire\Component;
use Illuminate\Http\Request;

class Home extends Component
{
    public $data = [];
    public $afterSearch = false;
    public $code;

    public function getData() {
        $this->afterSearch = false;
        $this->code = str_replace('#', '', strtolower($this->code));

        $submission = Submission::where('code', $this->code)->first();
        
        if ($submission) {
            $id = $submission->id;
            $this->data = Process::where('application_id', $submission->application_id)
                ->with(['processAction' => function($query) use ($id) {
                    $query->with(['baseAction', 'processActionUser' => function($action) use ($id) {
                        $action->where('submission_id', $id);
                    }]);
                }])->orderBy('order', 'asc')->get();
        } else {
            $this->data = [];
        }

        $this->afterSearch = true;
    }

    public function changeCode() {
        $this->data = [];
    }

    public function mount(Request $request) {
        if ($request->code) {
            $this->code = $request->code;
            $this->getData();
        }
    }

    public function render()
    {
        return view('livewire.home');
    }
}
