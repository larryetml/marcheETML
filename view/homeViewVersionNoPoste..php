<!-- 
    ETML
    Auteur : Larry Lam
    Date : 13.05.19
    Description : Page d'accueil d'un utilisateur (collaborateur)
-->

<div class="container">

    <div class="row text-center mt-5 mb-3">
        <div class="col">
            <h1>Vue d'ensemble</h1>
        </div>
    </div>
    <div class="row text-center mb">
        <div class="col">
            <!-- Affiche le nom de l'utilisateur ainsi que son poste assigné -->
            <h4>Bienvenue <?php echo $userName?></h4>
        </div>
    </div>
    <?php

    if($poste)
    {
        echo'
    <div class="row text-center mb-5">
        <div class="col">
            <!-- Affiche le nom du poste assigné -->
            <h5>Vous êtes assigné au poste : <?php echo $posteName?></h5>
        </div>
    </div>
    <div class="pb-5 row justify-content-center">
        <div class="card col-lg-8 no-padding mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col text-left">
                            <!-- Affiche le poste -->
                            <h5 class="modal-title"><?php echo $posteName?></h5>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">';
                // Parcourt tous les collaborateurs également assigné au poste
                foreach($collaborators as $collaborator)
                {
                    echo '
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
    </div>';
    }else
    {
        echo'
        <div class="row text-center mb-5">
            <div class="col">
                <h5>Vous n\'êtes assigné à aucun poste</h5>
            </div>
        </div>
        ';
    }
    ?>
</div>