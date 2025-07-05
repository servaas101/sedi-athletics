<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $totalSchools = Tenant::count();
        $activeSchools = Tenant::where('status', 'active')->count();
        $inactiveSchools = Tenant::where('status', 'inactive')->count();

        return view('hub.dashboard', compact('totalSchools', 'activeSchools', 'inactiveSchools'));
    }

    public function index()
    {
        $schools = Tenant::all();
        return view('hub.schools.index', compact('schools'));
    }

    public function create()
    {
        return view('hub.schools.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:tenants',
            'api_token' => 'nullable|string|max:80|unique:tenants',
            'status' => 'nullable|string',
        ]);

        Tenant::create($request->all());
        return redirect()->route('hub.schools.index')->with('success', 'School created successfully.');
    }

    public function edit(Tenant $school)
    {
        return view('hub.schools.edit', compact('school'));
    }

    public function update(Request $request, Tenant $school)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:tenants,code,' . $school->id,
            'api_token' => 'nullable|string|max:80|unique:tenants,api_token,' . $school->id,
            'status' => 'nullable|string',
        ]);

        $school->update($request->all());
        return redirect()->route('hub.schools.index')->with('success', 'School updated successfully.');
    }

    public function destroy(Tenant $school)
    {
        $school->delete();
        return redirect()->route('hub.schools.index')->with('success', 'School deleted successfully.');
    }
}
