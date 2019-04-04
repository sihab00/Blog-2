<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use App\User;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Queueable;


    private $user;

    /**

     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
       $this->user = $user;
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
        return (new MailMessage)
                    ->line('Dear'. $this->user->username)
                    ->line('Your account has been created successflly. Please click the following link to activated your account!')
                    ->action('Click to verify the account', route('verify',$this->user->email_verification_token));
    }

    /**
 * Get the Nexmo / SMS representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return NexmoMessage
 */
    // public function toNexmo($notifiable)
    // {
    // return (new NexmoMessage)
    //             ->content('Dear'. $this->user->username. '.Your accoutn has been created successflly --NIsaD')
    //             ->from('01683662615');
    // }

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
