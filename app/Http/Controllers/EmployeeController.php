<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
    	$employees = DB::table('employee')->select('emp_id','fname','lname','email','phone')->where('com_id','=',$id)->paginate(5);
    	$company = DB::table('company')->select('name')->where('com_id','=',$id)->get();
        return view('employee_list', ['data' => $employees,'company'=>$company,'com_id'=>$id]);
    }

    public function create($id,Request $request)
    {
        return view('employee_add',['id'=>$id]);
    }

    public function save(Request $request)
    {
    	if(!empty($request->input()))
		{
	    	$validatedData = $request->validate([
		        'fname' => 'required|max:255',
		        'lname' => 'required|max:255',
		        'email' => 'required|unique:employee',
		        'phone' => '',
		        'com_id' => '',
		    ]);
			DB::table('employee')->insert($validatedData);
	    }
		return redirect('/view_company_emplyees/'.$request->input('com_id'));
    }

    public function edit(Request $request)
    {
    	if(!empty($request->input()))
		{
			$emp_id = $request->input('emp_id');
	    	$validatedData = $request->validate([
		        'fname' => 'required|max:255',
		        'lname' => 'required|max:255',
		        'email' => 'required',
		        'phone' => '',
		        'com_id' => '',
		    ]);
			DB::table('employee')->where('emp_id', '=', $emp_id)->update($validatedData);
	    }
		return redirect('/view_company_emplyees/'.$request->input('com_id'));
    }

    public function modify($id)
    {
    	$data = DB::table('employee')->where('emp_id','=',$id)->get();
        return view('employee_modify', ['emp' => $data[0],'com_id'=>$data[0]->com_id,'emp_id'=>$id]);
    }


    public function delete(Request $request)
    {
    	$res = [
    		"success"=>false
    	];
    	if($request->input('id'))
		{
			DB::table('employee')->where('emp_id', '=', $request->input('id'))->delete();
			$res['success'] = true;
		}
		return response()->json($res,200);
    }
}
