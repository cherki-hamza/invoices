@extends('backend.layouts.master')
@section('title')
{{ __('dashboard.sections') }}
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('public/assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ __('dashboard.sections') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('dashboard.sections') }}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">

                     <!--div-->
                     <div class="col-xl-12">
                        <!-- start alerts -->
                           @include('backend.alerts.alert')
                         <!-- end alerts -->
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">

                                        <a class="modal-effect btn btn-success" data-effect="effect-scale"
                                            data-toggle="modal" href="#add_section">{{ __('dashboard.Add_section') }}</a>

                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example" class="table  dataTable key-buttons text-md-nowrap">
                                        <thead>
                                            <tr class="bg-info">
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">{{ __('dashboard.section_name') }}</th>
                                                <th class="border-bottom-0">{{ __('dashboard.description') }}</th>
                                                <th class="border-bottom-0">Created By</th>
                                                <th class="border-bottom-0">{{ __('dashboard.actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i=0;
                                            @endphp
                                           @foreach ($sections as $section)
                                           @php $i++ @endphp
                                            <tr>
                                              <td>{{ $i}}</td>
                                              <td>{{ $section->section_name }}</td>
                                              <td>{{ $section->description }}</td>
                                              <td>{{ $section->created_by }}</td>

                                                <td>
                                                        <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                            data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}"
                                                            data-description="{{ $section->description }}" data-toggle="modal"
                                                            href="#edit_section" title="{{ __('dashboard.edit') }}"><i class="las la-pen"></i>
                                                        </a>

                                                        <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                            data-id="{{ $section->id }}" data-section_name="{{ $section->section_name }}"
                                                            data-toggle="modal" href="#delete_section" title="{{ __('dashboard.delete') }}"><i
                                                                class="las la-trash"></i>
                                                       </a>

                                                </td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/div-->
				</div>
				<!-- row closed -->
<!-- start modal add new section -->
<div class="modal" id="add_section">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('dashboard.Add_section') }}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sections.store',99) }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="exampleInputEmail1">{{ __('dashboard.section_name') }}</label>
                        <input type="text" class="form-control" id="section_name" name="section_name">
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">{{ __('dashboard.description') }}</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">{{ __('dashboard.confirm') }}</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End modal add new section -->
<!-- start modal edit section  -->
<div class="modal fade" id="edit_section" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{ __('dashboard.edit') }} {{ __('dashboard.section') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action="sections/update" method="post" autocomplete="off">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="">
                    <label for="section_name" class="col-form-label"> {{ __('dashboard.section_name') }} :</label>
                    <input class="form-control" name="section_name" id="section_name" type="text">
                </div>
                <div class="form-group">
                    <label for="message-text" class="col-form-label">{{ __('dashboard.description') }}:</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('dashboard.update') }}</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.close') }}</button>
        </div>
        </form>
    </div>
</div>
</div>
<!-- end modal edit section -->
<!-- start modal delete section -->
<div class="modal" id="delete_section">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
            <h6 class="modal-title">{{ __('dashboard.delete') }} {{ __('dashboard.section') }} </h6><button aria-label="Close" class="close" data-dismiss="modal"
                type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="sections/destroy" method="post">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <p>{{ __('dashboard.are_you_sure_to_delete') }} ؟</p><br>
                <input type="hidden" name="id" id="id" value="">
                <input class="form-control" name="section_name" id="section_name_delete" type="text" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.close') }}</button>
                <button type="submit" class="btn btn-danger">{{ __('dashboard.confirm') }}</button>
            </div>
    </div>
    </form>
</div>
</div>
<!-- end modal delete section -->
			</div>
			<!-- Container closed -->

		</div>
		<!-- main-content closed -->

@endsection
@section('js')
<!-- Internal Data tables -->
<script src="{{URL::asset('public/assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
@if(LaravelLocalization::getCurrentLocale() ==='ar')
<script src="{{URL::asset('public/assets/plugins/datatable/js/ar/jquery.dataTables.js')}}"></script>
@else
<script src="{{URL::asset('public/assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
@endif
<script src="{{URL::asset('public/assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('public/assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('public/assets/js/table-data.js')}}"></script>
<script src="{{ URL::asset('public/assets/js/modal.js') }}"></script>
<script>
    // script for edit section
    $('#edit_section').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name').val(section_name);
        modal.find('.modal-body #description').val(description);
    })

    // script for delete section
    $('#delete_section').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        var section_name = button.data('section_name')
        var modal = $(this)
        modal.find('.modal-body #id').val(id);
        modal.find('.modal-body #section_name_delete').val(section_name);
    })
</script>
@endsection
