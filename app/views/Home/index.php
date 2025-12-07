<?php
    // Asumsi: BASE_URL sudah didefinisikan sebelumnya di file atau environment
    $new_arrivals = [
        ['title' => 'CARTIER', 'desc' => 'Platinum, Ruby and Diamond Leaf Earrings', 'image' => 'Earrings1 (For Home).png'],
        ['title' => 'JEROME', 'desc' => 'Platinum, Yellow Diamond and Diamond Earrings', 'image' => 'Earrings2 (For Home).png'],
        ['title' => 'TIFFANY & CO.', 'desc' => 'Platinum and Diamond Ring', 'image' => 'Earrings3 (For Home).png']
    ];
?>
<div class="home-page">
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-wrap="true">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="<?= BASE_URL ?>/assets/img/hero_jewelery.png" class="d-block w-100" alt="Jewelry Auction">
            <div class="carousel-caption d-none d-md-block">
                <h5>First slide label</h5>
                <p>Some representative placeholder content for the first slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>/assets/img/hero_car.png" class="d-block w-100" alt="Car Auction">
            <div class="carousel-caption d-none d-md-block">
                <h5>Second slide label</h5>
                <p>Some representative placeholder content for the second slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>/assets/img/hero_house.png" class="d-block w-100" alt="Real Estate Auction">
            <div class="carousel-caption d-none d-md-block">
                <h5>Third slide label</h5>
                <p>Some representative placeholder content for the third slide.</p>
            </div>
        </div>
        <div class="carousel-item">
            <img src="<?= BASE_URL ?>/assets/img/hero_mac.png" class="d-block w-100" alt="Electronics Auction">
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

<div class="container mt-4">
    <div class="live-auction-header">
        <h1>Live Auction</h1>
        <p>Explore the best & largest marketplace with our beautiful Bidding product. 
            We want to be a part of your smile, success and future growth</p>
    </div> 
    <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php $count = 0; foreach($auctions as $auction): if($count >= 3) break; ?>

        <div class="col">
            <div class="card live-card shadow-sm">

                <?php 
                    // Logika untuk class khusus 'vas-style'
                    $is_vas = (strpos($auction['title'], 'Vas') !== false);
                    $img_class = $is_vas ? 'vas-style' : '';
                ?>

                <div class="img-container <?= $img_class?>">
                    <img src="<?= BASE_URL ?>assets/img/<?= $auction['image'] ?>" class="card-img-top" alt="<?= htmlspecialchars($auction['title']) ?>">
                </div>

                <div class="card-body">
                    <h5 class="card-tittle"><?= htmlspecialchars($auction['title']) ?></h5>

                    <?php 
                        $now = strtotime("now");
                        $end = strtotime($auction['end_time']);
                    ?>

                    <?php if($now < $end): ?>
                    <div class="countdown-container" data-end="<?= $auction['end_time']?>">
                        <div class="countdown-box">
                            <div class="count-item">
                                <span class="days">00</span>
                                <div class="count-label">Days</div>
                            </div>
                            <div class="count-item">
                                <span class="hours">00</span>
                                <div class="count-label">Hours</div>
                            </div>
                            <div class="count-item">
                                <span class="minutes">00</span>
                                <div class="count-label">Min</div>
                            </div>
                            <div class="count-item">
                                <span class="seconds">00</span>
                                <div class="count-label">Sec</div>
                            </div>
                        </div>
                    </div>

                    <?php else: ?>
                        <p class="auction-ended-text"><strong>Countdown: </strong>Auction Ended</p>
                    <?php endif; ?>

                    <div class="price-info">
                        <p><strong>Starting Price: </strong>$<?= number_format($auction['starting_price'],2) ?></p>

                        <?php if(!empty($auction['final_price'])): ?>
                            <p><strong>Final Price: </strong>$<?= number_format($auction['final_price'],2) ?></p>
                        <?php endif; ?>
                    </div> 
                </div>

                <div class="view-details-container">
                    <a href="<?= BASE_URL ?>auction/show/<?= $auction['id'] ?>" class="btn btn-warning btn-sm">Place a bid</a>
                </div>

            </div>
        </div>
        <?php $count++; endforeach; ?>
    </div>
    <a href="<?= BASE_URL ?>auctions" class="btn btn-warning view-all-btn mt-5">
        View All Auctions
    </a>
</div>

<div class="container"><hr style="margin-top: 50px; margin-bottom: 50px;"></div>

<div class="container">
    <div class="new-arrival-header">
        <h4 class="section-title">Shop New Arrival from Rolex, Hermès, Gucci, and More</h4>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
            <div class="arrival-card">
                <img src="<?= BASE_URL ?>assets/img/Earrings1 (For Home).jpg" alt="CARTIER">
                <h6 class="card-title">CARTIER</h6>
                <p class="card-text">Platinum, Ruby and Diamond Leaf Earrings</p>
                <p class="card-price">USD 21.500,00</p>
            </div>
        </div>

        <div class="col">
            <div class="arrival-card">
                <img src="<?= BASE_URL ?>assets/img/Earrings2 (For Home).jpg" alt="JEROME">
                <h6 class="card-title">JEROME</h6>
                <p class="card-text">Platinum, Yellow Diamond and Diamond Earrings</p>
                <p class="card-price">USD 18.000,00</p>
            </div>
        </div>

        <div class="col">
            <div class="arrival-card">
                <img src="<?= BASE_URL ?>assets/img/Earrings3 (For Home).jpg" alt="TIFFANY & CO.">
                <h6 class="card-title">TIFFANY & CO.</h6>
                <p class="card-text">Platinum and Diamond Ring</p>
                <p class="card-price">USD 12.500,00</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="private-service-header">
        <h4 class="section-title">Private Services</h4>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="service-card">
                <h4>Private Sales</h4>
                <p>Enchères Private Sales department provides our clients with a uniquely personalized approach to collecting. 
                    We utilize innovative, targeted approaches that combine personal relationships with collectors and market intelligence.</p>
            </div>
        </div>

        <div class="col">
            <div class="service-card">
                <h4>Professional & Advisor Services</h4>
                <p>Enchères Professional & Advisor Services team builds valuable client partnerships, leveraging expertise to deliver tailored solutions for collectors, beneficiaries, attorneys, executors, fiduciaries, institutions, and industry professionals across the art world.</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="learn-more-header">
        <h4 class="section-title">Learn More About Private Sales at Enchères</h4>
    </div>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div class="Learn-more-card">
                <img src="<?= BASE_URL ?>assets/img/DiscoverPrivateSales.png" alt="Discover Private Sales at Enchères">
                <p>Discover Private Sales at Enchères</p>
            </div>
        </div>

        <div class="col">
            <div class="Learn-more-card">
                <img src="<?= BASE_URL ?>assets/img/BrowseWorks.png" alt="Browse Works Available for Private Sales">
                <p>Browse Works Available for Private Sales</p>
            </div>
        </div>
    </div>
</div>
</div>
