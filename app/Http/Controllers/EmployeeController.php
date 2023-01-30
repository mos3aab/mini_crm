<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::latest()
        ->join('companies', 'employees.company', '=', 'companies.id')
        ->select('employees.*','companies.name')->paginate(10);

        return view('employee.index',compact('employees'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
        return view('employee.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::select('name','id')->get();
        
        return view('employee.add')->with('companies',$companies);
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
            'fname' => 'required',
            'lname' => 'required',
        ]);
        ;
        Employee::create([
            'fname'=>   $request->fname,
            'lname'=>   $request->lname,
            'email'=>  $request->email,
            'phone'=>$request->phone,
            'company'=>$request->company,
        ]);
        
        return redirect()->route('employees')
        ->with('success','Employee Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies = Company::select('name','id')->get();
        $employee = Employee::find($id);
        return view('employee.edit')->with(['companies'=>$companies,'employee'=>$employee]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Employee::where('id',request()->id)->update([
            'fname'=>   $request->fname,
            'lname'=>   $request->lname,
            'email'=>  $request->email,
            'phone'=>$request->phone,
            'company'=>$request->company,
        ]);
    
        return redirect()->route('employees')
        ->with('success','Employee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $employee = Employee::findOrFail(request()->id)->delete();
        return redirect()->route('employees')
        ->with('info','Employee Deleted successfully.');
    }
}
