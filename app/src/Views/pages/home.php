<?php include __DIR__."/../header.php"; ?>

<div class="container">

  <?php
    // Messages flash
    if (isset($_SESSION['alert']) && !empty($_SESSION['alert'])) {
        foreach ($_SESSION['alert'] as $k => $v) {
            echo "<div class=\"alert alert-dismissible alert-".$k." container\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            foreach ($v as $msg) {
                echo $msg."<br>";
            }
            echo "</div>";
        }
    }
  ?>

  <h1><?= $title ?></h1>

  <?php if (isset($_SESSION['name']) && !empty($_SESSION['name'])): ?>
    <h3>Bienvenue <?= $_SESSION['name'] ?></h3>
  <?php else: ?>
    <form action="" method="post">
      <div class="form-group">
        <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom">
      </div>

      <!-- csrf -->
      <input type="hidden" name="<?= $csrfNameKey ?>" value="<?= $csrfName ?>">
      <input type="hidden" name="<?= $csrfValueKey ?>" value="<?= $csrfValue ?>">
      <!-- csrf -->

      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
  <?php endif; ?>

</div>

<?php include __DIR__."/../footer.php"; ?>
