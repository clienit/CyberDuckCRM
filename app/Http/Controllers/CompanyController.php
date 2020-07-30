<?php

namespace App\Http\Controllers;

use App\Model\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompany;

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

        return view('companies.index',compact('companies'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $requestData = $request->all();

        if($request->hasFile('logo'))
        {
            // Parse filename
            $filenameWithExtension = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('logo')->storeAs('public', $fileNameToStore);
            // Update logo value with the path of the image
            $requestData['logo'] = $path;
        }

        Company::create($requestData);
   
        return redirect()->route('companies.index')
                        ->with('success','Company created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('companies.show',compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCompany $request, Company $company)
    {
        $requestData = $request->all();

        if($request->hasFile('logo'))
        {
            // Parse filename
            $filenameWithExtension = $request->file('logo')->getClientOriginalName();
            $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('logo')->storeAs('public', $fileNameToStore);
            // Update logo value with the path of the image
            $requestData['logo'] = $path;
        }

        $company->update($requestData);
  
        return redirect()->route('companies.index')
                        ->with('success','Company updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
  
        return redirect()->route('companies.index')
                        ->with('success','Company deleted successfully');
    }
}
