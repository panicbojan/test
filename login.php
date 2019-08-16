


<html>
    <head>
        <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <div class="container">
            <?php
                require_once 'header.php';
            ?>
        </div>
        <br><br>
        <div class="container col-md-6 mt-5">
            <form method="get" class="form-group">
                <label for="email" class="mt-2"> E-mail: </label>
                <input type="text" class="form-control mt-2" name="email">
                <label for="pass" class="mt-2"> Password: </label>
                <input type="password" class="form-control mt-1" name="pass">
                <input type="submit" name="submit" value="Submit" class="btn btn-primary mt-2">
            </form>
        </div>
        
        <div style="text-align: center">
            <?php
                
                if(isset($_GET['submit']))
                {$login=0; 
                    require_once 'baza.php';
                    $obj=new baza();

                    $email=$_GET['email'];
                    $pass=$_GET['pass'];
                    $users=$obj->listajU();
                    $passwords=$obj->listajP();
                    $name=$obj->listajI();
                    
                     for($i=0;$i<count($users);$i++){
                        if($email==$users[$i]['email'] && $pass==$passwords[$i]['password']){


                            session_start();
                            $_SESSION['dozvola']=1;

                            if(isset($_COOKIE['user'])&& $_COOKIE['user']!=$email){

                                setcookie("user",NULL,time()-3600,"/");

                                    setcookie("user",$name[$i]['name'],time()+(86400*2),"/");

                            }
                            else if(!isset($_COOKIE['user'])){

                                setcookie("user",$name[$i]['name'],time()+(86400*2),"/");

                            }

                            $login=1;

                        }
                    }

                    if($login==1){
                        header('Location:index.php');
                    }else
                    if($login==0){
                        echo "Error logging you in.<br><br>";
                    }

                }
                                if(isset($_GET['logout'])) {
                                    setcookie("user",NULL,time()-3600,"/");
                                }

            ?>
        </div>
        
        <?php 
            
                if(isset($_GET['search']))
                {
                    if(isset($_COOKIE['user'])){
                        header('Location:index.php');
                    }else{
                        header('Location:login.php');
                    }
                }
            
            
            
            ?>
        
        </body>
</html>