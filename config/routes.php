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
    HuoneController::paivita($id);
  });
  
  $routes->post('/huone/:id/poista', function($id) {
    HuoneController::poista($id);
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
    KayttajaController::profiili($id);
  });
  
  $routes->get('/user/:id/muokkaa', function($id) {
    KayttajaController::muokkaa($id);
  });
  
  $routes->post('/user/:id/muokkaa', function($id) {
    KayttajaController::muokkaaPost($id);
  });
  
  $routes->post('/user/:id/poista', function($id) {
    KayttajaController::poista($id);
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
  
  