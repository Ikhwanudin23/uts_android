<?php

namespace App\Http\Controllers\School;
use Illuminate\Http\Request;
use App\Model\SchoolModel;
use App\Http\Controllers\Controller;
use App\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         return response() -> json(Response::transform(SchoolModel::get(), "ok" , true), 200);
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
    public function store(Request $request)    {
        $rules = [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return response() -> json(array(
                'message' => 'check your request again. desc must be 10 char or more and form must be filled', 'status' => false), 400);
        }else{
            $photo = $request->file('image');
            $extension = $photo->getClientOriginalExtension();
            Storage::disk('public')->put($photo->getFilename().'.'.$extension,  File::get($photo));
            $school = new SchoolModel();
            $school->name = $request->name;
            $school->description = $request->description;
            $school->image = "uploads/".$photo->getFilename().'.'.$extension;
            $school->save();

            return response()->json(
                Response::transform(
                    $school, 'successfully created', true
                ), 201);
        }
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
     public function search(Request $request){
        $query = $request->search;
        $bug = SchoolModel::where('name','LIKE','%'.$query.'%')->get();
        if(sizeof($bug) > 0){
            return response() -> json(Response::transform($bug,"Has found", true), 200);
        }else{
            return response() -> json(array('message'=>'No record found', 'status' => false), 200);
        }
    }
}
