<style>
  @font-face {
    font-family: "PlusJakartaSans";
    src: url("<?= BASE_URL ?>/assets/Plus_Jakarta_Sans/static/PlusJakartaSans-Regular.ttf") format("truetype");
  }

  body{
    font-family: "PlusJakartaSans", sans-serif;
  }

  .about-section{
    background-color:#f2f2f2;
    padding-top: 60px;
    padding-bottom: 60px;
  }

  .section-title{
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 20px;
  }

  .explore-title{
    position: relative;
    display: inline-block;
    padding-bottom: 10px;
  }

  .explore-title::after {
    content: "";
    width: 60px;
    height: 3px;
    background-color: #d6a500; /* gold-yellow line */
    position: absolute;
    bottom: 0;
    left: 10%;
    transform: translateX(-50%);
  }

  .explore-card {
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .explore-card:hover {
    transform: scale(1.03);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
  }

  .explore-card:hover .explore-img {
    transform: scale(1.1);
  }

  .explore-img {
    width: 100%;
    height: auto;
    display: block;
    border-radius: 8px;
    transition: transform 0.4s ease;
  }

  .explore-card::after {
    content: "";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0);
    transition: background 0.3s ease;
  }

  .explore-card:hover::after {
    background: rgba(0,0,0,0.25);
  }

  .explore-label {
    position: absolute;
    bottom: 10px;
    left: 10px;
    background: rgba(0,0,0,0.6);
    color: #fff;
    padding: 6px 12px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    z-index: 2;
    transition: transform 0.3s ease, opacity 0.3s ease;
  }

  .explore-card:hover .explore-label {
    transform: translateY(-4px);
    opacity: 1;
  }
</style>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= BASE_URL ?>/assets/img/hero_about.png" class="d-block w-100" alt="...">
    </div>
  </div>
</div>

<!-- ABOUT SECTION -->
<div class="about-section py-5">
  <div class="container">

    <h2 class="section-title">About Us</h2>

    <p class="about-text">
      Established in 1969, Enchères is the world’s premier destination for art and luxury. 
      Enchères promotes access to and ownership of exceptional art and luxury objects through 
      auctions and buy-now channels including private sales, e-commerce and retail. Our trusted 
      global marketplace is supported by an industry-leading technology platform and a network 
      of specialists spanning 40 countries and 70 categories which include Contemporary Art, 
      Modern and Impressionist Art, Old Masters, Chinese Works of Art, Jewelry, Watches, Wine 
      and Spirits, and Design, as well as collectible cars and real estate. Enchères believes in 
      the transformative power of art and culture and is committed to making our industries more 
      inclusive, sustainable and collaborative.
    </p>
  </div>
</div>

<!-- EXPLORE SECTION -->
<section class="explore-section py-5">
  <div class="container">

    <h2 class="section-title explore-title text-center mb-4">Explore Enchères</h2>

    <div class="row g-4 justify-content-center">
      <?php for($i = 1; $i <= 6; $i++): ?>
        <div class="col-md-4 col-sm-6">
          <div class="explore-card">
            <img src="<?= BASE_URL ?>/assets/img/about<?=$i?>.png" class="explore-img" alt="Explore <?= $i ?>">
            <div class="explore-label">Services</div>
          </div>
        </div>
      <?php endfor; ?>
    </div>

  </div>
</section>