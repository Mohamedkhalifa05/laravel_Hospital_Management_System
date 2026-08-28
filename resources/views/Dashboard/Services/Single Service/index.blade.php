@extends('Dashboard.layouts.master')
@section('title')
    {{trans('main-sidebar_trans.Single_service')}}
@stop
@section('css')
    <!--Internal   Notify -->
    <link href="{{URL::asset('dashboard/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{trans('main-sidebar_trans.Services')}}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{trans('main-sidebar_trans.Single_service')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @if(!session('open_service_modal'))
    @include('Dashboard.messages_alert')
    @endif
    <!-- row -->
    <!-- row opened -->
    <div class="row row-sm">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addServiceModal">
                            {{trans('Services.add_Service')}}
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-md-nowrap" id="example2">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th> {{trans('Services.name')}}</th>
                                <th> {{trans('Services.price')}}</th>
                                <th> {{trans('doctors.Status')}}</th>
                                <th> {{trans('Services.description')}}</th>
                                <th>{{trans('sections_trans.created_at')}}</th>
                                <th>{{trans('sections_trans.Processes')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($services as $service)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->price}}</td>
                                    <td>
                                        <div
                                            class="dot-label bg-{{$service->status == 1 ? 'success':'danger'}} ml-1"></div>
                                        {{$service->status == 1 ? trans('doctors.Enabled'):trans('doctors.Not_enabled')}}
                                    </td>
                                    <td> {{ Str::limit($service->description, 50) }}</td>
                                    <td>{{ $service->created_at->diffForHumans() }}</td>
                                    <td>
                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                           data-toggle="modal" href="#edit{{$service->id}}"><i
                                                class="las la-pen"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                           data-toggle="modal" href="#delete{{$service->id}}"><i
                                                class="las la-trash"></i></a>
                                    </td>
                                </tr>

                                @include('Dashboard.Services.Single Service.edit')
                                @include('Dashboard.Services.Single Service.delete')
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- bd -->
            </div><!-- bd -->
        </div>
        <!--/div-->

    @include('Dashboard.Services.Single Service.add')
    <!-- /row -->

    </div>
    <!-- row closed -->

    <!-- Container closed -->

    <!-- main-content closed -->
@endsection
@section('js')

<script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
<script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>

{{-- فتح Add بعد Validation --}}
@if(session('open_service_modal') == 'add')
<script>
    $(document).ready(function () {
        $('#addServiceModal').modal('show');
    });
</script>
@endif


@if(session('open_service_modal') == 'edit')
<script>
    $(document).ready(function () {
        $('#edit{{ session('service_id') }}').modal('show');
    });
</script>
@endif

<script>
$(document).ready(function () {

    $('.modal[id^="edit"]').each(function () {

        let modal = $(this);

        modal.find('input[name="name"]').attr(
            'data-original',
            modal.find('input[name="name"]').val()
        );

        modal.find('input[name="price"]').attr(
            'data-original',
            modal.find('input[name="price"]').val()
        );

        modal.find('textarea[name="description"]').attr(
            'data-original',
            modal.find('textarea[name="description"]').val()
        );

        modal.find('select[name="status"]').attr(
            'data-original',
            modal.find('select[name="status"]').val()
        );
    });


    // عند إغلاق Edit Modal
    $('.modal[id^="edit"]').on('hidden.bs.modal', function () {

        let modal = $(this);

        // إرجاع البيانات الأصلية
        modal.find('input[name="name"]').val(
            modal.find('input[name="name"]').attr('data-original')
        );

        modal.find('input[name="price"]').val(
            modal.find('input[name="price"]').attr('data-original')
        );

        modal.find('textarea[name="description"]').val(
            modal.find('textarea[name="description"]').attr('data-original')
        );

        modal.find('select[name="status"]').val(
            modal.find('select[name="status"]').attr('data-original')
        );

        modal.find('.text-danger').remove();

        modal.find('.is-invalid').removeClass('is-invalid');
    });

});
</script>

@endsection
