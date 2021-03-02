<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaserStoreRequest;
use App\Http\Resources\PurchaserResource;
use App\Models\Purchaser;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PurchaserController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaserStoreRequest $request)
    {
        $purchaser = Purchaser::create([
            'name' => $request->name
        ]);

        return PurchaserResource::make($purchaser);
    }
}
