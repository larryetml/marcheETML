


        <!-- <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">Connexion</div>
                    <div class="card-body">
                        <form action="index.php?page=log" method="POST">
                            <div class="form-group row">
                                <label for="email" class="col-lg-4 col-form-label text-lg-right">Email</label>
                                <div class="col-lg-7">
                                    <input type="text" id="email" class="form-control" name="email" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-lg-4 col-form-label text-lg-right">Mot de passe</label>
                                <div class="col-lg-7">
                                    <input type="password" id="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-lg-7 offset-lg-4">
                                    <button type="submit" class="btn btn-primary">
                                        Connexion
                                    </button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div> -->
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