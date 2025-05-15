<?php

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function sendNotification(User $user, string $title, string $message, bool $sendEmail = true)
    {
        // Create database notification
        $notification = Notification::create([
            'user_id' => $user->id,
            'title' => $title,
            'message' => $message,
            'status' => 'unread'
        ]);

        // Send email notification if requested
        if ($sendEmail) {
            $this->sendEmail($user, $title, $message);
        }

        return $notification;
    }

    public function sendEmail(User $user, string $title, string $message)
    {
        Mail::send('emails.notification', [
            'user' => $user,
            'title' => $title,
            'message' => $message
        ], function($mail) use ($user, $title) {
            $mail->to($user->email)
                 ->subject($title);
        });
    }

    public function sendEventReminder(User $user, $event)
    {
        $title = "Reminder: {$event->title}";
        $message = "Don't forget! The event '{$event->title}' starts on " . 
                  $event->start_date->format('F j, Y \a\t g:i A');

        return $this->sendNotification($user, $title, $message);
    }

    public function markAsRead($notificationId, $userId)
    {
        return Notification::where('id', $notificationId)
                         ->where('user_id', $userId)
                         ->update(['status' => 'read']);
    }

    public function getUnreadCount($userId)
    {
        return Notification::where('user_id', $userId)
                         ->where('status', 'unread')
                         ->count();
    }
} 