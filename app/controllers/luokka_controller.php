<?php

	class LuokkaController extends BaseController{
		public static function index(){
		    self::check_logged_in();
			$luokat = Luokka::all();
			View::make('luokka/index.html', array('luokat' => $luokat));		  
		}

		public static function show($id){
			self::check_logged_in();
			$luokka = Luokka::find($id);
			$user = self::get_user_logged_in();
			$ktunnus = $user->id;

			View::make('luokka/askareet.html', array('luokka' => $luokka, 'askareet' => Luokka::findLuokanAskareet($id, $ktunnus)));
		}

		public static function create(){
			self::check_logged_in();
			View::make('luokka/new.html');
		}

		public static function store(){
			self::check_logged_in();
			$params = $_POST;

			$attributes = array(
				'nimi' => $params['nimi']
			);		

			$luokka = new Luokka($attributes);
			$errors = $luokka->errors();

			if(count($errors) == 0){
				$luokka->save();
				Redirect::to('/luokat');
			}else{
				View::make('/luokka/new.html', array('errors' => $errors));
			}
		}

		public static function update($id){
			self::check_logged_in();
			$params = $_POST;

			$attributes = array(
    			'nimi' => $params['nimi']
			);

			$luokka = new Luokka($attributes);
			$errors = $luokka->errors();

			if(count($errors) > 0){
				View::make('luokka/edit.html', array('errors' => $errors));
			}else{
				$luokka->update();
				Redirect::to('/luokat');
			}
		}

		public static function destroy($id){
			self::check_logged_in();
			$luokka = new Luokka(array('ltunnus' => $id));
			$luokka->destroy();
			Redirect::to('/luokat');
		}
	}