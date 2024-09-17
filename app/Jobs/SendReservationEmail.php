<?php

namespace App\Jobs;

use App\Models\Reservation;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendReservationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $reservation;
    protected $recipientEmail;

    public function __construct(Reservation $reservation, string $recipientEmail)
    {
        $this->reservation = $reservation;
        $this->recipientEmail = $recipientEmail;
    }

    public function handle()
{
    Log::info('Sending reservation email to: ' . $this->recipientEmail);

    $config = Configuration::getDefaultConfiguration()
        ->setApiKey('api-key', env('MAIL_PASSWORD'));

    $emailApi = new TransactionalEmailsApi(new \GuzzleHttp\Client, $config);

    $email = new SendSmtpEmail([
        'to' => [['email' => $this->recipientEmail]],
        'subject' => 'Meeting Reservation Details',
        'htmlContent' => view('emails.reservation', ['reservation' => $this->reservation])->render(),
        'sender' => ['email' => env('MAIL_FROM_ADDRESS'), 'name' => env('MAIL_FROM_NAME')],
    ]);

    try {
        $emailApi->sendTransacEmail($email);
    } catch (\Exception $e) {
        Log::error('Error sending reservation email to ' . $this->recipientEmail . ': ' . $e->getMessage());
    }
}

}
