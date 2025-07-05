<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Http\Requests\StoreTenantRequest;
use App\Http\Requests\UpdateTenantRequest;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        return response()->json(Tenant::all());
    }

    public function store(StoreTenantRequest $request)
    {
        $school = Tenant::create($request->validated());
        return response()->json($school, 201);
    }

    public function show(Tenant $school)
    {
        return response()->json($school);
    }

    public function update(UpdateTenantRequest $request, Tenant $school)
    {
        $school->update($request->validated());
        return response()->json($school);
    }

    public function destroy(Tenant $school)
    {
        $school->delete();
        return response()->json(null, 204);
    }
}
