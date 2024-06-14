<?php

namespace App\Events;

use App\Models\Employee;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class EmployeeCreated
{
    use Dispatchable, SerializesModels;

    public $employee;
    public $user;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
        $this->user = Auth::user();
    }
}