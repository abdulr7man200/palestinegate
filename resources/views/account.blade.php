@extends('layouts.app')

@section('content')


<div class="container py-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary bg-gradient text-white">
            <h3 class="mb-0">Order History</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle" aria-label="Order history table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Order Date</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>#101</td>
                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Wireless Bluetooth Headphones with Noise Cancellation">Wireless Headphones</td>
                            <td>2</td>
                            <td>$199.99</td>
                            <td>2023-10-01</td>
                            <td><span class="badge bg-success">Shipped</span></td>
                        </tr>
                        <tr>
                            <td>#102</td>
                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Premium Leather Phone Case">Phone Case</td>
                            <td>1</td>
                            <td>$29.99</td>
                            <td>2023-10-05</td>
                            <td><span class="badge bg-warning text-dark">Processing</span></td>
                        </tr>
                        <tr>
                            <td>#103</td>
                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Fast Charging Power Bank 20000mAh">Power Bank</td>
                            <td>1</td>
                            <td>$49.99</td>
                            <td>2023-10-08</td>
                            <td><span class="badge bg-info">Delivered</span></td>
                        </tr>
                        <tr>
                            <td>#104</td>
                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="Wireless Gaming Mouse with RGB">Gaming Mouse</td>
                            <td>3</td>
                            <td>$89.99</td>
                            <td>2023-10-12</td>
                            <td><span class="badge bg-danger">Cancelled</span></td>
                        </tr>
                        <tr>
                            <td>#105</td>
                            <td data-bs-toggle="tooltip" data-bs-placement="top" title="USB-C to HDMI Cable Adapter">USB-C Adapter</td>
                            <td>2</td>
                            <td>$19.99</td>
                            <td>2023-10-15</td>
                            <td><span class="badge bg-primary">In Transit</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
</script>
@endsection