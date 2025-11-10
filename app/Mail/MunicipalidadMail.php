<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MunicipalidadMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $pdfPath; // Propiedad para almacenar la ruta del PDF

    /**
     * Create a new message instance.
     *
     * @param string $pdfPath
     */
    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath; // Almacenar la ruta del PDF
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Municipalidad Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.municipalidad',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        // Retornamos un array vacío ya que se hará la adjunción en el método build
        return [];
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Adjuntar el PDF
        return $this->attach($this->pdfPath, [
            'as' => 'ActaConforme.pdf',  // Nombre del archivo adjunto
            'mime' => 'application/pdf',  // Tipo MIME
        ]);
    }
}
