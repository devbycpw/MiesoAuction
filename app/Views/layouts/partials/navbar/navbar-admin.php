<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>admin/auctions">
      <img src="<?= BASE_URL ?>assets/img/Logo.png" width="120" height="55">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse w-100" id="adminNavbar">
      <div class="d-flex w-100 justify-content-between align-items-center">
        <div></div>
        <div class="navbar-nav">
          <a class="nav-link" href="<?= BASE_URL ?>admin/auctions">Manage Auctions</a>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Payments</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= BASE_URL ?>admin/payment/all">All</a></li>
              <li><a class="dropdown-item" href="<?= BASE_URL ?>admin/payment/pending">Pending</a></li>
              <li><a class="dropdown-item" href="<?= BASE_URL ?>admin/payment/approved">Approved</a></li>
              <li><a class="dropdown-item" href="<?= BASE_URL ?>admin/payment/rejected">Rejected</a></li>
            </ul>
          </div>
          <a class="nav-link" href="<?= BASE_URL ?>admin/users">Users</a>
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
    let navLinks = document.querySelectorAll(".navbar-nav .nav-link, .dropdown-menu .dropdown-item");
    let currentPath = window.location.pathname.replace(/\/+$/, "");
    navLinks.forEach(link => {
      let href = link.getAttribute("href").replace(/\/+$/, "");
      if (href === currentPath) {
        link.classList.add("active");
        let parent = link.closest(".dropdown-menu");
        if (parent) {
          parent.parentElement.children[0].classList.add("active");
        }
      }
    });
  });
</script>
