<!-- 
    ETML
    Auteur : Larry Lam
    Date : 09.05.19
    Description : Menu de navigation
-->
<nav class="navbar navbar-expand-lg navbar-light mb-4">
  <a class="navbar-brand" href="./index.php">Marche Etml</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=students">Liste des élèves</a>
      </li>
      <li class="nav-item">
      <?php        
        //Afficher le lien "login" ou "Se déconnecter"
        echo $navLoginLink;
        ?>
      </li>
    </ul>
  </div>
</nav>