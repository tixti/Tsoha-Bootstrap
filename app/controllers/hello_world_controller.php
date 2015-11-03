<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu!';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function askare_lista(){
      View::make('suunnitelmat/askare_lista.html');
    }

    public static function askare_muokkaa(){
      View::make('suunnitelmat/askare_muokkaa.html');
    }

    public static function login(){
      View::make('suunnitelmat/kirjautumissivu.html');
    }
  }
