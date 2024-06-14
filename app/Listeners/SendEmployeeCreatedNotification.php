<?php

namespace App\Listeners;

use App\Events\EmployeeCreated;
use App\Mail\EmployeeCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendEmployeeCreatedNotification implements ShouldQueue
{
    public function handle(EmployeeCreated $event)
    {
        try {
            Mail::to($event->user->email)->send(new EmployeeCreatedNotification($event->employee));
        } catch (\Exception $e) {
            Log::error('Failed to send email to: ' . $event->user->email . '. Error: ' . $e->getMessage());
        }
    }
}
