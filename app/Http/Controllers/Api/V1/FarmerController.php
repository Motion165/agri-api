<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FarmerResource;
use App\Models\Farmer;
use App\Filters\V1\FarmerFilter;
use Illuminate\Http\Request;

class FarmerController extends Controller
{
    public function index(Request $request)
    {
        $filter = new FarmerQuery();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return FarmerResource::collection(Farmer::paginate());
        } else {
            $farmers = Farmer::where($queryItems)->paginate();
            return FarmerResource::collection($farmers);
        }
    }
}
