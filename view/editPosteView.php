<!-- 
    ETML
    Auteur : Larry Lam
    Date : 22.05.19
    Description : Première vue lors de la création d'un poste, contient un formulaire pour le nom de ce dernier
-->
<div class="row mb-3 mt-5">
    <a href="index.php" class="link-back">
        <i class="fas fa-long-arrow-alt-left"></i> Retour
</a>
</div>

<div class="row justify-content-center mb-5">
        <h1>Modifier <?php echo $poste['posName']?></h1>
</div>

<div class="scrolling-wrapper">
<form action="index.php?page=poste&action=edit&n=<?php echo($poste['idPoste'])?>" method="post" id="formEditPoste">
<div class="row justify-content-center mb-5">
    <div class="col-sm-6">
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

        // var_dump($collaborators);
        echo('<pre>');

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
        <input type="hidden" id="step" value="2" name="step" form="formEditPoste">
        <input type="submit" value="Terminer" form="formEditPoste" class="btn btn-primary float-right my-5">
    </form>

</div>
<script>
$(document).ready(function() {
    var myTable = $('#tableCollaborators').DataTable();
});
</script>