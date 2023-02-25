<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Item;
use App\Models\Orders;
use App\Models\FoodItem;
use App\Models\FoodMenu;
use Illuminate\Http\Request;
use App\Models\FoodItem_orders;
use App\Models\Inventory_reports;
use App\Models\Transaction_reports;
use App\Http\Controllers\Controller;
use App\Models\FoodItem_ingredients;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function transaction_report(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
    
        $pdf = PDF::loadView('pdf.transaction_report',[
            'data'=>Orders::whereBetween('created_at', [$from, $to])->get(),
            'from' => $from,
            'to'=> $to
        ]); 

        $transaction_report = new Transaction_reports();
        $transaction_report->user_id = auth()->id();
        $transaction_report->from = $from;
        $transaction_report->to = $to;
        $transaction_report->save();
        
        return $pdf->stream('transaction_report_from_'.date('F d Y', strToTime($from)).'_to_'.date('F d Y', strToTime($to)).'.pdf');
    }

    public function inventory_report(Request $request)
    {
        $from = $request->input('from');
        $to = $request->input('to');
    
        $pdf = PDF::loadView('pdf.inventory_report',[
            'data'=>Item::whereBetween('created_at', [$from, $to])->get(),
            'from' => $from,
            'to'=> $to
        ]); 
        
        $inventory_report = new Inventory_reports();
        $inventory_report->user_id = auth()->id();
        $inventory_report->from = $from;
        $inventory_report->to = $to;
        $inventory_report->save();

        return $pdf->stream('inventory_report_from_'.date('F d Y', strToTime($from)).'_to_'.date('F d Y', strToTime($to)).'.pdf');
    }

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
            'food_item_id.*' => 'required|exists:food_items,id',
            'food_item_quantity.*' => 'required|integer|min:1',
            'total_price' => 'required|numeric|min:0',
            'payment' => 'nullable|numeric|min:0',
        ]);

        $food_item_ids = $request->input('food_item_id');
        $food_item_quantities = $request->input('quantity');
        $total_price = $request->input('total_price');
        $modeOfPayment = $request->input('modeOfPayment');
        $payment = $request->input('payment');

        $order = new Orders();
        $order->user_id = auth()->id();
        $order->total_price = $total_price;
        $order->description = $request->input('description');
        $order->modeOfPayment = $modeOfPayment;

        if ($payment >= $total_price) {
            $order->paymentStatus = 'Paid';
            $order->payment = $payment;
    
            if ($payment - $total_price == 0) {
                $order->payment_change = 0;
            } else {
                $order->payment_change = $payment - $total_price;
            }
        } 
        else { 
            $order->paymentStatus = "Not paid";
            if($payment != null)
            {
                $order->payment = $payment; 
            }
            $order->payment_change = ($payment - $order->total_price);
        }
        $order->save();

        for ($i=0; $i < count($request->food_item_id); $i++) { 
            $datasave = [
                'food_item_id' => $request->food_item_id[$i],
                'quantity' => $request->quantity[$i],
                'order_id' => $order->id,
            ];
            FoodItem_orders::create($datasave);
        }

        foreach ($food_item_ids as $index => $food_item_id) {
            $food_item = FoodItem::findOrFail($food_item_id);
            $food_item_quantity = $food_item_quantities[$index];
    
            foreach ($food_item->item as $item) {
                $item->quantity -= $item->pivot->quantity * $food_item_quantity;
                $item->save();
            }
    
            //$order->food_item()->attach($food_item_id, ['quantity' => $food_item_quantity]);
        }

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
        $order = Orders::findOrFail($id);
        $order->user_id = auth()->id();
        if ($request->input('payment') >= $order->total_price) {
            $order->paymentStatus = "Paid";
            $order->payment = $request->input('payment');
            $order->modeOfPayment = $request->input('modeOfPayment');
            if(($request->input('payment') - $order->total_price == 0)){
                $order->payment_change = 0;
            }else $order->payment_change = ($request->input('payment') - $order->total_price);
        }
        else {
            $order->paymentStatus = "Not paid";
            $order->payment = $request->input('payment');
            $order->payment_change = ($request->input('payment') - $order->total_price);
        }
        $order->update();

        return redirect()->route('orders', $id)->with('edit-success','Item Edited Successfully');
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
