<?php

    class baza {

            const ime_hosta = 'localhost';
            const korisnik = 'root';
            const sifra = '';
            const ime_baze = "quantox_test";
            
            private $dbh;
           
            function __construct() {
            try {
                $konekcioni_string="mysql:host=".self::ime_hosta.";dbname=".self::ime_baze;
                $this->dbh = new PDO($konekcioni_string, self::korisnik, self::sifra);
            }
            catch(PDOException $e) {
                echo "GRESKA: ";
                echo $e->getMessage();
                }
            }
           
            function __destruct() {
                $this->dbh = null;
            }
            
            
            function listajU()
            {
                try{
                    $sql="select email from users";
                    $rezultat= $this->dbh->query($sql);
                    $niz=$rezultat->fetchAll(PDO::FETCH_ASSOC);

                    return $niz;

                }catch(PDOException $exc){
                    echo $exc->getMessage();
                }
            }
              function listajP()
            {
                try{
                    $sql="select password from users";
                    $rezultat= $this->dbh->query($sql);
                    $niz=$rezultat->fetchAll(PDO::FETCH_ASSOC);

                    return $niz;

                }catch(PDOException $exc){
                    echo $exc->getMessage();
                }
            }
             function listajI()
            {
                try{
                    $sql="select name from users";
                    $rezultat= $this->dbh->query($sql);
                    $niz=$rezultat->fetchAll(PDO::FETCH_ASSOC);

                    return $niz;

                }catch(PDOException $exc){
                    echo $exc->getMessage();
                }
            }
            
            function dodaj($e,$n,$p)
            {
                try
                {
                    $sqlpom="select * from users";
                    $rezultat= $this->dbh->query($sqlpom);
                    $niz=$rezultat->fetchAll(PDO::FETCH_ASSOC);
                    $ind=0;
                    foreach($niz as $user)
                    {
                        if(!strcmp($e,$user['email']))
                        {
                            $ind=1;
                        }
                    }
                        if(!$ind)
                        {
                            echo "Added successfully";
                            $sql="INSERT INTO users(email, name, password) VALUES ('$e','$n','$p')";
                            $pdo_izraz = $this->dbh->exec($sql);
                            
                            
                        }else
                        {
                            echo "Already registered";
                            
                        }
                    
                }
                catch(PDOException $e) {
                    echo "GRESKA: ";
                    echo $e->getMessage();
                    return false;
                }

            }
            
            
            public function search($src=NULL) {
            try {
                $sql = "SELECT * FROM users";
                
                if ( isset ($src) ) {
                $sql.=" WHERE email LIKE '%$src%' or name LIKE '%$src%'";
                }
                $pdo_izraz = $this->dbh->query($sql);
                $niz = $pdo_izraz->fetchALL(PDO::FETCH_ASSOC);
                
                foreach($niz as $user) {
                echo $user['email']." ";
                echo $user['name']."<br>";
                }
                
            }
                catch(PDOException $e) {
                echo "GRESKA: ";
                echo $e->getMessage();
                }
            }


    }

?>

