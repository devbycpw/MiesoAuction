<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= BASE_URL ?>/assets/img/hero_about.png" class="d-block w-100" alt="...">
    </div>
  </div>
</div>

<div class="container mt-4">
    <h1>About Us</h1>

    <p>Established in 1969, Enchères is the world’s premier destination for art and luxury. Enchères promotes access to and ownership of exceptional art and luxury objects through auctions and buy-now channels including private sales, e-commerce and retail. Our trusted global marketplace is supported by an industry-leading technology platform and a network of specialists spanning 40 countries and 70 categories which include Contemporary Art, Modern and Impressionist Art, Old Masters, Chinese Works of Art, Jewelry, Watches, Wine and Spirits, and Design, as well as collectible cars and real estate. Sotheby’s believes in the transformative power of art and culture and is committed to making our industries more inclusive, sustainable and collaborative.</p>

    <h1>Explore Enchères</h1>

    <section class="explore-encheres my-5">
    <h1 class="text-center mb-4">Explore Enchères</h1>
    <div class="container">
        <div class="row justify-content-center g-4">
            <?php for ($i=1; $i <= 6; $i++): ?> 
                <div class="col-md-4">
                    <div class="card">
                    <img src="<?=BASE_URL?>/assets/img/about<?=$i?>.png" class="card-img-top" alt="History">
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    </section>
</div>