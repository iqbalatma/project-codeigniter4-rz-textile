<?php if (session()->get("validationError")) { ?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->get("validationError") ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php }
if (session()->get("success")) { ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session()->get("success") ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php }
if (session()->get("failed")) {
?>
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session()->get("failed") ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
<?php
} ?>