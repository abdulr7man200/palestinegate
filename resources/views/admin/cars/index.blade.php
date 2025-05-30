@extends('admin.layouts.app')
@section('content')
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row m-t-30">
                <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
                    <h3 class="mb-0">Cars Management</h3>
                    <button class="btn btn-primary" id="addNewUserBtn" data-toggle="modal" data-target="#addModal">Add New</button>
                </div>

                <div class="col-md-12">
                    <!-- DATA TABLE-->
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0 text-white">Cars</h4>
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


@include('admin.cars.create')
@include('admin.cars.edit')

@endsection
@push('scripts')


{!! $dataTable->scripts() !!}

<script src="{{ asset('ajax/cars.js') }}?={{ time() }}"></script>

@endpush
