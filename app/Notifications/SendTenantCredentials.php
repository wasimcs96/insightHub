<?php

namespace App\Notifications;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendTenantCredentials extends Notification implements ShouldQueue
{
    use Queueable;

    public Tenant $tenant;
    public string $password;
    public string $loginUrl;

    /**
     * Create a new notification instance.
     */
    public function __construct(Tenant $tenant, string $password, string $loginUrl = null)
    {
        $this->tenant = $tenant;
        $this->password = $password;
        $this->loginUrl = $loginUrl ?? config('app.url') . '/login';
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to ' . config('app.name') . ' - Your Account Credentials')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Welcome to ' . config('app.name') . '. Your tenant account has been successfully created.')
            ->line('**Company Name:** ' . $this->tenant->name)
            ->line('**Email:** ' . $notifiable->email)
            ->line('**Temporary Password:** ' . $this->password)
            ->line('Please keep this password secure. We recommend changing it after your first login.')
            ->action('Login to Your Account', $this->loginUrl)
            ->line('If you have any questions or need assistance, please contact our support team.')
            ->line('Thank you for choosing ' . config('app.name') . '!');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'tenant_id' => $this->tenant->id,
            'tenant_name' => $this->tenant->name,
            'login_url' => $this->loginUrl,
        ];
    }
}
