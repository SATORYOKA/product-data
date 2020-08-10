<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\User;

use App\Product;

use Storage;

use Illuminate\Support\Facades\Validator;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        
        $data = [
            'products' => $products,
            ];
        
        return view('products.index', [
            'products' => $products,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product;
        
        return view('products.create', [
            'product' => $product,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|max:100',
            'description' => 'required|max:500',
            'price' => 'required|integer|min:1',
                ]);
        
        $product = new Product;
        $product->image_file_name = $request->image_file_name;
        $product->content = $request->content;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        
        
        
        
        //Validatorファサードのmakeメソッドの第１引数は、バリデーションを行うデータ。
    //第２引数はそのデータに適用するバリデーションルール
        $validator = Validator::make($request->all(), [
            'file' => 'required|max:10240|mimes:jpeg,gif,png',
        ]);

    //上記のバリデーションがエラーの場合、ビューにバリデーション情報を渡す
        if ($validator->fails()){
            return back()->withInput()->withErrors($validator);
        }
    //s3に画像を保存。第一引数はs3のディレクトリ。第二引数は保存するファイル。
    //第三引数はファイルの公開設定。
        $file = $request->file('file');
        $path = Storage::disk('s3')->putFile('/', $file, 'public');

    //カラムに画像のパスとタイトルを保存
        Post::create([
            'image_file_name' => $path,
        ]);

        return redirect('/');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        
        return view('products.show', [
            'product' => $product,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        
        return view('products.edit', [
            'product' => $product, 
            ]);
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
        $request->validate([
            'content' => 'required|max:100',
            'description' => 'required|max:500',
            'price' => 'required|integer|min:1',

            ]);
            
        $product = Product::findOrFail($id);
        $product->content = $request->content;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->save();
        
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/');
    }
    
}