@extends('backend.layouts.master')
@section('css')
    <style>
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
@endsection
@section('title')
{{__('dashboard.invoice_printing')}}-{{ $invoice->invoice_number }} 
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
							<h4 class="content-title mb-0 my-auto">{{ __('dashboard.invoice') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('dashboard.invoice_printing')}}</span>
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
                    <div class="col-xl-12">
                        <div class=" main-content-body-invoice" id="print">
                            <div class="card card-invoice">
                                <div class="card-body">
                                    <div class="invoice-header">
                                        <h1 class="invoice-title">فاتورة تحصيل</h1>
                                        <div class="billed-from">
                                            <h6>BootstrapDash, Inc.</h6>
                                            <p>201 Something St., Something Town, YT 242, Country 6546<br>
                                                Tel No: 324 445-4544<br>
                                                Email: youremail@companyname.com</p>
                                        </div><!-- billed-from -->
                                    </div><!-- invoice-header -->
                                    <div class="row mg-t-20">
                                        <div class="col-md">
                                            <label class="tx-gray-600">Billed To</label>
                                            <div class="billed-to">
                                                <h6>Juan Dela Cruz</h6>
                                                <p>4033 Patterson Road, Staten Island, NY 10301<br>
                                                    Tel No: 324 445-4544<br>
                                                    Email: youremail@companyname.com</p>
                                            </div>
                                        </div>
                                        <div class="col-md">
                                            <label class="tx-gray-600">معلومات الفاتورة</label>
                                            <p class="invoice-info-row"><span>رقم الفاتورة</span>
                                                <span>{{ $invoice->invoice_number }}</span></p>
                                            <p class="invoice-info-row"><span>تاريخ الاصدار</span>
                                                <span>{{ $invoice->invoice_Date }}</span></p>
                                            <p class="invoice-info-row"><span>تاريخ الاستحقاق</span>
                                                <span>{{ $invoice->due_date }}</span></p>
                                            <p class="invoice-info-row"><span>القسم</span>
                                                <span>{{ $invoice->section->section_name }}</span></p>
                                        </div>
                                    </div>
                                    <div class="table-responsive mg-t-40">
                                        <table class="table table-invoice border text-md-nowrap mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="wd-20p">#</th>
                                                    <th class="wd-40p">المنتج</th>
                                                    <th class="tx-center">مبلغ التحصيل</th>
                                                    <th class="tx-right">مبلغ العمولة</th>
                                                    <th class="tx-right">الاجمالي</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td class="tx-12">{{ $invoice->product }}</td>
                                                    <td class="tx-center">{{ number_format($invoice->amount_collection, 2) }}</td>
                                                    <td class="tx-right">{{ number_format($invoice->amount_commission, 2) }}</td>
                                                    @php
                                                    $total = $invoice->amount_collection + $invoice->amount_commission ;
                                                    @endphp
                                                    <td class="tx-right">
                                                        {{ number_format($total, 2) }}
                                                    </td>
                                                </tr>
            
                                                <tr>
                                                    <td class="valign-middle" colspan="2" rowspan="4">
                                                        <div class="invoice-notes">
                                                            <label class="main-content-label tx-13">#</label>
            
                                                        </div><!-- invoice-notes -->
                                                    </td>
                                                    <td class="tx-right">الاجمالي</td>
                                                    <td class="tx-right" colspan="2"> {{ number_format($total, 2) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right">نسبة الضريبة ({{ $invoice->rate_vAT }})</td>
                                                    <td class="tx-right" colspan="2">{{ $invoice->value_vAT }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="tx-right">قيمة الخصم</td>
                                                    <td class="tx-right" colspan="2"> {{ number_format($invoice->discount, 2) }}</td>
            
                                                </tr>
                                                <tr>
                                                    <td class="tx-right tx-uppercase tx-bold tx-inverse">الاجمالي شامل الضريبة</td>
                                                    <td class="tx-right" colspan="2">
                                                        <h4 class="tx-primary tx-bold">{{ number_format($invoice->total, 2) }}</h4>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <hr class="mg-b-40">
            
            
            
                                    <button class="btn btn-danger  float-left mt-3 mr-2" id="print_Button" onclick="printDiv()"> <i
                                            class="mdi mdi-printer ml-1"></i>طباعة</button>
                                </div>
                            </div>
                        </div><!-- COL-END -->
                    </div>
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
    // function to print invoice
    function printDiv() {
        var printContents = document.getElementById('print').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        location.reload();
    }
</script>

@endsection
