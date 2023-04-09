<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Task::all();
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
            'title'=>'required|string|min : 5',
            'description'=>'required|string|max : 255',
            'priority'=>'required|integer|min:2|max:10',
            'status'=>'required|boolean',
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
            $inserted = Task::create($request->all());
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
        if(Task::where('id',$id)->exists()){
            $data = Task::find($id);
            return response()->json(['status'=>true,'message'=>'Successful','data'=>$data]);
           }else{
            return response()->json(['status'=>false,'message'=>'failed','data'=>'Not Found'],Response::HTTP_NOT_FOUND);

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
            'title'=>'required|string|min : 5',
            'description'=>'required|string|max : 255',
            'priority'=>'required|integer|min:2|max:10',
            'status'=>'required|boolean',
        ]);
        if(! $validator->fails()){
            $rowsOfUpdated = DB::update('UPDATE tasks SET title = ? ,  description = ? , priority  = ?  , status = ?  WHERE id = ? ', [$request->input('title'),$request->input('description'),$request->input('priority'),$request->input('status'),$id]);

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
        if(Task::where('id',$id)->exists()){
            $data = Task::find($id);
            $data->delete();
            return response()->json(['status'=>true,'message'=>'Task Deleted Successful']);
           }else{
            return response()->json(['status'=>false,'message'=>'Task Deleted failed '],Response::HTTP_NOT_FOUND);

           }

    }
}
