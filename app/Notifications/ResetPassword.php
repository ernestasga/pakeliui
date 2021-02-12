<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('email.reset_password.subject'))
            ->line(__('email.reset_password.line_1'))
            ->action(__('email.reset_password.reset_password'), url(route('password.reset', [
                                            'token' => $this->token,
                                            'email' => $notifiable->getEmailForPasswordReset(),
                                        ], false)))
            ->line(__('email.reset_password.line_2'));
    }
}
