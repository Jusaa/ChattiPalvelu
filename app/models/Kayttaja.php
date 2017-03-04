<?php

/**
 * Description of Kayttaja
 *
 * @author Jusaa
 */
class Kayttaja extends BaseModel {

    public $id, $nimi, $password, $email, $taso;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validateNimi', 'validatePassword', 'validateEmail', 'validateTaso');
    }

    public static function all() {

        $query = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $query->execute();
        $rows = $query->fetchAll();
        $kayttajat = array();

        foreach ($rows as $row) {
            $kayttajat[] = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password'],
                'email' => $row['email'],
                'taso' => $row['taso']
            ));
        }

        return $kayttajat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password'],
                'email' => $row['email'],
                'taso' => $row['taso']
            ));

            return $kayttaja;
        }

        return null;
    }

    public static function findNimella($nimi) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi LIMIT 1');
        $query->execute(array('nimi' => $nimi));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'password' => $row['password'],
                'email' => $row['email'],
                'taso' => $row['taso']
            ));

            return $kayttaja;
        }

        return null;
    }

    public static function save($kayttaja) {
        $query = DB::connection()->prepare('INSERT INTO Kayttaja (nimi, password, email) VALUES (:nimi, :password, :email)');
        $query->execute(array('nimi' => $kayttaja->nimi, 'password' => $kayttaja->password, 'email' => $kayttaja->email));
    }

    public static function update($kayttaja) {
        $query = DB::connection()->prepare('UPDATE Kayttaja SET nimi=:nimi, password=:password, email=:email, taso=:taso WHERE id=:id');
        $query->execute(array('nimi' => $kayttaja->nimi, 'password' => $kayttaja->password, 'email' => $kayttaja->email, 'taso' => $kayttaja->taso, 'id' => $kayttaja->id));
    }

    public static function delete($id) {
        $query = DB::connection()->prepare('DELETE FROM Kayttaja WHERE id=:id');
        $query->execute(array('id' => $id));
    }

    public static function authenticate($nimi, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE nimi = :nimi AND password = :password LIMIT 1');
        $query->execute(array('nimi' => $nimi, 'password' => $password));
        $row = $query->fetch();
        if ($row) {
            return self::findNimella($nimi);
        }
        return null;
    }

    public static function onkoHuoneessa($huone, $kayttaja) {
        $query = DB::connection()->prepare('SELECT * FROM HuoneKayttaja WHERE kayttaja_id=:kid AND huone_id=:hid LIMIT 1');
        $query->execute(array('kid' => $kayttaja->id, 'hid' => $huone->id));
        $row = $query->fetch();
        if ($row) {
            return true;
        }
        return false;
    }

    public static function liityHuoneeseen($huone, $kayttaja) {
        $query = DB::connection()->prepare('INSERT INTO HuoneKayttaja (kayttaja_id, huone_id) VALUES (:kid, :hid)');
        $query->execute(array('kid' => $kayttaja->id, 'hid' => $huone->id));
    }

    public static function poistuHuoneesta($huone, $kayttaja) {
        $query = DB::connection()->prepare('DELETE FROM HuoneKayttaja WHERE huone_id=:hid AND kayttaja_id=:kid');
        $query->execute(array('kid' => $kayttaja->id, 'hid' => $huone->id));
    }

    public static function huoneet($kayttaja) {
        $query = DB::connection()->prepare('SELECT huone_id FROM HuoneKayttaja WHERE kayttaja_id=:kid');
        $query->execute(array('kid' => $kayttaja->id));
        $rows = $query->fetchAll();
        $huoneet = array();

        foreach ($rows as $row) {
            $huoneet[] = Huone::find($row['huone_id']);
        }

        return $huoneet;
    }

    public function validateNimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä! Minimissään neljä merkkiä!';
        } elseif (strlen($this->nimi) < 4) {
            $errors[] = 'Nimen pituuden tulee olla vähintään neljä merkkiä!';
        }

        return $errors;
    }

    public function validatePassword() {
        $errors = array();
        if ($this->password == '' || $this->password == null) {
            $errors[] = 'Salasana ei saa olla tyhjä! Minimissään neljä merkkiä!';
        } elseif (strlen($this->password) < 4) {
            $errors[] = 'Salasanan pituuden tulee olla vähintään neljä merkkiä!';
        }

        return $errors;
    }

    public function validateEmail() {
        $errors = array();
        if ($this->email == '' || $this->email == null) {
            $errors[] = 'Sähköposti ei saa olla tyhjä!';
        } elseif (strpos($this->email, '@') == false) {
            $errors[] = 'Sähköpostiosoite ei ole oikeassa muodossa!';
        }

        return $errors;
    }
   
    public function validateTaso() {
        $errors = array();
        if ($this->taso == '' || $this->taso == null) {
            $errors[] = 'Taso ei voi olla tyhjä!';
        } elseif ($this->taso < 1 || $this->taso > 4) {
            $errors[] = 'Tason täytyy olla välillä 1-4';
        }

        return $errors;
    }
}
