<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class UnauthorizedController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::all();
        if($request->has('search')){
            $items = Item::where('name', 'like', "%{$request->search}%")->orWhere('model', 'like', "%{$request->search}%")->orWhere('description', 'like', "%{$request->search}%")->orWhere('url', 'like', "%{$request->search}%")->get();
        }
        return view('unauthorized.index', compact('items'));
    }
}
