<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    public function search(Request $request){
        $request->validate([
            'query' => 'required',
        ]);

        $query = $request->input('query');

//        $products = Products::where('name', 'like', "%$query%")
//            ->orWhere('details', 'like', "%$query%")
//            ->orWhere('description', 'like', "%$query%")
//            ->select('name', 'slug')
//            ->limit(3)
//            ->get();

        $categories = Category::where('name', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->get();

        return response()->json($categories, Response::HTTP_OK);
    }
}
