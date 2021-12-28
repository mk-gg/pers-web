<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
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
    public $account_type;
    public $password = '';
    public $passwordConfirmation = '';
    public $birthday;
    public $showAddAlert = false;
    public $account_types;
    public $mobile_no;
    public $sex;
    public $unit_name = '';

    public function rules()
    {
        return [
            'first_name' => 'max:15',
            'last_name' => 'max:20',
            'email' => 'email',
            'birthday' => 'required',
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
       
        
        // Validate First the inputs before creating
        $this->validate([
            'first_name' => 'max:15',
            'last_name' => 'max:20',
            'birthday' => 'required',
            'sex'  => ['required', Rule::in(['male', 'female'])],
            'email' => 'email',
            'mobile_no' => 'required',
            'account_type' => ['required', Rule::in(['responder', 'reporter', 'dispatcher', 'administrator'])],
            'email' => 'required|email:rfc,dns|unique:accounts',
            'password' => 'required|same:passwordConfirmation|min:6',
            'unit_name' => 'max:20',
           
        ]);
       
       
      
        // Create a user
        $this->user = Account::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'sex' => strtolower($this->sex),
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'account_type' => 'responder',
            'birthday' => $this->birthday,
            'mobile_no' => $this->mobile_no,
            'unit_name' => $this->unit_name,
            'remember_token' => Str::random(10),
            
        ]);
    
        // Pop up a alert message.
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