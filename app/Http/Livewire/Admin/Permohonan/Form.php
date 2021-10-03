<?php

namespace App\Http\Livewire\Admin\Permohonan;

use Auth;
use Session;
use App\Models\Submission;
use App\Models\Application;
use Livewire\Component;
use Illuminate\Support\Str;

class Form extends Component
{
    public $titleRoute = 'Permohonan Baru';
    public $data;
    public $applications = [];
    public $application_id;
    public $title;
    public $description;
    public $code;

    protected $rules = [
        'code' => 'required|max:12|unique:submissions,code',
        'title' => 'required|min:3|max:100',
    ];

    public function generateCode() {
        $getLast = Submission::orderBy('id', 'DESC')->first();

        if ($getLast) {
            $id = $getLast->id;
            $len = 6 - strlen((string) $id);

            $base = '';
            for ($i = 0; $i < $len; $i++) {
                $base .= '0';
            }
            return $base . $len;
        }
        return '000001';
    }

    public function getSlug($slug) {
        $check = Submission::where('slug', $slug)->first();
        if ($check) {
            return $slug . mt_rand();
        }

        return $slug;
    }

    public function store() {
        $this->code = strtolower($this->code);
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }
        $validatedData['application_id'] = $this->application_id;
        $validatedData['description'] = $this->description;
        $validatedData['slug'] = $this->getSlug(Str::slug($this->title));
        $validatedData['created_by'] = Auth::id();
        $validatedData['updated_by'] = Auth::id();

        Submission::create($validatedData);
        Session::flash('success', 'Berhasil menambahkan data');

        return redirect()->route('permohonan.index');
    }
    
    public function update($id) {
        $submit = Submission::find($id);
        if ($submit->code == $this->code) {
            unset($this->rules['code']);
        } else {
            $this->code = strtolower($this->code);
        }
        $validatedData = $this->validate();
        if (!$validatedData) {
            return $validatedData;
        }

        $slug = Str::slug($this->title);

        if ($submit) {
            if ($submit->slug != $slug) {
                $slug = $this->getSlug($slug);
            }
        }
        $validatedData['slug'] = $slug;
        $validatedData['application_id'] = $this->application_id;
        $validatedData['description'] = $this->description;
        $validatedData['updated_by'] = Auth::id();

        $submit->update($validatedData);
        Session::flash('success', 'Berhasil merubah data');
        return redirect()->route('permohonan.index');
    }

    public function mount($id = null) {
        $this->applications = Application::all();

        if ($id) {
            $this->titleRoute = 'Permohonan Edit';
            $this->data = Submission::where('id', $id)->first();
            
            $this->code = $this->data->code;
            $this->application_id = $this->data->application_id;
            $this->title = $this->data->title;
            $this->description = $this->data->description;
        }
    }

    public function render()
    {
        return view('livewire.admin.permohonan.form');
    }
}
