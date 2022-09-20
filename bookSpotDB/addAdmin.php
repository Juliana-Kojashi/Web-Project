?<?php

  require_once "login.php";

  try{
     $pdo=new PDO($attribute, $user, $password);
 }
 catch(PDOException $e)
 {
   echo "Lidhja nuk u krye, ndodhi nje gabim $e->getMessage() dhe ka nr $e->getCode()";
 }

 if(isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["email"]) && isset($_POST["password"]))
 {
     $emer=$_POST["name"];
     $mbiemer=$_POST["surname"];
     $email=$_POST["email"];
     $password=$_POST["password"];
     $hashPassword=password_hash($password, PASSWORD_DEFAULT);
     add_admin($pdo, $emer, $mbiemer, $email, $hashPassword);
 }

 function add_admin($pdo, $e, $m, $email, $pass)
 {
   $statement=$pdo->prepare("INSERT INTO admin(id, name, surname ,email, password) VALUES('',:emer, :mbiemer, :email, :password)");

   if($statement->bindParam(':emer', $e, PDO::PARAM_STR, 32 )&&
       $statement->bindParam(':mbiemer', $m, PDO::PARAM_STR, 32 )&&
       $statement->bindParam(':email', $email, PDO::PARAM_STR, 32 )&&
       $statement->bindParam(':password', $pass, PDO::PARAM_STR, 255 ))
 {
       if($statement->execute())

             header("location: addArticle.html");

           else
           echo "<br>Gabim ne ekzekutim";
         }
 }

 ?>
