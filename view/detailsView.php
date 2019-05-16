
<div class="row justify-content-center">
  <div class="col-md-8 text-center pb-4">
    <p class="text-left"><a href="index.php?page=students">< Retour</a></p>
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
            <br><img class="mb-3" src=\''.$consts['qrUrl'].$consts['qrSize'].'&data='.$consts['webUrl'].'?n='.$student['idStudent'].'\' alt="">';
          if($_SESSION['user']['useIsAdmin']!=1)
          {
            echo'
            <br><br><h5>Voulez-vous valider le passage au poste : Poste 2 ?</h5>
            <br><a href="index.php?page=edit&id='.$student['idStudent'].'" class="btn btn-success" role="button">Valider</a>
            <a href="index.php?page=edit&id='.$student['idStudent'].'" class="btn btn-danger" role="button">Refuser</a>';
          }
    }
  ?>
  </div>    
</div>
