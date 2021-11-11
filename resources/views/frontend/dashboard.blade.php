@extends('layouts.frontend')

@section('content')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <h4 class="page-title mb-0 font-size-18">Dashboard</h4>


        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-xl-6">

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div>
                                    <p class="text-muted fw-medium mt-1 mb-2">Payment Total</p>
                                    <h4>&#x20A6; 1,368, 000</h4>
                                </div>
                            </div>

                            <div class="col-4">
                                <div>
                                    <div id="radial-chart-1"></div>
                                </div>
                            </div>
                        </div>

                        <p class="mb-0"><span class="badge badge-soft-success me-2"> 0.8% <i
                                    class="mdi mdi-arrow-up"></i> </span> From previous period</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8">
                                <div>
                                    <p class="text-muted fw-medium mt-1 mb-2">Last Payment</p>
                                    <h4>&#x20A6; 32,695</h4>
                                </div>
                            </div>

                            <div class="col-4">
                                <div>
                                    <div id="radial-chart-2"></div>
                                </div>
                            </div>
                        </div>

                        <p class="mb-0"><span class="badge badge-soft-success me-2"> 0.6% <i
                                    class="mdi mdi-arrow-up"></i> </span> From previous period</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">Properties</h4>
                <div class="row">
                    <div class="col-sm-7">
                        <div>
                            <p class="mb-2">01 Jan - 31 Jan, 2020</p>
                            <h4>3</h4>

                            <p class="mt-4 mb-0"><span class="badge badge-soft-success me-2"> 0.6%
                                    <i class="mdi mdi-arrow-up"></i> </span> From previous period
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="mt-4 mt-sm-0">
                            <div id="sales-report-chart" class="apex-charts"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card">
            <div class="card-body">
                <div class="float-end">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Week</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Month</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Year</a>
                        </li>
                    </ul>
                </div>
                <h4 class="card-title mb-4">Payment</h4>

                <div id="mixed-chart" class="apex-charts"></div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

@endsection