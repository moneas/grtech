<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Events\EmployeeCreated;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::with('company')->get();
        return Inertia::render('Employee/Index', ['employees' => $employees]);
    }

    public function create()
    {
        $companies = Company::all();
        return Inertia::render('Employee/Create', ['companies' => $companies]);
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = Employee::create($request->validated());
        event(new EmployeeCreated($employee));
        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }

    public function show(Employee $employee)
    {
        return Inertia::render('Employee/Show', ['employee' => $employee]);
    }

    public function edit(Employee $employee)
    {
        $companies = Company::all();
        return Inertia::render('Employee/Edit', [
            'employee' => $employee,
            'companies' => $companies
        ]);
    }

    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
    }
}
