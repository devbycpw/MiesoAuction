
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="row g-0">

            <div class="col-md-5">
                <img src="<?= BASE_URL ?>/assets/img/auction<?= $auction['image']; ?>" 
                     class="img-fluid rounded-start" alt="Auction Image"
                     style="object-fit: cover; height: 100%;">
            </div>

            <div class="col-md-7">
                <div class="card-body">
                    <h3 class="card-title mb-3"><?= htmlspecialchars($auction['title']); ?></h3>

                    <p class="text-muted"><?= htmlspecialchars($auction['description']); ?></p>

                    <hr>

                    <h5 class="mb-3">Auction Information</h5>

                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 180px;">Auction ID</th>
                            <td><?= $auction['id']; ?></td>
                        </tr>
                        <tr>
                            <th>Category</th>
                            <td><?= $auction['category_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Starting Price</th>
                            <td>Rp <?= number_format($auction['starting_price']); ?></td>
                        </tr>
                        <tr>
                            <th>Final Price</th>
                            <td>
                                <?= $auction['final_price'] 
                                    ? "Rp " . number_format($auction['final_price']) 
                                    : "<span class='text-muted'>Not finished</span>"; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php if ($auction['status'] === 'active'): ?>
                                    <span class="badge bg-success">Active</span>
                                <?php elseif ($auction['status'] === 'closed'): ?>
                                    <span class="badge bg-danger">Closed</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary"><?= $auction['status']; ?></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Start Time</th>
                            <td><?= $auction['start_time']; ?></td>
                        </tr>
                        <tr>
                            <th>End Time</th>
                            <td><?= $auction['end_time']; ?></td>
                        </tr>
                    </table>
                    <hr>
                    <h5 class="mb-3">Seller Information</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 180px;">Seller Name</th>
                            <td><?= $auction['seller_name']; ?></td>
                        </tr>
                        <tr>
                            <th>Seller Email</th>
                            <td><?= $auction['seller_email']; ?></td>
                        </tr>
                    </table>
                    <hr>

                    <h5 class="mb-3">Winner Information</h5>
                    <table class="table table-borderless">
                        <tr>
                            <th style="width: 180px;">Winner Name</th>
                            <td><?= $auction['winner_name'] ?: "<span class='text-muted'>No winner yet</span>"; ?></td>
                        </tr>
                        <tr>
                            <th>Winner Email</th>
                            <td><?= $auction['winner_email'] ?: "<span class='text-muted'>No winner yet</span>"; ?></td>
                        </tr>
                    </table>

                    <?php if (Auth::isClient()): ?>
                        <a href="<?= BASE_URL ?>auction/show/<?= $d['id'] ?>" class="btn btn-warning btn-sm">Bid Now</a>
                    <?php endif; ?>

                    <?php if (Auth::isAdmin()): ?>
                        <div class="mt-4">
                            <a href="<?= BASE_URL ?>auctions" class="btn btn-secondary">Back</a>
                            <a href="<?= BASE_URL ?>auction/edit/<?= $auction['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="<?= BASE_URL ?>auction/delete/<?= $auction['id']; ?>" 
                            onclick="return confirm('Are you sure?')" 
                            class="btn btn-danger">Delete</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

