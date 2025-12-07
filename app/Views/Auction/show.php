<div class="container py-4">

    <a href="<?= BASE_URL ?>auctions" class="btn btn-secondary mb-3">
        &larr; Back to Auctions
    </a>

    <div class="row">
        <!-- LEFT: IMAGE -->
        <div class="col-md-5">
            <img src="<?= BASE_URL ?>assets/uploads/auction_images/<?= $auction['image'] ?>" 
                 class="img-fluid rounded shadow" alt="<?= $auction['title'] ?>">
        </div>

        <!-- RIGHT: DETAILS -->
        <div class="col-md-7">

            <h2 class="fw-bold"><?= $auction['title'] ?></h2>
            <p class="text-muted"><?= $auction['description'] ?></p>

            <table class="table">
                <tr>
                    <th>Seller</th>
                    <td> <?= $auction['seller_name'] ?></td>
                </tr>
                <tr>
                    <th>Open Price</th>
                    <td>Rp <?= number_format($auction['starting_price'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Current Price</th>
                    <td class="fw-bold text-success">
                        Rp <?= number_format($auction['current_price'], 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <th>Auction Deadline</th>
                    <td><?= $auction['end_time'] ?></td>
                </tr>
            </table>

            <hr>

            <!-- FLASH MESSAGE -->
            <?php if(Session::get("error")): ?>
                <div class="alert alert-danger"><?= Session::get("error"); Session::unset("error"); ?></div>
            <?php endif; ?>

            <?php if(Session::get("success")): ?>
                <div class="alert alert-success"><?= Session::get("success"); Session::unset("success"); ?></div>
            <?php endif; ?>
            <?php if(!Auth::isAdmin()): ?>
            <!-- BID FORM -->
            <h4>Place a Bid</h4>
            <form action="<?= BASE_URL ?>bids/placeBid" method="POST">
                <input type="hidden" name="auction_id" value="<?= $auction['id'] ?>">

                <div class="mb-3">
                    <label for="bid_amount" class="form-label">Your Bid</label>
                    <input type="number" name="bid_amount" id="bid_amount" class="form-control"
                           placeholder="Enter amount greater than current price" required>
                </div>
            <?php endif; ?>
                <?php if (Auth::isClient()): ?>
                    <button class="btn btn-success w-100">Submit Bid</button>
                <?php endif; ?>
            </form>
            <?php if (Auth::isAdmin()): ?>
                    <a href="<?=BASE_URL?>admin/auction/approve/<?=$auction['id']?>" class="btn btn-success w-100">Accept</a>
                    <a href="<?=BASE_URL?>admin/auction/reject/<?=$auction['id']?>" class="btn btn-success w-100">Reject</a>
            <?php endif; ?>

            <?php if (!Auth::check()): ?>
                    <a href="<?=BASE_URL?>login" class="btn btn-success w-100">Submit Bid</a>
            <?php endif; ?>
        </div>
    </div>
</div>
