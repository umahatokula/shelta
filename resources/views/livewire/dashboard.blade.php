<div>
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box no-shadow mb-0 bg-transparent">
                    <div class="box-header no-border px-0">
                        <h4 class="box-title">Property Types</h4>
                        <ul class="box-controls pull-right d-md-flex d-none">
                            <li>
                                <button class="btn btn-primary-light px-10">View All</button>
                            </li>
                            <li class="dropdown">
                                <button class="dropdown-toggle btn btn-primary-light px-10" data-toggle="dropdown"
                                    href="#" aria-expanded="false">Most Popular</button>
                                <div class="dropdown-menu dropdown-menu-right" style="">
                                    <a class="dropdown-item active" href="#">Today</a>
                                    <a class="dropdown-item" href="#">Yesterday</a>
                                    <a class="dropdown-item" href="#">Last week</a>
                                    <a class="dropdown-item" href="#">Last month</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            @forelse ($propertyTypes as $propertyType)            
            <div class="col-xl-3 col-md-6 col-12">
                <div class="box bg-secondary-light pull-up"
                    style="background-image: url({{ $propertyType->getFirstMedia('propertyTypephotos') ? $propertyType->getFirstMedia('propertyTypephotos')->getUrl('thumb') : null }}); background-position: right bottom; background-repeat: no-repeat;">
                    <div class="box-body">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center pr-2 justify-content-between">
                                <div class="d-flex">
                                    <span class="badge badge-primary mr-15">Active</span>
                                    <span class="badge badge-primary mr-5"><i class="fa fa-lock"></i></span>
                                    <span class="badge badge-primary"><i class="fa fa-clock-o"></i></span>
                                </div>
                                <div class="dropdown">
                                    <a data-toggle="dropdown" href="#" class="px-10 pt-5"><i
                                            class="ti-more-alt"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#"><i class="ti-import"></i> Import</a>
                                        <a class="dropdown-item" href="#"><i class="ti-export"></i> Export</a>
                                        <a class="dropdown-item" href="#"><i class="ti-printer"></i> Print</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#"><i class="ti-settings"></i> Settings</a>
                                    </div>
                                </div>
                            </div>
                            <h4 class="mt-25 mb-5">{{ ucfirst(strtolower($propertyType->name)) }}</h4>
                            <p class="text-fade mb-0 font-size-12">&#x20A6; {{ number_format($propertyType->amount) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                
            @endforelse
            
        </div>
        <div class="row">
            <div class="col-xl-12 col-12">
                <div class="box">
                    <div class="box-body">
                        <p class="text-fade">Total Courses</p>
                        <h3 class="mt-0 mb-20">19 <small class="text-success"><i class="fa fa-arrow-up ml-15 mr-5"></i>
                                2 New</small></h3>
                        <div id="charts_widget_2_chart"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')

<script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/pages/dashboard3.js') }}"></script>

@endpush
