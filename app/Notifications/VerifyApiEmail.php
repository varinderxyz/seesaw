<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class VerifyApiEmail extends Notification implements ShouldQueue
{
    use Queueable;
    protected $otp;
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct($otp)
    {
        $this->otp = $otp;
    }
    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }
     /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
     public function toMail($notifiable)
     {
        $url = $this->otp;
        return (new MailMessage)
            ->line('You are receiving this email because we received a email verify request for your account.')
            ->action('OTP: '. $url,'')
            ->line('If you did not request a email verify, no further action is required.')
            ->markdown('mail.emailverify', ['url' => $url]);
    }
    /**
    * Get the array representation of the notification.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}