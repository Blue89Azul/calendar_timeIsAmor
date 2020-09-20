<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Mail\Invitation;
use App\Models\User;

class InvitationController extends Controller
{
  public function mail(Request $request) {
    $invitatiton_form = $request->validate([
      'toEmail' => 'email',
      'textForSend' => 'max:200',
    ]);
    $inviteText = $request->get('textForSend');
    $cal_id = Auth::user()->cal_id;
    $inviteEmail = $request->get('toEmail');
    Mail::to($inviteEmail)->send(new Invitation($inviteText, $cal_id));
    return redirect('/calendar');
  }

  public function getRegister(){
    return view('auth.invitationRegister');
  }

  public function postRegister(Request $request){
    
    // $this->validate($request, [
    //   'name' => ['required', 'string', 'max:255'],
    //   'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //   'password' => ['required', 'string', 'min:8', 'confirmed'],
    //   'birthday' => ['required'],
    //   'partner_id' => ['nullable'],
    // ])
    //
    // $user = new User([
    //   'name' => $request->input('name'),
    //   'email' => $request->input('email'),
    //   'password' => bcrypt($request->input('password')),
    //   'birthday' => $request->input('birthday'),
    //   'partner_id' => Auth::id(),
    // ]);
    // $user->save();

    // 事前に登録しているユーザー
    $shoutai = Auth::user();
    $shoutai->partner_id = $user->id;
    $shoutai->save();

    //プッシュ通知。。。

    return redirect('/calendar'); //ユーザIDの表示
  }
}
