<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Http\Requests\StoreResultRequest;
use App\Http\Requests\UpdateResultRequest;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        return response()->json(Result::all());
    }

    public function store(StoreResultRequest $request)
    {
        $result = Result::create($request->validated());
        return response()->json($result, 201);
    }

    public function show(Result $result)
    {
        return response()->json($result);
    }

    public function update(UpdateResultRequest $request, Result $result)
    {
        $result->update($request->validated());
        return response()->json($result);
    }

    public function destroy(Result $result)
    {
        $result->delete();
        return response()->json(null, 204);
    }

    public function eventResults($event_id)
    {
        $results = Result::where('event_id', $event_id)->get();
        return response()->json($results);
    }
}
