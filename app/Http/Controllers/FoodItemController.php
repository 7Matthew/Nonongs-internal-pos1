<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;

class FoodItemController extends Controller
{
    //

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.foodMenu',[
            'data'=>FoodMenu::all() // eto yung $guitars sa foreach($data as $item)
        ]); 
    }

     /**FOOD MENU CRUD */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function create(){
        return view('admin.food-menu-crud.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=> 'required',
            'category'=> 'required',
            'price'=> 'required|int',
            'stocks'=> 'required|int'
        ]);
        $food = new FoodMenu();
        $food->name = strip_tags($request->input('name'));
        $food->price = strip_tags($request->input('price'));
        $food->category = strip_tags($request->input('category'));
        $food->stocks = strip_tags($request->input('stocks'));
        if ($request->hasFile('image')) {
            $food->image = $request->file('image')->store('uploads','public');
        }
        $food->save();

        return redirect()->route('food-item.index')->with('success','item added successfully!');
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
        return view('admin.food-menu-crud.show', [
            'food'=> FoodMenu::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.food-menu-crud.edit', [
            'food'=> FoodMenu::findOrFail($id)
        ]);
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
        $request->validate([
            'name'=> 'required',
            'price'=> 'required|int',
            'stocks'=> 'required|int'
        ]);
        $food = FoodMenu::findOrFail($id);
        $food->name = strip_tags($request->input('name'));
        $food->price = strip_tags($request->input('price'));
        $food->stocks = strip_tags($request->input('stocks'));
        if ($request->hasFile('image')) {
            $food->image = $request->file('image')->store('uploads','public');
        }
        $food->update();

        return redirect()->route('food-item.index', $id)->with('edit-success','Item Edited Successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FoodMenu::destroy($id);
        return redirect('food-item')->with('delete-success','Item Deleted Successfully!');  
    }
}
