<?php

class DosificacioneController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /dosificacione
	 *
	 * @return Response
	 */
	public function index()
	{
    	return Dosificacione::all()->toJson();
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /dosificacione/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /dosificacione
	 *
	 * @return Response
	 */
	public function store()
	{
	    $input = Input::all();
	    $Dosificacione = Dosificacione::create($input);
	    return Response::json($Dosificacione);
	}

	/**
	 * Display the specified resource.
	 * GET /dosificacione/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
	    $node = Dosificacione::find($id);
	    return Response::json($node);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /dosificacione/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /dosificacione/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::all();
		//var_dump($input);
		$node = Dosificacione::find($id)->update($input);
		return Response::json($node);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /dosificacione/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
	    $node = Dosificacione::destroy($id);
	    return Response::json($node);
	}

}