<div class="container mt-4">
    <form method="GET" action="">
    <div class="mb-3">
        <strong>Filter Kategori:</strong><br>

        <?php foreach($categories as $cat): ?>
            <label class="me-3">
                <input 
                    type="checkbox" 
                    name="category[]" 
                    value="<?= $cat['id'] ?>"
                    <?= in_array($cat['id'], $selected ?? []) ? 'checked' : '' ?>
                >
                <?= htmlspecialchars($cat['name']) ?>
            </label>
        <?php endforeach; ?>
    </div>

    <button type="submit" class="btn btn-primary btn-sm">Filter</button>
    <a href="<?= BASE_URL ?>auctions" class="btn btn-secondary btn-sm">Clear</a>
</form>
<hr>
    <h2 class="home-subtitle my-4">List Auction</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($auctions as $d): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <?php if(!empty($d['image'])): ?>
                        <img src="<?= BASE_URL ?>assets/uploads/auction_images/<?= $d['image'] ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($d['title']) ?>">
                    <?php endif; ?>

                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($d['title']) ?></h5>

                        <p class="card-text"><?= htmlspecialchars($d['description'] ?? '-') ?></p>

                        <p class="card-text">
                            <strong>Current Price:</strong>
                            $<span class="current-price" data-id="<?= $d['id'] ?>">
                                <?= number_format($d['current_price'], 2) ?>
                            </span>
                        </p>

                        <p class="card-text">
                            <strong>Countdown:</strong>
                            <span class="countdown-timer" data-end="<?= $d['end_time'] ?>"></span>
                        </p>

                    </div>

                    <div class="card-footer text-end">
                        <a href="<?= BASE_URL ?>auction/show/<?= $d['id'] ?>" class="btn btn-warning btn-sm">Place a Bid</a>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
