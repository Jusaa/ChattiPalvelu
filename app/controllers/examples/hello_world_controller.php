<?php

class HelloWorldController extends BaseController {

    public static function sandbox() {
        $henkilo = new Kayttaja(array(
            'nimi' => 'he',
            'password' => 'salasana',
            'email' => 'sahkoposti',
        ));
        $errors = $henkilo->errors();

        Kint::dump($errors);
    }

    public static function gamelist() {
        View::make('x_game_list.html');
    }

}
