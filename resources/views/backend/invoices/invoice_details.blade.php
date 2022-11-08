@extends('backend.layouts.master')
@section('title')
    {{ __('dashboard.invoice_detail') }}
@stop
@section('css')
    <!-- Internal Data table css -->
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/datatable/css/responsive.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ __('dashboard.invoice_detail') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('dashboard.invoice_detail') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    @include('backend.alerts.alert')
    <div class="row">
        <!-- start table -->

        <!--div-->

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab1" class="nav-link active" data-toggle="tab">معلومات
                                                    الفاتورة</a></li>
                                            <li><a href="#tab2" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                                            <li><a href="#tab3" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                            <li><a href="#tab4" class="nav-link" data-toggle="tab">مدير الملفات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">

                                        <!-- start tab1 -->
                                        <div class="tab-pane active" id="tab1">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row"> {{ __('dashboard.invoice_number') }}</th>
                                                            <td>{{ $invoices->invoice_number }}</td>
                                                            <th scope="row"> {{ __('dashboard.invoice_date') }}</th>
                                                            <td>{{ $invoices->invoice_Date }}</td>
                                                            <th scope="row"> {{ __('dashboard.due_date') }}</th>
                                                            <td>{{ $invoices->due_date }}</td>
                                                            <th scope="row">{{ __('dashboard.section') }}</th>
                                                            <td>{{ $invoices->section->section_name }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">{{ __('dashboard.the_product') }}</th>
                                                            <td>{{ $invoices->product }}</td>
                                                            <th scope="row">مبلغ التحصيل</th>
                                                            <td>{{ $invoices->amount_collection }}</td>
                                                            <th scope="row">مبلغ العمولة</th>
                                                            <td>{{ $invoices->amount_commission }}</td>
                                                            <th scope="row">{{ __('dashboard.discount') }}</th>
                                                            <td>{{ $invoices->discount }}</td>
                                                        </tr>


                                                        <tr>
                                                            <th scope="row"> {{ __('dashboard.tax_rate') }}</th>
                                                            <td>{{ $invoices->rate_vat }}</td>
                                                            <th scope="row"> {{ __('dashboard.tax_value') }}</th>
                                                            <td>{{ $invoices->value_vat }}</td>
                                                            <th scope="row">الاجمالي مع الضريبة</th>
                                                            <td>{{ $invoices->total }}</td>
                                                            <th scope="row"> {{ __('dashboard.status') }}</th>

                                                            @if ($invoices->value_status == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $invoices->handel_status_lang() }}</span>
                                                                </td>
                                                            @elseif($invoices->value_status == 2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $invoices->handel_status_lang() }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $invoices->handel_status_lang() }}</span>
                                                                </td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">{{ __('dashboard.notes') }}</th>
                                                            <td>{{ $invoices->note }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                        <!-- end tab1 -->

                                        <!-- start tab2 -->
                                        <div class="tab-pane" id="tab2">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th> {{ __('dashboard.invoice_number') }}</th>
                                                            <th> {{ __('dashboard.the_product') }}</th>
                                                            <th>{{ __('dashboard.section') }} </th>
                                                            <th> {{ __('dashboard.status') }} </th>
                                                            <th> {{ __('dashboard.invoice_date') }} </th>
                                                            <th>{{ __('dashboard.notes') }}</th>
                                                            <th> {{__('dashboard.added_date')}} </th>
                                                            <th>{{ __('dashboard.users') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                        @foreach ($details as $x)
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $x->invoice_number }}</td>
                                                                <td>{{ $x->product }}</td>
                                                                <td>{{ $invoices->section->section_name }}</td>
                                                                @if ($x->value_status == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $x->handel_status_lang() }}</span>
                                                                    </td>
                                                                @elseif($x->value_status == 2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $x->handel_status_lang() }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $x->handel_status_lang() }}</span>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $x->payment_date }}</td>
                                                                <td>{{ $x->note }}</td>
                                                                <td>{{ $x->created_at }}</td>
                                                                <td>{{ $x->user }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>
                                        <!-- end tab2 -->

                                        <!-- start tab3 -->
                                        <div class="tab-pane" id="tab3">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                               
                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="post" action="{{ route('invoice_attachements.store') }}"
                                                            enctype="multipart/form-data">
                                                            {{ csrf_field() }}
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="customFile"
                                                                    name="file_name" required>
                                                                <input type="hidden" id="customFile" name="invoice_number"
                                                                    value="{{ $invoices->invoice_number }}">
                                                                <input type="hidden" id="invoice_id" name="invoice_id"
                                                                    value="{{ $invoices->id }}">
                                                                <label class="custom-file-label" for="customFile">حدد
                                                                    المرفق</label>
                                                            </div><br><br>
                                                            <button type="submit" class="btn btn-primary btn-sm "
                                                                name="uploadedFile">{{__('dashboard.confirm')}}</button>
                                                        </form>
                                                    </div>
                                                
                                                <br>

                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0  table-hover"
                                                        style="text-align:center">
                                                        <thead class="my-3">
                                                            <tr class="text-dark">
                                                                <th scope="col">#</th>
                                                                <th scope="col">اسم الملف</th>
                                                                <th scope="col">قام بالاضافة</th>
                                                                <th scope="col"> {{__('dashboard.added_date')}} </th>
                                                                {{-- <th scope="col">العمليات</th> --}}
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>
                                                            @foreach ($attachments as $attachment)
                                                                <?php $i++; ?>
                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $attachment->check_file_name($invoices->invoice_number) }}
                                                                    </td>
                                                                    <td>{{ $attachment->created_by }}</td>
                                                                    <td>{{ $attachment->created_at }}</td>
                                                                    {{-- <td>

                                                                        <a class="btn btn-outline-success btn-sm"
                                                                            @php
                                                                             $file_name = json_decode($attachment->file_name); 
                                                                           @endphp
                                                                            href="{{ asset('public/invoice_files/file/') }}/{{ $invoices->invoice_number }}/{{ $file_name[0] }}"
                                                                            target="_blank" role="button"><i
                                                                                class="fas fa-eye"></i>&nbsp;
                                                                            عرض</a>

                                                                        <a class="btn btn-outline-info btn-sm"
                                                                            href="{{ asset('public/invoice_files/file/') }}/{{ $invoices->invoice_number }}/{{ $file_name[0] }}"
                                                                            download role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            تحميل</a>

                                                                            
                                                                        <button class="btn btn-outline-danger btn-sm"
                                                                            data-toggle="modal"
                                                                            data-file_name="{{ $file_name[0] }}"
                                                                            data-invoice_number="{{ $attachment->invoice_number }}"
                                                                            data-id_file="{{ $attachment->id }}"
                                                                            data-target="#delete_file"><i
                                                                                class="fas fa-trash"></i>&nbsp;
                                                                            حذف
                                                                        </button>


                                                                    </td> --}}
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- end tab3 -->

                                        <!-- start tab4 -->
                                        <div class="tab-pane" id="tab4">
                                            <div class="card">
                                                <ul class="list-group"> 
                                                    @foreach ($attachments as $attachment)
                                                     <li class="list-group-item">{{ $attachment->show_file($invoices->invoice_number,$attachment->id) }}</li> 
                                                    @endforeach 
                                                 </ul>
                                            </div>
                                        </div>
                                        <!-- end tab4 -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /div -->
        </div>

        <!--/div-->

    </div>
    <!-- end table -->
    </div>
    <!-- row closed -->
    </div>


    <!-- start delete destroy  -->
          <!-- delete -->
