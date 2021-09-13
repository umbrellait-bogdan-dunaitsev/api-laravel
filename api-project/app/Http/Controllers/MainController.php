<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function toProfile(Request $request) {
        $token = $request->get('r');
        $user = User::where('remember_token',$token)->firstOrFail();
        if (isset($user)) {
            $temp = User::find($user->id);
            $temp->remember_token = '';
            $temp->save();
            dd('Я все сделал');
            return redirect()->route('/user/{id}', [$user]);
        }
    }
}
