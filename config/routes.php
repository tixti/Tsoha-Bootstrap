<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/askareet', function() {
    HelloWorldController::askare_lista();
  });

  $routes->get('/askareet/1', function() {
    HelloWorldController::askare_muokkaa();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });
