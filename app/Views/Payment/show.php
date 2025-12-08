<div class="container mt-5">

    <h3 class="mb-4">Payment Confirmation</h3>

    <div class="row">
        <!-- LEFT: IMAGE -->
        <div class="col-md-5">
            <img src="<?= BASE_URL ?>assets/uploads/auction_images/<?= $auction['image'] ?>" 
                 class="img-fluid rounded shadow" 
                 alt="<?= $auction['title'] ?>">
        </div>

        <!-- RIGHT: DETAILS -->
        <div class="col-md-7">

            <h2 class="fw-bold"><?= $auction['title'] ?></h2>
            <p class="text-muted"><?= $auction['description'] ?></p>

            <table class="table table-bordered">
                <tr>
                    <th>Seller</th>
                    <td><?= $auction['seller_name'] ?></td>
                </tr>
                <tr>
                    <th>Open Price</th>
                    <td>Rp <?= number_format($auction['starting_price'], 0, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Final Price</th>
                    <td class="fw-bold text-success">
                        Rp <?= number_format($auction['final_price'], 0, ',', '.') ?>
                    </td>
                </tr>
                <tr>
                    <th>Auction Deadline</th>
                    <td><?= $auction['end_time'] ?></td>
                </tr>
            </table>

            <hr>

            <!-- PAYMENT FORM -->
            <h4 class="fw-bold">Complete Your Payment</h4>
            <p>Please use QRIS to complete the transaction.</p>

            <form action="<?= BASE_URL ?>payment/create" 
                  method="POST" 
                  enctype="multipart/form-data" 
                  class="mt-3">

                <input type="hidden" name="auction_id" value="<?= $auction['id'] ?>">

                <!-- Amount -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Amount</label>
                    <input type="number" name="amount" 
                           class="form-control" 
                           value="<?= $auction['final_price'] ?>" 
                           readonly>
                </div>

                <!-- QRIS Button -->
                <div class="mb-3">
                    <button type="button" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#qrisModal">
                        Pay with QRIS
                    </button>
                </div>

                <!-- File Upload -->
                <div class="mb-3 mt-3">
                    <label class="form-label fw-semibold">Upload Payment Proof</label>
                    <input type="file" name="payment_proof" 
                           class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 mt-2">
                    Submit Payment
                </button>

            </form>

        </div>
    </div>
</div>

<!-- QRIS Modal -->
<div class="modal fade" id="qrisModal" tabindex="-1" aria-labelledby="qrisModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qrisModalLabel">QRIS Payment</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p>Scan this QR code using your payment app:</p>
        <img src="<?= BASE_URL ?>assets/img/qris.png" class="img-fluid" alt="QRIS">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
