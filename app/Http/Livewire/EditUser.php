<?php

namespace App\Http\Livewire;

use App\Models\Account;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditUser extends Component{

    public Account $user;

    public $showSavedAlert = false;
    public $urlId = '';
    
    
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $account_type = '';
    public $password = '';
    public $birthday;
    public $passwordConfirmation = '';

    public function rules() {

        return [
            'user.first_name' => 'max:15',
            'user.last_name' => 'max:20',
            'user.email' => 'email',
            //'user.sex' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'user.birthday' => 'required|date|before:-13 years',
            'user.account_type' => ['required', Rule::in(['reporter', 'responder', 'dispatcher', 'administrator'])],
            'user.address' => 'max:40',
            'user.mobile_no' => 'numeric',
            'user.city_municipality' => 'max:20',
            'user.zip_code' => 'numeric',
        ];
        }
    


   // public function __construct(User $id)
   // {
   //     
   //     $user = User::find($id);
   // }


    public function mount(Account $id) 
    {
      
        $existingUser = Account::find($id)->first();
        $this->urlId = intval($existingUser->id);
        $this->user = $existingUser; 
        $existingUser = Account::where('email', $this->email)->first();
        if($existingUser && $existingUser->id == $this->urlId) {
            
           
        }
        else {
            
        }

    }
    
    public function save()
    {
        $this->validate();
        
        $this->user->save();
        
        $this->showSavedAlert = true;
    }

    
    public function render()
    {
    
        return view('livewire.edit-user');
    }
}