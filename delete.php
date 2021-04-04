<?php
require_once "db.php";
$id =$_GET["id"];
$q2="SELECT * FROM photo WHERE id ='$id'";
$state=$pdo->query($q2)->fetch(PDO::FETCH_OBJ);
// var_dump($state);
$path= __DIR__ . "/uploads/".$state->url;
if(!unlink($path))
{
    echo "fichier non supprime";
}else{

    $query="DELETE FROM photo WHERE id='$id'";
$statement=$pdo->prepare($query);
$k=$statement->execute();
if($k){
    $url=$_SERVER['HTTP_REFERER'];
    header("Location:$url");
}else{
    echo "echcec incomprehensible";
}

}

?>