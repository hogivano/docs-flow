<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Login extends Component
{
    public $email = '';
    public $password = '';
    public $remember_me = false;

    protected $rules = [
        'email' => 'required|email:rfc,dns',
        'password' => 'required',
    ];

    public function mount() {
        if(auth()->user()){
            redirect()->route('home');
        }
    }

    public function authenticate() {        
        if(auth()->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
            $user = User::where(["email" => $this->email])->first();
            auth()->login($user, $this->remember_me);
            return redirect()->route('dashboard');        
        }
        else{
            $errors = $this->getErrorBag();
            $errors->add('auth', 'Email/password salah');
            return $errors; 
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
