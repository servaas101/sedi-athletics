<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tenant;
use Illuminate\Support\Str;

class HubApiController extends Controller
{
    public function registerSchool(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:tenants',
        ]);

        $tenant = Tenant::create([
            'name' => $request->name,
            'code' => $request->code,
            'api_token' => Str::random(80),
            'status' => 'active',
        ]);

        return response()->json(['message' => 'School registered successfully', 'api_token' => $tenant->api_token], 201);
    }

    public function checkHealth($school_code)
    {
        $tenant = Tenant::where('code', $school_code)->first();

        if (! $tenant) {
            return response()->json(['message' => 'School not found'], 404);
        }

        $competitionsCount = $tenant->competitions()->count();
        $disciplinesCount = $tenant->disciplines()->count();
        $resultsCount = $tenant->results()->count();

        return response()->json([
            'school_code' => $school_code,
            'status' => 'healthy',
            'data_counts' => [
                'competitions' => $competitionsCount,
                'disciplines' => $disciplinesCount,
                'results' => $resultsCount,
            ],
        ]);
    }
}
