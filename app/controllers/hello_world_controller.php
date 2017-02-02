<?php

class HelloWorldController extends BaseController {

    public static function index() {
        View::make('home.html');
    }

    public static function login() {
        View::make('login.html');
    }

    public static function register() {
        View::make('register.html');
    }
    
    public static function registerPost() {
        $params = $_POST;
        $kayttaja = new Kayttaja(array(
            'nimi' => $params['nimi'],
            'password' => $params['password'],
            'email' => $params['email']
        ));
        
        $kayttaja->save($kayttaja);
        
        Redirect::to('/login');
    }

    public static function huone($id) {
        $huone = Huone::find($id);
        View::make('huone.html', array('huone' => $huone));
    }

    public static function user($id) {
        $kayttaja = Kayttaja::find($id);
        View::make('profile.html', array('kayttaja' => $kayttaja));
    }

    public static function huoneet() {
        $huoneet = Huone::all();
        View::make('huoneet.html', array('huoneet' => $huoneet));
    }

// ADMIN OSOITTEET ----------------------------------------------

    public static function listall() {
        $huoneet = Huone::all();
        $kayttajat = Kayttaja::all();
        View::make('list_all.html', array('huoneet' => $huoneet, 'kayttajat' => $kayttajat));
    }

    public static function huoneMuokkaa($id) {
        $huone = Huone::find($id);
        View::make('config_room.html', array('huone' => $huone));
    }
    
    public static function room_update($id){
        
    }

    public static function kayttajaMuokkaa($id) {
        $kayttaja = Kayttaja::find($id);
        View::make('config_user.html', array('kayttaja' => $kayttaja));
    }

    public static function user_update($id) {
        $params = $_POST;
        $kayttaja = Kayttaja::find($id);
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'email' => $params['email'],
            'taso' => $params['taso']
        );

        $kayttaja->save($attributes);
        
        Redirect::to('/');
    }

// ESIMERKKI OSOITTEET --------------------------------------------

    public static function sandbox() {
        $jussi = Kayttaja::find(1);
        $kayttajat = Kayttaja::all();
        // Kint-luokan dump-metodi tulostaa muuttujan arvon
        Kint::dump($kayttajat);
        Kint::dump($jussi);
    }

    public static function gamelist() {
        View::make('x_game_list.html');
    }

}
