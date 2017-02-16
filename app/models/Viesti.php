<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Viesti
 *
 * @author Jusaa
 */
class Viesti extends BaseModel {

    public $id, $kayttaja_id, $huone_id, $sisalto, $lahetysaika;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validateSisalto');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Viesti');
        $query->execute();
        $rows = $query->fetchAll();
        $viestit = array();

        foreach ($rows as $row) {
            $viestit[] = new Viesti(array(
                'id' => $row['id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'huone_id' => $row['huone_id'],
                'sisalto' => $row['sisalto'],
                'lahetysaika' => $row['lahetysaika']
            ));
        }

        return $viestit;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Viesti WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $viesti = new Viesti(array(
                'id' => $row['id'],
                'kayttaja_id' => $row['kayttaja_id'],
                'huone_id' => $row['huone_id'],
                'sisalto' => $row['sisalto'],
                'lahetysaika' => $row['lahetysaika']
            ));

            return $viesti;
        }

        return null;
    }

    public static function save($viesti) {
        $query = DB::connection()->prepare('INSERT INTO Viesti (kayttaja_id, huone_id, sisalto) VALUES (:kayttaja_id, :huone_id, :sisalto)');
        $query->execute(array('kayttaja_id' => $viesti->kayttaja_id, 'huone_id' => $viesti->huone_id, 'sisalto' => $viesti->sisalto));
    }

    public static function update($viesti) {
        $query = DB::connection()->prepare('UPDATE Viesti SET sisalto=:sisalto WHERE id=:id');
        $query->execute(array('kuvaus' => $viesti->kuvaus, 'id' => $viesti->id));
    }

    public static function delete($id) {
        $query = DB::connection()->prepare('DELETE FROM Viesti WHERE id=:id');
        $query->execute(array('id' => $id));
    }

    public function validateSisalto() {
        $errors = array();
        if ($this->sisalto == '' || $this->sisalto == null) {
            $errors[] = 'Viesti ei saa olla tyhjä!';
        }
        return $errors;
    }

}
