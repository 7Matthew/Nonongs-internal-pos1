<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Supplier;
use App\Models\FoodMenu;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('staff/inventory',[
            'data' => Item::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=> 'required',
            'supplier_id'=> 'int',
            'category_id'=> 'int',
            'user_id'=> 'int',
            'cost'=> 'required'
        ]);
        $item = new Item();
        $item->name = strip_tags($request->input('name'));
        $item->quantity = $request->input('quantity');
        $item->measuring_unit = strip_tags($request->input('measuring_unit'));
        $item->supplier_id = $request->input('supplier_id');
        $item->category_id = $request->input('category_id');         
        $item->user_id = auth()->id();
        $item->cost = strip_tags($request->input('cost'));
        $item->expiry_date = $request->input('expiry_date');
        
        $newImageName = '';
        if ($request->hasFile('image')) {
            $newImageName = time() . "-" . $request->name  . '.' . $request->image->extension();   
            $request->image->move(public_path('uploads'), $newImageName);
        }
        $item->image = $newImageName;
        $item->save();

        return redirect()->route('inventory.index')->with('success','item added successfully!');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name'=> 'required',
            'cost'=> 'required'
        ]);
        $item = Item::findOrFail($id);
        $item->name = strip_tags($request->input('name'));
        $item->supplier_id = $request->input('supplier_id');
        $item->category_id = $request->input('category_id');        
        $item->user_id = auth()->id();
        $item->cost = strip_tags($request->input('cost'));
        $item->quantity = strip_tags($request->input('quantity'));
        $newImageName = '';
        if ($request->hasFile('image')) {
            $newImageName = time() . "-" . $request->name  . '.' . $request->image->extension();   
            $request->image->move(public_path('uploads'), $newImageName);
            $destination = 'uploads/'.$item->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
        }
        $item->image = $newImageName;
        $item->update();

        return redirect()->route('inventory.index')->with('edit-success','item updated successfully!');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Item::destroy($id);
        return redirect('inventory')->with('success','Item deleted successfully');
    }
}
