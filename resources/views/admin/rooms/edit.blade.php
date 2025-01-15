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
                        <label for="stay_id" class="form-label">Stay</label>
                        <select class="form-control" id="edit-stay_id" name="stay_id" required>
                            <option value="" disabled selected>Select a stay</option>
                            @foreach ($stays as $stay)
                                <option value="{{ $stay->id }}">{{ $stay->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Image Upload -->
                    <div class="mb-3">
                        <label for="images" class="form-label">Images</label>
                        <input type="file" class="form-control" id="images" name="images[]"  multiple>
                    </div>

                    <div class="mb-3">
                        <label for="images" class="form-label">images</label>
                        <input type="file" class="form-control" id="edit-images" name="images[]"  multiple>
                    </div>

                    <div class="mb-3">
                        <label for="banner" class="form-label">Banner</label>
                        <input type="file" class="form-control" id="edit-banner" name="banner" >
                    </div>

                    <div class="mb-3">
                        <label for="main_pic" class="form-label">Card Pic</label>
                        <input type="file" class="form-control" id="edit-main_pic" name="main_pic" >
                    </div>

                    <!-- Beds -->
                    <div class="mb-3">
                        <label for="beds" class="form-label">Beds</label>
                        <input type="number" class="form-control" id="edit-beds" name="beds" required
                            min="1">
                    </div>

                    <!-- Price per Night -->
                    <div class="mb-3">
                        <label for="pricepernight" class="form-label">Price per Night</label>
                        <input type="number" step="0.01" class="form-control" id="edit-pricepernight"
                            name="pricepernight" required min="0">
                    </div>

                    <!-- Room Number -->
                    <div class="mb-3">
                        <label for="room_number" class="form-label">Room Number</label>
                        <input type="text" class="form-control" id="edit-room_number" name="room_number" required>
                    </div>

                    <!-- Availability -->
                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability</label>
                        <select class="form-control" id="edit-availability" name="availability" required>
                            <option value="1">Available</option>
                            <option value="0">Not Available</option>
                        </select>
                    </div>

                    <!-- AC Availability -->
                    <div class="mb-3">
                        <label for="has_ac" class="form-label">Air Conditioning</label>
                        <select class="form-control" id="edit-has_ac" name="has_ac" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <!-- WiFi Availability -->
                    <div class="mb-3">
                        <label for="has_wifi" class="form-label">Wi-Fi</label>
                        <select class="form-control" id="edit-has_wifi" name="has_wifi" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <!-- TV Availability -->
                    <div class="mb-3">
                        <label for="has_tv" class="form-label">TV</label>
                        <select class="form-control" id="edit-has_tv" name="has_tv" required>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
