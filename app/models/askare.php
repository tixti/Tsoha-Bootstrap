<?php

class Askare extends BaseModel{

	public $atunnus, $ktunnus, $nimi, $tarkeysaste, $deadline;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM askare');
		$query->execute();
		$rows = $query->fetchAll();
		$askareet = array();
    	
    	foreach ($rows as $row){
    		$askareet[] = new Askare(array(
    			'atunnus' => $row['atunnus'],
    			'ktunnus' => $row['ktunnus'],
    			'nimi' => $row['nimi'],
    			'tarkeysaste' => $row['tarkeysaste'],
    			'deadline' => $row['deadline']
    		));	
    	}
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
    			'tarkeysaste' => $row['tarkeysaste'],
    			'deadline' => $row['deadline']
    		));

    		return $askare;
    	}

    	return null;
	}

    public function save(){
    
    $query = DB::connection()->prepare('INSERT INTO Askare (nimi, tarkeysaste, deadline) VALUES (:nimi, :tarkeysaste, :deadline) RETURNING atunnus');
    $query->execute(array('nimi' => $this->nimi, 'tarkeysaste' => $this->tarkeysaste, 'deadline' => $this->deadline));
    $row = $query->fetch();
    $this->atunnus = $row['atunnus'];
  }
}