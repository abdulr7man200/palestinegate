@extends('admin.layouts.app')
@section('content')
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="overview-wrap">
                                    <h2 class="title-1">overview</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row m-t-25">
                            @role('admin')
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="zmdi zmdi-account-o"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ $totalUsers }}</h2>
                                                <span>Users</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            {{-- <canvas id="widgetChart1"></canvas> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c2">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-calendar-check" ></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ $totalBookings }}</h2>
                                                <span>Bookings</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            {{-- <canvas id="widgetChart2"></canvas> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endrole

                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c3">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-car" ></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ $totalCars }}</h2>
                                                <span>Cars</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            {{-- <canvas id="widgetChart3"></canvas> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c4">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-hotel" ></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ $totalStays }}</h2>
                                                <span>Stays</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            {{-- <canvas id="widgetChart4"></canvas> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @role('manager')
                            <div class="col-sm-6 col-lg-3">
                                <div class="overview-item overview-item--c1">
                                    <div class="overview__inner">
                                        <div class="overview-box clearfix">
                                            <div class="icon">
                                                <i class="fas fa-dollar-sign"></i>
                                            </div>
                                            <div class="text">
                                                <h2>{{ $totalPrice }}</h2>
                                                <span>Total Earnings</span>
                                            </div>
                                        </div>
                                        <div class="overview-chart">
                                            {{-- <canvas id="widgetChart1"></canvas> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @endrole

                        </div>
                    </div>
                </div>
            </div>
            @endsection
