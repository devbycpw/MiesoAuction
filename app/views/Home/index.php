<main class="home-page">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-wrap="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="<?= BASE_URL ?>/assets/img/hero_jewelery.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_URL ?>/assets/img/hero_car.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_URL ?>/assets/img/hero_house.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?= BASE_URL ?>/assets/img/hero_mac.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Fourth slide label</h5>
                    <p>Some representative placeholder content for the fourth slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- <?php if (Auth::isClient()): ?>
        <p class="home-welcome">Halo <?= Auth::user('full_name'); ?>! Kamu bisa melihat daftar produk.</p>
    <?php endif; ?>

    <?php if (!Auth::check()): ?>
        <p class="home-welcome">Login untuk fitur lebih lengkap.</p>
    <?php endif; ?> -->
<<<<<<< HEAD

    
=======
<div class="container mt-4">
    <h1>Live Action</h1>
    <p>Explore the best & largest marketplace with our beautiful Bidding product. We want to be a part of your smile, success and future growth  </p>
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php 
        $count = 0;
        foreach($auctions as $auction): 
            if($count >= 3) break;
        ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <?php if(!empty($auction['image'])): ?>
                        <img src="<?= BASE_URL ?>assets/img/<?= $auction['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($auction['title']) ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($auction['title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($auction['description'] ?? '-') ?></p>
                        <p class="card-text"><strong>Starting Price:</strong> $<?= number_format($auction['starting_price'],2) ?></p>
                        <?php if(!empty($auction['final_price'])): ?>
                            <p class="card-text"><strong>Final Price:</strong> $<?= number_format($auction['final_price'],2) ?></p>
                        <?php endif; ?>
                        <p class="card-text"><small class="text-muted">Status: <?= ucfirst($auction['status']) ?></small></p>
                        <p class="card-text"><small class="text-muted">Start: <?= $auction['start_time'] ?? '-' ?> | End: <?= $auction['end_time'] ?? '-' ?></small></p>
                    </div>
                    <div class="card-footer text-end">
                        <a href="<?= BASE_URL ?>auction/show/<?= $auction['id'] ?>" class="btn btn-warning btn-sm">View Details</a>
                    </div>
                </div>
            </div>
        <?php 
            $count++;
        endforeach; ?>
>>>>>>> Peter
    </div>
    <a href="<?= BASE_URL ?>auctions" class="btn btn-warning btn-sm">View All Auctions</a>

    <h4>Shop New Arrival from Rolex, Hermès, Gucci, and More</h4>

    <h4>Private Serice</h4>
    <h4>Private Sales</h4>
    <p>Enchères Private Sales department provides our clients with a uniquely personalized approach to collecting. We utilize innovative, targeted approaches that combine personal relationships with collectors and market intelligence.</p>

    <h4>Professional & Advisor Services</h4>
    <p>Enchères Professional & Advisor Services team builds valuable client partnerships, leveraging expertise to deliver tailored solutions for collectors, beneficiaries, attorneys, executors, fiduciaries, institutions, and industry professionals across the art world. </p>
    <h4>Learn More about Private Sales at Enchères</h4>

    </div>


</main>
