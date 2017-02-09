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
        View::make('home.html');
    }
    
    public static function listall() {
        $huoneet = Huone::all();
        $kayttajat = Kayttaja::all();
        View::make('list_all.html', array('huoneet' => $huoneet, 'kayttajat' => $kayttajat));
    }
}
