<div class="AuctionsList-page">
    <div class="ButtonBackHome">
         <a href="<?= BASE_URL ?>" class="btn btn-secondary mb-3">
        &larr; Back to Home
    </a>
    </div>
    <div class="row mt-4">
        <div class="col-md-3">
            <div class="filter-box mb-4">
                <form method="GET" action="">
                    <div class="filter-tittle">Filter Category: </div>
                    
                    <?php foreach($categories as $cat): ?>
                        <label class="me-3">
                            <input 
                                type="checkbox"
                                name="category[]"
                                value="<?= $cat['id'] ?>"
                                <?= in_array($cat['id'], $selected ?? []) ? 'checked' : '' ?>
                            >
                            <?= htmlspecialchars($cat['name'])?>
                        </label>
                    <?php endforeach; ?>
                    
                    <button type="submit" class="button-apply btn btn-sm">Apply</button>
                    <a href="<?= BASE_URL ?>auctions" class="button-clear btn btn-sm">Clear</a>
                </form>
            </div>
        </div>

        <!-- CARD KANAN -->
        <div class="col-md-9">

            <h2 class="home-subtitle mb-4"><b>Auction List</b></h2>
        
            <!-- CARD LIST -->
            <div class="row row-cols-1 row-cols-md-2 g-2">
                <?php foreach($auctions as $d): ?>
                    <div class="col-md-6">
                        <div class="card auction-card h-100">
                            <?php if(!empty($d['image'])): ?>
                                <img 
                                    src="<?= BASE_URL ?>assets/uploads/auction_images/<?= $d['image'] ?>" 
                                    alt="<?= htmlspecialchars($d['title']) ?>"
                                    class="auction-img"
                                >
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-tittle"><?= htmlspecialchars($d['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($d['description'] ?? '-') ?></p>
                                <p class="card-text">
                                    <strong>Open: </strong>$<?= number_format($d['current_price'], 2)?>
                                </p>

                                <div class="countdown-timer" data-end="<?= $d['end_time']?>">
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
                            </div>

                            <div class="card-footer bg-white text-center">
                                <a href="<?= BASE_URL ?>auction/show/<?= $d['id']?>" class="btn bid-btn w-100">Bid Now</a>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<br><br><br>