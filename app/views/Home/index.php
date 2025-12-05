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

    <h1 class="home-title">Welcome</h1>

    <?php if (Auth::isClient()): ?>
        <p class="home-welcome">Halo <?= Auth::user('full_name'); ?>! Kamu bisa melihat daftar produk.</p>
    <?php endif; ?>

    <?php if (!Auth::check()): ?>
        <p class="home-welcome">Login untuk fitur lebih lengkap.</p>
    <?php endif; ?>

    <h2 class="home-subtitle">List User</h2>
    <div class="user-list">
        <?php foreach($users as $u): ?>
            <p><?= $u['full_name']; ?></p>
        <?php endforeach; ?>
    </div>
</main>
