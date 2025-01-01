<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;


class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $order;

    /**
     * Create a new message instance.
     *
     * @param  $order
     * @return void
     */
    public function __construct($order)
    {
        $this->order = $order; // Menyimpan data order
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // Membuat PDF menggunakan template invoice.blade.php
        $pdf = Pdf::loadView('admin.invoice', ['data' => $this->order]);

        // Mengirim email dengan message.blade.php sebagai isi email dan PDF sebagai lampiran
        return $this->subject('Invoice for Your Order')
            ->view('admin.message') // Menggunakan message.blade.php sebagai isi email
            ->with(['order' => $this->order]) // Mengirimkan data order ke view message.blade.php
            ->attachData($pdf->output(), 'invoice_' . $this->order->id . '.pdf', [
                'mime' => 'application/pdf',
            ]);
    }


    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
