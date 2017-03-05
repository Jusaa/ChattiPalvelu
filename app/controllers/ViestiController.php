<?php

class ViestiController extends BaseController {

    public static function lisaa($id) {
        $params = $_POST;

        $attributes = array(
            'sisalto' => $params['usermsg'],
            'kayttaja_id' => self::get_user_logged_in()->id,
            'huone_id' => $id
        );
        $viesti = new Viesti($attributes);
        $errors = $viesti->errors();
        if (count($errors) == 0) {
            $viesti->save($viesti);
        } else {
            Redirect::to('/huone/' . $id, array('errors' => $errors));
        }
        Redirect::to('/huone/' . $id);
    }

    public static function poista($id) {
        $viesti = Viesti::find($id);
        if(Kayttaja::find($viesti->kayttaja_id)->taso < self::get_user_logged_in()->taso || Kayttaja::find($viesti->kayttaja_id) == self::get_user_logged_in()){
            Viesti::delete($id);
            Redirect::to('/listall');
        }
        self::check_taso(5);
    }

}

?>