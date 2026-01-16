<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Realm;
use Illuminate\Http\Request;

class RealmController extends Controller
{
    public function index()
    {
        return Realm::with('region')->get();
    }

    public function show(string $id)
    {
        return Realm::with(['region', 'heroes', 'artifacts'])->findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'ruler' => ['required', 'string', 'max:255'],
            'alignment' => ['required', 'string', 'max:50'],
            'region_id' => ['required', 'exists:regions,id'],
        ]);

        $realm = Realm::create($data);

        return response()->json($realm, 201);
    }

    public function update(Request $request, string $id)
    {
        $realm = Realm::findOrFail($id);

        $data = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'ruler' => ['sometimes', 'required', 'string', 'max:255'],
            'alignment' => ['sometimes', 'required', 'string', 'max:50'],
            'region_id' => ['sometimes', 'required', 'exists:regions,id'],
        ]);

        $realm->update($data);

        return $realm;
    }

    public function destroy(string $id)
    {
        $realm = Realm::findOrFail($id);
        $realm->delete();

        return response()->json(['message' => 'Realm deleted']);
    }

    public function heroes(string $id)
    {
    $realm = \App\Models\Realm::with('heroes')->findOrFail($id);
    return $realm->heroes;
    }

}
