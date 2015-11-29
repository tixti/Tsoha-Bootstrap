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
    UserController::login();
  });

  $routes->post('/login', function(){
    UserController::handle_login();
  });

  $routes->get('/askareet/new', function(){
    AskareController::create();
  });

  $routes->get('/askareet/:id', function($id) {
    AskareController::show($id);
  });

  $routes->post('/askareet/:id', function($id) {
    AskareController::update($id);
  });

  $routes->post('/askareet/:id/destroy', function($id) {
    AskareController::destroy($id);
  });

  $routes->post('/askareet', function(){
    AskareController::store();
  });

  $routes->post('/logout', function(){
    UserController::logout();
  });

  $routes->get('/luokat', function() {
    LuokkaController::index();
  });

  $routes->get('/luokat/new', function(){
    LuokkaController::create();
  });

  $routes->get('/luokat/:id', function($id) {
    LuokkaController::show($id);
  });

  $routes->post('/luokat/:id/destroy', function($id) {
    LuokkaController::destroy($id);
  });

  $routes->post('/luokat', function(){
    LuokkaController::store();
  });

  


