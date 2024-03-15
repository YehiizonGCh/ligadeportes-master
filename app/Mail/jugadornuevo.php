<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Attachment;
class jugadornuevo extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $msg;
    public $documentos;
    public $fichaMedica;
    protected $pdf;
    public function __construct($msg, $documentos = null, $fichaMedica = null)
    {
        $this->msg = $msg;
        $this->documentos = $documentos;
        $this->fichaMedica = $fichaMedica;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('joelsiesquens@gmail.com', 'Liga de Deportes Lambayeque'),
            subject: 'Nuevo Jugador Inscrito',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.jugadornuevo'
        );
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
       return [];
        /* $attachments = [
            'documentos'=>$documentos,
            'fichamedica'=>$fichaMedica,
            ];

        if ($this->documentos) {
            $attachments[] = Attachment::fromStorage($this->documentos);
        }

        if ($this->fichaMedica) {
            $attachments[] = Attachment::fromStorage($this->fichaMedica);
        }

        return $attachments;*/
    }
}
