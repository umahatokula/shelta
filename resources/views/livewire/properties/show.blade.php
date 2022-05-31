<div>
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} - Property</h1>
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

                        @can('view property')
                        <div class="example-content">
                            <div class="row">
                                <div class="col-12">
                                    {{$property->unique_number}}
                                </div>
                            </div>
                        </div>
                        @endcan

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
