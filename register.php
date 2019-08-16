

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
            <form class="form-group" method="get" class="needs-validation">
                <label for="name"> Name: </label>
                <input type="text" class="form-control mb-2" name="name">
                <label for="email"> E-mail: </label>
                <input type="text" class="form-control mb-2" name="email">
                <label for="password"> Password: </label>
                <input type="password" class="form-control mb-2" name="pass">
                <label for="confirm"> Confirm password: </label>
                <input type="password" class="form-control mb-3" name="rpass">
                <input type="submit" name="submit" class="btn btn-primary" value="Submit">
            </form>
        </div>
        
        <div style="text-align: center">
            <?php
            require_once 'baza.php';

            $obj=new baza();

            if(isset($_GET['submit']))
            {
                if(empty($_GET['name']))
                {
                    echo "Enter name";                   
                }
                else if(empty($_GET['email']))
                {
                    echo "Enter email";
                }
                else if(empty($_GET['pass']) || empty($_GET['rpass']))
                {
                    echo "Enter password";
                }
                
                else
                {
                    $email=$_GET['email'];
                    $name=$_GET['name'];
                    $pass=$_GET['pass'];
                    $rpass=$_GET['rpass'];

                    $foundE= preg_match("/[a-zA-Z0-9\.]{1,15}@[a-z]{3,7}\.[a-z]{3}/", $email);
                    $foundP= preg_match("/[a-zA-Z0-9]{6,}/", $pass);
                    
                    if(!$foundE)
                    {
                        echo "Email not valid";
                    }
                    else if(!$foundP)
                    {
                        echo "Password not valid";
                    }
                    else if($_GET['pass']!=$_GET['rpass'])
                    {
                        echo "Passwords needs to match";
                    }
                    if($foundE && $foundP && $pass==$rpass)
                    {
                        $obj->dodaj($email,$name,$pass);
                    }
                }

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