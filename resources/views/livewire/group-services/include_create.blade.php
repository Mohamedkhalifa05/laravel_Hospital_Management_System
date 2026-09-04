@extends('Dashboard.layouts.master')

@section('css')

@endsection

@section('title')
    مجموعة خدمات
@stop

@section('page-header')
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الخدمات</h4>
                <span class="text-muted mt-1 tx-13 mr-2 mb-0">
                    / مجموعة خدمات
                </span>
            </div>
        </div>
    </div>
@endsection

@section('content')

    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    <livewire:group-services.create-group-services />

                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

@endsection
