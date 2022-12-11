<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Auth;

use App\Traits\MessTraits;

use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
   use MessTraits;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pro =  ProductResource::collection(Product::where('user_id',Auth::user()->id)->get());
        return $pro;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

   
    public function store(StoreProductRequest $request)
    {
        $request->validated($request->all());

        
      $pro = Product::create([
        'user_id'=>Auth::user()->id,
        'name'=>$request->name,
        'detail'=>$request->detail,
        'size'=>$request->size,
        'qty'=>$request->qty,
        'price'=>$request->price,
      ]);

        return new ProductResource($pro);

    }

  
    public function show(Product $product)
    {
        return $this->isAuth($product)?$this->isAuth($product) :
        new ProductResource($product);
    }

 
    public function edit(Product $product)
    {

    }

  
    public function update(UpdateProductRequest $request, Product $product)
    {
         

         

          
        if(Auth::user()->id !== $product->user_id){
            return $this->error('','this user are Unauthenticated to update this data',403);
        }
        $product->update($request->all());
      
      return new ProductResource($product);

    }

    public function destroy(Product $product)
    {
        if(Auth::user()->id !== $product->user_id){
            return $this->error('','this user are Unauthenticated to delete this data',403);
        }
       
        $product->delete();
        return response('',204);
    }


    public function isAuth($pro){
        if(Auth::user()->id !== $pro->user_id){
            return $this->error('','this user are Unauthenticated to get this data',403);
        }
    }
}
