<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Farmer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FarmerResource;
use App\Http\Resources\V1\FarmerCollection;
use App\Filters\V1\FarmerFilter;



class FarmerController extends Controller
{
    public function index(Request $request)
    {
        $filter = new FarmerFilter();
        $queryItems = $filter->transform($request);

        if (count($queryItems) == 0) {
            return FarmerResource::collection(Farmer::paginate());
        } else {
            $farmers = Farmer::where($queryItems)->paginate();
            return new FarmerCollection($transactions->appends($request->query()));
        }
    }
}