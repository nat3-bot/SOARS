<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificateEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $students;
    protected $event;
    protected $filePath;

    /**
     * Create a new message instance.
     * 
     * @param $students
     * @param $event
     * @param $filePath
     */
    public function __construct($students, $event, $filePath)
    {
        $this->students = $students;
        $this->event = $event;
        $this->filePath = $filePath;
    }

    

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function build()
    {
        return $this->view('send_certificate')
                    ->with([
                        'students' => $this->students,
                        'event' => $this->event,
                    ])
                    ->subject('Certificate of Completion')
                    ->attach($this->filePath);
    }
}
