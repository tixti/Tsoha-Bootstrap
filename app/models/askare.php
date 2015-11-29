<?php

class Askare extends BaseModel{

	public $atunnus, $ktunnus, $nimi, $tarkeysaste, $deadline;

	public function __construct($attributes){
		parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_tarkeysaste', 'validate_date');
	}

	public static function all($id){
		$query = DB::connection()->prepare('SELECT * FROM Askare WHERE ktunnus = :ktunnus');
		$query->execute(array('ktunnus' => $id));
		$rows = $query->fetchAll();
		$askareet = array();
    	
    	foreach ($rows as $row){
    		$askareet[] = new Askare(array(
    			'atunnus' => $row['atunnus'],
    			'ktunnus' => $row['ktunnus'],
    			'nimi' => $row['nimi'],
    			'tarkeysaste' => $row['tärkeysaste'],
    			'deadline' => $row['deadline']
    		));	
    	}

        return $askareet;
	}

	public static function find($atunnus){
		$query = DB::connection()->prepare('SELECT * FROM Askare WHERE atunnus = :atunnus LIMIT 1');
		$query->execute(array('atunnus' => $atunnus));
    	$row = $query->fetch();

    	if($row){
    		$askare = new Askare(array(
    			'atunnus' => $row['atunnus'],
    			'ktunnus' => $row['ktunnus'],
    			'nimi' => $row['nimi'],
    			'tarkeysaste' => $row['tärkeysaste'],
    			'deadline' => $row['deadline']
    		));

    		return $askare;
    	}

    	return null;
	}

    public function save(){  
        $query = DB::connection()->prepare('INSERT INTO Askare (ktunnus, nimi, tärkeysaste, deadline) VALUES (:ktunnus, :nimi, :tarkeysaste, :deadline) RETURNING atunnus');
        $query->execute(array('ktunnus' => $this->ktunnus, 'nimi' => $this->nimi, 'tarkeysaste' => $this->tarkeysaste, 'deadline' => $this->deadline));      
        $row = $query->fetch();
        $this->atunnus = $row['atunnus'];
    }

    public function saveAskareenLuokka($luokka) {
        $query = DB::connection()->prepare('INSERT INTO Askareenluokka (atunnus, ltunnus) VALUES (:atunnus, :ltunnus)');
        $query->execute(array('atunnus' => $this->atunnus, 'ltunnus' => $luokka));
    }

    public function update(){
        $query = DB::connection()->prepare('UPDATE Askare SET nimi = :nimi, tärkeysaste = :tarkeysaste, deadline = :deadline WHERE atunnus = :atunnus');
        $query->execute(array('nimi' => $this->nimi, 'tarkeysaste' => $this->tarkeysaste, 'deadline' => $this->deadline, 'atunnus' => $this->atunnus));
    }

    public function destroy(){
        $query2 = DB::connection()->prepare('DELETE FROM Askareenluokka WHERE atunnus = :atunnus');
        $query2->execute(array('atunnus' => $this->atunnus));
        $query = DB::connection()->prepare('DELETE FROM Askare WHERE atunnus = :atunnus');
        $query->execute(array('atunnus' => $this->atunnus));
    }

}


