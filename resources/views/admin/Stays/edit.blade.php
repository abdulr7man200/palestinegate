<!-- Edit Stay Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStayModalLabel">Edit</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    @csrf

                    <input type="hidden" id="edit_id" name="id">

                    <div class="mb-3">
                        <label for="images" class="form-label">images</label>
                        <input type="file" class="form-control" id="edit-images" name="images[]"  multiple>
                    </div>


                    <div class="mb-3">
                        <label for="edit-name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit-name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" id="edit-type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="hotels">Hotels</option>
                            <option value="apartments">Apartments</option>
                            <option value="chales">Chales</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="edit-description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit-description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="font-weight-bold text-black">City</label>
                        <select id="edit-city" name="city" class="form-control">
                          <option value="">Select City</option>
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

                    <div class="mb-3">
                        <label for="edit-streetaddress" class="form-label">Street Address</label>
                        <input type="text" class="form-control" id="edit-streetaddress" name="streetaddress" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-amenities" class="form-label">Amenities</label>
                        <textarea class="form-control" id="edit-amenities" name="amenities" rows="2" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="edit-price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="edit-price" name="price" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-numberofbedrooms" class="form-label">Number of Bedrooms</label>
                        <input type="number" class="form-control" id="edit-numberofbedrooms" name="numberofbedrooms" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-maxnumofguests" class="form-label">Maximum Number of Guests</label>
                        <input type="number" class="form-control" id="edit-maxnumofguests" name="maxnumofguests" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
