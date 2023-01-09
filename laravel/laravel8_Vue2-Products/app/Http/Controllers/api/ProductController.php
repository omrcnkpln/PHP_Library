<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::query()->orderBy('id')->orderBy("name")->get();

        return response()->json($products);
//        return response()->json("index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json("create");
//        echo "create";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Storage $storage)
    {
        if ($request["picture"]) {
            $image = $request["picture"];
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10) . '.' . 'png';
            $isUploaded = $storage::disk("public")->put($imageName, base64_decode($image));

            if ($isUploaded) {
                $request["picture"] = $imageName;
            }
            else {
                $request["picture"] = null;
            }
        }

        $product = Product::query()->create($request->all());

        return response()->json([
            'status' => 'success',
            'product' => $product
        ]);

//        return response()->json("store");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::query()->find($id);

        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json("edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Storage $storage)
    {
        if ($request["picture"]) {
            $image = $request["picture"];
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = Str::random(10) . '.' . 'png';
            $isUploaded = $storage::disk("public")->put($imageName, base64_decode($image));

            if ($isUploaded) {
                $request["picture"] = $imageName;
            }
            else {
                $request["picture"] = null;
            }
        }

        $product = Product::query()->find($id);
        $product->update($request->all());

        return response()->json([
            'status' => 'success',
            'post' => $product
        ]);

//        return response()->json("update");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::query()->find($id);
        $product->delete();

        return response()->json('Product successfully deleted!');
    }
}
