<?php

class KayttajaController extends BaseController {

    public static function login() {
        View::make('login.html');
    }
    
    public static function loginPost() {
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['nimi'], $params['password']);
        
        if(!$kayttaja){
            View::make('login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'nimi' => $params['nimi']));
        }else{
            $_SESSION['kayttaja'] = $kayttaja->id;

        Redirect::to('/', array('message' => 'Hei ' . $kayttaja->nimi . '! Kirjautuminen onnistui'));
        }
    }
    
    public static function logout() {
        self::check_logged_in();
        $_SESSION['kayttaja'] = null;
        Redirect::to('/login', array('message' => 'Uloskirjautuminen onnistui'));
    }
    
    public static function register() {
        View::make('register.html');
    }

    public static function registerPost() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'password' => $params['password'],
            'email' => $params['email']
        );
        $kayttaja = new Kayttaja($attributes);
        $errors = $kayttaja->errors();
        if (count($errors) == 0) {
            $kayttaja->save($kayttaja);
            Redirect::to('/login');
        }

        View::make('register.html', array('errors' => $errors, 'attributes' => $attributes));
    }

    public static function profiili($id) {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $kayttaja = Kayttaja::find($id);
        $huoneet = Kayttaja::huoneet($kayttaja);  
        if($user_logged_in->id == $kayttaja->id){
            View::make('profiili.html', array('kayttaja' => $kayttaja, 'huoneet' => $huoneet, 'oma' => $user_logged_in));
        }
        View::make('profiili.html', array('kayttaja' => $kayttaja, 'huoneet' => $huoneet));
    }

    public static function muokkaa($id) {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $taso = self::get_user_logged_in()->taso;
        $kayttaja = Kayttaja::find($id);
        if($taso == 4){
            View::make('muokkaa_kayttaja.html', array('kayttaja' => $kayttaja, 'taso4' => $taso));
        }else if($user_logged_in->id == $kayttaja->id){
            View::make('muokkaa_kayttaja.html', array('kayttaja' => $kayttaja));
        }
        self::check_taso(4);
    }

    public static function muokkaaPost($id) {
        self::check_logged_in();
        $user_logged_in = self::get_user_logged_in();
        $taso = self::get_user_logged_in()->taso;
        $kayttaja = Kayttaja::find($id);
        if($taso < 4 && $user_logged_in->id != $kayttaja->id){
            View::make('muokkaa_kayttaja.html', array('kayttaja' => $kayttaja));
        }        
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'password' => $params['password'],
            'email' => $params['email'],
            'taso' => $params['taso']
        );

        $kayttaja = new Kayttaja($attributes);
        $errors = $kayttaja->errors();

        if (count($errors) > 0) {
            View::make('muokkaa_kayttaja.html', array('errors' => $errors, 'kayttaja' => $kayttaja));
        } else {
            // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
            $kayttaja->update($kayttaja);
            Redirect::to('/', array('message' => 'Tietoja on muokattu onnistuneesti!'));
        }
    }

    public static function poista($id) {
        self::check_logged_in();
        Kayttaja::delete($id);
        Redirect::to('/', array('message' => 'Käyttäjä on poistettu onnistuneesti!'));
    }
}
