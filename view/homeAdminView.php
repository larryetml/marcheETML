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
        <h4>Bienvenue <?php echo $adminName?></h4>
    </div>
    <div class="row justify-content-center">
        <a class="btn btn-primary mx-1" href="index.php?page=poste" role="button">Créer un poste</a>
        <a class="btn btn-primary mx-1" href="#" role="button">Envoyer les codes QR</a>
    </div>
    <div class="py-5 row justify-content-center">

        <?php 
        
        /*
        foreach($postes as $poste)
        {
            echo'
            <div class="card col-lg-8 no-padding mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col text-left">
                            <h5 class="modal-title">'.$poste['posName'].'</h5>
                        </div>
                        <div class="col text-right pt-1">
                            <a href="#"><i class="fas fa-pen" style="font-size:15px"></i></a>
                            <a href="#" class="ml-2"><i class="fas fa-times" style="font-size:18px"></i></a>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">

                    ';
                    foreach($collaborators as $collaborator)
                    {
                        if($collaborator['idPoste']==$poste['idPoste'])
                        {
                            echo'
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col text-left">'.$collaborator['colName'].' '.$collaborator['colLastname'].'</div>
                                    <div class="col text-right font-weight-bold">'.$collaborator['secName'].'</div>
                                </div>
                            </li>';
                        }
                    }
                    echo'
                </ul>
            </div>
            ';
        }*/

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
                            <a href="#"><i class="fas fa-pen" style="font-size:15px"></i></a>
                            <a href="#" class="ml-2"><i class="fas fa-times" style="font-size:18px"></i></a>
                        </div>
                    </div>
                </div>
                <ul class="list-group list-group-flush">

                    ';

                    foreach($poste['collaborators'] as $collaborators)
                    {
                        foreach($collaborators as $collaborator)
                        {
                                echo'
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col text-left">'.$collaborator['colName'].' '.$collaborator['colLastname'].'</div>
                                        <div class="col text-right font-weight-bold">'.$collaborator['secName'].'</div>
                                    </div>
                                </li>';
                        }
                    }   

                    echo'
                </ul>
            </div>
            ';

        }
        
        
        ?>



    </div>

</div>