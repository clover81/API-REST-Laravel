<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Creature;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
    public function index()
    {
        return Creature::with('region')->get();
    }

    public function show(string $id)
    {
        return Creature::with('region')->findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'species' => ['required', 'string', 'max:255'],
            'threat_level' => ['required', 'integer', 'min:1', 'max:10'],
            'region_id' => ['required', 'exists:regions,id'],
        ]);

        $creature = Creature::create($data);

        return response()->json($creature, 201);
    }

    public function update(Request $request, string $id)
    {
        $creature = Creature::findOrFail($id);

        $data = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'species' => ['sometimes', 'required', 'string', 'max:255'],
            'threat_level' => ['sometimes', 'required', 'integer', 'min:1', 'max:10'],
            'region_id' => ['sometimes', 'required', 'exists:regions,id'],
        ]);

        $creature->update($data);

        return $creature;
    }

    public function destroy(string $id)
    {
        $creature = Creature::findOrFail($id);
        $creature->delete();

        return response()->json(['message' => 'Creature deleted']);
    }

    
    public function dangerous(Request $request)
    {
        $level = (int) $request->query('level', 8);//aquí en el request es el que dice si viene ?level=8

        return Creature::where('threat_level', '>=', $level)
            ->with('region')
            ->get();
    }
}
