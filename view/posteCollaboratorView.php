<!-- 
    ETML
    Auteur : Larry Lam
    Date : 16.05.19
    Description : 2ème vue pour la création d'un poste, elle affiche la liste des collaborateurs afin de pouvoir les assigner à ce dernier.
-->
<div class="row mb-3 mt-5">
    <div class="col-sm-6 mx-auto">
    <a href="index.php" class="link-back">
        <i class="fas fa-long-arrow-alt-left"></i> Retour
    </div>  
</a>
</div>

<div class="row justify-content-center mb-3">
        <h1>Créer un poste</h1>
</div>
<div class="row justify-content-center">
<!-- Todo ajouter nom du poste dynamiquement -->
        <h4>Mon poste 1</h4>
</div>
<div class="scrolling-wrapper">
<form action="index.php?page=poste" method="post" id="form_collaborators">
<table id="tablestudents" class="table table-striped table-bordered" style="width:100%">
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
                    ';
                    echo'
                        <div class="checkbox mt-2">
                            <label style="font-size: 2em">
                                <input type="checkbox" name="assignedCollaborators[]" value="'.$collaborator['idCollaborator'].'" form="form_collaborators">
                                <span class="cr"><i class="cr-icon fa fa-check color-primary"></i></span>
                            </label>
                        </div>
                    </td>
            </tr>
            ';
        }

        // <a href="index.php?page=poste&action=add&id='.$collaborator['idCollaborator'].'" ><i class="fas fa-user-plus"></i></a>
                    // <a href="#" class="red"><i class="fas fa-user-minus"></i></a>
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
        <input type="hidden" id="step" value="3" name="step" form="form_collaborators">
        <input type="submit" value="Terminer" form="form_collaborators" class="btn btn-primary float-right my-5">
    </form>

</div>
    <script>
    function deletestudent(idstudent, studentname)
        {
            if(confirm("Voulez-vous vraiment supprimer " + studentname + " ?"))
            {
                window.location.replace('index.php?page=delete&id='+idstudent);
            }else
            {
            }
        }
   
    $(document).ready(function() {
        var myTable = $('#tablestudents').DataTable();
    });
    </script>