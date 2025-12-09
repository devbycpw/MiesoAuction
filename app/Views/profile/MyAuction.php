<div class="AuctionsList-page">
    <div class="row mt-4">

        <div class="col-12">
            
            <div class="d-flex justify-content-between align-items-center mb-4 ps-3 pe-3">
                <h2 class="home-subtitle mb-0"><b>My Auctions</b></h2>
                <a href="<?=BASE_URL?>auction/create" class="btn btn-primary">
                    + Create New Auction
                </a>
            </div>
            
            <?php if (empty($auctions)): ?>
                <div class="alert alert-info mx-3">You haven't created any auctions yet.</div>
            <?php else: ?>

                <div class="row row-cols-1 row-cols-md-3 g-2">
                    <?php foreach($auctions as $d): ?>
                        <div class="col"> <div class="card auction-card h-100">
                                
                                <?php if(!empty($d['image'])): ?>
                                    <img 
                                        src="<?= BASE_URL ?>assets/uploads/auction_images/<?= htmlspecialchars($d['image']) ?>" 
                                        alt="<?= htmlspecialchars($d['title']) ?>"
                                        class="auction-img"
                                    >
                                <?php endif; ?>

                                <div class="card-body">

                                    <h5 class="card-title">
                                        <?= htmlspecialchars($d['title']) ?>
                                    </h5>

                                    <p class="card-text">
                                        <?= htmlspecialchars(substr($d['description'] ?? '-', 0, 100)) . (strlen($d['description'] ?? '') > 100 ? '...' : '') ?>
                                    </p>

                                    <?php 
                                        $status = $d['status'] ?? 'pending';
                                        $badge_class = "secondary";
                                        if ($status == 'active') $badge_class = "success";
                                        if ($status == 'closed' || $status == 'rejected') $badge_class = "danger";
                                        if ($status == 'sold') $badge_class = "primary";
                                    ?>
                                    <span class="badge bg-<?= $badge_class ?>">
                                        <?= strtoupper($status) ?>
                                    </span>

                                    <hr>

                                    <p class="card-text mb-1">
                                        <strong>Highest Bid:</strong>
                                        <?= $d['highest_bid'] 
                                            ? "$" . number_format($d['highest_bid'], 2)
                                            : "$-" 
                                        ?>
                                    </p>

                                    <p class="card-text mb-1">
                                        <strong>Total Bids:</strong> <?= $d['total_bids'] ?? 0 ?>
                                    </p>

                                    <p class="text-muted small">
                                        <strong>Ends:</strong> 
                                        <?= date("d M Y H:i", strtotime($d['end_time'] ?? 'now')) ?>
                                    </p>

                                </div>

                                <div class="card-footer bg-white text-center">
                                    <a href="<?= BASE_URL ?>auction/show/<?= $d['id'] ?>"class="btn bid-btn w-100 mb-2">View Auction</a>
                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>