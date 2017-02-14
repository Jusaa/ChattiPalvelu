<?php

class BaseController {
    
    public static function get_user_logged_in() {
        if (isset($_SESSION['kayttaja'])) {
            $id = $_SESSION['kayttaja'];
            $kayttaja = Kayttaja::find($id);
            return $kayttaja;
        }
        return null;
    }

    public static function check_logged_in() {
        if (!isset($_SESSION['kayttaja'])) {
            Redirect::to('/login', array('message2' => 'Kirjaudu ensin sisään tai siirry rekisteröitymiseen!'));
        }
    }

}
