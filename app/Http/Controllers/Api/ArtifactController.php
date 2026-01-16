<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artifact;
use Illuminate\Http\Request;

class ArtifactController extends Controller
{
    public function index()
    {
        return Artifact::with('originRealm')->get();
    }

    public function show(string $id)
    {
        return Artifact::with(['originRealm', 'heroes'])->findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255'],
            'origin_realm_id' => ['required', 'exists:realms,id'],
            'power_level' => ['required', 'integer', 'min:1', 'max:100'],
            'description' => ['nullable', 'string'],
        ]);

        $artifact = Artifact::create($data);

        return response()->json($artifact, 201);
    }

    public function update(Request $request, string $id)
    {
        $artifact = Artifact::findOrFail($id);

        $data = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'type' => ['sometimes', 'required', 'string', 'max:255'],
            'origin_realm_id' => ['sometimes', 'required', 'exists:realms,id'],
            'power_level' => ['sometimes', 'required', 'integer', 'min:1', 'max:100'],
            'description' => ['nullable', 'string'],
        ]);

        $artifact->update($data);

        return $artifact;
    }

    public function destroy(string $id)
    {
        $artifact = Artifact::findOrFail($id);
        $artifact->delete();

        return response()->json(['message' => 'Artifact deleted']);
    }

    
    public function top()
    {
        return Artifact::where('power_level', '>', 90)
            ->with('originRealm')
            ->get();
    }
}
