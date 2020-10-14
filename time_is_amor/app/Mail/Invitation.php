<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\RandomStrings;

class Invitation extends Mailable
{
    use Queueable, SerializesModels;
    protected $text;
    protected $cal_id;
    protected $randomStr;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inviteText)
    {
        $this->text = $inviteText;
        $this->randomStr = new RandomStrings;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        $fromEmail = Auth::user()->email;
        $fromName =  Auth::user()->name;
        $this->randomStr->random_str = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz'), 0, 6);
        $this->randomStr->users_id = Auth::id();
        $this->randomStr->save();
        return $this->view('emails.invitation', [
          'value' => $this->randomStr->random_str,
        ])
                    ->subject('TimE is AMOr | 招待メール')
                    ->with([
                      "text" => $this->text,
                      "name" => $fromName,
                    ])
                    ->from($fromEmail);
    }
}
