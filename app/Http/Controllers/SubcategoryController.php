<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use GuzzleHttp\Middleware;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Validation\Validator;
use Lcobucci\JWT\Validation\Validator as JWTValidationValidator;
use Nette\Utils\Json;

class SubcategoryController extends Controller
{
    public function __construct()
    { 
        $this->middleware('auth:api', ['except' => ['index']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::all();

    return response()->json([
        'data' => $subcategories
        ]);

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
        $validator = Validator::make($request->all(), [
            'nama_subkategori' => 'required',
            'id_kategori' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp'
        ]);
    
        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), 422
            );
        }
    
        $input = $request->all();
        if ($request->has('gambar')) {
            File::delete('uploads/' . $input['gambar']); // Menghapus gambar yang lama
            $gambar = $request->file('gambar');
            $nama_gambar = time() . rand(1, 9) . '.' . $gambar->getClientOriginalExtension();
            $gambar->move('uploads', $nama_gambar);
            $input['gambar'] = $nama_gambar;
        }
    
        $subcategory = Subcategory::create($input);
    
        return response()->json([
            'data' => $subcategory
    ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory $Subcategory
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $Subcategoryy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subcategory  $Subcategory
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $Subcategoryy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $Subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subcategory $Subcategory)
    {

        $Subcategory->update($request->all());

        return response()->json([
            'message'=>'success',
            'data'=>$Subcategory
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $Subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subcategory $subcategory)
    {
        File::delete('uploads/' . $subcategory->gambar);
    $subcategory->delete();

    return response()->json([
        'message' => 'success'
        ]);
    }
}
