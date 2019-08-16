<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
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
        
         <br><br><br><br><br>
        <?php
        
            require_once 'baza.php';
            
            $obj=new baza();
            
            if(isset($_COOKIE['user'])){
               ?>
        
                <form action="login.php">
                   <button type="submit" name="logout">Logout</button>
               </form>
          <br><br><br>
         <?php
                $pom=$_COOKIE['user'];
                echo "Welcome, $pom!"."<br><br><br>";
                
                
            }
            else
            {
                echo "Please login <a href='login.php'>Login</a>";
            }
                ?>
         
            <?php 
            
                if(isset($_GET['search']))
                {
                    if(isset($_COOKIE['user'])){
                        $obj->search($_GET['search']);
                    }else{
                        header('Location:login.php');
                    }
                }
            
            
            
            ?>
           
           
        
        
    </body>
</html>
