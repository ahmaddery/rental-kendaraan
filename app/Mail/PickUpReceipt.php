<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class PickUpReceipt extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;
    public $pickUpDate;
    public $returnDate;
    public $duration;
    public $kendaraans;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $order, $pickUpDate, $returnDate)
    {
        $this->user = $user;
        $this->order = $order;
        $this->pickUpDate = $pickUpDate;
        $this->returnDate = $returnDate;
        $this->kendaraans = \App\Models\Kendaraan::whereIn('id', explode(',', $order->kendaraan_id))->get();
        
        // Calculate the duration
        $this->duration = $this->calculateDuration($pickUpDate, $returnDate);
    }

    /**
     * Calculate the rental duration based on pick-up and return dates.
     */
    private function calculateDuration($pickUpDate, $returnDate)
    {
        $pickUpDate = \Carbon\Carbon::parse($pickUpDate);
        $returnDate = \Carbon\Carbon::parse($returnDate);
        return $pickUpDate->diffInDays($returnDate);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = Pdf::loadView('emails.pickup_receipt', [
            'user' => $this->user,
            'order' => $this->order,
            'pickUpDate' => $this->pickUpDate,
            'returnDate' => $this->returnDate,
            'duration' => $this->duration,
            'kendaraans' => $this->kendaraans,
        ]);

        return $this->view('emails.pickup_receipt')
                    ->subject('Your Vehicle Pick-Up Receipt')
                    ->attachData($pdf->output(), 'receipt.pdf', [
                        'mime' => 'application/pdf',
                    ])
                    ->with([
                        'user' => $this->user,
                        'order' => $this->order,
                        'pickUpDate' => $this->pickUpDate,
                        'returnDate' => $this->returnDate,
                        'duration' => $this->duration,
                        'kendaraans' => $this->kendaraans,
                    ]);
    }
}
