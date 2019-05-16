<nav class="navbar navbar-expand-lg navbar-light mb-4">
  <a class="navbar-brand" href="./index.php">Marche Etml</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="index.php?page=students">Liste des élèves</a>
      </li>
      <li class="nav-item">
      <?php        
        if(isset($_SESSION['user']))
        {
          echo '<a class="nav-link" href="index.php?page=disconnect">Se déconnecter</a>';
        }else
        {
          echo '<a class="nav-link" href="index.php?page=login">Login</a>';
        }
        ?>
      </li>

    </ul>
  </div>
</nav>
<!-- <script>
$(".nav a").on("click", function(){
   $(".nav").find(".active").removeClass("active");
   $(this).parent().addClass("active");
});
</script> -->