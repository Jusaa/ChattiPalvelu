<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Huone
 *
 * @author Jusaa
 */
class Huone extends BaseModel {

    public $id, $nimi, $kuvaus;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validateNimi', 'validateKuvaus');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Huone');
        $query->execute();
        $rows = $query->fetchAll();
        $huoneet = array();

        foreach ($rows as $row) {
            $huoneet[] = new Huone(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
            ));
        }

        return $huoneet;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Huone WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $huone = new Huone(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'kuvaus' => $row['kuvaus']
            ));

            return $huone;
        }

        return null;
    }

    public static function save($huone) {
        $query = DB::connection()->prepare('INSERT INTO Huone (nimi, kuvaus) VALUES (:nimi, :kuvaus)');
        $query->execute(array('nimi' => $huone->nimi, 'kuvaus' => $huone->kuvaus));
    }

    public static function update($huone) {
        $query = DB::connection()->prepare('UPDATE Huone SET nimi=:nimi, kuvaus=:kuvaus WHERE id=:id');
        $query->execute(array('nimi' => $huone->nimi, 'kuvaus' => $huone->kuvaus, 'id' => $huone->id));
    }

    public static function delete($id) {
        $query = DB::connection()->prepare('DELETE FROM HuoneKayttaja WHERE huone_id=:id');
        $query->execute(array('id' => $id));
        
        $query = DB::connection()->prepare('DELETE FROM Viesti WHERE huone_id=:id');
        $query->execute(array('id' => $id));
        
        $query = DB::connection()->prepare('DELETE FROM Huone WHERE id=:id');
        $query->execute(array('id' => $id));
    }
    
    public static function kayttajat($id){
        $query = DB::connection()->prepare('SELECT kayttaja_id FROM HuoneKayttaja WHERE huone_id=:hid');
        $query->execute(array('hid' => $id));
        $rows = $query->fetchAll();
        $kayttajat = array();

        foreach ($rows as $row) {
            array_push($kayttajat, Kayttaja::find($row['kayttaja_id']));
        }
        return $kayttajat;
    }
    
    public function validateNimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä! Minimissään neljä merkkiä!';
        } elseif (strlen($this->nimi) < 4) {
            $errors[] = 'Nimen pituuden tulee olla vähintään neljä merkkiä!';
        } elseif (strlen($this->nimi) > 50) {
            $errors[] = 'Nimen pituus saa olla maksimissaan 50 merkkiä!';
        }

        return $errors;
    }
    
    public function validateKuvaus() {
        $errors = array();
        if (strlen($this->kuvaus) > 255) {
            $errors[] = 'Kuvaus saa olla maksimissaan 255 merkkiä pitkä!';
        }

        return $errors;
    }
}
