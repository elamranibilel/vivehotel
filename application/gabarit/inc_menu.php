<nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-dark">
  <div class="container">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Index</span></a>
        </li>
        <li><a class='nav-link' href='<?= hlien("chambre", "index") ?>'>Chambre</a></li>
        <!-- <li><a class='nav-link' href='<?= hlien("chcategorie", "index") ?>'>Chcategorie</a></li> -->
        <li><a class='nav-link' href='<?= hlien("client", "index") ?>'>Client</a></li>
        <li><a class='nav-link' href='<?= hlien("hotel", "index") ?>'>Hotel</a></li>
        <li><a class='nav-link' href='<?= hlien("personnel", "index") ?>'>Personnel</a></li>
        <li><a class='nav-link' href='<?= hlien("reservation", "index") ?>'>Reservation</a></li>
        <li><a class='nav-link' href='<?= hlien("services", "index") ?>'>Services</a></li>
        <!-- <li><a class='nav-link' href='<?= hlien("tarifer", "index") ?>'>Tarifer</a></li>  -->

      </ul>
      <ul class="navbar-nav ml-auto">
        <li><a class="nav-link" href="<?= hlien("authentification", "deconnexion") ?>">Déconnexion</a></li>
        <li><a class="nav-link" href='<?= hlien("authentification", "connexion") ?>'>Connexion</a></li>
      </ul>
    </div>
  </div>
</nav>