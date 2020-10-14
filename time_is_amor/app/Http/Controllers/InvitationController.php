<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Mail\Invitation;
use App\Models\RandomStrings;
use App\User;

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
        $form_email = Auth::user()->email;
        \Mail::to($inviteEmail)->send(new Invitation($inviteText, $cal_id));
        return redirect('/calendar');
    }

    public function getRegister($value)
    {
      return view('auth.invitationRegister', [
        'value' => $value,
        'randomStr' => new RandomStrings,
      ]);
    }

    public function postRegister(Request $request)
    {
        $this->validate($request, [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
          'birthday' => 'required',
          'partner_id' => 'nullable',
        ]);
        $partner = new User([
          'name' => $request->input('name'),
          'email' => $request->input('email'),
          'password' => Hash::make($request->input('password')),
          'birthday' => $request->input('birthday'),
          'partner_id' => $request->input('partner_id'),
        ]);
          $partner->save();
    if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
              $user = User::find($partner->partner_id);
              $user->partner_id = $partner->id;
              $user->save();
          return redirect('/calendar');
        }
    }
}
