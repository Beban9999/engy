<?php 
require_once __DIR__  . '/../config.php';
require_once __DIR__ . '/../includes/Database.php';

class Korisnik{
    public $id;
    public $username;
    public $password;
    public $email;
    public $tip_korisnika_id;

    public static function proveri($username,$password){
        $password = hash('sha1', $password);
        $database = Database::getInstance();

        $korisnici = $database->select('Korisnik',
        'SELECT * FROM korisnici WHERE username LIKE :username AND password LIKE :password',
        [
            ':username' => $username,
            ':password' => $password
        ]
        );

        foreach ($korisnici as $korisnik){
            return $korisnik;
        }
        return null;
    }
}

