<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FoodItemController extends Controller
{
    //

    
    public function fetchFoodItem()
    {
        $food = FoodMenu::all();

        return response()->json([
            'food'=> $food,
        ]);
    }

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
            'category_id'=> 'int',
            'description' => 'min:0|max:999999',
            'price'=> 'required|int',
            'image' => 'mimes:jpg,png,jpeg|max:2021'
        ]);

        $food = new FoodMenu();
        $food->name = strip_tags($request->input('name'));
        $food->category_id = $request->input('category_id');
        $food->user_id = auth()->id();
        $food->description = strip_tags($request->input('description'));
        $food->price = strip_tags($request->input('price'));

        $newImageName = '';
        if ($request->hasFile('image')) {
            $newImageName = time() . "-" . $request->name  . '.' . $request->image->extension();   
            $request->image->move(public_path('uploads'), $newImageName);
        }
        $food->image = $newImageName;
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
            'description' => 'min:0|max:999999'
        ]);
        $food = FoodMenu::findOrFail($id);
        $food->name = strip_tags($request->input('name'));
        $food->description = strip_tags($request->input('description'));
        $food->price = strip_tags($request->input('price'));
        $newImageName = '';
        if ($request->hasFile('image')) {
            $newImageName = time() . "-" . $request->name  . '.' . $request->image->extension();   
            $request->image->move(public_path('uploads'), $newImageName);
            $destination = 'uploads/'.$food->image;
            if (File::exists($destination)) {
                File::delete($destination);
            }
        }
        $food->image = $newImageName;
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
        $food = FoodMenu::find($id);
        $destination = 'uploads/'.$food->image;

        if (File::exists($destination)) {
            File::delete($destination);
        }

        FoodMenu::destroy($id);
        return redirect('food-item')->with('success','Item Deleted Successfully!');  
    }
}
