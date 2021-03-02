<?php

namespace App\Http\Controllers;

use App\Models\Purchaser;
use Illuminate\Http\Request;
use App\Models\ProductPurchaser;
use App\Http\Resources\PurchaserResource;
use App\Http\Requests\ProductPurchaseStoreRequest;

class ProductPurchaserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Purchaser $purchaser)
    {
        $query = ProductPurchaser::query()->with('product:id,name');

        $query->where('purchaser_id', $purchaser->id);

        if ($request->has('start_date') && strlen($request->start_date)) {
            $query->where('purchase_timestamp', '>=', $request->start_date . ' 00:00:00');
        }

        if ($request->has('end_date') && strlen($request->end_date)) {
            $query->where('purchase_timestamp', '<=', $request->end_date . ' 23:59:59');
        }

        $query->selectRaw('DATE(purchase_timestamp) as period, product_id');
        $query->OrderbyRaw('period DESC');

        $results = $query->get();

        $collection = collect($results);

        $groupedCollection = $collection->groupBy('period')->map(function ($item, $key) {
            $result = [];
            foreach ($item as $key => $value) {
                $result[] = [
                    "product" => $value->product->name
                ];
            }
            return $result;
        });

        return [
            "purchases" => $groupedCollection
        ];
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductPurchaseStoreRequest $request)
    {
        $purchasedProduct = ProductPurchaser::create([
            'product_id' => $request->product_id,
            'purchaser_id' => $request->purchaser_id,
            'purchase_timestamp' => $request->purchase_timestamp
        ]);

        return PurchaserResource::make($purchasedProduct);
    }
}
