<?php

class ViestiController extends BaseController{
    
    public static function lisaa($id){
        $params = $_POST;
        
        $attributes = array(
            'sisalto' => $params['usermsg'],
            'kayttaja_id' =>  self::get_user_logged_in()->id,
            'huone_id' => $id
        );
        $viesti = new Viesti($attributes);
        $errors = $viesti->errors();
        if (count($errors) == 0) {
            $viesti->save($viesti);
        }else{
            Redirect::to('/huone/' . $id, array('errors' => $errors));
        }
        Redirect::to('/huone/' . $id);
    }    
}

//session_start();
//$text = $_POST['text'];
//$kayttaja = $_POST['user'];
//$huone = $_POST['room'];
//
//$attributes = array(
//            'sisalto' => $text,
//            'kayttaja_id' =>  $kayttaja,
//            'huone_id' => $huone
//        );    
//$viesti = new Viesti($attributes);
//$errors = $viesti->errors();
//        if (count($errors) == 0) {
//            $viesti->save($viesti);
//        }
//
//$fp = fopen("log.html", 'a');
//fwrite($fp, "<div class='msgln'>(" . date("g:i A") . ") <b>" . $_SESSION['name'] . "</b>: " . stripslashes(htmlspecialchars($text)) . "<br></div>");
//fclose($fp);
?>