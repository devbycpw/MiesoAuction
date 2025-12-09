<div class="AuctionsList-page">

    <div class="ButtonBackHome">
        <a href="<?= BASE_URL ?>" class="btn btn-secondary mb-3">
            &larr; Back to Home
        </a>
    </div>

    <div class="row mt-4">

        <!-- CARD KANAN -->
        <div class="col-12">

            <h2 class="home-subtitle mb-4"><b>My Auctions</b></h2>

            <?php if (empty($data)): ?>
                <div class="alert alert-info">You haven't created any auctions yet.</div>
            <?php else: ?>

                <!-- CARD LIST -->
                <div class="row row-cols-1 row-cols-md-2 g-2">
                    <?php foreach($data as $d): ?>
                        <div class="col-md-6">
                            <div class="card auction-card h-100">
                                
                                <!-- IMAGE -->
                                <?php if(!empty($d['image'])): ?>
                                    <img 
                                        src="<?= BASE_URL ?>assets/uploads/auction_images/<?= $d['image'] ?>" 
                                        alt="<?= htmlspecialchars($d['title']) ?>"
                                        class="auction-img"
                                    >
                                <?php endif; ?>

                                <div class="card-body">

                                    <!-- TITLE -->
                                    <h5 class="card-title">
                                        <?= htmlspecialchars($d['title']) ?>
                                    </h5>

                                    <!-- DESCRIPTION -->
                                    <p class="card-text">
                                        <?= htmlspecialchars($d['description'] ?? '-') ?>
                                    </p>

                                    <!-- STATUS -->
                                    <?php 
                                        $badge = "secondary";
                                        if ($d['status'] == 'open') $badge = "success";
                                        if ($d['status'] == 'closed') $badge = "danger";
                                    ?>
                                    <span class="badge bg-<?= $badge ?>">
                                        <?= strtoupper($d['status']) ?>
                                    </span>

                                    <hr>

                                    <!-- HIGHEST BID -->
                                    <p class="card-text mb-1">
                                        <strong>Highest Bid:</strong>
                                        <?= $d['highest_bid'] 
                                            ? "$" . number_format($d['highest_bid'], 2)
                                            : "-" 
                                        ?>
                                    </p>

                                    <!-- TOTAL BIDS -->
                                    <p class="card-text mb-1">
                                        <strong>Total Bids:</strong> <?= $d['total_bids'] ?>
                                    </p>

                                    <!-- END TIME -->
                                    <p class="text-muted small">
                                        <strong>Ends:</strong> 
                                        <?= date("d M Y H:i", strtotime($d['end_time'])) ?>
                                    </p>

                                </div>

                                <div class="card-footer bg-white text-center">

                                    <!-- VIEW DETAIL -->
                                    <a 
                                        href="<?= BASE_URL ?>auction/show/<?= $d['id'] ?>"
                                        class="btn bid-btn w-100 mb-2"
                                    >
                                        View Auction
                                    </a>

                                    <!-- EDIT BUTTON ONLY IF OPEN -->
                                    <?php if ($d['status'] == 'open'): ?>
                                        <a 
                                            href="<?= BASE_URL ?>auction/edit/<?= $d['id'] ?>"
                                            class="btn btn-warning w-100"
                                        >
                                            Edit Auction
                                        </a>
                                    <?php endif; ?>

                                </div>

                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            <?php endif; ?>

        </div>
    </div>

</div>

<br><br><br>
