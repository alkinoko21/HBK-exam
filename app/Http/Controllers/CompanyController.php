<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$companies = DB::table('company')->select('email','com_id','name','website')->paginate(5);
        return view('company_list', ['comps' => $companies]);
    }

    public function create(Request $request)
    {
        return view('company_add');
    }

    public function save(Request $request)
    {
    	if(!empty($request->input()))
		{
	    	$validatedData = $request->validate([
		        'name' => 'required|max:255',
		        'email' => 'required|unique:company',
		        'website' => '',
		        'logo' => ''
		    ]);
		    if ($request->file('logo')) {
		        $validatedData['logo'] = $request->file('logo')->store('logo', ['disk' => 'public']);
		         
		    }
			DB::table('company')->insert($validatedData);
	    }
		return redirect('/company_list');
    }

    public function delete(Request $request)
    {
    	$res = [
    		"success"=>false
    	];
    	if($request->input('id'))
		{
			DB::table('company')->where('com_id', '=', $request->input('id'))->delete();
			$res['success'] = true;
		}
		return response()->json($res,200);
    }

    public function edit(Request $request)
    {
    	if(!empty($request->input()))
		{
			$com_id = $request->input('com_id');
	    	$validatedData = $request->validate([
		        'name' => 'required|max:255',
		        'email' => 'required',
		        'website' => '',
		        // 'logo' => 'dimensions:min_width=100,min_height=100'
		    ]);
			DB::table('company')->where('com_id', '=', $com_id)->update($validatedData);
	    }
		return redirect('/company_list');
    }

    public function modify($id)
    {
    	$data = DB::table('company')->where('com_id','=',$id)->get();
        return view('company_modify', ['comp' => $data[0],'id'=>$id]);
    }
}
