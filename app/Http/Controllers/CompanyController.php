<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use DB;
class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('company.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required',
            'logo'=>'image|dimensions:min_width=100,min_height=100'
        ]);
        
        // save logo
         $file_name = null;
        if($request->file('logo')){
            $img = $request->file('logo');
            $ext = $img->getClientOriginalExtension();
            $file_name= uniqid().'.'.$ext;
            $img->move(public_path(),$file_name);
        }
        Company::create([
            'name'=>   $request->name,
            'email'=>  $request->email,
            'website'=>$request->website,
            'logo'=>   $file_name
        ]);
        
        return redirect()->route('companies')
        ->with('success','Company created successfully.');
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('company.edit')->with('company',$company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $company = Company::findOrFail(request()->id);
        if(request()->logo){
            if(file_exists(public_path($company->logo)) && $company->logo )
                unlink(public_path($company->logo));

            $img = $request->file('logo');
            $ext = $img->getClientOriginalExtension();
            $file_name= uniqid().'.'.$ext;
            $img->move(public_path(),$file_name);
            Company::where('id',request()->id)->update([
                'name'=>   $request->name,
                'email'=>  $request->email,
                'website'=>$request->website,
                'logo'=>   $file_name
            ]);
        }else{
            Company::where('id',request()->id)->update([
                'name'=>   $request->name,
                'email'=>  $request->email,
                'website'=>$request->website,
            ]);
        }
        
        return redirect()->route('companies')
        ->with('success','Company updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = Company::findOrFail(request()->id);
        
        if($company->logo)
            unlink(public_path($company->logo));

        $company->delete();
        return redirect()->route('companies')
        ->with('info','Company Deleted successfully.');
    }
}
