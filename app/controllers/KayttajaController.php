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

    public static function user($id) {
        $kayttaja = Kayttaja::find($id);
        View::make('profile.html', array('kayttaja' => $kayttaja));
    }

    public static function kayttajaMuokkaa($id) {
        $kayttaja = Kayttaja::find($id);
        View::make('config_user.html', array('kayttaja' => $kayttaja));
    }

    public static function user_update($id) {
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
            View::make('config_user.html', array('errors' => $errors));
        } else {
            // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
            $kayttaja->update($kayttaja);
            Redirect::to('/', array('message' => 'Tietoja on muokattu onnistuneesti!'));
        }
    }

    public static function user_delete($id) {
        Kayttaja::delete($id);
        Redirect::to('/', array('message' => 'Käyttäjä on poistettu onnistuneesti!'));
    }
}
