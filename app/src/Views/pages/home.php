<?php include __DIR__."/../header.php"; ?>

<div class="container">
  <?php
    if (isset($_SESSION['Flash']) && !empty($_SESSION['Flash'])) {
        foreach ($_SESSION['Flash'] as $k => $v) {
            echo "<div class=\"alert alert-dismissible alert-".$k." container\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>";
            foreach ($v as $msg) {
                echo $msg."<br>";
            }
            echo "</div>";
        }
    }
    // var_dump();
  ?>

  <h1><?= $title ?></h1>
</div>

<?php include __DIR__."/../footer.php"; ?>
