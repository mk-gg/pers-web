<?php

namespace App\Http\Livewire;

use App\Models\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class NewUser extends Component
{
    public Account $user;
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $account_type = '';
    public $password = '';
    public $passwordConfirmation = '';
    //public $birthdate = '';
    public $showAddAlert = false;
    public $account_types;

    public function rules()
    {
        return [
            'first_name' => 'max:15',
            'last_name' => 'max:20',
            'email' => 'email',
            'account_type' => ['required', Rule::in(['responder', 'reporter', 'dispatcher', 'administrator'])],
            'password' => 'required|same:passwordConfirmation|min:6'
        ];
    }

    public function updatedEmail()
    {
        $this->validate(['email'=>'required|email:rfc,dns|unique:accounts']);
    }


    
    public function add()
    {
        
        $this->validate([
            'first_name' => 'max:15',
            'last_name' => 'max:20',
            'email' => 'email',
            
            'account_type' => ['required', Rule::in(['responder', 'reporter', 'dispatcher', 'administrator'])],
            'email' => 'required',
            'password' => 'required|same:passwordConfirmation|min:6',
           
        ]);
       
        
        $this->user = Account::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'account_type' => strtolower($this->account_type),
            'password' => Hash::make($this->password),
            'remember_token' => Str::random(10),
        ]);

        $this->showAddAlert = true;   
        return redirect('/users');
    }


    public function render()
    {
        //view('livewire.new-user', ['account_types' => ['Responder', 'Reporter', 'Dispatcher']]
        return view('livewire.new-user');
        ;
    }
    
}