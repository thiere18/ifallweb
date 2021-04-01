
<?php
require_once "db.php";


$query =$pdo->query("SELECT * FROM photo ");
$photos = $query->fetchAll(PDO::FETCH_OBJ);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
  <div class="jumbotron container" >
        <h1 class="display-3">Bienvenu Dans BiB>_>PIXEL!</h1>
        <p class="lead">L'album Photo a votre gout</p>
        <hr class="my-4">
        <p>Que voulez vous Faire Aujourd'hui</p>
        <p class="lead">
            <button type="button" class="btn btn-primary">
                <a class="text-white" href="./add.php" >Ajouter des images</a>
            </button>
            <button type="button" class="btn btn-secondary">
                <a class="text-white" href="./all.php" >Afficher tout images</a>
            </button>
            <button type="button" class="btn btn-success">Afficher par page</button>
            <button type="button" class="btn btn-danger">Supprimer un image</button>

</p>
<div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Liste des <b>Photos</b></h2></div>
                    <div class="col-sm-4">
                    </div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#iD</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($photos):?>
                        <? foreach($photos as $photo):?>
                            <tr>
                        <td><?=$photo->id;?></td>
                        <td><?=$photo->url;?></td>
                        <td><?=$photo->description;?></td>
                        <td>
                            <a class="delete" title="Delete" data-toggle="tooltip" href="./delete.php?id=<?= $photo->id;?>"> <i class="material-icons"></i></a>
                        </td>
                    </tr>
                            <?php endforeach;?>
 
                    
                
                </tbody>
            </table>
            <?php else:?>
                <hr>
   <p class="container">
   Il n ya aucune photo dans votre bibliotheque veuillez en ajouter 
   </p>
  </div>
            <?php endif;?>
        </div>
    </div>    

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>


