<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;
      protected $text;
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
        // dd($fromEmail);
        return $this->view('emails.invitation')
                    ->subject('テスト送信')
                    ->with([
                      "text" => $this->text,
                    ])
                    ->from($fromEmail);
    }
}