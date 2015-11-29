<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $validatorerrors = array();
        $validatorerrors = array_merge($validatorerrors, $this->{$validator}());
        $errors = array_merge($errors, $validatorerrors);
      }

      return $errors;
    }

    public function validate_tarkeysaste(){
        $errors = array();
        if(is_numeric($this->tarkeysaste) == false){
            $errors[] = 'Tärkeysasteen tulee olla numero';
        }
        if($this->tarkeysaste < 1 || $this->tarkeysaste > 5){
            $errors[] = 'Tärkeysasteen tulee olla väliltä 1-5';
        }

        return $errors;
    }

    public function validate_nimi(){
        $errors = array();
        if($this->nimi == '' || $this->nimi == null){
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if(strlen($this->nimi) < 2){
            $errors[] = 'Nimen pituuden tulee olla vähintään kaksi merkkiä!';
        }

        return $errors;
    }

    public function validate_date(){
        $errors = array();
        $date = $this->deadline;
        $format = 'd/m/Y';
        if(self::validateDate($date, $format)){
          return $errors;
        } else {
          $errors[] = 'Päivämäärä ei ole oikein!';
        }
        return $errors;
    }

    function validateDate($date, $format){
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

  }
