<div>

    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Settings</h1>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">&nbsp</h5>
                </div>
                <div class="card-body">
                    <div class="example-container">
                        <div class="example-content">

                            @can('set company profile')
                            <div class="row">
                                <div class="col-12 d-flex justify-content-end">
                                    <a href="{{ route('settings.edit', $settings) }}"
                                        class="btn-lg btn btn-primary">Edit</a>
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
                        @endcan

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
