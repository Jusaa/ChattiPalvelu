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
        $this->validators = array('validate_nimi', 'validate_password', 'validate_email');
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
            return $this;
        } else {
            return null;
        }
    }

    public function validate_nimi() {
        $errors = array();
        if ($this->nimi == '' || $this->nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä! Minimissään neljä merkkiä!';
        } elseif (strlen($this->nimi) < 4) {
            $errors[] = 'Nimen pituuden tulee olla vähintään neljä merkkiä!';
        }

        return $errors;
    }

    public function validate_password() {
        $errors = array();
        if ($this->password == '' || $this->password == null) {
            $errors[] = 'Salasana ei saa olla tyhjä! Minimissään neljä merkkiä!';
        } elseif (strlen($this->password) < 4) {
            $errors[] = 'Salasanan pituuden tulee olla vähintään neljä merkkiä!';
        }

        return $errors;
    }

    public function validate_email() {
        $errors = array();
        if ($this->email == '' || $this->email == null) {
            $errors[] = 'Sähköposti ei saa olla tyhjä!';
        } elseif (strpos($this->email, '@') == false) {
            $errors[] = 'Sähköpostiosoite ei ole oikeassa muodossa!';
        }

        return $errors;
    }

//    public static function update($attributes) {
//        $query = DB::connection()->prepare('UPDATE Kayttaja SET nimi=:nimi, email=:email, taso=:taso WHERE id=:id');
//        $query->execute(array('nimi' => $attributes->nimi, 'email' => $attributes->email, 'taso' => $attributes->taso, 'id' => $attributes->id));
//        $query->execute();
//    }
}
