<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RegionController;
use App\Http\Controllers\Api\RealmController;
use App\Http\Controllers\Api\HeroController;
use App\Http\Controllers\Api\CreatureController;
use App\Http\Controllers\Api\ArtifactController;
use App\Http\Controllers\Api\ArtifactHeroController;

// los endpoints extra que no pertenecen al CRUD
Route::get('artifacts/top', [ArtifactController::class, 'top']);
Route::get('heroes/alive', [HeroController::class, 'alive']);
Route::get('creatures/dangerous', [CreatureController::class, 'dangerous']);
Route::get('realms/{id}/heroes', [RealmController::class, 'heroes']);
Route::get('regions/{id}/creatures', [RegionController::class, 'creatures']);

// Resources, genera automáticamente los 5 endpoints REST de GET (index), POST(store), GET(show), PUT(update), DELETE(destroy)
Route::apiResource('regions', RegionController::class);
Route::apiResource('realms', RealmController::class);
Route::apiResource('heroes', HeroController::class);
Route::apiResource('creatures', CreatureController::class);
Route::apiResource('artifacts', ArtifactController::class);

// Pivote (N:N), controla la tabla artifact_hero muchos a muchos. No se puede hacer con apiResource porque no es una tabla normal y tiene dos claves(hero_id,artifact_id)
Route::post('artifact-hero', [ArtifactHeroController::class, 'store']);
Route::delete('artifact-hero', [ArtifactHeroController::class, 'destroy']);
Route::get('heroes/{id}/artifacts', [ArtifactHeroController::class, 'heroArtifacts']);
Route::get('artifacts/{id}/heroes', [ArtifactHeroController::class, 'artifactHeroes']);



