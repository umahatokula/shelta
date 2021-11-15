<div>
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="me-auto">
                <h4 class="page-title">{{ config('app.name', 'Real Estate App') }} Staff</h4>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <Link :href="route('home')">
                                    <i class="mdi mdi-home-outline"></i>
                                </Link>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('staff.index') }}">Staff</a></li>
                            <li class="breadcrumb-item active active" aria-current="page"><a href="{{ route('staff.profile') }}">My Profile</a></li>
                            <li class="breadcrumb-item active active" aria-current="page">2FA</li>
                        </ol>
                    </nav>
                </div>
            </div>

        </div>
    </div>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-8">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box-body">

                        <div>
                            @if (session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                        </div>
                        
                        <p>
                            <form wire:submit.prevent="save">
                                @csrf

                                <div class="mb-3 row my-5">
                                    <label for="example-text-input" class="col-md-7 col-form-label">Do you want to enable or disable Two Factor Authentication? 

                                    <br> 

                                    (Currently <span class="text-{{ $user_2fa ? 'success' : 'danger' }}">{{ $user_2fa ? 'Enabled' : 'Disabled' }}</span>)</label>

                                    <div class="col-md-5">

                                        <button class="btn btn-{{ $user_2fa ? 'danger' : 'success' }}" >{{ $user_2fa ? 'Disable Two Factor Authentication' : 'Enable Two Factor Authentication' }}</button>
                                    </div>
                                </div>

                            </form>

                        </p>

                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
