<?php

  require_once "login.php";
  try{
     $pdo=new PDO($attribute, $user, $password);
  }
  catch(PDOException $e)
  {
   echo "Lidhja nuk u krye, ndodhi nje gabim $e->getMessage() dhe ka nr $e->getCode()";
  }

  if(isset($_POST["titulli"]) && isset($_POST["autori"]) && isset($_POST["nr_faqeve"]) && isset($_POST["shtepia_botuese"]) && isset($_POST["isbn"]) &&
      isset($_POST["cmimi"]) && isset($_POST["pershkrimi"]))
  {
    $titulli = $_POST["titulli"];
    $autori = $_POST["autori"];
    $nr_faqe = $_POST["nr_faqeve"];
    $shtepia_botuese = $_POST["shtepia_botuese"];
    $isbn = $_POST["isbn"];
    $cmimi = $_POST["cmimi"];
    $pershkrimi = $_POST["pershkrimi"];
    add_article($pdo, $titulli, $autori, $nr_faqe, $shtepia_botuese, $isbn, $cmimi, $pershkrimi);
  }

  function add_article($pdo, $tit, $aut, $nr_fq, $sh_b, $isbn, $cmimi, $note)
  {
     $statement=$pdo->prepare("INSERT INTO book(id, titulli, autori, nr_faqeve, shtepia_botuese, isbn, cmimi, pershkrimi) VALUES('',:titulli, :autori, :nr_faqe, :shtepia_botuese, :isbn, :cmimi, :pershkrimi)");
     if($statement->bindParam(':titulli', $tit)&&
         $statement->bindParam(':autori', $aut)&&
         $statement->bindParam(':nr_faqe', $nr_fq)&&
         $statement->bindParam(':shtepia_botuese', $sh_b)&&
         $statement->bindParam(':isbn', $isbn)&&
         $statement->bindParam(':cmimi', $cmimi)&&
         $statement->bindParam(':pershkrimi', $note))
         {
           if($statement->execute()){
             echo "<br>Insert u krye me sukses <br>";
           }
           else {
             echo "<br>Gabim ne ekzekutim";
           }
         }
  }

 ?>
