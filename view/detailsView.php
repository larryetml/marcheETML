<!-- 
    ETML
    Auteur : Larry Lam
    Date : 10.05.19
    Description : Vue détaillée de l'élève
-->
<div class="row justify-content-center">
  <div class="col-md-8 text-center pb-4">
    <div class="text-left">    
      <a href="index.php?page=students" class="link-back">
          <i class="fas fa-long-arrow-alt-left"></i> Retour
      </a>
    </div>
    <div class="pt-3 pb-5">
      <h1>Détails de l'élève</h1>
    </div> 
  <?php

    if (!$student) 
    {
        echo '<div class="text-center">Il n\'y a aucun apprenti correspondant...</div>';
    } 
    else 
    {
        echo'
            <img class="mb-3" src=\'view/assets/images/students/'.$student['stuImageUrl'].'\' alt=""><br>
            <p><strong>Prénom : </strong>'.$student['stuName'].'</p>
            <p><strong>Nom : </strong>'.$student['stuLastname'].'</p>
            <p><strong>Classe : </strong>'.$student['claName'].'</p>
            <p><strong>Section : </strong>'.$student['secName'].'</p>
            <img class="mb-3" src=\''.$CONSTS['qrUrl'].$CONSTS['qrSize'].'&data='.$CONSTS['webUrl'].'?n='.$student['idStudent'].'\' alt="Code QR">';
          
            echo '
            <table class="table table-bordered">
            <thead>
              <tr>
                <th scope="col"></th>
                <th scope="col">Poste</th>
                <th scope="col">Passé ?</th>
              </tr>
            </thead>
            <tbody>
            ';
            foreach($postes as $index=>$poste)
            {
              echo'
              <tr>
                <th scope="row">'.($index+1).'</th>
                <td>'.$poste['posName'].'</td>
                <td>
                  <div class="custom-control custom-checkbox">';                    
                    //Rajoute checked si l'étudiant a passé le poste
                    foreach($passedPostes as $passedPoste)
                    {
                      if($poste['idPoste'] == $passedPoste['idPoste'])
                      {
                        echo '<input type="checkbox" class="custom-control-input" disabled checked>';
                      }else
                      {
                        echo '<input type="checkbox" class="custom-control-input" disabled>';
                      }
                    }
                    echo'
                    <label class="custom-control-label"></label>
                  </div>
                </td>
              </tr>';
            }
            echo'
                </tbody>
              </table>';

            if(!$isAdmin)
            {
              if($isAlreadyValidated)
              {
                echo'<br><h5>L\'élève est déjà passé au poste : '.$collaboratorPoste['posName'].'.</h5>
                <br><a href="index.php?page=validate&action=remove&poste='.$collaboratorPoste['idPoste'].'&id='.$student['idStudent'].'" class="btn btn-danger" role="button">Retirer</a>';
              }else
              {
                echo'<br><h5>Voulez-vous valider le passage au poste : '.$collaboratorPoste['posName'].' ?</h5>
                <br><a href="index.php?page=validate&action=validate&poste='.$collaboratorPoste['idPoste'].'&id='.$student['idStudent'].'" class="btn btn-success" role="button">Valider</a>';
              }

            }
    }
  ?>
  </div>    
</div>
