<?php

namespace App\Http\Controllers;

use App\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $foods = Food::all();

        return Response()->json([

            'message' => 'berhasil',
            'status' => 'oke',
            'data' => $foods
        ],200);
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
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'photo' => 'required'
        ]);


        $food = Food::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'photo' => $request->file('photo')->store('makanan')
        ]);

        return Response()->json([

            'message' => 'berhasil',
            'status' => 'oke',
            'data' => $food
        ],200);
    }

     public function search(Request $request){
        $query = $request->search;
        $food = Food::where('name','LIKE','%'.$query.'%')->get();
        if(sizeof($food) > 0){
            return Response()->json(['message' => 'has found', 'status' => true, 'data' => $food],200);
        }else{
            return Response()->json(['message' => 'no record found', 'status' => false],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function edit(Food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        //
    }
}
