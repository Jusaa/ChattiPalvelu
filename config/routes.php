<?php 

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/gamelist', function() {
    HelloWorldController::gamelist();
  });
  
  
  //Sivuun luonnostellut sivut
  $routes->get('/', function() {
    HelloWorldController::huoneet();
  });
  
  $routes->get('/login', function() {
    HelloWorldController::login();
  });
  
  $routes->get('/register', function() {
    HelloWorldController::register();
  });
  
  $routes->post('/register', function() {
      HelloWorldController::registerPost();
  });
  
  $routes->get('/huoneet', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/huone/:id', function($id) {
    HelloWorldController::huone($id);
  });
  
  $routes->get('/listall', function() {
    HelloWorldController::listall();
  });

  $routes->get('/huone/:id/muokkaa', function($id) {
    HelloWorldController::huoneMuokkaa($id);
  });
  
  $routes->post('/huone/:id/muokkaa', function($id) {
    HelloWorldController::room_update($id);
  });
  
  $routes->get('/user/:id', function($id) {
    HelloWorldController::user($id);
  });
  
  $routes->post('/user/:id/muokkaa', function($id) {
    HelloWorldController::user_update($id);
  });
  
  $routes->get('/user/:id/muokkaa', function($id) {
    HelloWorldController::kayttajaMuokkaa($id);
  });
  
  