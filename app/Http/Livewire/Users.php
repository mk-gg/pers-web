<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Account;
class Users extends Component
{   
    public Account $user;
    public Account $existingUser;
    public $email = '';
    public $urlId = '';
  

    public function delete(Account $user)
    {
       
        $this->existingUser = Account::find($user)->first();
       
        $this->urlId = intval($user->id);
        $this->user = $this->existingUser; 
        $this->email = $this->existingUser->email;
        $this->existingUser = Account::where('email', $this->email)->first();
        
        if($this->existingUser && $this->existingUser->id == $this->urlId) 
        {
            
           $user->delete();
         
        }
        else {
            
           
       
        }
    }

    public function render()
    {
        return view('livewire.users', [
            //'users' => User::all(),
            'users' => Account::all(), 
        ]);
    }
}
