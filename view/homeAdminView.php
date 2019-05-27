<!-- 
    ETML
    Auteur : Larry Lam
    Date : 13.05.19
    Description : Page d'accueil d'un utilisateur (admin)
-->
<div class="container">
    <div class="row justify-content-center my-5">
        <h1>Vue d'ensemble</h1>
    </div>
    <div class="row justify-content-center mb-5">
        <!-- Affiche le nom de l'utilisateur -->
        <h4>Bienvenue <?php echo $userName?></h4>
    </div>
    <div class="row justify-content-center">
        <a class="btn btn-primary mx-1" href="index.php?page=poste&action=create" role="button">Créer un poste</a>
        <a class="btn btn-success mx-1" href="index.php?page=send" role="button">Terminer</a>
    </div>
    <div class="py-5 row justify-content-center">

        <?php 
        // Parcourt la liste des postes et les afficher
        foreach($listPostes as $poste)
        {
            echo'
            <div class="card col-lg-8 no-padding mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col text-left">
                            <h5 class="modal-title">'.$poste['posName'].'</h5>
                        </div>
                        <div class="col text-right pt-1">
                            <a href="index.php?page=poste&action=edit&id='.$poste['idPoste'].'"><i class="fas fa-pen" style="font-size:15px"></i></a>
                            <a href="index.php?page=poste&action=delete&id='.$poste['idPoste'].'" class="ml-2"><i class="fas fa-trash-alt" style="font-size:18px"></i></a>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">';
                // Pour chaque collaborateurs assigné au poste
                foreach($poste['collaborators'][0] as $collaborator)
                {
                    // Afficher son nom, prénom et sa section
                    echo'
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col text-left">'.$collaborator['colName'].' '.$collaborator['colLastname'].'</div>
                            <div class="col text-right font-weight-bold">'.$collaborator['secName'].'</div>
                        </div>
                    </li>';
                }
            echo'
                </ul>
            </div>
            ';

        }
        ?>
    </div>
</div>