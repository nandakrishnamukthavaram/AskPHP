<head>
  <link rel="stylesheet" href="../public/style.css">
</head>

<nav class="navbar">
  <div class="navbar-logo">
    <a href="./">
      <img src="./public/logo1.png" height="35" />
      <span>AskPHP</span>
    </a>
  </div>
  <div class="navbar-menu">
    
      <li class="navbar-item">
        <a class="navbar-link" href="./">Home</a>
      </li>
      <?php if ($_SESSION['user']['username']) { ?>
        <li class="navbar-item">
          <a class="navbar-link" href="./server/requests.php?logout=true">Logout(<?php echo ucfirst($_SESSION['user']['username']) ?>)</a>
        </li>
        <li class="navbar-item">
          <a class="navbar-link" href="?ask=true">Ask A Question</a>
        </li>
        <li class="navbar-item">
          <a class="navbar-link" href="?u-id=<?php echo $_SESSION['user']['user_id'] ?>">My Questions</a>
        </li>
      <?php } else { ?>
        <li class="navbar-item">
          <a class="navbar-link" href="?login=true">Login</a>
        </li>
        <li class="navbar-item">
          <a class="navbar-link" href="?signup=true">SignUp</a>
        </li>
      <?php } ?>
      <li class="navbar-item">
        <a class="navbar-link" href="?latest=true">Latest Questions</a>
      </li>
   
  </div>
  <form class="navbar-form" action="">
    <input class="navbar-search" name="search" type="search" placeholder="Search questions">
    <button class="navbar-button" type="submit">Search</button>
  </form>
</nav>
