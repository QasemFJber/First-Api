<?php

namespace App\Http\Controllers;

use App\Models\Lecturer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LecturerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Lecturer::all();
        return response()->json(['status'=>true,'message'=>'succes','data'=>$data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator($request->all(),[
            'name'=>'required|string|min:3',
            'email'=>'required|email|max:255',
            'password'=>'required|string',
            'specialization'=>'required|string',
        ]);

        if(! $validator->fails()){
            // $insert = DB::insert('INSERT INTO categories (name,info,visible) Values (?,?,?)',[$request->input('name'),$request->input('info'),$request->input('visible')]);
            // $insert = DB::table('categories')->insert([
            //     'name'=>$request->input('name'),
            //     'info'=>$request->input('info'),
            //     'visible'=>$request->input('visible'),
            // ]);
            // $category = new Category();
            // $category->name = $request->input('name');
            // $category->info = $request->input('info');
            // $category->visible = $request->input('visible');
            // $inserted = $category->save();
            $inserted = Lecturer::create($request->all());
            return response()->json(['status'=>true,'message'=>$inserted ? 'Added Successful' : 'Added Failed'],$inserted ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        }else{
            return response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first()]);

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
        if(Lecturer::where('id',$id)->exists()){

            $data = Lecturer::findOrFail($id);

            return response()->json(['status'=>true,'message'=>'Successful','data'=>$data]);
           }else{
            return response()->json(['status'=>false,'message'=>'failed ','data'=>'Not Found'],Response::HTTP_NOT_FOUND);

           }

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
        $validator = Validator($request->all(),[
            'name'=>'required|string|min:3',
            'email'=>'required|email|max:255',
            'password'=>'required|string',
            'specialization'=>'required|string',
        ]);

        if(! $validator->fails()){
            $rowsOfUpdated = DB::update('UPDATE lecturers SET name = ? ,  email = ? ,  password = ?  , specialization = ? WHERE id = ? ', [$request->input('name'),$request->input('email'),$request->input('password'),$request->input('specialization'),$id]);

            return response()->json(['status'=>true,'message'=>'Successful','data updated'=>$rowsOfUpdated]);

        }else{
            return response()->json(['status'=>false,'message'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Lecturer::where('id',$id)->exists()){

            $data = Lecturer::find($id);
            $data->delete();
            return response()->json(['status'=>true,'message'=>'Lecturer Deleted Successful']);
           }else{
            return response()->json(['status'=>false,'message'=>'Lecturer Deleted failed '],Response::HTTP_NOT_FOUND);

           }

    }
}
