<?php

namespace App\Http\Controllers\api\v4;

use App\Http\Controllers\Controller;
use App\Model\ProductCompare;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    public function __construct(
        private ProductCompare $product_compare,
    ) {

    }

    public function list(Request $request){
        $compare_lists = $this->product_compare->with('product.rating')
            ->whereHas('product')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json($compare_lists, 200);
    }

    public function compare_product_store(Request $request)
    {
        $compare_list = $this->product_compare->where(['user_id'=> $request->user()->id, 'product_id'=> $request->product_id])->first();
        if ($compare_list) {
            $compare_list->delete();
            $count_compare_list = $this->product_compare->whereHas('product',function($q){
                return $q;
            })->where('user_id', $request->user()->id);

            $product_count = $this->product_compare->where(['product_id' => $request->product_id])->count();
            session()->put('compare_list', $this->product_compare->where('user_id', $request->user()->id)->pluck('product_id')->toArray());

            return response()->json([
                'error' => translate("compare_list_Removed"),
                'value' => 2,
                'count' => $count_compare_list,
                'product_count' => $product_count
            ]);


        } else {
            $count_compare_list_exist = $this->product_compare->where('user_id', $request->user()->id)->count();

            if ($count_compare_list_exist == 3){
                $this->product_compare->where('user_id', $request->user()->id)->orderBY('id')->first()->delete();
            }

            $compare_list = new ProductCompare;
            $compare_list->user_id = $request->user()->id;
            $compare_list->product_id = $request->product_id;
            $compare_list->save();

            $count_compare_list = $this->product_compare->whereHas('product',function($q){
                return $q;
            })->where('user_id', $request->user()->id)->count();

            $product_count = $this->product_compare->where(['product_id' => $request->product_id])->count();
            session()->put('compare_list', $this->product_compare->where('user_id', $request->user()->id)->pluck('product_id')->toArray());

            return response()->json([
                'message' => 'successfully added',
                'status' => 1,
                'count' => $count_compare_list,
                'id' => $request->product_id,
                'product_count' => $product_count
            ], 200);
        }
    }

    public function clear_all(Request $request){
        $this->product_compare->where('user_id', $request->user()->id)->delete();

        return response()->json([
            'message' => 'successfully clear',
            'status' => 1,
        ], 200);
    }
}
