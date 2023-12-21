<nav class="navbar navbar-dark <?=(!($_SESSION['admin']) ? "bg-primary" : "bg-dark")?>">
  <div class="container">
    <a class="navbar-brand" href="#">
        <?=(isset($_SESSION['admin']) ? 'Admin Dashboard' : 'User Dashboard')?>
    </a>
    <div id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
            <form action="index.php?route=logout" method="post">
                <button type="submit" class="btn btn-link navbar-btn navbar-link text-light text-decoration-none">Logout</button>
            </form>
        </li>
      </ul>
    </div>
  </div>
</nav>