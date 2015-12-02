<?php

	class AskareController extends BaseController{

		public static function index(){
			self::check_logged_in();
			$user = self::get_user_logged_in();
			$id = $user->id;
			$askareet = Askare::all($id);
			View::make('askare/index.html', array('askareet' => $askareet));
		}

		public static function show($id){
			self::check_logged_in();
			$askare = Askare::find($id);
			$askare->deadline = date("d/m/Y", strtotime($askare->deadline));
			View::make('askare/edit.html', array('askareet' => $askare));
		}

		public static function create(){
			self::check_logged_in();
			$luokat = Luokka::all();
			View::make('askare/new.html', array('luokat' => $luokat));
		}

		public static function store(){
			self::check_logged_in();
			$params = $_POST;

			if (!empty($params['luokat'])){
				$luokat = $params['luokat'];
			}
			$attributes = array(
				'ktunnus' => $params['ktunnus'],
				'nimi' => $params['nimi'],
				'tarkeysaste' => $params['tarkeysaste'],
				'deadline' => $params['deadline']
			);		

			$askare = new Askare($attributes);
			$errors = $askare->errors();

			if(count($errors) == 0){
				$askare->save();
				if (!empty($params['luokat'])){
					foreach($luokat as $luokka){
						$askare->saveAskareenLuokka($luokka);
					}
				}
				Redirect::to('/askareet');
			}else{
				$luokat = Luokka::all();
				View::make('/askare/new.html', array('errors' => $errors, 'luokat' => $luokat, 'attributes' => $attributes));
			}
		}

		public static function update($id){
			self::check_logged_in();
			$params = $_POST;
		
			$attributes = array(
				'atunnus' => $id,
    			'nimi' => $params['nimi'],
    			'tarkeysaste' => $params['tarkeysaste'],
    			'deadline' => $params['deadline']
				);

			$askare = new Askare($attributes);
			$errors = $askare->errors();

			if(count($errors) > 0){
				$askare = Askare::find($askare->atunnus);
				$askare->deadline = date("d/m/Y", strtotime($askare->deadline));
				View::make('askare/edit.html', array('askareet' => $askare, 'errors' => $errors));
			}else{
				$askare->update();
				Redirect::to('/askareet');
			}
		}

		public static function destroy($id){
			self::check_logged_in();
			$askare = new Askare(array('atunnus' => $id));
			$askare->destroy();
			Redirect::to('/askareet');
		}
	}