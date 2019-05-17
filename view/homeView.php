<!-- 
    ETML
    Auteur : Larry Lam
    Date : 13.05.19
    Description : Page d'accueil d'un utilisateur (collaborateur)
-->

<div class="container">

    <div class="row justify-content-center mt-5 mb-3">
        <h1>Vue d'ensemble</h1>
    </div>
    <div class="row text-center mb-5">
        <div class="col">
            <h4>Bienvenue <?php echo $adminName?></h4>
            <h5>Vous êtes assigné au poste : <?php echo $posteName?></h5>
        </div>
    </div>
    <div class="pb-5 row justify-content-center">
        <div class="card col-lg-8 no-padding mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col text-left">
                            <h5 class="modal-title"><?php echo $posteName?></h5>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">

                <?php 
                foreach($collaborators as $collaborator)
                {
                    echo '<li class="list-group-item">
                    <div class="row">
                        <div class="col text-left">'.$collaborator['colName'].' '.$collaborator['colLastname'].'</div>
                        <div class="col text-right font-weight-bold">'.$collaborator['secName'].'</div>
                    </div>
                </li>';
                }
                ?>

                </ul>
            </div>
    </div>
</div>