<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::select('SELECT * FROM products');
        return response()->json(['status'=>true,'message'=>'Successful','date'=>$data]);

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
            'quantity'=>'required|integer',
            'price'=>'required|integer',
            'description'=>'required|string',
            'image'=>'string',
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
            $inserted = Product::create($request->all());
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
       if(Product::where('id',$id)->exists()){
        // $data = DB::table('products')->get();
        $data = Product::find($id);
        return response()->json(['status'=>true,'message'=>'Successful','data'=>$data]);
       }else{
        return response()->json(['status'=>false,'message'=>'Failed','data'=>'Not Found'],Response::HTTP_NOT_FOUND);

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
            'quantity'=>'required|integer',
            'price'=>'required|integer',
            'description'=>'required|string',
            'image'=>'string',
        ]);

        if(! $validator->fails()){
            $rowsOfUpdated = DB::update('UPDATE products SET name = ? ,  quantity = ? , price  = ? , description = ? ,image = ?  WHERE id = ? ', [$request->input('name'),$request->input('quantity'),$request->input('price'),$request->input('description'),$request->input('image'),$id]);

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
        if(Product::where('id',$id)->exists()){
            $data = Product::find($id);
            $data->delete();
            return response()->json(['status'=>true,'message'=>'Deleted Successful']);
        }else{
            return response()->json(['status'=>false,'message'=>'Deleted Failed'],Response::HTTP_NOT_FOUND);

        }

    }
}
