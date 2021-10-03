<?php

namespace App\Http\Livewire\Admin\Permohonan;

use App\Models\Process;
use App\Models\Application;
use App\Models\Submission;
use Livewire\Component;

class Detail extends Component
{
    public $submission;
    public $process;

    public function mount($id) {
        $this->submission = Submission::where('id', $id)->first();

        if ($this->submission) {
            $this->process = Process::where('application_id', $this->submission->application_id)
                ->with(['processAction' => function($query) use ($id) {
                    $query->with(['baseAction', 'processActionUser' => function($action) use ($id) {
                        $action->where('submission_id', $id);
                    }]);
                }])->orderBy('order', 'asc')->get();
        }
    }

    public function render()
    {
        return view('livewire.admin.permohonan.detail');
    }
}
