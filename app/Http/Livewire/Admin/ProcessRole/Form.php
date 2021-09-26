<?php

namespace App\Http\Livewire\Admin\ProcessRole;

use Session;
use App\Models\Application;
use App\Models\Role;
use App\Models\Process;
use App\Models\ProcessRole;
use Livewire\Component;

class Form extends Component
{
    public $application;
    public $roles = [];
    public $read = [];
    public $created = [];
    public $updated = [];
    public $deleted = [];
    public $process_id = null;
    public $processes = [];
    public $loading = false;
    public $showButton = false;

    protected $rules = [
        'process_id' => 'required'
    ];

    public function checkProcessRole($process_id, $role_id) {
        return (ProcessRole::where('process_id', $process_id)->where('role_id', $role_id)->first()) ? true : false;
    }

    public function defaultCrud() {
        $this->read = [];
        $this->created = [];
        $this->updated = [];
        $this->deleted = [];
    }

    public function generateDataCrud() {
        $this->defaultCrud();
        foreach($this->roles as $role) {
            if ($role->read == 1) {
                array_push($this->read, $role->id);
            }
            if ($role->create == 1) {
                array_push($this->created, $role->id);
            }
            if ($role->update == 1) {
                array_push($this->updated, $role->id);
            }
            if ($role->delete == 1) {
                array_push($this->deleted, $role->id);
            }
        }
    }

    public function createNewProcessRole($process_id) {
        $getRoles = Role::all();
        foreach ($getRoles as $role) {
            if (!$this->checkProcessRole($process_id, $role->id)) {
                ProcessRole::create([
                    'role_id' => $role->id,
                    'process_id' => $process_id,
                    'read' => ($role->id == 1) ? true : false,
                    'create' => ($role->id == 1) ? true : false,
                    'update' => ($role->id == 1) ? true : false,
                    'delete' => ($role->id == 1) ? true : false,
                ]);
            }
        }

        $this->roles = ProcessRole::where('process_id', $process_id)->with('process', 'role')->get();
        $this->generateDataCrud();
    }

    public function initProcessId() {
        if (sizeof($this->processes) > 0) {
            $this->process_id = $this->processes[0]->id;
            $this->getDataRoles();
        }
    }

    public function getDataRoles() {
        if ($this->process_id) {
            $proId = $this->process_id;
            $this->createNewProcessRole($proId);
            $this->showButton = true;
        } else {
            $this->roles = [];
            $this->showButton = false;
        }
    }
    
    public function changeOption() {
        $this->getDataRoles();
    }

    public function submit() {
        foreach($this->roles as $role) {
            $arrCrud = [];
            $inRead = in_array($role->id,$this->read);
            $inCreated = in_array($role->id, $this->created);
            $inUpdated = in_array($role->id, $this->updated);
            $inDeleted = in_array($role->id, $this->deleted);

            if ($role->read != (($inRead) ? 1 : 0)) {
                $arrCrud['read'] = (($inRead) ? 1 : 0);
            }

            if ($role->create != (($inCreated) ? 1 : 0)) {
                $arrCrud['create'] = (($inCreated) ? 1 : 0);
            }

            if ($role->update != (($inUpdated) ? 1 : 0)) {
                $arrCrud['update'] = (($inUpdated) ? 1 : 0);
            }

            if ($role->delete != (($inDeleted) ? 1 : 0)) {
                $arrCrud['delete'] = (($inDeleted) ? 1 : 0);
            }

            if (sizeof($arrCrud) > 0) {
                ProcessRole::where('id', $role->id)->update($arrCrud);
                Session::flash('success', 'Berhasil update data');
            } else {
                Session::flash('error', 'Tidak ada perubahan data');
            }
        }
        return redirect()->route('process-role.setting-byappid', ['application_id' => $this->application->id]);
    }

    public function mount($application_id = null, $process_id = null) {
        $this->application = Application::where('id', $application_id)->first();
        if (!$this->application) {
            Session::flash('error', 'Data tidak ditemukan');
            return redirect()->back();
        }
        $this->processes = Process::where('application_id', $this->application->id)->get();
    }

    public function render()
    {
        return view('livewire.admin.process-role.form');
    }
}
