<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        return Region::all();
    }

    public function show(string $id)
    {
        return Region::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $region = Region::create($data);

        return response()->json($region, 201);
    }

    public function update(Request $request, string $id)
    {
        $region = Region::findOrFail($id);

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $region->update($data);

        return $region;
    }

    public function destroy(string $id)
    {
        $region = Region::findOrFail($id);
        $region->delete();

        return response()->json(['message' => 'Region deleted']);
    }

    public function creatures(string $id)
    {
    $region = \App\Models\Region::with('creatures')->findOrFail($id);
    return $region->creatures;
    }

}
