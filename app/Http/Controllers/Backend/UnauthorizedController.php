<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class UnauthorizedController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('unauthorized.index', compact('items'));
    }
}
