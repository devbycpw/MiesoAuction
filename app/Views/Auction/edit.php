<div class="container mt-5">
    <div class="card shadow border-0">
        <div class="card-body">
            
            <h3 class="mb-4">Edit Auction</h3>

            <form action="<?= BASE_URL ?>auction/update/<?= $auction['id'] ?>" 
                  method="POST" 
                  enctype="multipart/form-data">

                <input type="hidden" name="old_image" value="<?= $auction['image'] ?>">

                <div class="mb-3">
                    <label class="form-label">Title <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="title" 
                           class="form-control" 
                           value="<?= htmlspecialchars($auction['title']) ?>" 
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category_id" class="form-select">
                        <option value="">-- Select Category --</option>

                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id']; ?>"
                                <?= ($cat['id'] == $auction['category_id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']); ?>
                            </option>
                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4"><?= 
                        htmlspecialchars($auction['description']) 
                    ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Image</label>
                    <input type="file" 
                           name="image" 
                           class="form-control" 
                           accept="image/*" 
                           onchange="previewImage(event)">

                    <p class="mt-2">Current Image:</p>
                    <img id="preview" 
                         src="<?= BASE_URL ?>assets/uploads/auction_images/<?= $auction['image'] ?>" 
                         class="mt-1 rounded"
                         style="max-width: 200px;">
                </div>

                <div class="mb-3">
                    <label class="form-label">Starting Price (Rp) <span class="text-danger">*</span></label>
                    <input type="number" 
                           name="starting_price" 
                           class="form-control" 
                           value="<?= $auction['starting_price'] ?>" 
                           required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Start Time</label>
                    <input type="datetime-local" 
                           name="start_time" 
                           class="form-control"
                           value="<?= $auction['start_time'] ? date('Y-m-d\TH:i', strtotime($auction['start_time'])) : '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">End Time</label>
                    <input type="datetime-local" 
                           name="end_time" 
                           class="form-control"
                           value="<?= $auction['end_time'] ? date('Y-m-d\TH:i', strtotime($auction['end_time'])) : '' ?>">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="<?= BASE_URL ?>auctions" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update Auction</button>
                </div>

            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    let img = document.getElementById('preview');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.display = "block";
}
</script>
