<!-- 
    ETML
    Auteur : Larry Lam
    Date : 13.05.19
    Description : Vue de connexion
-->
    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body pb-5">
            <h5 class="card-title text-center">Connexion</h5>
            <form class="form-signin" autocomplete="off" method="POST" action="index.php?page=log">
              <div class="form-label-group mb-3">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="Email" required autofocus autocomplete="off">
              </div>

              <div class="form-label-group mb-4">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Mot de passe" required>
              </div>

              <?php
                if(isset($_GET['error']))
                {
                    if($_GET['error']== '1')
                    {
                        echo '<div class="alert alert-danger">
                        Mauvais email ou mot de passe.
                      </div>';
                    }
                }
              ?>
            
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Se connecter</button>
            </form>
          </div>
        </div>
      </div>