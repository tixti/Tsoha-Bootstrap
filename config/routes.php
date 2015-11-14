<?php

  $routes->get('/', function() {
    AskareController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/askareet', function() {
    AskareController::index();
  });

  $routes->get('/login', function() {
    HelloWorldController::login();
  });

  $routes->get('/askareet/new', function(){
    AskareController::create();
  });

  $routes->get('/askareet/:id', function($id) {
    AskareController::show($id);
  });

  $routes->post('/askareet', function(){
    AskareController::store();
  });