<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StatusRequest;

class StatusController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$statuses = Status::latest()->paginate();
		return view('status.index', compact('statuses'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$status = new Status;
		return view('status.create', compact('status'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(StatusRequest $request)
	{
        $data = $request->validated();
        
        Status::create($data);
        
        return redirect()->route('status.index')->withSuccess('Data successfully created.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Status $status)
	{
		return view('status.edit', compact('status'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(StatusRequest $request, Status $status)
	{
		$data = $request->validated();
        $data['name'] = $request->input('name');
        $data['notes'] = $request->input('notes');
    
        $status->update($data);
    
        return redirect()->route('status.index')->with('success', 'Data succcessfully updated');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function delete(Status $Status)
	{
		$Status->delete();
		return to_route('Statuss.index')->withSuccess('Data successfully deleted.');
	}
}
