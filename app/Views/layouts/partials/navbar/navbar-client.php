<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="<?= BASE_URL ?>home">
      <img src="<?= BASE_URL ?>assets/img/Logo.png" width="120" height="66">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100" id="navbarNavAltMarkup">
      <div class="d-flex w-100 justify-content-between align-items-center">
        <div></div>
        <div class="navbar-nav">
          <a class="nav-link" href="<?= BASE_URL ?>auctions">Auction</a>
          <a class="nav-link" href="<?= BASE_URL ?>about">About Us</a>
          <a class="nav-link" href="<?= BASE_URL ?>myBids">My Bids</a>
        </div>
        <div class="navbar-nav">
          <a class="nav-link fw-semibold" href="<?= BASE_URL ?>logout">Logout</a>
        </div>
      </div>
    </div>
  </div>
</nav>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    let navLinks = document.querySelectorAll(".navbar-nav .nav-link");
    let currentPath = window.location.pathname.split("/").pop(); 

    navLinks.forEach(link => {
      let linkPath = link.getAttribute("href").split("/").pop();
      if (linkPath === currentPath) {
        navLinks.forEach(l => l.classList.remove("active")); 
        link.classList.add("active");
      }
    });
  });
</script>