<?php

namespace App\Http\Controllers;

use App\Phonebook;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PhonebookRequest;

class PhonebookController extends Controller
{


    /**
     *  Protect the phonebook route through the auth middleware 
     */ 
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the phonebooks 
        return  Phonebook::orderBy('id', 'DESC')->get();
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
    public function store(PhonebookRequest $request)
    {
        Log::info('store()...');
        //return $request->all();
        
        // Method 1.
        $pb = new Phonebook;
        $pb->name = $request->input('name');
        $pb->phone = $request->input('phone');
        $pb->email = $request->input('email');
        $pb->save();

        //Phonebook::create($request->all());
        return response()->json(['message'=> 'Phonebook record created successfully!']);


        // method 2
        $validator = Validator::make($request->all(),[
                'name' => 'required', 
                'phone' => 'required', 
                'email' => 'required|email|unique:phonebooks', 
            ]);
        if ( $validator->fails()) { 
                return response()->json(['errors' => $validator->errors()]);
        }

        Phonebook::create($request->all());
        return response()->json(['message'=> 'Phonebook record created successfully!']);

        // method 3
        //
        $validatedData = $this->validate($request->all(), [
                'name' => 'required', 
                'phone' => 'required', 
                'email' => 'required|email|unique:phonebooks', 
            ]);
        return Phonebook::create($validatedData);
        //return response()->json(['message'=> 'Phonebook record created successfully!']);

          
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function show(Phonebook $phonebook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Phonebook $phonebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function update(PhonebookRequest $request) //, Phonebook $phonebook)
    {
        //
        Log::info('update()...');
        Log::info($request);
        //  
        //
        //return $request->all();
        // Method 1.
        $pb = Phonebook::find($request->id);
        $pb->name = $request->input('name');
        $pb->phone = $request->input('phone');
        $pb->email = $request->input('email');
        $pb->save();

        //Phonebook::create($request->all());
        return response()->json(['message'=> 'Phonebook record updated successfully!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Phonebook  $phonebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Phonebook $phonebook)
    {
        //
        Log::info('destroy()...');
        Log::info($phonebook);

        $phonebook::where('id', $phonebook->id)->delete();
        return response()->json(['message'=> 'Phonebook record deleted successfully!']);
    }
}
