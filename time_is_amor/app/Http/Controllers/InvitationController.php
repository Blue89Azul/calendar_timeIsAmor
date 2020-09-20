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
    
    return;
  }
}
