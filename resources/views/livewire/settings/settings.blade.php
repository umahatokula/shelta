<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Settings</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                            <li class="breadcrumb-item" aria-current="page">Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-lg-8">
                <div class="box p-15">
                    <div class="row">
                        <div class="col-12 float-right">
                            <a href="{{ route('settings.edit', $settings) }}"
                                class="waves-effect waves-light btn btn-primary btn-sm float-right">Edit</a>
                        </div>
                        @if ($settings)
                        <div class="col-6">
                            <div>
                                <p>
                                    <h4>{{ $settings->company_name }}</h4>
                                </p>
                                <p>Email :<span class="text-gray ps-10"> <a
                                            href="mailto:{{ $settings->company_email }}">{{ $settings->company_email }}</a></span>
                                </p>
                                <p>Phone :<span class="text-gray ps-10"> <a
                                            href="tel:{{ $settings->company_phone }}">{{ $settings->company_phone }}</a></span>
                                </p>
                                <p>Address :<span class="text-gray ps-10"> {{ $settings->company_address }}</span></p>
                            </div>
                        </div>
                        <div class="col-6 d-flex justify-content-center"">
                            <img src=" {{ $settings->getFirstMediaUrl('logoLight') }}"
                            alt="{{ $settings->company_name }}" width="300px">
                        </div>
                        @else
                            <p>Kindly update settings</p> 
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

</div>
