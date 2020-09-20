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
    public function __construct($inviteText)
    {
        $this->text = $inviteText;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $fromEmail = Auth::user()->email;
        return $this->view('emails.invitation')
                    ->subject('TimE is AMOr | 招待メール')
                    ->with([
                      "text" => $this->text,
                    ])
                    ->from($fromEmail);
    }
}
