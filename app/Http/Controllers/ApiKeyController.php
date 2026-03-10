<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreApiKeyRequest;
use App\Http\Requests\UpdateApiKeyRequest;
use App\Models\ApiKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiKeyController extends Controller
{
    public function index()
    {
        $apiKeys = ApiKey::latest()->paginate(10);
        return view('admin.api-key.index', compact('apiKeys'));
    }

    public function create()
    {
        return view('admin.api-key.create');
    }

    public function store(StoreApiKeyRequest $request)
    {
        DB::transaction(function() use ($request){
            $validated = $request->validated();

            $newApiKey = ApiKey::create($validated);
        });

        return redirect()->route('admin.api-keys.index')->with('success', 'new api key added succsessfully');
    }

    public function show(ApiKey $apiKey)
    {
        //
    }

    public function edit(ApiKey $apiKey)
    {
        return view('admin.api-key.edit', compact('apiKey'));
    }

    public function update(UpdateApiKeyRequest $request, ApiKey $apiKey)
    {
        DB::transaction(function() use ($request, $apiKey){
            $validated = $request->validated();

            $apiKey->update($validated);
        });

        return redirect()->route('admin.api-keys.index')->with('success', 'api key updated succsessfully');
    }

    public function destroy(ApiKey $apiKey)
    {
        DB::transaction(function() use ($apiKey){
            $apiKey->delete();
        });

        return redirect()->route('admin.api-keys.index')->with('success', 'api key deleted succsessfully');
    }
}
