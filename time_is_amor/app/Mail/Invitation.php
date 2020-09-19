<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;
      protected $text;
      protected $cal_id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inviteText, $cal_id)
    {
      $this->text = $inviteText;
      $this->cal_id = $cal_id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $fromEmail = Auth::user()->email;
        // dd($fromEmail);
        return $this->view('emails.invitation')
                    ->subject('TimE is AMOr | 招待メール')
                    ->with([
                      "text" => $this->text,
                      "cal_id" => $this->cal_id,
                    ])
                    ->from($fromEmail);
    }
}
