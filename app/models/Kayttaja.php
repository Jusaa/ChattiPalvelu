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

//    public static function update($attributes) {
//        $query = DB::connection()->prepare('UPDATE Kayttaja SET nimi=:nimi, email=:email, taso=:taso WHERE id=:id');
//        $query->execute(array('nimi' => $attributes->nimi, 'email' => $attributes->email, 'taso' => $attributes->taso, 'id' => $attributes->id));
//        $query->execute();
//    }
}
