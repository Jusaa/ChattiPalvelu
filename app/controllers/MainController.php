<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MainController
 *
 * @author Jusaa
 */
class MainController extends BaseController {
    
    public static function index() {
        self::check_logged_in();
        View::make('home.html');
    }
    
    public static function listall() {
        self::check_logged_in();
        self::check_taso(2);
        $huoneet = Huone::all();
        $kayttajat = Kayttaja::all();
        $viestit = Viesti::all();
        View::make('listaa_kaikki.html', array('huoneet' => $huoneet, 'kayttajat' => $kayttajat, 'viestit' => $viestit));
    }
}
