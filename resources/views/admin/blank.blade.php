@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col">
            <div class="page-description">
                <h1>{{ config('app.name', 'Real Estate App') }} Title</h1>
                <span>Description</span>
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
                            content
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection