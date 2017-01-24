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
  
  $routes->get('/huoneet', function() {
    HelloWorldController::index();
  });
  
  $routes->get('/huone/1', function() {
    HelloWorldController::huone();
  });
  
  $routes->get('/listall', function() {
    HelloWorldController::listall();
  });

  $routes->get('/huone/1/muokkaa', function() {
    HelloWorldController::huoneMuokkaa();
  });
  
  $routes->get('/user', function() {
    HelloWorldController::user();
  });
  
  $routes->get('/user/1/muokkaa', function() {
    HelloWorldController::kayttajaMuokkaa();
  });
  
  