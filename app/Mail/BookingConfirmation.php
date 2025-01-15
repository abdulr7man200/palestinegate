<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $booking;
    public $isStore;

    /**
     * Create a new message instance.
     */
    public function __construct($booking, $isStore = false)
    {
        $this->booking = $booking;
        $this->isStore = $isStore;
    }


    public function build()
    {
        return $this->subject('Booking Confirmation')
                    ->view($this->isStore ? 'emails.booking-store' : 'emails.booking-confirmation')
                    ->with([
                        'user' => auth()->user(),
                        'booking' => $this->booking,
                        'car' => $this->booking->car_id ? $this->booking->car : null,
                        'room' => $this->booking->room_id ? $this->booking->room : null,
                        'stay' => $this->booking->stay_id ? $this->booking->stay : null,
                    ]);
    }
}
