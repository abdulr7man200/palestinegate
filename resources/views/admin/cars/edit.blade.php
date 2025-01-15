<!-- Edit User Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label for="images" class="form-label">images</label>
                        <input type="file" class="form-control" id="edit-images" name="images[]"  multiple>
                    </div>

                    <div class="mb-3">
                        <label for="banner" class="form-label">Banner</label>
                        <input type="file" class="form-control" id="edit-banner" name="banner">
                    </div>

                    <div class="mb-3">
                        <label for="main_pic" class="form-label">Card Pic</label>
                        <input type="file" class="form-control" id="edit-main_pic" name="main_pic" >
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="edit-type" name="type" required>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label">Model</label>
                        <input type="text" class="form-control" id="edit-model" name="model" required>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" class="form-control" id="edit-year" name="year" required>
                    </div>

                    <div class="mb-3">
                        <label for="price_per_day" class="form-label">Price Per Day</label>
                        <input type="text" class="form-control" id="edit-price_per_day" name="price_per_day" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="edit-description" name="description" required>
                    </div>



                    <div class="mb-3">
                        <label for="edit-location" class="font-weight-bold text-black">Location</label>
                        <select id="edit-location" name="location" class="form-control">
                          <option value="">Select Location</option>
                          <option value="jerusalem">Jerusalem</option>
                          <option value="nablus">Nablus</option>
                          <option value="ramallah">Ramallah</option>
                          <option value="bethlehem">Bethlehem</option>
                          <option value="hebron">Hebron</option>
                          <option value="gaza">Gaza</option>
                          <option value="tulkarem">Tulkarem</option>
                          <option value="jenin">Jenin</option>
                          <option value="tubas">Tubas</option>
                          <option value="salfit">Salfit</option>
                          <option value="qalqilya">Qalqilya</option>
                          <option value="jericho">Jericho</option>
                          <option value="ramallah">Ramallah</option>
                          <option value="deir al-balah">Deir al-Balah</option>
                          <option value="khan_younis">Khan Younis</option>
                          <option value="rafah">Rafah</option>
                        </select>
                      </div>
                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
