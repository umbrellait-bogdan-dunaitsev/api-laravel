<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Mail;


class UserController extends Controller
{
    public function beginCheck(Request $request) {
        $email = $request->email;
        $user = User::where('email',$email)->firstOrFail();
        if (isset($user)) {
            $this->generateToken($user);
            $this->sendEmail($user);
            return ['message' => 'На вашу почту отправлено письмо с подтверждением'];
        } else {
            return ['message' => 'Такого e-mail не существует в системе'];
        }      
    }

    public function generateToken(User $user) {
        $temp_token = Str::random(64);
        $temp = User::find($user->id);
        $temp->remember_token = $temp_token;
        $temp->save();
    }

    public function sendEmail(User $user) {
        $user->link = 'http://localhost:5555/myRoom/?r='.$user->remember_token;
        Mail::send('mail', ['user' => $user], function ($m) {
            $m->from('bogdan.dunaitsev@umbrellait.com', 'PortalApp');
            $m->to('bogdan.dunaitsev@umbrellait.com', 'Пользователю')->subject('Ссылка для входа в приложение');
        });
        // $w1 = new EvTimer(600, 0, function () {
        //     $temp = User::find($user->id);
        //     $temp->remember_token = '';
        //     $temp->save();
        // });
    }
}
