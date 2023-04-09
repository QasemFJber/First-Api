<?php

namespace App\Http\Controllers;

use App\Models\Directorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class DirectorateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Directorate::all();
        return response()->json(['status'=>true,'message'=>'Successful','data'=>$data]);
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
            'name'=>'required|string|min:5',
            'type'=>'required|string|max:255',
            'educational_district'=>'required|string',
            'address'=>'required|string',
            'phone_number'=>'required|string',
            'email'=>'required|string',
            'educational_director_name'=>'required|string',
            'educational_director_phone_number'=>'required|string',
            'students_number'=>'required|integer',
            'teachers_number'=>'required|integer',
            'departments'=>'required|string',
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
            $inserted = Directorate::create($request->all());
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
        if(Directorate::where('id',$id)->exists()){
            $data = Directorate::find($id);
            return response()->json(['status'=>true,'message'=>'Successful','data'=>$data]);
        }else{
            return response()->json(['status'=>false,'message'=>'Data Not Found '],Response::HTTP_NOT_FOUND);

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
            'name'=>'required|string|min:5',
            'type'=>'required|string|max:255',
            'educational_district'=>'required|string',
            'address'=>'required|string',
            'phone_number'=>'required|string',
            'email'=>'required|string',
            'educational_director_name'=>'required|string',
            'educational_director_phone_number'=>'required|string',
            'students_number'=>'required|integer',
            'teachers_number'=>'required|integer',
            'departments'=>'required|string',
        ]);

        if(! $validator->fails()){
            $rowsOfUpdated = DB::update('UPDATE directorates SET
            name = ? ,  type = ? , educational_district  = ? ,
            address = ? ,  phone_number = ? , email  = ? ,
            educational_director_name = ? ,  educational_director_phone_number = ? , students_number  = ?
            teachers_number = ? ,  departments = ?
             WHERE id = ? ', [
             $request->input('name'),$request->input('type'),$request->input('educational_district'),
             $request->input('address'),$request->input('phone_number'),$request->input('email'),
             $request->input('educational_director_name'),$request->input('educational_director_phone_number'),$request->input('students_number')
             ,$request->input('teachers_number'),$request->input('departments'),$id]);

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
        if(Directorate::where('id',$id)->exists()){

            $data = Directorate::findOrFail($id);
            $data->delete();
            return response()->json(['status'=>true,'message'=>'Directorate Deleted Successful']);
           }else{
            return response()->json(['status'=>false,'message'=>'Directorate Deleted failed '],Response::HTTP_NOT_FOUND);

           }
    }
}
