<?php

namespace App\Http\Controllers;

use App\Flower;
use Illuminate\Http\Request;

class FlowerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flowers = Flower::all();

        return Response()->json([

            'message' => 'berhasil',
            'status' => 'oke',
            'data' => $flowers
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


        $flower = Flower::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'photo' => $request->file('photo')->store('gambar')
        ]);

        return Response()->json([

            'message' => 'berhasil',
            'status' => 'oke',
            'data' => $flower
        ],200);
    }

     public function search(Request $request){
        $query = $request->input('search');
        $flower = Flower::where('name','LIKE','%'.$query.'%')->get();
        if(sizeof($flower) > 0){
            return Response()->json(['message' => 'has found', 'status' => true, 'data' => $flower],200);
        }else{
            return Response()->json(['message' => 'no record found', 'status' => false],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function show(Flower $flower)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function edit(Flower $flower)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flower $flower)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flower  $flower
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flower $flower)
    {
        //
    }
}
