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
    protected $pdf;
    public function __construct($msg)
    {
        $this->msg = $msg;
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
    /*public function build()
    {
        return $this->view('pdf.jugador_nuevo')
                    ->attachData($this->pdf, 'Jugador_Nuevo.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
*/
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            /*Attachment::fromPath(storage_path('app/public/jugadores/documentos/', $this->msg->docs))
                ->as('autorizacion.pdf')
                ->withMime('application/pdf'),*/
        ];
    }
}
