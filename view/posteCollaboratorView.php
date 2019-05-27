<!-- 
    ETML
    Auteur : Larry Lam
    Date : 16.05.19
    Description : 2ème étape/vue pour la création d'un poste, elle affiche la liste des collaborateurs disponibles afin de pouvoir les assigner au poste.
-->
<div class="row mb-3 mt-5">
    <!-- Retour sur la page précédante -->
    <a href="javascript:history.go(-1)" class="link-back">
        <i class="fas fa-long-arrow-alt-left"></i> Retour
    </a>
</div>

<div class="row justify-content-center mb-3">
        <h1>Créer un poste</h1>
</div>
<div class="row justify-content-center">
    <!-- Nom du poste -->
    <h4><?php echo $_SESSION['posteName'] ?></h4>
</div>
<!-- Si le tableau est trop large (mobile et tablettes), rendre la div scrollable horizontalement.   -->
<div class="scrolling-wrapper">
    <form action="index.php?page=poste&action=create" method="post" id="formCollaborators">
        <table id="tableCollaborators" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Section</th>
                    <th>Assigner ?</th>
                </tr>
            </thead>
            <tbody>

            <?php 
            // Parcourt les collaborateurs
            foreach($collaborators as $collaborator)
            {
                // Pour chacun d'eux, afficher leurs informations telles que le nom, prénom, email, nom de la section
                echo'
                    <tr>
                        <td>'.$collaborator['colName'].'</td>
                        <td>'.$collaborator['colLastname'].'</td>
                        <td>'.$collaborator['colEmail'].'</td>
                        <td>'.$collaborator['secName'].'</td>
                        <td class="text-center">
                        ';
                        // assignedCollaborators[] est un tableau contenant l'id de tous les collaborateurs assignés (déclenché en cochant la case)
                        echo'
                            <div class="checkbox mt-2">
                                <label style="font-size: 2em">                                    
                                    <input type="checkbox" name="assignedCollaborators[]" value="'.$collaborator['idCollaborator'].'" form="formCollaborators">
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
                    <th>Assigner ?</th>
                </tr>
            </tfoot>
        </table>
        <!-- Input caché pour passer à la prochaine étape-->
        <input type="hidden" id="step" value="3" name="step" form="formCollaborators">
        <input type="submit" value="Terminer" form="formCollaborators" class="btn btn-primary float-right my-5">
    </form>

</div>
<script>
$(document).ready(function() {
    // Création de la dataTable avec la librairie DataTable.
    var myTable = $('#tableCollaborators').DataTable();
});
</script>