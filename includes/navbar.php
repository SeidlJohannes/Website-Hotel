<nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
  <!--navbar-expand{-sm|-md|-lg|-xl|-xxl} for responsiv design; sticky Top does not hide content (like fixed-top)-->
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php?menu=home"> <!--a tag defines hyperlink-->
      <img src="images/FH_Logo.png" alt="Logo" width="50" height="50">
    </a>
    <!--this button is for the dropdown menu-->
    <button type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" class="navbar-toggler"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!--here are the different items/links in our navbar-->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <?php foreach ($navigation as $navigationElement): ?>
          <!--Zusammen mit endforeach kann man dazwischen html code schreiben und php wird kurz unterbrochen-->
          <!--Wenn ein Element am Anfang der Seite auf 'acive' gestellt wird
                  mit zB: $navigation = getNavigation('Impressum');
                  Dann wird die classe nav-item active vergeben, sonst nur nav-item
                  -->
          <li <?php
          if ($navigationElement['active']) {
            echo 'class="nav-item active"';
          } else {
            echo 'class="nav-item"';
          } ?>>
            <a class="nav-link" href="<?= $navigationElement['target'] ?>">
              <?= $navigationElement['label'] ?>
            </a></li>
        <?php endforeach; ?>
      </ul>
      <a class="fa fa-question-circle" style="font-size:36px;color:gold" href="index.php?menu=help"></a>
      <!--////////////////////////LOGIN or LOGOUT////////////////////////-->
      <?php
      if (isset($_SESSION['username'])) {
        $benutzername = $_SESSION['username'] ?>
        <div class="dropdown ml-auto"> <!--ml-auto puts content to the right-->
          <button>
            <?php echo "$benutzername" ?>
          </button>
          <div class="dropdown-content">
            <a href="index.php?menu=profil">
              <button class="dropbtn">Profil ansehen</button></a>
            <a href="index.php?menu=logout">
              <button class="dropbtn">Abmelden</button></a>
          </div>
        </div>
      <?php } ?>
      <?php if (!isset($_SESSION['username'])) { ?>
        <button class="ml-auto" onclick="document.getElementById('login').style.display='block'">
          Anmelden</button>
        <?php include __DIR__ . '/../sites/login.php' ?>
      <?php } ?>
    </div>
  </div>
</nav>