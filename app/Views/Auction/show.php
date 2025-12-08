<?php 
    // Ambil ID pengguna saat ini dan cek kepemilikan di awal
    $current_user_id = Auth::user('id'); 
    $auction_owner_id = $auction["user_id"] ?? null; 
    $is_owner = ($current_user_id == $auction_owner_id);
    $is_active = ($auction['status'] === 'active');
?>

<div class="container py-4">

    <a href="<?= BASE_URL ?>auctions" class="btn btn-secondary mb-3">
        &larr; Back to Auctions
    </a>

    <div class="row">
        <div class="col-md-5">
            <img src="<?= BASE_URL ?>assets/uploads/auction_images/<?= htmlspecialchars($auction['image']) ?>" 
                 class="img-fluid rounded shadow" alt="<?= htmlspecialchars($auction['title']) ?>">
        </div>

        <div class="col-md-7">

            <h2 class="fw-bold"><?= htmlspecialchars($auction['title']) ?></h2>
            <p class="text-muted"><?= htmlspecialchars($auction['description']) ?></p>

            <table class="table">
                <tr>
                    <th>Seller</th>
                    <td> <?= htmlspecialchars($auction['seller_name']) ?></td>
                </tr>
                <tr>
                    <th>Open Price</th>
                    <td>$<?= number_format($auction['starting_price'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Current Price</th>
                    <td class="fw-bold text-success">
                        $<?= number_format($auction['current_price'], 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <th>Auction Deadline</th>
                    <td><?= htmlspecialchars($auction['end_time']) ?></td>
                </tr>
            </table>

            <hr>

            <?php if(Session::get("error")): ?>
                <div class="alert alert-danger"><?= Session::get("error"); Session::unset("error"); ?></div>
            <?php endif; ?>
            <?php if(Session::get("success")): ?>
                <div class="alert alert-success"><?= Session::get("success"); Session::unset("success"); ?></div>
            <?php endif; ?>

            <?php if (Auth::isClient()): ?>

                <?php if ($is_owner): ?>
                    <?php if ($auction['status'] == 'pending'): ?>
                        <h4>Seller Actions</h4>
                        <div class="d-grid gap-2 mt-2">
                            <a href="<?=BASE_URL?>auction/edit/<?= $auction['id'] ?>" class="btn btn-warning">Edit Auction</a>
                            <a href="<?=BASE_URL?>auction/delete/<?= $auction['id'] ?>" class="btn btn-danger">Delete Auction</a>
                        </div>
                    <?php else: ?>
                         <div class="alert alert-secondary">Your auction is <?= ucfirst($auction['status']) ?>.</div>
                    <?php endif; ?>

                <?php else: ?>
                    <?php if ($is_active): ?>
                        <h4>Place a Bid</h4>
                        <form action="<?= BASE_URL ?>bids/placeBid" method="POST">
                            <input type="hidden" name="auction_id" value="<?= $auction['id'] ?>">

                            <div class="mb-3">
                                <label for="bid_amount" class="form-label">Your Bid</label>
                                <input type="number" name="bid_amount" id="bid_amount" class="form-control"
                                       placeholder="Enter amount greater than current price" required>
                            </div>
                            
                            <button class="btn btn-success w-100">Submit Bid</button>
                        </form>
                    <?php else: ?>
                        <div class="alert alert-info">Bidding is closed for this auction (Status: <?= ucfirst($auction['status']) ?>).</div>
                    <?php endif; ?>
                
                <?php endif; ?>

            <?php elseif (Auth::isAdmin()): ?>
                <h4>Admin Actions</h4>
                <?php if ($auction['status'] == 'pending'): ?>
                    <div class="d-grid gap-2 mt-2">
                        <a href="<?=BASE_URL?>admin/auction/approve/<?=$auction['id']?>" class="btn btn-success">Approve</a>
                        <a href="<?=BASE_URL?>admin/auction/reject/<?=$auction['id']?>" class="btn btn-danger">Reject</a>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">Status: <?= ucfirst($auction['status']) ?>.</div>
                <?php endif; ?>

            <?php elseif (!Auth::check()): ?>
                <div class="alert alert-warning text-center mt-3">
                    <p class="mb-2">You must log in to place a bid.</p>
                    <a href="<?=BASE_URL?>login" class="btn btn-success w-100">Login to Place a Bid</a>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>