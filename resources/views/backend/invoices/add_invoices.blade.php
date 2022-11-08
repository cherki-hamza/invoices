@extends('backend.layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('public/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('public/assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('public/assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />

    @if(LaravelLocalization::getCurrentLocale() ==='ar')
        <!--Internal Sumoselect css-->
        <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/sumoselect/sumoselect-rtl.css') }}">
        <!--Internal  TelephoneInput css-->
        <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
    @else
        <!--Internal Sumoselect css-->
        <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/sumoselect/sumoselect.css') }}">
        <!--Internal  TelephoneInput css-->
        <link rel="stylesheet" href="{{ URL::asset('public/assets/plugins/telephoneinput/telephoneinput.css') }}">
    @endif

@endsection
@section('title')
{{__('dashboard.add_invoice')}} 
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('dashboard.invoices')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{__('dashboard.add_invoice')}} </span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    @include('backend.alerts.alert')

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('invoices.store') }}" method="post" enctype="multipart/form-data"
                        autocomplete="off">
                        {{ csrf_field() }}
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="invoice_number" class="control-label">{{ __('dashboard.invoice_number') }}</label>
                                <input type="text" class="form-control" id="invoice_number" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" required>
                            </div>

                            <div class="col">
                                <label for="invoice_date">{{__('dashboard.invoice_date')}}</label>
                                <input class="form-control fc-datepicker" name="invoice_date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="col">
                                <label for="due_date"> {{ __('dashboard.due_date') }} </label>
                                <input class="form-control fc-datepicker" name="due_date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="section" class="control-label">{{__('dashboard.section')}}</label>
                                <select name="section" class="form-control SlectBox" onclick="console.log($(this).val())"
                                    onchange="console.log('change is firing')">
                                    <!--placeholder-->
                                    <option value="" selected disabled> {{__('dashboard.select_section')}} </option>
                                    @foreach ($sections as $section)
                                        <option value="{{ $section->id }}"> {{ $section->section_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col hpa2">
                                <label for="inputName" class="control-label">{{__('dashboard.product')}}</label>

                                @if(LaravelLocalization::getCurrentLocale() ==='ar')
                                <span style="display: none;" class="text-danger" id="hpac">لم يتم العثور على البيانات في الخادم ، يرجى المحاولة مرة أخرى</span>
                                @elseif(LaravelLocalization::getCurrentLocale() ==='fr')
                                <span style="display: none;" class="text-danger" id="hpac">LES DONNÉES NE SONT PAS TROUVÉES SUR LE SERVEUR VEUILLEZ RÉESSAYER</span>
                                @else
                                <span style="display: none;" class="text-danger" id="hpac">THE DATA NOT FOUND IN THE SERVER PLEASE TRY AGAIN</span>
                                @endif
                                <select id="product" name="product" class="form-control">
                                </select>
                            </div>

                            <div class="col">
                                <label for="amount_collection" class="control-label">{{__('dashboard.collection_amount')}}</label>
                                <input type="text" class="form-control" id="amount_collection" name="amount_collection"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="amount_commission" class="control-label">{{__('dashboard.commission_amount')}}</label>
                                <input type="text" class="form-control form-control-lg" id="amount_commission"
                                    name="amount_commission" title="يرجي ادخال مبلغ العمولة "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col">
                                <label for="discount" class="control-label">{{__('dashboard.discount')}}</label>
                                <input type="text" class="form-control form-control-lg" id="discount" name="discount"
                                    title="يرجي ادخال مبلغ الخصم "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value=0 required>
                            </div>

                            <div class="col">
                                <label for="rate_vat" class="control-label">{{__('dashboard.vat_rate')}}</label>
                                <select name="rate_vat" id="rate_vat" class="form-control" onchange="myFunction()">
                                    <!--placeholder-->
                                    <option value="" selected disabled>{{__('dashboard.select_the_tax_rate')}}</option>
                                    <option value="5%">5%</option>
                                    <option value="7%">7%</option>
                                    <option value="10%">10%</option>
                                    <option value="15%">15%</option>
                                    <option value="20%">20%</option>
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="value_vat" class="control-label">{{__('dashboard.value_added_tax')}}</label>
                                <input type="text" class="form-control" id="value_vat" name="value_vat" readonly>
                            </div>

                            <div class="col">
                                <label for="total" class="control-label"> {{__('dashboard.total_including_tax')}}</label>
                                <input type="text" class="form-control" id="total" name="total" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="note">{{__('dashboard.notes')}}</label>
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            </div>
                        </div><br>

                        <p class="text-danger">* {{__('dashboard.attachment_format')}} pdf, jpeg ,.jpg , png </p>
                        <h5 class="card-title">{{__('dashboard.attachments')}}</h5>

                        <div class="col-sm-12 col-md-12">
                            <input multiple type="file" name="pic[]" class="dropify" accept=".pdf,.jpg, .png, image/jpeg, image/png"
                                data-height="100" />
                        </div><br>

                        <div class="d-flex justify-content-center">
                            <button name="save_invoice" type="submit" class="btn btn-primary">{{__('dashboard.saving_data')}}</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('public/assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('public/assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('public/assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('public/assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('public/assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('public/assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('public/assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('public/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('public/assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('public/assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('public/assets/js/form-elements.js') }}"></script>




    <script>
        $('.fc-datepicker').datepicker({
           dateFormat: "yy-mm-dd"
        });
    </script>

<script>
    $(document).ready(function(){
        
    });
</script>
    <script>
        $(document).ready(function() {
            $('select[name="section"]').on('change', function() {
                let SectionId = $(this).val();
                if (SectionId) {
                    $.ajax({
                        url: "{{ URL::to('dashboard/invoice') }}/" + SectionId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data);
                            $('select[name="product"]').empty();
                            $.each(data, function(key, value) {
                                $('select[name="product"]').append('<option value="' +
                                    value + '">' + value + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                    $('#hpac').removeAttr("style");
                    $('.hpa2').addClass('alert alert-danger');
                }
            });

        });

    </script>


    <script>
        // function to calculte the discount ant the vat 
        function myFunction() {

            var Amount_Commission = parseFloat(document.getElementById("amount_commission").value);
            var Discount = parseFloat(document.getElementById("discount").value);
            var Rate_VAT = parseFloat(document.getElementById("rate_vat").value);
            var Value_VAT = parseFloat(document.getElementById("value_vat").value);

            var Amount_Commission2 = Amount_Commission - Discount;


            if (typeof Amount_Commission === 'undefined' || !Amount_Commission) {

                alert('يرجي ادخال مبلغ العمولة ');

            } else {
                var intResults = Amount_Commission2 * Rate_VAT / 100;

                var intResults2 = parseFloat(intResults + Amount_Commission2);

                sumq = parseFloat(intResults).toFixed(2);

                sumt = parseFloat(intResults2).toFixed(2);

                document.getElementById("value_vat").value = sumq;

                document.getElementById("total").value = sumt;

            }

        }

    </script>


@endsection
