<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guitar;
use App\Http\Requests\GuitarFormRequest;

class GuitarController extends Controller
{

    private static function getData()
    {
        return [
            ['id'=>1,'name'=>'American Standard Strat','brand'=>'fender'],
            ['id'=>2,'name'=>'Starla S2','brand'=>'PRS'],
            ['id'=>3,'name'=>'Explorer','brand'=>'Gibson'],
            ['id'=>4,'name'=>'Talman','brand'=>'Ibanez'],
            ['id'=>5,'name'=>'Taylor','brand'=>'Taylor']
        ];
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guitars.index',[
            'guitars'=>Guitar::all(), // eto yung $guitars sa foreach($guitars as $guitar)
            'userInput'=>'<script><alert>hello</alert></script>'
        ]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get
        return view('guitars.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuitarFormRequest $request) // We use GuitarFormRequest in order to validate the user $Request
    {
        //POST
        $data = $request->validated();
        Guitar::create($data);// this is what we call mass assignment, same lang to ng nasa baba na code block. automatic na inaassign yung values galing sa client request then ipapasa sa fields na meron sa database dapat same name ang fields from client side, sa fields from server side

        /* etong code block na to ay same sa Guitar::create($data)
        $guitar = new Guitar(); 

        $guitar->name = $data['name'];
        $guitar->brand = $data['brand'];
        $guitar->year_made = $data['year_made'];
        $guitar->save();
        */

        return redirect()->route('guitars.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guitar $guitar) 
    {
        //
        return view('guitars.show', [
            'guitar'=> $guitar
        ]);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guitar $guitar)
    {
        //
        return view('guitars.edit', [
            'guitar'=> $guitar
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuitarFormRequest $request, Guitar $guitar) 
    {
        // on the FIRST PARAMETER, we use the '$request' as an object for 'GuitarFormRequest' to validate user request. on the SECOND PARAMETER, we use '$guitar' as an object for our 'Guitar' model so that we can assign the values from '$request' to the values on '$guitar' 
        //'$request' is from client side bale kinukuha natin yung user input tas ilalagay sa object, and '$guitar' is on server side. dito natin ipapasa yung value from client side, so that we can store the information on the database
        //validate
        $data = $request->validated(); // kukunin yung validated values from the request then assign those to '$data', now si '$data' na ngayon ang may dala ng ating client '$request', na ipapasa nya sa '$guitar'
        $guitar->update($data);

        /*$guitar->name = $data['name'];
        $guitar->brand = $data['brand'];
        $guitar->year_made = $data['year_made'];
        $guitar->save();*/

        return redirect()->route('guitars.show', $guitar->id);

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
        Guitar::destroy($id);
        return redirect()->route('guitars.index');
    }
}
