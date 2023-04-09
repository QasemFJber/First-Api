<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDO;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = DB::select('SELECT * FROM categories');
        // $data = DB::table('categories')->get();
        $data = Category::all();
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
            'name'=>'required|string|min : 5',
            'info'=>'required|string|max : 255',
            'visible'=>'required|boolean',
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
            $inserted = Category::create($request->all());
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

  //   $data = DB::select('SELECT * FROM categories WHERE id = {$id}');
         $data = Category::find($id);
        return response()->json(['status'=>! is_null($data),'message'=>$data ? 'Successful' : 'Not Found','data'=>$data]);
        if(!$id){
            return response()->json(['status'=>! is_null($data),'message'=>'failed','data'=>null],404);
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
            'info'=>'required|string|max:255',
            'visible'=>'required|boolean',
        ]);

        if(! $validator->fails()){
            $rowsOfUpdated = DB::update('UPDATE categories SET name = ? ,  info = ? , visible  = ?  WHERE id = ? ', [$request->input('name'),$request->input('info'),$request->input('visible'),$id]);

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


        // $number = intval($data->number);

        if (Category::where('id', $id)->exists()) { // التحقق مما إذا كانت القيمة موجودة في الجدول

            $data = Category::findOrFail($id);
            $data->delete();
            return response()->json(['status'=>true,'message'=>'Category Deleted Successful']);
        } else {
            return response()->json(['status'=>false,'message'=>'Category Deleted failed '],Response::HTTP_NOT_FOUND);
        }
        // if($number == 1 ){
        //

        // }else{
        //

        // }
    }
}
