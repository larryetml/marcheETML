
      <div class="row justify-content-center">
        <div class="col-md-8">
          <p class="mb-3"><a href="index.php?page=list">< Retour</a></p>
          
        <?php
          if ($idProduct==null) 
          {
            
              echo '<div class="text-center">Il n\'y a aucun produit correspondant...</div>';
          } 
          else 
          {
              echo'
                <form>
                <img class="mb-3" src=\''.$consts['qrUrl'].$consts['qrSize'].'&data='.$consts['webUrl'].'?n='.$product['idProduct'].'\' alt="">
                <div class="form-group">
                    <label for="inputName"><strong>Nom</strong></label>
                    <input type="text" class="form-control" id="inputName" value="'.$product['proName'].'">
                  </div>
                  <div class="form-group">
                    <label for="inputName"><strong>Type</strong></label>
                    <input type="text" class="form-control" id="inputName" value="'.$product['typName'].'">
                  </div>
                  <div class="form-group">
                    <label for="inputName"><strong>Couleur</strong></label>
                    <input type="text" class="form-control" id="inputName" value="'.$product['colName'].'">
                  </div>
                  <div class="form-group">
                    <label for="inputName"><strong>Stocks</strong></label>
                    <input type="number" class="form-control" id="inputName" value="'.$product['proQuantity'].'">
                  </div>
                  <div class="form-group">
                    <label for="inputName"><strong>Description</strong></label>
                    <input type="text" class="form-control" id="inputName" value="'.$product['proDescription'].'">
                  </div>
                  <a href="index.php?page=details&id='.$product['idProduct'].'" class="btn btn-secondary" role="button">Annuler</a>
                  <button class="btn btn-primary" type="submit">Enregistrer</button>
                </form>
                ';
          }
        ?>
        </div>    
      </div>