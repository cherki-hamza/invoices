@extends('backend.layouts.master')
@section('title')
{{ __('dashboard.products') }}
@stop
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('public/assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('public/assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('public/assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('public/assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">

<link href="{{ URL::asset('public/assets/plugins/prism/prism.css') }}" rel="stylesheet">
<!---Internal Owl Carousel css-->
<link href="{{ URL::asset('public/assets/plugins/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
<!---Internal  Multislider css-->
<link href="{{ URL::asset('public/assets/plugins/multislider/multislider.css') }}" rel="stylesheet">
<!--- Select2 css -->
<link href="{{ URL::asset('public/assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">{{ __('dashboard.products') }}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{ __('dashboard.products') }}</span>
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
                            <div style="display: none" class="alert alert-warning text-bold check_section text-danger text-center">Oops Please insert at list one section for add new product</div>
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">

                                        <a class="modal-effect btn btn-success" data-effect="effect-scale"
                                            data-toggle="modal" href="#add_product">{{ __('dashboard.Add_product') }}</a>

                                </div>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50'>
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0"> {{ __('dashboard.product_name') }}</th>
                                                <th class="border-bottom-0">{{ __('dashboard.section_name') }}</th>
                                                <th class="border-bottom-0">{{ __('dashboard.description') }}</th>
                                                <th class="border-bottom-0">{{ __('dashboard.actions') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 0; ?>
                                            @foreach ($products as $product)
                                                <?php $i++; ?>
                                                <tr>
                                                    <td>{{ $i }}</td>
                                                    <td>{{ $product->product_name }}</td>
                                                    <td>{{ $product->section->section_name }}</td>
                                                    <td>{{ $product->description }}</td>
                                                    <td>

                                                            <button class="btn btn-outline-success btn-sm"

                                                                data-product_name="{{ $product->product_name }}"
                                                                data-pro_id="{{ $product->id }}"
                                                                data-section_name="{{ $product->section->section_name }}"
                                                                data-section_id="{{ $product->section_id }}"
                                                                data-description="{{ $product->description }}"

                                                                data-toggle="modal"
                                                                data-target="#edit_product">{{ __('dashboard.edit') }}
                                                            </button>

                                                            <button class="btn btn-outline-danger btn-sm " data-pro_id="{{ $product->id }}"
                                                                data-product_name="{{ $product->product_name }}" data-toggle="modal"
                                                                data-target="#delete_product">{{ __('dashboard.delete') }}
                                                            </button>


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
<!-- start modal add new product -->
<div class="modal" id="add_product">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">{{ __('dashboard.Add_product') }}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                    type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('products.store') }}" method="post">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label for="product_name">{{ __('dashboard.product_name') }}</label>
                        <input type="text" class="form-control" id="product_name" name="product_name">
                    </div>

                    <div class="form-group">
                        <label class="my-1 mr-2" for="section_id">{{ __('dashboard.section') }}</label>
                        <select name="section_id" id="section_id" class="form-control" required>
                            <option value="" selected disabled> -- {{ __('dashboard.select_section') }} --</option>
                            @foreach ($sections as $section)
                                <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">{{ __('dashboard.description') }}</label>
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
<!-- End modal add new product -->
<!-- start modal edit product  -->
<div class="modal fade" id="edit_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel"> {{ __('dashboard.edit') }} {{ __('dashboard.product') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

            <form action="products/update" method="post" autocomplete="off">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="form-group">
                    <input type="hidden" name="pro_id" id="pro_id" value="">
                    <label for="product_name" class="col-form-label"> {{ __('dashboard.product_name') }} :</label>
                    <input class="form-control" name="product_name" id="product_name" type="text">
                </div>

                <div class="form-group">
                    <label class="my-1 mr-2" for="section_name">{{ __('dashboard.section') }}</label>
                    <select name="section_name" id="section_name" class="form-control custom-select my-1 mr-sm-2" required>
                         <option class="myoption" selected value=""></option>
                        @foreach ($sections as $section)
                            <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">{{ __('dashboard.description') }}:</label>
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
<!-- end modal edit product -->
<!-- start modal delete product -->
<div class="modal" id="delete_product">
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content modal-content-demo">
        <div class="modal-header">
            <h6 class="modal-title"> {{ __('dashboard.delete') }} {{ __('dashboard.product') }}</h6><button aria-label="Close" class="close" data-dismiss="modal"
                type="button"><span aria-hidden="true">&times;</span></button>
        </div>
        <form action="products/destroy" method="post">
            {{ method_field('delete') }}
            {{ csrf_field() }}
            <div class="modal-body">
                <p>{{ __('dashboard.are_you_sure_to_delete') }}?</p><br>
                <input type="hidden" name="pro_id" id="pro_id" value="">
                <input class="form-control" name="product_name" id="product_name_delete" type="text" readonly>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('dashboard.close') }}</button>
                <button type="submit" class="btn btn-danger">{{ __('dashboard.confirm') }}</button>
            </div>
    </div>
    </form>
</div>
</div>
<!-- end modal delete product -->
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

<!-- Internal Prism js-->
<script src="{{ URL::asset('public/assets/plugins/prism/prism.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('public/assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('public/assets/plugins/select2/js/select2.min.js') }}"></script>




<script>
    $(document).ready(function(){
        let location = $('.check_link').attr('href')
        console.log(location);
        if(location === '#'){
         $('.check_section').attr('style','');
        }
    });
</script> 

<script>
    // edit product
    $('#edit_product').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var pro_id = button.data('pro_id')
        var product_name = button.data('product_name')
        var section_id = button.data('section_id')
        var section_name = button.data('section_name')
        //console.log(section_name);
        var description = button.data('description')
        var modal = $(this)
        modal.find('.modal-body #product_name').val(product_name);
        modal.find('.modal-body #section_name .myoption').val(section_id);
        modal.find('.modal-body #section_name .myoption').text(section_name);
        modal.find('.modal-body #description').val(description);
        modal.find('.modal-body #pro_id').val(pro_id);
    })

    // delet product
    $('#delete_product').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var pro_id = button.data('pro_id')
        var product_name = button.data('product_name')
        var modal = $(this)
        modal.find('.modal-body #pro_id').val(pro_id);
        modal.find('.modal-body #product_name_delete').val(product_name);
    })


</script>

@endsection
