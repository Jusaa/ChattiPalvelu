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

    public static function huone() {
        View::make('huone.html');
    }

    public static function user() {
        View::make('profile.html');
    }

// ADMIN OSOITTEET ----------------------------------------------

    public static function huoneet() {
        View::make('huoneet.html');
    }

    public static function listall() {
        View::make('list_all.html');
    }

    public static function huoneMuokkaa() {
        View::make('config_room.html');
    }

    public static function kayttajaMuokkaa() {
        View::make('config_user.html');
    }

// ESIMERKKI OSOITTEET --------------------------------------------

    public static function sandbox() {
        View::make('x_helloworld.html');
    }

    public static function gamelist() {
        View::make('x_game_list.html');
    }

}
