<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeSpaceRequest;
use App\Http\Requests\UpdateOfficeSpaceRequest;
use App\Models\City;
use App\Models\OfficeSpace;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OfficeSpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officeSpaces = OfficeSpace::with('city')->latest()->paginate(10);

        return view('admin.office-space.index', compact('officeSpaces'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::latest()->get();

        return view('admin.office-space.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfficeSpaceRequest $request)
    {
        DB::transaction(function() use ($request){
            $validated = $request->validated();

            if($request->hasFile('thumbnail')){
                $thumbnailOfficeSpacePath = $request->file('thumbnail')->store('office-spaces-thumbnail', 'public');
                $validated['thumbnail'] = $thumbnailOfficeSpacePath;
            }

            $validated['slug'] = Str::slug($validated['name']);

            $newOfficeSpace = OfficeSpace::create($validated);

            if($request->benefits){
                foreach($request->benefits as $benefit){
                    if($benefit){
                        $newOfficeSpace->officeSpaceBenefits()->create([
                            'name' => $benefit
                        ]);
                    }
                }
            }

            if($request->hasFile('photos')){
                foreach($request->file('photos') as $photo){
                    $photoOfficeSpacePath = $photo->store('office-space-photos', 'public');

                    $newOfficeSpace->officeSpacePhotos()->create([
                        'photo' => $photoOfficeSpacePath
                    ]);
                }
            }

        });

        return redirect()->route('admin.office-spaces.index')->with('success', 'new office space added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(OfficeSpace $officeSpace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OfficeSpace $officeSpace)
    {
        $cities = City::latest()->get();

        return view('admin.office-space.edit', compact('officeSpace', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfficeSpaceRequest $request, OfficeSpace $officeSpace)
    {
        DB::transaction(function() use ($request, $officeSpace){
            $validated = $request->validated();

            if($request->hasFile('thumbnail')){
                if ($officeSpace->thumbnail) {
                    Storage::disk('public')->delete($officeSpace->thumbnail);
                }

                $thumbnailOfficeSpacePath = $request->file('thumbnail')->store('office-spaces-thumbnail', 'public');
                $validated['thumbnail'] = $thumbnailOfficeSpacePath;
            }
            $validated['slug'] = Str::slug($validated['name']);

            $officeSpace->update($validated);

            foreach ($officeSpace->officeSpaceBenefits as $index => $benefitModel) {
                $newBenefit = $request->benefits[$index] ?? null;

                if ($newBenefit && $benefitModel->name !== $newBenefit) {
                    $benefitModel->update([
                        'name' => $request->benefits[$index]
                    ]);
                }
            }

            if ($request->hasFile('photos')) {
                foreach ($officeSpace->officeSpacePhotos as $index => $photoModel) {
                    $newPhoto = $request->file('photos')[$index] ?? null;
                    if ($newPhoto) {
                        Storage::disk('public')->delete($photoModel->photo);

                        $path = $newPhoto->store('office-space-photos', 'public');
                        $photoModel->update([
                            'photo' => $path
                        ]);
                    }
                }
            }     

        });

        return redirect()->route('admin.office-spaces.index')->with('success', 'Office space updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OfficeSpace $officeSpace)
    {
        DB::transaction(function() use ($officeSpace){
            $officeSpace->delete();
        });

        return redirect()->route('admin.office-spaces.index')->with('success', 'deleted office space succsessfully');
    }
}
