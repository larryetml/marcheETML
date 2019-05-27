<!-- 
    ETML
    Auteur : Larry Lam
    Date : 22.05.19
    Description : Vue pour modifier un poste, le nom peut être changé et les collaborators peuvent être assignés / retirés
-->
<div class="row mb-3 mt-5">
    <a href="index.php" class="link-back">
        <i class="fas fa-long-arrow-alt-left"></i> Retour
</a>
</div>

<div class="row justify-content-center mb-5">
        <!-- Nom du poste -->
        <h1>Modifier <?php echo $poste['posName']?></h1>
</div>

<div class="scrolling-wrapper">
<!-- L'action envoi vers la page edit suivi de l'id du poste -->
<form action="index.php?page=poste&action=edit&id=<?php echo($poste['idPoste'])?>" method="post" id="formEditPoste">
<div class="row justify-content-center mb-4">
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
    <div class="form-label-group mb-4">
            <label for="posteName">Nom</label>
            <input type="text" id="posteName" class="form-control" name="posteName" value="<?php echo $poste['posName']?>" form="formEditPoste" required>
    </div>
    </div>
</div>
<table id="tableCollaborators" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Section</th>
                <th class="no-sorting">Assigner ?</th>
            </tr>
        </thead>
        <tbody>

        <?php 
        // Affiche tous les collaborateurs disponibles
        foreach($collaborators as $collaborator)
        {
            echo'
                <tr>
                    <td>'.$collaborator['colName'].'</td>
                    <td>'.$collaborator['colLastname'].'</td>
                    <td>'.$collaborator['colEmail'].'</td>
                    <td>'.$collaborator['secName'].'</td>
                    <td class="text-center">
                    <div class="checkbox mt-2">
                        <label style="font-size: 2em">';

                        echo'<input type="checkbox" name="assignedCollaborators[]" value="'.$collaborator['idCollaborator'].'" form="formEditPoste" ';
                        //Si isAssign est a true, rajouter la propriété checked
                        echo($collaborator['isAssigned'] ? 'checked>' : '>');
            echo'
                            <span class="cr"><i class="cr-icon fa fa-check color-primary"></i></span>
                        </label>
                    </div>
                </td>
            </tr>
            ';
        }

        ?>        
        <tfoot>
            <tr>
                <th>Prénom</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Section</th>
                <th class="no-sorting">Assigner ?</th>
            </tr>
        </tfoot>
    </table>
        <!-- Input caché pour savoir qu'on passe à l'étape 2 -->
        <input type="hidden" id="step" value="2" name="step" form="formEditPoste">
        <input type="submit" value="Terminer" form="formEditPoste" class="btn btn-primary float-right my-4">
    </form>

</div>
<script>
$(document).ready(function() {
    var myTable = $('#tableCollaborators').DataTable();
});
</script>