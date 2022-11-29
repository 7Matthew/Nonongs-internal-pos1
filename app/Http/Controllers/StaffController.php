<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\FoodMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu()
    {
        return view('staff/menu',[
            'data' => FoodMenu::all()
        ]);
    }

    public function index()
    {
        return view('staff/menu',[
            'data' => FoodMenu::all()
        ]);
    }
    
    public function orders()
    {   
        return view('staff/orders',[
            'data' => Orders::all()
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
        return view('staff.menu');
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
            'description' => 'string|max:999999',
            'total-price'=> 'int',
            'payment' => ['required','int'],
            'payment_change' => 'int'
        ]);

        $order = new Orders();
        $user = Auth::user('id');
        $order->user_id = $user->id;
        $order->description = $request->input('description');
        $order->total_price = $request->input('total_price');
        $order->payment = $request->input('payment');
        if(($request->input('payment') - $request->input('total_price') == 0)){
            $order->payment_change = 0;
        }else $order->payment_change = ($request->input('payment') - $request->input('total_price'));
        $order->save();

        return redirect()->route('make_order.index')->with('success','item added successfully!');
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
