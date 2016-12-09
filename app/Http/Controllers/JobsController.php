<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Http\Requests;

class JobsController extends Controller
{
	public function __construct(){
		$this->middleware('admin');
	}
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::orderBy('order', 'asc')->get();
        
       	return view('cv.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cv.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$job = Job::create($request->all());
    	
    	flash()->success('The job entry has been successfully created');
    	
    	return redirect('cvadmin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$job = Job::where('id', $id)->first();
    	
    	if(!$job){
    		return redirect('cvadmin');
    	}
    	
    	return view('cv.show', compact('job'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$job = Job::findOrFail($id);
    	
    	return view('cv.edit', compact('job'));
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
        $job = Job::findOrFail($id);
        
        $job->update($request->all());
        
        flash()->success('The job entry has been updated!');
        
        return redirect('cvadmin');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Job::destroy($id);
        
        return redirect('cvadmin');
    }
    
	public function order(Request $request){
		$data = $request->input('item');
		$i = 0;
		
		foreach($data as $value){
			$job = Job::find($value);
			$job->order = $i;
			$job->save();
			$i++;
		}
	}
}
