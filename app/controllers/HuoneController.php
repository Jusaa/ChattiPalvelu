<?php

class HuoneController extends BaseController{
    
    public static function huone($id) {
        $huone = Huone::find($id);
        View::make('huone.html', array('huone' => $huone));
    }    

    public static function huoneet() {
        $huoneet = Huone::all();
        $user_logged_in = self::get_user_logged_in();
        View::make('huoneet.html', array('huoneet' => $huoneet, 'user_logged_in' => $user_logged_in));
    }
    
    public static function huoneMuokkaa($id) {
        $huone = Huone::find($id);
        View::make('config_room.html', array('huone' => $huone));
    }
    
    public static function room_update($id){
        
    }
}
