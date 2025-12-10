<?php
$price = $auction["final_price"] ?? $auction["highest_bid"] ?? $auction["starting_price"] ?? 0;
$endDate = !empty($auction["end_time"]) ? date("d M Y", strtotime($auction["end_time"])) : "-";
$paymentStatus = $payment["status"] ?? "unpaid";
$paymentProof = $payment["payment_proof"] ?? null;
$paymentDate = $payment["updated_at"] ?? $payment["created_at"] ?? null;
$paymentDateUi = $paymentDate ? date("d M Y", strtotime($paymentDate)) : "-";
$isPaid = $paymentStatus === "verified";
?>

<div class="transaction-page container py-4">
    <?php if (Session::get('success')): ?>
        <div class="alert alert-success"><?= htmlspecialchars(Session::get('success')); Session::unset('success'); ?></div>
    <?php endif; ?>
    <?php if (Session::get('error')): ?>
        <div class="alert alert-danger"><?= htmlspecialchars(Session::get('error')); Session::unset('error'); ?></div>
    <?php endif; ?>
    <a href="<?= BASE_URL ?>myBids" class="transaction-back"><i class="bi bi-arrow-left"></i> Back</a>

    <div class="transaction-grid">
        <div class="transaction-image">
            <?php if (!empty($auction["image"])): ?>
                <img src="<?= BASE_URL ?>assets/uploads/auction_images/<?= htmlspecialchars($auction["image"]); ?>" alt="<?= htmlspecialchars($auction["title"]); ?>">
            <?php else: ?>
                <div class="img-placeholder">No Image</div>
            <?php endif; ?>
        </div>

        <div class="transaction-detail">
            <div class="transaction-header">
                <div>
                    <p class="eyebrow"><i class="bi bi-cash-coin me-1"></i>Transaction Detail</p>
                    <h2><?= htmlspecialchars($auction["title"]); ?></h2>
                    <p class="muted">Watch</p>
                </div>
                <span class="badge <?= $isPaid ? "badge-paid" : "badge-unpaid"; ?>">
                    <?= $isPaid ? "Paid" : "Unpaid"; ?>
                </span>
            </div>

            <div class="transaction-block">
                <h4>Auction Information</h4>
                <div class="info-row">
                    <span class="info-label"><i class="bi bi-cash-stack me-1"></i>Winning Bid</span>
                    <span class="info-value">$ <?= number_format($price, 2, ".", ","); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="bi bi-calendar3 me-1"></i>Date Auction</span>
                    <span class="info-value"><?= $endDate; ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label"><i class="bi bi-hammer me-1"></i>House</span>
                    <span class="info-value"><?= htmlspecialchars($auction["seller_name"] ?? "Unknown"); ?></span>
                </div>
            </div>

            <div class="transaction-block">
                <h4><?= $isPaid ? "Payment Detail" : "Payment Status"; ?></h4>

                <?php if ($isPaid): ?>
                    <div class="payment-box paid">
                        <div class="payment-row strong">
                            <span><i class="bi bi-check-circle-fill me-1"></i>Payment Complete</span>
                        </div>
                        <div class="payment-row">
                            <span><i class="bi bi-upc-scan me-1"></i>Transaction ID</span>
                            <span>TXN-<?= strtoupper(substr(md5($payment["id"] ?? "txn"), 0, 6)); ?></span>
                        </div>
                        <div class="payment-row">
                            <span><i class="bi bi-credit-card-2-front me-1"></i>Payment Method</span>
                            <span><?= htmlspecialchars($payment["payment_method"] ?? "QRIS"); ?></span>
                        </div>
                        <div class="payment-row">
                            <span><i class="bi bi-calendar-check me-1"></i>Payment Date</span>
                            <span><?= $paymentDateUi; ?></span>
                        </div>
                        <div class="payment-row strong total">
                            <span>Amount Paid</span>
                            <span>$ <?= number_format($price, 2, ".", ","); ?></span>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="payment-box pending">
                        <div class="payment-row strong">
                            <span><i class="bi bi-hourglass-split me-1"></i>Payment Pending</span>
                        </div>
                        <p class="muted small mb-2">Please complete your payment to finalize the auction winner.</p>
                        <button class="btn-pay" data-bs-toggle="modal" data-bs-target="#qrisModal">
                            Pay $<?= number_format($price, 2, ".", ","); ?> Now
                        </button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="transaction-upload">
        <form action="<?= BASE_URL ?>payment/upload/<?= htmlspecialchars($auction["id"]); ?>" method="post" enctype="multipart/form-data">
            <div class="upload-box">
                <?php if ($paymentProof): ?>
                    <img src="<?= BASE_URL ?>assets/uploads/payment_proof/<?= htmlspecialchars($paymentProof); ?>" alt="Payment proof" class="upload-preview" id="proofPreview">
                <?php else: ?>
                    <div class="upload-placeholder">
                        <div class="upload-icon">🖼</div>
                        <p class="muted">Upload your payment proof (jpg/jpeg/png/webp)</p>
                    </div>
                <?php endif; ?>
            </div>

        <?php if (!$isPaid): ?>
            <div class="upload-actions">
                <label class="btn-ghost mb-0">
                    Choose from File
                    <input id="proofInput" type="file" name="payment_proof" accept=".jpg,.jpeg,.png,.webp" hidden required>
                </label>
                <button id="uploadBtn" type="submit" class="btn-outline" <?= $isPaid ? "disabled" : ""; ?>>
                    Upload Image
                </button>
            </div>
        <?php endif; ?>
        </form>
    </div>
</div>

<!-- QRIS Modal -->
<div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qrisModalLabel">Pay with QRIS</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <img src="<?= BASE_URL ?>assets/img/qris.png" alt="QRIS code" class="w-100">
        <p class="mt-2 muted small">Scan this QR to pay the final amount, then upload your proof below.</p>
      </div>
    </div>
  </div>
</div>

<script>
  (function() {
    const input = document.getElementById("proofInput");
    const uploadBtn = document.getElementById("uploadBtn");
    const preview = document.getElementById("proofPreview");

    if (!input || !uploadBtn) return;
    if (!<?= $isPaid ? 'true' : 'false' ?>) {
      uploadBtn.disabled = true;
    }

    input.addEventListener("change", (e) => {
      const file = e.target.files?.[0];
      uploadBtn.disabled = !file;

      if (file && preview) {
        const reader = new FileReader();
        reader.onload = (ev) => {
          preview.src = ev.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  })();
</script>
