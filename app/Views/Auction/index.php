<style>
    html, body {
        max-width: 100%;
        overflow-x: clip; /* Ganti hidden → clip, BIAR SCROLL BISA */
    }

    .row{
         margin-left: 0 !important;
        margin-right: 0 !important;
        padding-left: 12px;
        padding-right: 12px;
    }

    /* FILTER BOX */
    .filter-box{
        background: #fff;
        border: 1px solid #ddd;
        padding: 16px 18px;
        border-radius: 8px;
        margin-left: 8px;
    }

    .filter-box label{
        display: flex;
        margin-bottom: 10px;
    }

    .filter-tittle{
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .filter-box input[type="checkbox"] {
        margin-right: 10px;
        width: 20px;
    }

    /* APPLY BUTTON */
    .button-apply, 
    .button-clear{
        width: 80px;
        margin-top: 12px;
        border: 1px solid #000;
        margin-right: 10px;
        font-size: 16px;
        font-weight: 600;
    }

    .button-apply:hover,
    .button-clear:hover{
        background-color: #e0a800;
        border-color: #e0a800;
        color: #ffffff;
    }

    /* CARD AUCTION */
    .col-md-9{
        padding-left: 20px !important;
    }

    .row-cols-md-2 > * {
        padding: 8px !important;
    }

    .auction-card {
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid #ddd;
    }

    .auction-img{
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    .card-body{
        padding: 14px 16px;
    }

    .auction-card:hover{
        transform: translateY(-5px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
    }

    /* TITLE */
    .card-tittle{
        font-size: 16px;
        font-weight: 700;
    }

    /* DESCRIPTION */
    .card-text{
        font-size: 13px;
        color: #555;
        margin-bottom: 6px;
    }

    /* COUNTDOWN BOX */
    .countdown-box{
        display: flex;
        gap: 8px;
        margin-bottom: 12px;
        margin-top: 10px;
    }

    .count-item{
        flex-grow: 1;
        width: auto;
        text-align: center;
        background: #f5f5f5;
        padding: 6px 0;
        border-radius: 6px;
    }

    .count-item:nth-child(1),
    .count-item:nth-child(2),
    .count-item:nth-child(3),
    .count-item:nth-child(4) {
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

    /* BID BUTTON */
    .bid-btn{
        display: block;
        width: 100%;
        background-color: #ffffff;
        font-size: 20px;
        font-weight: 600;
        border-radius: 6px;
        border: 1px solid #000;
        padding: 8px 16px;
        transition: .2s ease;
    }

    .bid-btn:hover {
        background-color: #e0a800;
        border-color: #e0a800;
        color: #ffffff;
    }

    /* GRID GAP FIX */
    .row {
        row-gap: 30px;
    }

    .home-subtitle{
        padding-left: 12px;
    }

    /* SHOW MORE BUTTON */
    .show-more-btn {
        margin-top: 25px;
        padding: 10px 35px;
        border-radius: 50px;
        border: 1px solid #444;
        background: transparent;
        transition: .3s;
    }

    .show-more-btn:hover {
        background: #444;
        color: white;
    }
</style>
<div class="row mt-4">
    <div class="col-md-3">
        <div class="filter-box mb-4">
            <form method="GET" action="">
                <div class="filter-tittle"><strong>Filter Category: </strong></div>
                
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

        <h2 class="home-subtitle mb-4">Auction List</h2>
     
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
<br><br><br>
