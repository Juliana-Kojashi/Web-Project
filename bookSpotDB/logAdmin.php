<?php
require_once "login.php";

try{
   $pdo=new PDO($attribute, $user, $password);
}
catch(PDOException $e)
{
 echo "Lidhja nuk u krye, ndodhi nje gabim $e->getMessage() dhe ka nr $e->getCode()";
}

if(isset($_POST['email'])&&isset($_POST['password']))
{
    $psw_temp=$_POST['password'];
    $row=find_user($pdo, $_POST['email']);

    if(!$row)
     echo "Error on query execution! No user found";
     else
      {
        $emer=$row['name'];
        $mbiemer=$row['surname'];
        $password=$row['password'];

        if(!password_verify($psw_temp, $password))
            die("Invalid password");
        else {
          header("location: addArticle.html");
        }

      }

}

else {
      die("Enter the username and password");
    }

function find_user($pdo, $e)
{
  $statement=$pdo->prepare("SELECT * FROM admin where email=:email");

  if($statement->bindParam(":email", $e, PDO::PARAM_STR, 32))
  {
    if($statement->execute())
      return $statement->fetch(PDO::FETCH_ASSOC);

    else
        return false;
  }
  else
    return false;

}
