<?php

namespace App\Service;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
class RegisterController extends BaseController
{
    public function store($input){
        $input['password']=bcrypt($input['password']);
        $register=User::create($input);
    }
    public function rePass($input){
        $user=User::find($input->id);
        $user->password=bcrypt($input->newpass);
        $user->save();
    }
}
