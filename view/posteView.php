<!-- 
    ETML
    Auteur : Larry Lam
    Date : 16.05.19
    Description : Première vue lors de la création d'un poste, contient un formulaire pour le nom de ce dernier
-->
<div class="row mb-3 mt-5">
    <div class="col-sm-6 mx-auto">
    <a href="index.php" class="link-back">
        <i class="fas fa-long-arrow-alt-left"></i> Retour
    </div>  
</a>
</div>

<div class="row justify-content-center mb-5">
        <h1>Créer un poste</h1>
</div>
<div class="row justify-content-center mb-5">
    <div class="col-sm-6">
    
        <?php
            // Si le paramètre GET 'error'est définit
            if(isset($_GET['error']))
            {
              // Si le 'error' vaut 1, afficher un message d'erreur
                if($_GET['error']== 1)
                {
                    echo '<div class="alert alert-danger">
                    Ce nom de poste est déjà utilisé
                    </div>';
                }
            }
        ?>
        <form action="index.php?page=poste&action=create" method="post">
            <div class="form-label-group mb-4">
                    <label for="posteName">Nom</label>
                    <input type="text" id="posteName" class="form-control" name="posteName" placeholder="Nom du poste" required>
                    <!-- Input caché pour passer à la prochaine étape-->
                    <input type="hidden" id="step" value="2" name="step">
            </div>
            <input type="submit" value="Continuer" class="btn btn-primary float-right">
        </form>
    </div>
</div>