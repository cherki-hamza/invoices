@extends('backend.layouts.master')
@section('title')
{{ __('dashboard.invoices_archive') }} 
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('public/assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/notify/css/notifIt.css') }}" rel="stylesheet"/>
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ __('dashboard.invoices') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('dashboard.invoices_archive') }}</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

        {{-- @include('backend.alerts.alert') --}}
        @include('backend.alerts.notification')
				<!-- row -->
				<div class="row">
                    <!-- start table -->

                        <!--div-->
                        <div class="col-xl-12">
                            <div class="card mg-b-20">
                                <div class="card-header pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="card-title mg-b-0">{{ __('dashboard.invoices') }}</h4>
                                        <a href="{{ route('invoices.create') }}" class="modal-effect btn btn btn-success" style="color:white"><i
                                            class="fas fa-plus"></i>&nbsp; {{ __('dashboard.add_invoice') }}</a>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example1" class="table key-buttons text-md-nowrap">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.invoice_number') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.invoice_date') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.due_date') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.the_product') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.section') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.discount') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.tax_rate') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.tax_value') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.total') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.status') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.notes') }} </th>
                                                    <th class="border-bottom-0"> {{ __('dashboard.actions') }} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i=0;
                                                @endphp
                                                @foreach ($invoices as $invoice)  
                                                @php
                                                    $i++;
                                                @endphp  
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$invoice->invoice_number}}</td>
                                                    <td>{{$invoice->invoice_Date}}</td>
                                                    <td>{{$invoice->due_date}}</td>
                                                    <td>{{$invoice->product}}</td>
                                                    
                                                      <td>
                                                        <a href="{{route('invoice_details' , $invoice->id)}}">
                                                        {{$invoice->section->section_name}}
                                                       </a>
                                                    </td>
                                                   
                                                    <td>{{$invoice->discount}}</td>
                                                    <td>{{$invoice->rate_vAT}}</td>
                                                    <td>{{$invoice->value_vAT}}</td>
                                                    <td>{{$invoice->total}}</td>
                                                    <td>
                                                    @if ($invoice->Value_Status == 1)
                                                        <span class="text-success">{{ $invoice->handel_status_lang() }}</span>
                                                      @elseif($invoice->Value_Status == 2)
                                                       <span class="text-danger">{{ $invoice->handel_status_lang() }}</span>
                                                    @else
                                                       <span class="text-warning">{{ $invoice->handel_status_lang() }}</span>
                                                    @endif
                                                   </td>
                                                    <td>{{$invoice->note}}</td>
                                                    
                                                    <td>
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" aria-haspopup="true"
                                                                class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                                type="button">{{__('dashboard.processes')}}<i class="fas fa-caret-down ml-1"></i></button>
                                                            <div class="dropdown-menu tx-13">
                                                                <a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                                    data-toggle="modal" data-target="#transfer_invoice"><i
                                                                        class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp; {{__('dashboard.transfer_to_billing')}}</a>
                                                                <a class="dropdown-item" href="#" data-invoice_id="{{ $invoice->id }}"
                                                                    data-toggle="modal" data-target="#delete_invoice"><i
                                                                        class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;{{__('dashboard.delete')}} {{__('dashboard.invoice')}}</a>
                                                            </div>
                                                        </div>
            
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
                    <!-- end table -->

                    <!-- start modals -->
                       
                    <!-- حذف الفاتورة -->
                    <div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"> {{__('dashboard.delete')}} {{__('dashboard.invoice')}}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <form action="invoices_archive/destroy" method="post">
                                    {{ method_field('delete') }}
                                    {{ csrf_field() }}
                            </div>
                            <div class="modal-body">
                                {{__('dashboard.are_you_sure_to_delete')}}
                                <input type="hidden" name="invoice_id" id="invoice_id" value="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('dashboard.close')}}</button>
                                    <button type="submit" class="btn btn-success">{{__('dashboard.confirm')}}</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    </div>
                    <!-- حذف الفاتورة -->

                    <!-- ارشيف الفاتورة -->
                    <div class="modal fade" id="transfer_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{__('dashboard.archive_invoice')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <form action="invoices_archive/update" method="post">
                                        {{ method_field('patch') }}
                                        {{ csrf_field() }}
                                </div>
                                <div class="modal-body">
                                    {{__('dashboard.are_you_sure_to_back_of_restore')}}
                                    <input type="hidden" name="invoice_id" id="invoice_id" value="">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('dashboard.close')}}</button>
                                    <button type="submit" class="btn btn-success">{{__('dashboard.confirm')}}</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- ارشيف الفاتورة -->
                    <!-- end modals -->
				</div>
				<!-- row closed -->
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
 <!--Internal  Notify js -->
 <script src="{{URL::asset('public/assets/plugins/notify/js/notifIt.js') }}"></script>
 <script src="{{URL::asset('public/assets/plugins/notify/js/notifit-custom.js') }}"></script>

<script>
    // delete invoice from database
    $('#delete_invoice').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })

     // transfere archive 
     $('#transfer_invoice').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var invoice_id = button.data('invoice_id')
        var modal = $(this)
        modal.find('.modal-body #invoice_id').val(invoice_id);
    })
</script>

@endsection