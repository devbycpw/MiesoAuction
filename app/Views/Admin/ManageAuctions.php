<div class="container py-4">
    <h2 class="mb-4">All Auctions List (Admin View)</h2>

    <?php if(Session::get("success")): ?>
        <div class="alert alert-success"><?= Session::get("success"); Session::unset("success"); ?></div>
    <?php endif; ?>
    <?php if(Session::get("error")): ?>
        <div class="alert alert-danger"><?= Session::get("error"); Session::unset("error"); ?></div>
    <?php endif; ?>
    
    <?php if (!empty($auctions)): ?>
        
        <?php foreach ($auctions as $auction): ?>

            <div class="card mb-4 shadow-sm border-light">
                <div class="card-header bg-light text-dark fw-bold">
                    Auction ID: <?= htmlspecialchars($auction['id']) ?> - <?= htmlspecialchars($auction['title']) ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center">
                            <?php if ($auction['image']): ?>
                                <img src="<?= BASE_URL ?>assets/uploads/auction_images/<?= htmlspecialchars($auction['image']) ?>" 
                                     alt="<?= htmlspecialchars($auction['title']) ?>" 
                                     class="img-fluid rounded" style="max-height:150px; width: auto; object-fit: cover;">
                            <?php else: ?>
                                <div class="bg-light p-4 rounded text-muted">No Image</div>
                            <?php endif; ?>
                        </div>

                        <div class="col-md-9">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <th style="width: 25%;">Category</th>
                                    <td><?= htmlspecialchars($auction['category_name']) ?></td>
                                    <th style="width: 20%;">Start Time</th>
                                    <td><?= htmlspecialchars($auction['start_time']) ?></td>
                                </tr>
                                <tr>
                                    <th>Seller Name</th>
                                    <td><?= htmlspecialchars($auction['seller_name']) ?></td>
                                    <th>End Time</th>
                                    <td><?= htmlspecialchars($auction['end_time']) ?></td>
                                </tr>
                                <tr>
                                    <th>Starting Price</th>
                                    <td class="fw-bold text-info">$<?= number_format($auction['starting_price'], 2) ?></td>
                                    <th>Status</th>
                                    <td>
                                        <?php 
                                            // Menampilkan badge status
                                            $status_class = match ($auction['status']) {
                                                'pending' => 'bg-warning text-dark',
                                                'active' => 'bg-primary',
                                                'sold' => 'bg-success',
                                                'rejected' => 'bg-danger',
                                                'closed' => 'bg-secondary',
                                                default => 'bg-info',
                                            };
                                            echo '<span class="badge ' . $status_class . '">' . ucfirst(htmlspecialchars($auction['status'])) . '</span>';
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            
                            <div class="d-flex justify-content-end gap-2">
                                <a href="<?= BASE_URL ?>auction/show/<?= htmlspecialchars($auction['id']) ?>" 
                                   class="btn btn-primary btn-sm">
                                   View Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
        
    <?php else: ?>
        <div class="alert alert-info" role="alert">
            No auctions found in the system.
        </div>
    <?php endif; ?>
</div>