<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        return Hero::with('realm')->get();
    }

    public function show(string $id)
    {
        return Hero::with(['realm', 'artifacts'])->findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'race' => ['required', 'string', 'max:255'],
            'rank' => ['nullable', 'string', 'max:255'],
            'realm_id' => ['required', 'exists:realms,id'],
            'alive' => ['sometimes', 'boolean'],
        ]);

        $hero = Hero::create($data);

        return response()->json($hero, 201);
    }

    public function update(Request $request, string $id)
    {
        $hero = Hero::findOrFail($id);

        $data = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'race' => ['sometimes', 'required', 'string', 'max:255'],
            'rank' => ['nullable', 'string', 'max:255'],
            'realm_id' => ['sometimes', 'required', 'exists:realms,id'],
            'alive' => ['sometimes', 'boolean'],
        ]);

        $hero->update($data);

        return $hero;
    }

    public function destroy(string $id)
    {
        $hero = Hero::findOrFail($id);
        $hero->delete();

        return response()->json(['message' => 'Hero deleted']);
    }

   
    public function alive()
    {
        return Hero::where('alive', true)->with('realm')->get();
    }
}
