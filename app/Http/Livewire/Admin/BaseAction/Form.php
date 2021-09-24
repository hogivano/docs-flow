<?php

namespace App\Http\Livewire\Admin\BaseAction;

use Session;
use App\Models\BaseAction;
use Livewire\Component;

class Form extends Component
{
    public $data;
    public $name = '';
    public $type = '';
    public $location = '';
    public $validation = '';
    public $min;
    public $max;
    public $titleRoute = 'Base Action Baru';
    public $typeOption = [];

    protected $rules = [
        'name' => 'required|max:100',
        'type' => 'required'
    ];

    public function store() {
        // $validatedData = $this->validate();
        // if (!$validatedData) {
        //     return $validatedData;
        // }

        // BaseAction::create($validatedData);
        BaseAction::create([
            'name' => $this->name,
            'type' => $this->type,
            'location' => $this->location,
            'validation' => $this->validation,
            'min' => $this->min,
            'max' => $this->max
        ]);
        Session::flash('success', 'Berhasil menambahkan data');
        return redirect()->route('base-action.index');
    }

    public function update($id) {
        // $validatedData = $this->validate();
        // if (!$validatedData) {
        //     return $validatedData;
        // }
        $base = BaseAction::find($id);
        $base->update([
            'name' => $this->name,
            'type' => $this->type,
            'location' => $this->location,
            'validation' => $this->validation,
            'min' => $this->min,
            'max' => $this->max
        ]);

        Session::flash('success', 'Berhasil mengubah data');
        return redirect()->route('base-action.index');
    }

    public function mount($id = null) {
        $this->typeOption = BaseAction::typeOption();
        if ($id) {
            $this->titleRoute = 'Base Action Edit';
            $this->data = BaseAction::where('id', $id)->first();
            
            if (!$this->data) {
                Session::flash('error', 'Data tidak ditemukan');
                return redirect()->route('base-action.index');
            }
            $this->name = $this->data->name;
            $this->type = $this->data->type;
            $this->location = $this->data->location;
            $this->value = $this->data->validation;
            $this->min = $this->data->min;
            $this->max = $this->data->max;
        }
    }

    public function render()
    {
        return view('livewire.admin.base-action.form');
    }
}
