<!-- Add Stay Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStayModalLabel">Add New</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" action="{{ route('stays.store') }} " method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="images" class="form-label">images</label>
                        <input type="file" class="form-control" id="images" name="images[]" required multiple>
                    </div>

                    <div class="mb-3">
                        <label for="banner" class="form-label">Banner</label>
                        <input type="file" class="form-control" id="" name="banner" required>
                    </div>

                    <div class="mb-3">
                        <label for="main_pic" class="form-label">Card Pic</label>
                        <input type="file" class="form-control" id="" name="main_pic" required>
                    </div>


                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="">Select Type</option>
                            <option value="hotels">Hotels</option>
                            <option value="apartments">Apartments</option>
                            <option value="chales">Chales</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="font-weight-bold text-black">City</label>
                        <select id="city" name="city" class="form-control">
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
                        <label for="streetaddress" class="form-label">Street Address</label>
                        <input type="text" class="form-control" id="streetaddress" name="streetaddress" required>
                    </div>



                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                    </div>

                    <div class="mb-3">
                        <label for="numberofbedrooms" class="form-label">Number of Bedrooms</label>
                        <input type="number" class="form-control" id="numberofbedrooms" name="numberofbedrooms" required>
                    </div>

                    <div class="mb-3">
                        <label for="maxnumofguests" class="form-label">Maximum Number of Guests</label>
                        <input type="number" class="form-control" id="maxnumofguests" name="maxnumofguests" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
