<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cities = City::latest()->paginate(10);

        return view('admin.city.index', compact('cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCityRequest $request)
    {
        DB::transaction(function() use ($request){
            $validated = $request->validated();

            if($request->hasFile('photo')){
                $cityPhotoPath = $request->file('photo')->store('cities', 'public');
                $validated['photo'] = $cityPhotoPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $newCity = City::create($validated);
        });

        return redirect()->route('admin.cities.index')->with('success', 'new city added succsessfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city)
    {
        return view('admin.city.edit', compact('city'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        DB::transaction(function() use ($request, $city){
            $validated = $request->validated();

            if($request->hasFile('photo')){

                // hapus photo lama
                if ($city->photo) {
                    Storage::disk('public')->delete($city->photo);
                }

                $photoPath = $request->file('photo')->store('cities', 'public');
                $validated['photo'] = $photoPath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $city->update($validated);
        });

        return redirect()->route('admin.cities.index')->with('success', 'city updated succsessfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(City $city)
    {
        DB::transaction(function() use ($city){
            $city->delete();
        });

        return redirect()->route('admin.cities.index')->with('success', 'city deleted succsessfully');
    }
}
