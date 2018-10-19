<?php

namespace Larashop\Http\Controllers\Admin;


use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larashop\Http\Controllers\Controller;
use Larashop\Models\Brand;
use Larashop\Models\User;


class BrandsController extends Controller
{
    protected $user;   
    
    /**
     * Instantiate a new BrandsController instance.
     */
    
    public function __construct()
    {
        $this->user = User::find(Auth::id());
        $this->middleware('permission:create', ['only' => ['create', 'store']]);
        
        $this->middleware('permission:edit', ['only' => ['edit', 'update']]);
        
        $this->middleware('permission:delete', ['only' => ['show', 'delete']]);
        
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        // $brands = Brand::all();
        $brands = Auth::user()->brands()->get();

        $params = [
        'title' => 'Brands Listing',
        'brands' => $brands,
        ];

        return view('admin.brands.brands_list')->with($params);
        
    }
    
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {       
        $params = [
        'title' => 'Create Brand',
        ];
        
        return view('admin.brands.brands_create')->with($params);   
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $this->validate($request, [
        'name' => 'required|unique:brands',
        'description' => 'required',
        ]);
        
        $brand = Brand::create([
        'name' => $request->input('name'),
        'description' => Auth::id(),
        ]);
        
        return redirect()->route('brands.index')->with('success', trans('general.form.flash.created',['name' => $brand->name]));   
    }
    
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function show($id)
    {
        try
        {
            $brand = Brand::findOrFail($id);

            $params = [
            'title' => 'Delete Brand',
            'brand' => $brand,
            ];

            return view('admin.brands.brands_delete')->with($params);  
        }
        
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function edit($id)
    {
        try
        {
            $brand = Brand::findOrFail($id);

            $params = [
            'title' => 'Edit Brand',
            'brand' => $brand,
            ];

            return view('admin.brands.brands_edit')->with($params);
        }
        
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
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
        try
        {
            $this->validate($request, [
            'name' => 'required|unique:brands,name,'.$id,
            'description' => 'required',
            ]);
            
            $brand = Brand::findOrFail($id);
            
            $brand->name = $request->input('name');
            
            $brand->description = $request->input('description');
            
            $brand->save();

            return redirect()->route('brands.index')->with('success', trans('general.form.flash.updated',['name' => $brand->name]));
        }
        
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
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
        try
        {
            $brand = Brand::findOrFail($id);

            $brand->delete();

            return redirect()->route('brands.index')->with('success', trans('general.form.flash.deleted',['name' => $brand->name]));
        }
        
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException)
            {
                return response()->view('errors.'.'404');
            }
        }
    }
}
