<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EditUser extends Component{

    public User $user;

    public $showSavedAlert = false;
    public $urlId = '';
    
    
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $role = '';
    public $password = '';
    public $passwordConfirmation = '';
    
    public function rules() {
        
        return [
         
            'user.first_name' => 'max:15',
            'user.last_name' => 'max:20',
            'user.email' => 'email',
            'user.phone' => 'numeric',
            
        ];
    }

   // public function __construct(User $id)
   // {
   //     
   //     $user = User::find($id);
   // }

    public function tests()
    {
        dd('boo');
    }
    public function mount(User $id) 
    {
      
        $existingUser = User::find($id)->first();
        $this->urlId = intval($existingUser->id);
        $this->user = $existingUser; 
        $existingUser = User::where('email', $this->email)->first();
        if($existingUser && $existingUser->id == $this->urlId) {
            
            dd(1);
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