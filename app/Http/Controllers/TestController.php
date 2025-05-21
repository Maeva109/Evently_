<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Review;
use App\Models\Notification;
use App\Models\Log;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function testFeatures()
    {
        // Create test users with different roles
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active'
        ]);

        $participant = User::create([
            'name' => 'Test Participant',
            'email' => 'participant@test.com',
            'password' => Hash::make('password'),
            'role' => 'participant',
            'status' => 'active'
        ]);

        // Create a test review
        $review = Review::create([
            'user_id' => $participant->id,
            'event_id' => 1, // Assuming you have an event with ID 1
            'rating' => 5,
            'comment' => 'This was an amazing event!'
        ]);

        // Create a test notification
        $notification = $this->notificationService->sendNotification(
            $participant,
            'Welcome to Evently!',
            'Thank you for joining our platform. Start exploring events now!',
            false // Don't send email in test
        );

        // Create a test log
        $log = Log::activity(
            $admin->id,
            'create',
            'Created a test user account'
        );

        // Return test data
        return view('test.features', compact('admin', 'participant', 'review', 'notification', 'log'));
    }

    public function showNotifications()
    {
        $notifications = Notification::with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('test.notifications', compact('notifications'));
    }

    public function showLogs()
    {
        $logs = Log::with('user')
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('test.logs', compact('logs'));
    }

    public function showReviews()
    {
        $reviews = Review::with(['user', 'event'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('test.reviews', compact('reviews'));
    }
} 