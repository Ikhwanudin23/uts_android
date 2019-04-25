<?php

namespace App\Http\Controllers;

use App\Alat;
use Illuminate\Http\Request;
use App\Response;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alat = Alat::all();

        return Response()->json([

            'message' => 'berhasil',
            'status' => true,
            'data' => $alat
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


        $alat = Alat::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'photo' => $request->file('photo')->store('gambar')
        ]);

        return Response()->json([

            'message' => 'berhasil',
            'status' => true,
            'data' => $alat
        ],200);

    }

    public function search(Request $request){
        $query = $request->input('search');
        $alat = Alat::where('name','LIKE','%'.$query.'%')->get();
        if(sizeof($alat) > 0){
            return Response()->json(['message' => 'has found', 'status' => true, 'data' => $alat],200);
        }else{
            return Response()->json(['message' => 'no record found', 'status' => false],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function show(Alat $alat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function edit(Alat $alat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alat $alat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bug = Alat::find($id);
        if(is_null($bug)){
            return response() -> json(array('message'=>'cannot delete because record not found', 'status'=>false),200);
        }
        Alat::destroy($id);
        return response() -> json(array('message'=>'succesfully deleted', 'status' => true), 200);
    }
}
