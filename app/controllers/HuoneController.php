<?php

class HuoneController extends BaseController{
    
    public static function huone($id) {
        self::check_logged_in();
        $huone = Huone::find($id);
        View::make('huone.html', array('huone' => $huone));
    }    

    public static function huoneet() {
        self::check_logged_in();
        $huoneet = Huone::all();
        $user_logged_in = self::get_user_logged_in();
        View::make('huoneet.html', array('huoneet' => $huoneet, 'user_logged_in' => $user_logged_in));
    }
    
    public static function lisaa() {
        View::make('lisaa_huone.html');
    }

    public static function lisaaPost() {
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
        View::make('config_room.html', array('huone' => $huone));
    }
    
    public static function room_update($id){
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
            View::make('config_room.html', array('errors' => $errors, 'huone' => $huone));
        } else {
            $huone->update($huone);
            Redirect::to('/', array('message' => 'Tietoja on muokattu onnistuneesti!'));
        }
    }
    
    public static function room_delete($id){
        self::check_logged_in();
        Huone::delete($id);
        Redirect::to('/', array('message' => 'Huone on poistettu onnistuneesti!'));
    }
}
