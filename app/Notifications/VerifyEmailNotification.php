<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailNotification extends VerifyEmail
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    // public function via(object $notifiable): array
    // {
    //     return ['mail'];
    // }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        return (new MailMessage)
            ->subject('Penting: Verifikasi Akun MyCommerce Anda')

            // --- Konten Email ---
            ->line('Halo '.$notifiable->name.',')
            ->line('Terima kasih telah mendaftar di **MyCommerce**! Langkah terakhir untuk mengaktifkan akun Anda adalah dengan mengklik tombol verifikasi di bawah ini.')
            ->line('Verifikasi email ini diperlukan agar Anda dapat melakukan transaksi checkout dan mengakses semua fitur premium kami.')

            // --- Tombol Aksi ---
            ->action('Verifikasi Email Saya Sekarang', $verificationUrl)

            // --- Catatan Penutup ---
            ->line('Jika Anda mengalami masalah saat mengklik tombol "Verifikasi Email Saya Sekarang", silakan salin dan tempel URL di bawah ini ke browser Anda:')
            ->line($verificationUrl)
            ->line('Hormat kami,')
            ->line('Tim MyCommerce');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
