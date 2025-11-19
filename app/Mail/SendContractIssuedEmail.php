<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendContractIssuedEmail extends Mailable
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
        // Log the data for debugging purposes (optional)
        Log::info('Sending contract issued email', $this->data);

        // Return the email with the subject, message as HTML, and attached file
        $filePath = $this->data['filePath'] ?? ''; // Ensure file path is provided

        return $this->subject($this->subject)
                    ->html($this->message)  // Send the message as HTML content
                    ->attach($filePath, [  // Attach the PDF file
                        'as' => 'contract.pdf',  // Optional: Rename the file in the email
                        'mime' => 'application/pdf' // MIME type of the file
                    ]);
    }
}
