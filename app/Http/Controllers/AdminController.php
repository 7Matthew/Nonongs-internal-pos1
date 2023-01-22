<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodMenu;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin/admin-dashboard');
    }
    
    public function foodMenu()
    {
        //$data = FoodMenu::all();
        return view('admin/foodMenu');//->with('admin', $data);
        //return view('admin/foodMenu');
    }
  
    public function order_history()
    {
        return view('admin/order_history');
    }
    public function reports()
    {
        return view('admin/reports');
    }
    
   
}
