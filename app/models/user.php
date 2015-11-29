<?php

class User extends BaseModel{

	public $id, $username, $password;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function authenticate($username, $password){
		$query = DB::connection()->prepare('SELECT * FROM Käyttäjä WHERE käyttäjätunnus = :username AND salasana = :salasana LIMIT 1');
		$query->execute(array('username' => $username, 'salasana' => $password));
		$row = $query->fetch();

		if($row){
			$user = new User(array(
				'id' => $row['ktunnus'],
				'username' => $row['käyttäjätunnus'],
				'password' => $row['salasana']
			));

			return $user;
		}else{
			return null;
		}
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Käyttäjä WHERE ktunnus = :id LIMIT 1');
		$query->execute(array('id' => $id));
    	$row = $query->fetch();

    	if($row){
			$user = new User(array(
				'id' => $row['ktunnus'],
				'username' => $row['käyttäjätunnus'],
				'password' => $row['salasana']
			));

			return $user;
		}else{
			return null;
		}
	}
}