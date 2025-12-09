<div class="container py-4 admin-payments">
    <h2>All Payments (<?= count($data) ?>)</h2>

    <?php if (empty($data)): ?>
        <div class="alert text-center py-4 mb-0 admin-empty-state">
            No payments are currently pending verification.
        </div>
    <?php else: ?>
        <table class="table table-striped table-hover admin-payments-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Auction Title</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Date Paid</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $payment): ?>
                    <tr>
                        <td><?= htmlspecialchars($payment['id']) ?></td>
                        <td><?= htmlspecialchars($payment['auction_title']) ?></td>
                        <td><?= htmlspecialchars($payment['user_name']) ?> (<?= htmlspecialchars($payment['user_email']) ?>)</td>
                        <td>$<?= number_format($payment['amount'], 2) ?></td>
                        <td><?= htmlspecialchars($payment['created_at']) ?></td>
                        <?php
                            $cls = match ($payment['status']) {
                                'pending' => 'badge-pending',
                                'verified' => 'badge-approved',
                                'rejected' => 'badge-rejected',
                                default => 'bg-secondary'
                            };
                        ?>
                        <td><span class="badge <?= $cls ?>"><?= ucfirst(htmlspecialchars($payment['status'])) ?></span></td>
                        <td>
                            <a href="<?= BASE_URL ?>admin/showPayment/<?= $payment['id'] ?>" class="btn btn-primary btn-sm admin-show-detail">Show Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
