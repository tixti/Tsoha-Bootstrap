<?php

class AskareController extends BaseController{
	public static function index(){
		$askareet = Askare::all();

		View::make('askare/index.html', array('askareet' => $askareet));
	}

	public static function show($id){
		$askareet = Askare::find(id);

		View::make('askare/edit.html', array('askareet' => $askareet));
	}

	public static function store(){
		$params = $_POST;

		$askare = new Askare(array(
			'nimi' => $params['nimi'],
			'tarkeysaste' => $params['tarkeysaste'],
			'deadline' => $params['deadline']
		));

		$askare->save();

		Redirect::to('/askareet/' . $askare->atunnus);
	}
}