<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artifact;
use App\Models\Hero;
use Illuminate\Http\Request;

class ArtifactHeroController extends Controller
{
    // POST /artifact-hero  { "artifact_id": 1, "hero_id": 4 }
    public function store(Request $request)
    {
        $data = $request->validate([
            'artifact_id' => ['required', 'exists:artifacts,id'],
            'hero_id' => ['required', 'exists:heroes,id'],
        ]);

        $hero = Hero::findOrFail($data['hero_id']);
        $hero->artifacts()->syncWithoutDetaching([$data['artifact_id']]);

        return response()->json(['message' => 'Artifact assigned to hero'], 201);
    }

    // DELETE /artifact-hero  { "artifact_id": 1, "hero_id": 4 }
    public function destroy(Request $request)
    {
        $data = $request->validate([
            'artifact_id' => ['required', 'exists:artifacts,id'],
            'hero_id' => ['required', 'exists:heroes,id'],
        ]);

        $hero = Hero::findOrFail($data['hero_id']);
        $hero->artifacts()->detach($data['artifact_id']);

        return response()->json(['message' => 'Artifact removed from hero']);
    }

    // GET /heroes/{id}/artifacts
    public function heroArtifacts(string $id)
    {
        $hero = Hero::with('artifacts')->findOrFail($id);
        return $hero->artifacts;
    }

    // GET /artifacts/{id}/heroes
    public function artifactHeroes(string $id)
    {
        $artifact = Artifact::with('heroes')->findOrFail($id);
        return $artifact->heroes;
    }
}
