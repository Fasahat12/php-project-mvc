<nav class="navbar navbar-expand-lg navbar-dark <?= (!($_SESSION['admin']) ? "bg-primary" : "bg-dark") ?>">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <?php if ($_SESSION['userId']) : ?>
        <?= (isset($_SESSION['admin']) ? 'Admin Dashboard' : 'User Dashboard') ?>
      <?php else : ?>
        Mini-MVC
      <?php endif; ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if ($_SESSION['userId']) : ?>
          <?php if (!($_SESSION['admin'])) : ?>
            <a class="nav-link text-light" aria-current="page" href="index.php?route=manage-address">Manage Delivery Address</a>
          <?php endif; ?>
          <li class="nav-item">
            <form action="index.php?route=logout" method="post">
              <button type="submit" class="btn btn-link navbar-btn navbar-link text-light text-decoration-none">Logout</button>
            </form>
          </li>
        <?php else : ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php?route=login-page">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index.php">Sign Up</a>
          </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>