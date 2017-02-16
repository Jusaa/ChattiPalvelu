<?php

class HuoneController extends BaseController {

    public static function huone($id) {
        self::check_logged_in();
        $huone = Huone::find($id);
        $kayttaja = self::get_user_logged_in();
        $huonekayttajat = Huone::kayttajat($id);
        if ($kayttaja->onkoHuoneessa($huone, $kayttaja)) {
            View::make('huone.html', array('huone' => $huone, 'liittynyt' => $kayttaja, 'kayttajat' => $huonekayttajat));
        }
        View::make('huone.html', array('huone' => $huone, 'kayttajat' => $huonekayttajat));
    }

    public static function huoneet() {
        self::check_logged_in();
        $huoneet = Huone::all();
        $user_logged_in = self::get_user_logged_in();
        View::make('huoneet.html', array('huoneet' => $huoneet, 'user_logged_in' => $user_logged_in));
    }

    public static function lisaa() {
        self::check_logged_in();
        View::make('lisaa_huone.html');
    }

    public static function lisaaPost() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus']
        );
        $huone = new Huone($attributes);
        $errors = $huone->errors();
        if (count($errors) == 0) {
            $huone->save($huone);
            Redirect::to('/', array('message' => 'Huone on lisätty onnistuneesti!'));
        }

        View::make('lisaa_huone.html', array('errors' => $errors, 'attributes' => $attributes));
    }

    public static function huoneMuokkaa($id) {
        self::check_logged_in();
        $huone = Huone::find($id);
        View::make('muokkaa_huone.html', array('huone' => $huone));
    }

    public static function paivita($id) {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus']
        );

        $huone = new Huone($attributes);
        $errors = $huone->errors();

        if (count($errors) > 0) {
            View::make('muokkaa_huone.html', array('errors' => $errors, 'huone' => $huone));
        } else {
            $huone->update($huone);
            Redirect::to('/', array('message' => 'Tietoja on muokattu onnistuneesti!'));
        }
    }

    public static function poista($id) {
        self::check_logged_in();
        Huone::delete($id);
        Redirect::to('/', array('message' => 'Huone on poistettu onnistuneesti!'));
    }

    public static function liity($id) {
        self::check_logged_in();
        $kayttaja = self::get_user_logged_in();
        $huone = Huone::find($id);
        $kayttaja->liityHuoneeseen($huone, $kayttaja);
        Redirect::to('/huone/' . $huone->id, array('huone' => $huone, 'message' => 'Huoneeseen liitytty!'));
    }

    public static function poistu($id) {
        self::check_logged_in();
        $kayttaja = self::get_user_logged_in();
        $huone = Huone::find($id);
        $kayttaja->poistuHuoneesta($huone, $kayttaja);
        Redirect::to('/huone/' . $huone->id, array('huone' => $huone, 'message' => 'Huoneesta poistuttu!'));
    }

}
