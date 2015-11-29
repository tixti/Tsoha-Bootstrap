<?php

class Luokka extends BaseModel{

	public $ltunnus, $nimi;

	public function __construct($attributes){
		parent::__construct($attributes);
        $this->validators = array('validate_nimi');
	} 

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Luokka');
		$query->execute();
		$rows = $query->fetchAll();
		$luokat = array();
    	
        if($rows){

        	foreach ($rows as $row){
        		$luokat[] = new Luokka(array(
        			'ltunnus' => $row['ltunnus'],
        			'nimi' => $row['nimi']
        		));	
        	}

            return $luokat;
        }
        
        return null;    
	}

	public static function find($ltunnus){
		$query = DB::connection()->prepare('SELECT * FROM Luokka WHERE ltunnus = :ltunnus LIMIT 1');
		$query->execute(array('ltunnus' => $ltunnus));
    	$row = $query->fetch();

    	if($row){
    		$luokka = new Luokka(array(
    			'ltunnus' => $row['ltunnus'],
    			'nimi' => $row['nimi']
    		));

    		return $luokka;
    	}

    	return null;
	}

	public function save(){  
        $query = DB::connection()->prepare('INSERT INTO Luokka (nimi) VALUES (:nimi) RETURNING ltunnus');
        $query->execute(array('nimi' => $this->nimi));
        $row = $query->fetch();
        $this->ltunnus = $row['ltunnus'];
    }

    public function update(){
        $query = DB::connection()->prepare('UPDATE Luokka SET nimi = :nimi WHERE ltunnus = :ltunnus');
        $query->execute(array('nimi' => $this->nimi, 'ltunnus' => $this->ltunnus));
    }

    public function destroy(){
        $query2 = DB::connection()->prepare('DELETE FROM Askareenluokka WHERE ltunnus = :ltunnus');
        $query2->execute(array('ltunnus' => $this->ltunnus));
        $query = DB::connection()->prepare('DELETE FROM Luokka WHERE ltunnus = :ltunnus');
        $query->execute(array('ltunnus' => $this->ltunnus));
    }

    public static function findLuokanAskareet($ltunnus, $ktunnus){
        $query = DB::connection()->prepare('SELECT *
                                            FROM Askare
                                            NATURAL JOIN Askareenluokka                                           
                                            WHERE ltunnus = :ltunnus 
                                            AND ktunnus = :ktunnus                                        
                                            ');
        $query->execute(array('ltunnus' => $ltunnus, 'ktunnus' => $ktunnus));
        $rows = $query->fetchAll();
        $askareet = array();
        
        if($rows){
            foreach ($rows as $row) {
            
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

        return null;
    }

}