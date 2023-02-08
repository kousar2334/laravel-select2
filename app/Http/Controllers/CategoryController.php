<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * This Methods will return category options
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function categoryOptions(Request $request)
    {

        $query = Categories::query()->select('id', 'name as text');
        if ($request->has('term')) {
            $term = trim($request->term);
            $query = $query->where('name', 'LIKE',  '%' . $term . '%');
        }

        $categories = $query->orderBy('name', 'asc')->paginate(10);
        $morePages = true;

        if (empty($categories->nextPageUrl())) {
            $morePages = false;
        }
        $results = array(
            "results" => $categories->items(),
            "pagination" => array(
                "more" => $morePages
            )
        );

        return response()->json($results);
    }
}
