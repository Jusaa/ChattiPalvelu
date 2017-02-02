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
class Huone extends BaseModel{
    public $id, $nimi, $kuvaus;
    
    public function __construct($attributes){
        parent::__construct($attributes);
    }
    
    public static function all(){
        
    $query = DB::connection()->prepare('SELECT * FROM Huone');
    $query->execute();
    $rows = $query->fetchAll();
    $huoneet = array();

    foreach($rows as $row){
      $huoneet[] = new Huone(array(
        'id' => $row['id'],
        'nimi' => $row['nimi'],
        'kuvaus' => $row['kuvaus']
      ));
    }

    return $huoneet;
    }
    
    public static function find($id){
    $query = DB::connection()->prepare('SELECT * FROM Huone WHERE id = :id LIMIT 1');
    $query->execute(array('id' => $id));
    $row = $query->fetch();

    if($row){
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
        $query->execute(array('nimi' => $huone->nimi, 'password' => $huone->kuvaus));
    }
    
}


