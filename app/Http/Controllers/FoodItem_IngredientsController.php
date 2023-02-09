<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodItem_ingredients;
use App\Models\FoodMenu;

class FoodItem_IngredientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.foodMenu',[
            'data'=>FoodMenu::all(), // eto yung $guitars sa foreach($data as $item)
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
            'item_id'=> ['required','string'],
            'quantity'=> ['required','numeric']
        ]);

        $food_ingredient = new FoodItem_ingredients();
        $food_ingredient->food_item_id = $request->input('food_item_id');
        $food_ingredient->item_id = $request->input('item_id');
        $food_ingredient->quantity = $request->input('quantity');
        $food_ingredient->save();

        return redirect()->route('food-item.index')->with('success','Ingredient Added!');
        
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
    }
}
