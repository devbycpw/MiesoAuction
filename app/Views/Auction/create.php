<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-body">
            <h3 class="mb-4">Create New Auction</h3>

            <form action="<?= BASE_URL ?>auction/store" method="POST" enctype="multipart/form-data">

                <!-- Title -->
                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" required>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4"></textarea>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                    <img id="preview" class="mt-3 rounded" style="max-width:200px; display:none;">
                </div>

                <!-- Starting Price -->
                <div class="mb-3">
                    <label class="form-label">Starting Price (Rp) <span class="text-danger">*</span></label>
                    <input type="number" name="starting_price" class="form-control" required>
                </div>

                <!-- Start Time -->
                <div class="mb-3">
                    <label class="form-label">Start Time</label>
                    <input type="datetime-local" name="start_time" class="form-control">
                </div>

                <!-- End Time -->
                <div class="mb-3">
                    <label class="form-label">End Time</label>
                    <input type="datetime-local" name="end_time" class="form-control">
                </div>

                <!-- ACTION -->
                <div class="d-flex justify-content-between">
                    <a href="<?= BASE_URL ?>auctions" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Create Auction</button>
                </div>

            </form>
        </div>
    </div>
</div>
