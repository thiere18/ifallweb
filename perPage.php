
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="style.css">
    <title>Hello, world!</title>
  </head>
  <body>
  <div class=" container" style="max-width: 75%;">
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
            <button type="button" class="btn btn-danger">
            <a class="text-white" href="./perPage.php" >Affichage par page </a>
            </button>

</p>
   <form action="" method="GET">
   <select id="records" name="records"> 
        <option  value="5">5</option>
        <option  value="10">10</option>
        <option  value="15">15</option>
        </select>
        <input type = "submit" name = "record">
   </form>


<?php
require_once "db.php";

if(isset($_GET["records"]) && $_GET["records"] > 0)
 {
     $parPage = $_GET["records"] ;     
 }else{
  $parPage=4;
}
// On détermine sur quelle page on se trouve
if(isset($_GET['page']) && !empty($_GET['page'])){
  $currentPage = (int) strip_tags($_GET['page']);
}else{
  $currentPage = 1;
}
// comptage nbre de photo
$sql = 'SELECT COUNT(*) AS nb_photo FROM `photo`;';

// On prépare la requête
$query = $pdo->prepare($sql);

// On exécute
$query->execute();

// On récupère le nombre de photo
$result = $query->fetch();


$nbArticles = (int) $result['nb_photo'];

// On calcule le nombre de pages total
$pages = ceil($nbArticles / $parPage);

// Calcul du 1er article de la page
$premier = ($currentPage * $parPage) - $parPage;

$sql = 'SELECT * FROM `photo` ORDER BY `created_at` DESC LIMIT :premier, :parPage;';

// On prépare la requête
$query = $pdo->prepare($sql);

$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parPage', $parPage, PDO::PARAM_INT);

// On exécute
$query->execute();

// On récupère les valeurs dans un tableau associatif
// $articles = $query->fetchAll(PDO::FETCH_OBJ);
$offset=$parPage*($currentPage-1);
$query =$pdo->query("SELECT * FROM photo ORDER BY  `created_at` DESC LIMIT $offset , $parPage");
$photos = $query->fetchAll(PDO::FETCH_OBJ);


?>

    <?php if($photos):?>
<div class="row container">
   <!-- card start -->
   <?php foreach($photos as $photo):?>
   <div class="col-md-4 ImmageStyle  mb-2  " style=" height: 300px;">
    <div class="card">
      <div class="card-block">
      <img class="img-thumbnail" src="./uploads/<?= $photo->url;?>" alt="Card image cap" >
        <div class="car-title">
          <?= $photo->description?>

          <button type="button" class="btn btn-danger m-3 btn-sm"> 
          <a href="./delete.php?id=<?= $photo->id;?>" class="">Supprimer</a>
</button>
       </div>
      </div>
    </div>
  </div>
  <!-- end of cards -->
  <?php endforeach;?>
  
</div>
<?php else:?>
  <div class="container">
  <hr>
   <p class="container">
   Il n ya aucune photo dans votre bibliotheque veuillez en ajouter 
   </p>
  </div>
      <?php endif;?>

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

<nav class="container mt-5  ">
                    <ul class="pagination">
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : "" ?>">
                            <a href="./all.php?page=<?= $currentPage - 1 ?>" class="page-link">Précédente</a>
                        </li>
                        <?php for($page = 1; $page <= $pages; $page++): ?>
                            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                                <a href="./perPage.php?page=<?= $page ?>" class="page-link"><?= $page ?></a>
                            </li>
                        <?php endfor ?>
                        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : "" ?>">
                            <a href="./perPage.php?page=<?= $currentPage + 1 ?>" class="page-link">Suivante</a>
                        </li>
                    </ul>
                </nav>
</div>