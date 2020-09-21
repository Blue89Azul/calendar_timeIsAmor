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
    public function mail(Request $request)
    {
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

    public function getRegister()
    {
        //別のセッションデータを
        return view('auth.invitationRegister');
    }

    public function postRegister(Request $request)
    {
        $form = $request->all();
        if (isset($form['name'])) {
            $user = new User(['partner_id' => Auth::id()]);
        }
        unset($form['_token']);
        $user->save();

        // 事前に登録しているユーザー
        $shoutai = Auth::user();
        // dd($shoutai);
        $shoutai->partner_id = $user->id;
        $shoutai->save();

        return redirect('/calendar'); //ユーザIDの表示
    }
}
