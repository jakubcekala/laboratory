<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;
use PDF;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Item::all();
        if($request->has('search')){
            $items = Item::where('name', 'like', "%{$request->search}%")->orWhere('model', 'like', "%{$request->search}%")->orWhere('description', 'like', "%{$request->search}%")->orWhere('url', 'like', "%{$request->search}%")->get();
        }
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(ItemStoreRequest $request)
    {
        if ($request->file('image') != null) {
            $image_file = $request->image;

            $image = Image::make($image_file);

            Response::make($image->encode('jpeg'));

            Item::create([
                'name' => $request->name,
                'model' => $request->model,
                'description' => $request->description,
                'url' => $request->url,
                'amount' => $request->amount,
                'all_amount' => $request->all_amount,
                'image' => $image
            ]);

            return redirect()->route('items.index')->with('message', 'Equipment added successfully');
        } else {
            Item::create([
                'name' => $request->name,
                'model' => $request->model,
                'description' => $request->description,
                'url' => $request->url,
                'amount' => $request->amount,
                'all_amount' => $request->all_amount
            ]);
            return redirect()->route('items.index')->with('message', 'Equipment added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        return view('items.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemUpdateRequest $request, Item $item)
    {
        if ($request->image != null) {
            $image_file = $request->image;

            $image = Image::make($image_file);

            Response::make($image->encode('jpeg'));

            $item->update([
                'name' => $request->name,
                'model' => $request->model,
                'description' => $request->description,
                'url' => $request->url,
                'amount' => $request->amount,
                'all_amount' => $request->all_amount,
                'image' => $image
            ]);

            return redirect()->route('items.index')->with('message', 'Equipment updated successfully Image');
        } else {
            $item->update([
                'name' => $request->name,
                'model' => $request->model,
                'description' => $request->description,
                'url' => $request->url,
                'amount' => $request->amount,
                'all_amount' => $request->all_amount
            ]);

            return redirect()->route('items.index')->with('message', 'Equipment updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {

        $item->delete();
        return redirect()->route('items.index')->with('message', 'Equipment deleted successfully');

    }

    public function fetch_Image($id) {
        $image_temp = Item::findOrFail($id);

        $image_file = Image::make($image_temp->image);

        $response = Response::make($image_file->encode('jpeg'));

        $response->header('Content-Type', 'image/jpeg');

        return $response;
    }

    public function unauthorized($id)
    {
        $items = Item::all();
        return view('items.unauthorized', compact('items'));
    }

    public function generateReport() {
        $items = Item::all();
        $pdf = PDF::loadView('items.index', compact('items'));
        return $pdf->download('equipment.pdf');
    }
}