<div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('delete_file') }}" method="post">

                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                    </p>
                    <div class="row form-group">
                    <input class="form-control text-info" type="text" name="id_file" id="id_file" value="">
                    <input class="form-control text-info" type="text" name="file_name" id="file_name" value="">
                    <input class="form-control text-info" type="text" name="invoice_number" id="invoice_number" value="">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('dashboard.close')}}</button>
                    <button type="submit" class="btn btn-danger">{{__('dashboard.confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!--  end delete destroy  -->

              <!-- delete -->
<div class="modal fade" id="custom_delete_destroy_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('custom_destroy') }}" method="post">

                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                    </p>
                    <div class="row form-group">
                    <input class="form-control text-info" type="text" name="id_file" id="id_file" value="">
                    <input class="form-control text-info" type="text" name="file_name" id="file_name" value="">
                    <input class="form-control text-info" type="text" name="invoice_number" id="invoice_number" value="">
                </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{__('dashboard.close')}}</button>
                    <button type="submit" class="btn btn-danger">{{__('dashboard.confirm')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!--  end delete destroy  -->

    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Data tables -->
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
    @if (LaravelLocalization::getCurrentLocale() === 'ar')
        <script src="{{ URL::asset('public/assets/plugins/datatable/js/ar/jquery.dataTables.js') }}"></script>
    @else
        <script src="{{ URL::asset('public/assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
    @endif
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/jszip.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
    <!--Internal  Datatable js -->
    <script src="{{ URL::asset('public/assets/js/table-data.js') }}"></script>
    <!-- start script delete file  -->
    <script>
        // delet and destroy file
        $('#delete_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })

        // custom destroy 
        $('#custom_delete_destroy_file').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget)
            var id_file = button.data('id_file')
            var file_name = button.data('file_name')
            var invoice_number = button.data('invoice_number')
            var modal = $(this)
            modal.find('.modal-body #id_file').val(id_file);
            modal.find('.modal-body #file_name').val(file_name);
            modal.find('.modal-body #invoice_number').val(invoice_number);
        })
    </script>
     <!-- end script delete file  -->
@endsection
