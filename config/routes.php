<?php 


//MAINCONTROLLER ---------------------------------------------------------------
  $routes->get('/huoneet', function() {
    MainController::index();
  });
  
  $routes->get('/listall', function() {
    MainController::listall();
  });
  
  
//HUONECONTROLLER --------------------------------------------------------------
  
  $routes->get('/', function() {
    HuoneController::huoneet();
  });
  
  $routes->get('/huone/lisaa', function() {
      HuoneController::lisaa();
  });
  
  $routes->post('/huone/lisaa', function() {
    HuoneController::lisaaPost();
  });
  
  $routes->get('/huone/:id', function($id) {
    HuoneController::huone($id);
  });

  $routes->get('/huone/:id/muokkaa', function($id) {
    HuoneController::huoneMuokkaa($id);
  });
  
  $routes->post('/huone/:id/muokkaa', function($id) {
    HuoneController::room_update($id);
  });
  
  $routes->post('/huone/:id/poista', function($id) {
    HuoneController::room_delete($id);
  }); 
  
//KAYTTAJACONTROLLER -----------------------------------------------------------
  
  $routes->get('/login', function() {
    KayttajaController::login();
  });
  
  $routes->post('/login', function() {
    KayttajaController::loginPost();
  });
  
  $routes->get('/logout', function() {
  KayttajaController::logout();
  });
  
  $routes->get('/register', function() {
    KayttajaController::register();
  });
  
  $routes->post('/register', function() {
    KayttajaController::registerPost();
  }); 
  
  $routes->get('/user/:id', function($id) {
    KayttajaController::user($id);
  });
  
  $routes->get('/user/:id/muokkaa', function($id) {
    KayttajaController::kayttajaMuokkaa($id);
  });
  
  $routes->post('/user/:id/muokkaa', function($id) {
    KayttajaController::user_update($id);
  });
  
  $routes->post('/user/:id/poista', function($id) {
    KayttajaController::user_delete($id);
  });
  
  $routes->get('/huone/liity/:id', function($id) {
      HuoneController::liity($id); 
  });
  
  $routes->get('/huone/poistu/:id', function($id) {
      HuoneController::poistu($id); 
  });
  
//ESIMERKIT --------------------------------------------------------------------

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/gamelist', function() {
    HelloWorldController::gamelist();
  });
  
  