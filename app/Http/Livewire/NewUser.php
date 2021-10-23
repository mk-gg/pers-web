<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NewUser extends Component
{
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $role = '';
    public $password = '';
    public $passwordConfirmation = '';

    public function rules()
    {
        return [
            'first_name' => 'max:15',
            'last_name' => 'max:20',
            'email' => 'email',
            #'role' => ['required', Rule::in(['Responder', 'Reporter', 'Dispatcher', 'Administrator'])],
        ];
    }

    public function updatedEmail()
    {
        $this->validate(['email'=>'required|email:rfc,dns|unique:users']);
    }


    
    public function add()
    {
        $this->validate([
            'first_name' => 'max:15',
            'last_name' => 'max:20',
            'email' => 'email',
            #'role' => ['required', Rule::in(['Responder', 'Reporter', 'Dispatcher', 'Administrator'])],
            'email' => 'required',
            'password' => 'required|same:passwordConfirmation|min:6',
        ]);

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'remember_token' => Str::random(10),
        ]);

        return redirect('/users');
    }


    public function render()
    {
        return view('livewire.new-user');
    }
    
}