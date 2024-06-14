<?php
namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return Inertia::render('Company/Index', ['companies' => $companies]);
    }

    public function create()
    {   
        return Inertia::render('Company/Create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validation rule for image
            'website' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Company::create($data);

        return redirect()->route('company.index')->with('success', 'Company created successfully.');
    }

    public function update(Request $request, Company $company)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // validation rule for image
            'website' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->except('logo');

        if ($request->hasFile('logo')) {
            if ($company->logo) {
                Storage::disk('public')->delete($company->logo);
            }

            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $company->update($data);
        $company->refresh();

        return redirect()->route('company.index')->with('success', 'Company updated successfully.');
    }


    public function show(Company $company)
    {
        return Inertia::render('Companies/Show', ['company' => $company]);
    }

    public function edit(Company $company)
    {
        return Inertia::render('Company/Edit', ['company' => $company]);
    }

    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}
