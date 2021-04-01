<?php
require_once "db.php";
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension non autorise, choisissez un fichier JPEG ou PNG .";
      }
      $target_dir = "uploads/";
      $target_file = $target_dir . basename($file_name);
      if(file_exists($target_file)){
         $errors[]="le fichier existe deja";

      }

      
      if($file_size > 2097152){
         $errors[]='la taille ne peut depasser 2 MB';
      }

      
      if(empty($errors)==true){
         if(move_uploaded_file($file_tmp,"uploads/".$file_name)){
            $url=$_FILES["image"]["name"];
            $description= $_POST["description"];
            if($description==""){
              $description="Pas de description";
            }
            $query="INSERT INTO photo (url,description) VALUES ('$url', '$description')";
            $pdo->prepare($query)->execute();
$success[]="fichier enregistre ";
        
         }
         
      }else{
         print_r($errors);
      }
   }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
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
            <button type="button" class="btn btn-danger">
            <a class="text-white" href="./suup.php" >Supprimmer des images</a>
            </button>
</p>

<form action="" method="POST" enctype="multipart/form-data">
<div class="mb-3">
  <label for="formFileMultiple" class="form-label">Veuillez choisir votre fichier a uploader</label>
  <input class="form-control" type="file" id="formFileMultiple"  name ="image">
  <div class="mb-3">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" name ="description" rows="3"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
      </form>

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
<?php if($errors):?>
      <?php foreach($errors as $error):?>
      <div class=" mx-auto alert alert-danger alert-dismissible fade show" role="alert" style="width: 700px;">
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    
      <?=$error;?>
    </div>
    <? endforeach;?>
      <? elseif ($success): ?>
        <?php foreach($success as $succes):?>
          <div class=" mx-auto alert alert-success alert-dismissible fade show" role="alert" style="width: 600px;">
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      <?=$succes;?>
    
    
    </div>
    <? endforeach;?>
    <? endif;?>
  