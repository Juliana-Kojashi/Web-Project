<?php

  require_once "login.php";
  try{
     $pdo=new PDO($attribute, $user, $password);
  }
  catch(PDOException $e)
  {
   echo "Lidhja nuk u krye, ndodhi nje gabim $e->getMessage() dhe ka nr $e->getCode()";
  }

  if (isset($_POST["search"]))
  {
    $search = $_POST["search"];
    $search_by = $_POST["search_by"];
    $query="SELECT * FROM `book` WHERE $search_by LIKE '%$search%'";
  }

  $result=$pdo->query($query);

  if(!$result=$pdo->query($query)){
     echo "Gabim ne ekzekutim";
   }
  else {
    while($row=$result->fetch(PDO::FETCH_BOTH))
    {
      echo "Titulli: ".$row["titulli"];
      echo "<br>Autori: ".$row["autori"];
      echo "<br>Numri i faqeve: ".$row["nr_faqeve"];
      echo "<br>Shtëpia Botuese: ".$row["shtepia_botuese"];
      echo "<br>ISBN: ".$row["isbn"];
      echo "<br>Çmimi: ".$row["cmimi"];
    }
  }


 ?>
