@extends('admin.layouts.app')
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row m-t-30">
                    <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
                        <h3 class="mb-0">Stays Management</h3>
                        <button class="btn btn-primary" id="addNewStayBtn" data-toggle="modal" data-target="#addModal">Add
                            New</button>
                    </div>

                    <div class="col-md-12">
                        <!-- DATA TABLE-->
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0 text-white">Stays</h4>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    {!! $dataTable->table(['class' => 'table table-hover table-bordered table-striped mb-0'], true) !!}
                                </div>
                            </div>
                        </div>
                        <!-- END DATA TABLE-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.stays.create')
    @include('admin.stays.edit')
@endsection
@push('scripts')

<script>
    // Function to toggle the fields based on the type selection
    function toggleEditFields() {
      const editType = document.getElementById('edit-type');
      const isHotel = editType.value === 'hotels';
      const priceField = document.getElementById('edit-price');
      const bedroomsField = document.getElementById('edit-numberofbedrooms');
      const guestsField = document.getElementById('edit-maxnumofguests');

      // Toggle disabled attribute
      priceField.disabled = isHotel;
      bedroomsField.disabled = isHotel;
      guestsField.disabled = isHotel;

      // Optional: Toggle required attribute
      priceField.required = !isHotel;
      bedroomsField.required = !isHotel;
      guestsField.required = !isHotel;
    }

    // Wait until the DOM is fully loaded
    document.addEventListener("DOMContentLoaded", function () {
      // Check on initial load in case the existing value is "hotels"
      toggleEditFields();

      // Listen for changes on the edit-type select element
      document.getElementById('edit-type').addEventListener('change', toggleEditFields);
    });
  </script>


    <script>
        document.getElementById('type').addEventListener('change', function() {
            const isHotel = this.value === 'hotels';
            const priceField = document.getElementById('price');
            const bedroomsField = document.getElementById('numberofbedrooms');
            const guestsField = document.getElementById('maxnumofguests');

            // Toggle 'disabled' attribute
            priceField.disabled = isHotel;
            bedroomsField.disabled = isHotel;
            guestsField.disabled = isHotel;

            // Optional: Toggle required attribute
            priceField.required = !isHotel;
            bedroomsField.required = !isHotel;
            guestsField.required = !isHotel;
        });
    </script>

    {!! $dataTable->scripts() !!}

    <script src="{{ asset('ajax/Stays.js') }}?={{ time() }}"></script>
@endpush
