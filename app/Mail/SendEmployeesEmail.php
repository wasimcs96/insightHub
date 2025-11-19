<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmployeesEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $message;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message, $data)
    {
        $this->subject = $subject;
        $this->message = $message;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                    ->html($this->message);
                    // ->view('emails.employeeonboard')
                    // ->with([
                    //     'message' => $this->message,
                    //     'data' => $this->data,
                    // ]);
    }
}
