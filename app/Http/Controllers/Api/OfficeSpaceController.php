<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\OfficeSpaceResource;
use App\Models\OfficeSpace;
use Illuminate\Http\Request;

class OfficeSpaceController extends Controller
{
        public function index()
    {
        $officeSpacess = OfficeSpace::with('city')->get();

        return OfficeSpaceResource::collection($officeSpacess);
    }

    public function show(OfficeSpace $officeSpace)
    {
        $officeSpace->load(['city', 'officeSpacePhotos', 'officeSpaceBenefits']);

        return new OfficeSpaceResource($officeSpace);
    }
}
