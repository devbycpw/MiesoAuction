<style>
    @font-face {
        font-family: "PlusJakartaSans";
        src: url("<?= BASE_URL ?>/assets/Plus_Jakarta_Sans/static/PlusJakartaSans-Regular.ttf") format("truetype");
    }

    body{
        
    }
    .live-auction-header h1{
        font-size: 32px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .live-auction-header p{
        font-size: 16px;
        color: #555;
        margin-bottom: 24px;
    }

    .live-card{
        border-radius: 12px;
        overflow: hidden;
        transition: 0.2 ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        border: none;
        height: 100%;
    }

    .live-card img{
        width: 100%;
        height: 200px;
        aspect-ratio: 1/1;
        object-fit: cover;
        border-radius: 12px 12px 0 0;
    }

    .live-card .img-container {
        width: 100%;
        height: 200px; 
        overflow: hidden;
        border-radius: 12px 12px 0 0; 
        display: flex; 
        align-items: center;
        justify-content: center;
    }

    .live-card .img-container.vas-style img {
        /* Gaya khusus untuk Vas Dinasti Ming (dilihat dari desain, gambar lebih seperti 'contain' di dalam area) */
        width: 100%;
        height: auto;
        max-height: 100%;
        object-fit: contain; 
        border-radius: 12px 12px 0 0;
    }

    .live-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    .live-card .card-body {
        padding: 16px 16px 0 16px; 
    }

    .live-card .card-title {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .price-info p {
        margin-bottom: 4px; 
        font-size: 14px;
        color: #333;
    }

    .price-info strong {
        font-weight: 600;
    }

    /* Countdown box style */
    .countdown-box {
        display: flex;
        gap: 8px;
        margin-bottom: 12px;
        margin-top: 10px;
    }

    .count-item {
        flex-grow: 1;
        width: auto;
        text-align: center;
        background: #f5f5f5;
        padding: 6px 0;
        border-radius: 6px;
    }

    .count-item:nth-child(1), .count-item:nth-child(2), .count-item:nth-child(3), .count-item:nth-child(4) {
        max-width: 55px;
    }

    .count-item span {
        font-size: 18px;
        font-weight: 700;
        display: block;
        line-height: 1;
        margin-bottom: 4px;
    }

    .count-label {
        font-size: 10px;
        margin-top: 0;
        color: #777;
        text-transform: uppercase;
        font-weight: 500;
    }

    .auction-ended-text {
        font-size: 14px;
        font-weight: 600;
        color: #333;
        margin-top: 12px;
        margin-bottom: 12px;
    }

    .live-card .view-details-container {
        padding: 0 16px 16px 16px;
        text-align: end;
        background-color: #fff; 
    }

    .live-card .btn-warning {
        background-color: #ffc107; 
        border-color: #ffc107;
        color: #000; 
        font-weight: 600;
        padding: 8px 16px;
        border-radius: 4px; 
        font-size: 14px;
    }

    .live-card .btn-warning:hover {
        background-color: #e0a800;
        border-color: #e0a800;
    }

    .view-all-btn {
        background-color: #ffc107; 
        border-color: #ffc107;
        color: #000; 
        font-weight: 600;
        padding: 10px 20px;
        border-radius: 6px;
        display: block; 
        width: 200px;
        margin: 20px auto 0; 
    }
</style>
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
                    $is_vas = (strpos($auction['title'], 'Vas') !== false);
                    $img_class = $is_vas ? 'vas-style' : '';
                ?>

                <div class="img-container <?= $img_class?>">
                    <img src="<?= BASE_URL ?>assets/img/<?= $auction['image'] ?>" class="card-img-top">
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


        <h4>Shop New Arrival from Rolex, Hermès, Gucci, and More</h4>

        <h4>Private Serice</h4>
        <h4>Private Sales</h4>
        <p>Enchères Private Sales department provides our clients with a uniquely personalized approach to collecting. We utilize innovative, targeted approaches that combine personal relationships with collectors and market intelligence.</p>

        <h4>Professional & Advisor Services</h4>
        <p>Enchères Professional & Advisor Services team builds valuable client partnerships, leveraging expertise to deliver tailored solutions for collectors, beneficiaries, attorneys, executors, fiduciaries, institutions, and industry professionals across the art world. </p>
        <h4>Learn More about Private Sales at Enchères</h4>








<script>
document.addEventListener("DOMContentLoaded", function () {
    const timers = document.querySelectorAll(".countdown-container");

    timers.forEach(timer => {
        const endTime = new Date(timer.getAttribute("data-end")).getTime();

        const daysEl = timer.querySelector(".days");
        const hoursEl = timer.querySelector(".hours");
        const minsEl = timer.querySelector(".minutes");
        const secsEl = timer.querySelector(".seconds");

        function updateCountdown() {
            let now = new Date().getTime();
            let diff = endTime - now;

            if (diff <= 0) {
                timer.innerHTML = `<p><strong>Countdown:</strong> Auction Ended</p>`;
                return;
            }

            let days = Math.floor(diff / (1000 * 60 * 60 * 24));
            let hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            let minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            let seconds = Math.floor((diff % (1000 * 60)) / 1000);

            daysEl.textContent = String(days).padStart(2, '0');
            hoursEl.textContent = String(hours).padStart(2, '0');
            minsEl.textContent = String(minutes).padStart(2, '0');
            secsEl.textContent = String(seconds).padStart(2, '0');
        }
        updateCountdown();          // pertama kali jalan
        setInterval(updateCountdown, 1000); // update setiap detik
    });
});
</script>