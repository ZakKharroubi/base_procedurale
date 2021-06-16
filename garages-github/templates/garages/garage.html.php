<!-- Développer le template d'affichage d'un seul garage -->

    <div class="container">



    <!-- Alerte formulaire mal rempli -->
<?php if(isset($_GET['info']) && $_GET['info'] == "error"){?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>OH LA LA !!!</strong> IL FAUT REMPLIR TOUS LES CHAMPS !!!!!!!!!!!!!
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php }?>


        <div class="row">
            <p><strong> <?php echo $garage['name'];?>  </strong></p>
            <p><strong> <?php echo $garage['address'];?>  </strong></p>
            <p><strong> <?php echo $garage['description'];?>  </strong></p>

        </div>

    <?php if(empty($annonces)){
        echo "Il n'y a pas encore d'annonce pour ce garage";
    }?>

    <?php foreach($annonces as $annonce){?>

        <h1> <?php echo $annonce['name']?> </h1> 
        <p> Prix :  <?php echo $annonce['price']?> € </p>
        <a href="deleteAnnonce.php?id=<?php echo $annonce['id']?>" class="btn btn-danger">Supprimer cette annonce</a>
   <?php }?>    
   <hr>
        
    
    <form action="saveAnnonce.php" method="POST">
        <div class="form-group">
        <textarea name="name" cols="30" rows="10" placeholder ="Titre de votre annonce" ></textarea>
        </div>
        <div class="form-group">
            <textarea name="price" cols="30" rows="10" placeholder="Prix (en €)"></textarea>
        </div>
            <input type="hidden" name="garageId" value="<?php echo $garage['id']?>">
        <div class="form-group">
            <button type="submit" class="btn btn-success">Poster cette annonce</button>
        </div>
    
    </form>
    <hr>

<a href="index.php" class="btn btn-primary">Retour à l'accueil</a>    
</div>
