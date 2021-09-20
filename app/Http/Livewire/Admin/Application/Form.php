<?php

namespace App\Http\Livewire\Admin\Application;

use Session;
use App\Models\Application;
use Livewire\Component;
use Illuminate\Support\Str;

class Form extends Component
{
    public $titleRoute = 'Application Baru';
    public $title = '';
    public $description = '';
    public $is_ordered = false;
    public $data = null;

    protected $rules = [
        'title' => 'required|min:3|max:225',
        'description' => 'required|min:3|max:225'
    ];

    public function store() {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        $validatedData['is_ordered'] = ($this->is_ordered) ? 1 : 0;
        $validatedData['slug'] = Str::slug($this->title);
        Application::create($validatedData);
        Session::flash('success', 'Berhasil menambahkan data');
        return redirect()->route('application.index');
    }

    public function update($id) {
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        //check slug
        $check = Application::where('id', $id)->first();
        $slug = Str::slug($this->title);
        if ($check->slug != $slug) {
            $check->slug = $slug;
        }
        $check->title = $this->title;
        $check->description = $this->description;
        $check->is_ordered = $this->is_ordered;
        $check->save();

        Session::flash('success', 'Berhasil edit data');
        return redirect()->route('application.index');
    }

    public function mount($id = null) {
        if ($id) {
            $this->titleRoute = 'Application Edit';

            $this->data = Application::find($id);

            if (!$this->data) {
                Session::flash('error', 'Application tidak ditemukan');
                return redirect()->route('application.index');
            }

            $this->title = $this->data->title;
            $this->description = $this->data->description;
            $this->is_ordered = $this->data->is_ordered;
        }
    }
    
    public function render()
    {
        return view('livewire.admin.application.form');
    }
}
