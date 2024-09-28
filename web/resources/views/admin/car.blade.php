@extends('admin.layouts.app')

@section('content')
    <style>
        .select2-dropdown.select2-dropdown--below {
            width: 420px !important;
        }

        .select2-container--default .select2-selection--single {
            padding: 6px;
            height: 37px;
            width: 420px;
            font-size: 1.2em;
            position: relative;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            background-image: -khtml-gradient(linear, left top, left bottom, from(#424242), to(#030303));
            background-image: -moz-linear-gradient(top, #424242, #030303);
            background-image: -ms-linear-gradient(top, #424242, #030303);
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #424242), color-stop(100%, #030303));
            background-image: -webkit-linear-gradient(top, #424242, #030303);
            background-image: -o-linear-gradient(top, #424242, #030303);
            background-image: linear-gradient(#424242, #030303);
            width: 40px;
            color: #fff;
            font-size: 1.3em;
            padding: 4px 12px;
            height: 36px;
            position: absolute;
            top: 0px;
            right: 0px;
            width: 20px;
        }
    </style>
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">List Car</h4>


                        <div class="col-md-12">
                            <a href="javascript:void(0)" id="createNewPost"
                                class="btn btn-sm btn-pill btn-primary float-right">Tambah </a>


                            {{-- <a href="{{ route('Export.MasterjenisTransaksi') }}" type="button" class="btn btn-info">Export Excel</a>
                    <a href="{{ route('Export.MasterjenisTransaksiPDF') }}" type="button" class="btn btn-success">Export PDF</a> --}}


                        </div>


                        @if (session('success'))
                            <div class="alert alert-icon alert-success alert-dismissible" role="alert">
                                <i class="fe fe-check mr-2" aria-hidden="true"></i>
                                <button type="button" class="close" data-dismiss="alert"></button>
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="form-group col-4">


                            </div>
                        </div>

                        {{-- , 'remember_token', 'email_verified_at' --}}
                        <div class="table-responsive" style="margin-top:30px;">
                            <table class="table table-striped data-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Car</th>
                                        <th>Type</th>
                                        <th>Capacity</th>
                                        <th>Price per Day</th>
                                        <th>Price per KM</th>
                                        <th>Price per Area</th>
                                        <th>Availability Start Time</th>
                                        <th>Availability End Time</th>
                                        <th>Is Available</th>
                                        <th width="80px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </section>


    <div class="modal fade" id="ajaxModelexa" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>


                <div class="modal-body">

                    <div class="alert alert-danger print-error-msg" style="display:none">
                        <ul></ul>
                    </div>


                    <form id="postForm" name="postForm" class="form-horizontal">
                        <input type="hidden" name="id" id="id">
{{--
                        <div class="form-group">
                            <label for="car" class="col-sm-12">car</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="car" name="car"
                                    placeholder="Enter car" value="" required>

                            </div>
                        </div> --}}

                        <div class="form-group">
                            <label for="car" class="col-sm-12">Car</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="car" name="car" placeholder="Enter car" required>
                            </div>

                        <div class="form-group">
                            <label for="type" class="col-sm-12">Type</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="type" name="type" required>
                                    <option value="" disabled selected>Pilih Jenis Transaksi</option>
                                    <option value="self_drive">self_drive</option>
                                    <option value="with_driver">with_driver</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="capacity" class="col-sm-12">capacity</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="capacity" name="capacity"
                                    placeholder="Enter capacity" value="" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="price_per_day" class="col-sm-12">price_per_day</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="price_per_day" name="price_per_day"
                                    placeholder="Enter price_per_day" value="" required>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="price_per_km" class="col-sm-12">price_per_km</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="price_per_km" name="price_per_km"
                                    placeholder="Enter price_per_km" value="" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="price_per_area" class="col-sm-12">price_per_area</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="price_per_area" name="price_per_area"
                                    placeholder="Enter price_per_area" value="" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="availability_start_time" class="col-sm-12">availability_start_time</label>
                            <div class="col-sm-12">
                                <input type="time" class="form-control" id="availability_start_time"
                                    name="availability_start_time" placeholder="Enter availability_start_time"
                                    value="" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="availability_end_time" class="col-sm-12">availability_end_time</label>
                            <div class="col-sm-12">
                                <input type="time" class="form-control" id="availability_end_time"
                                    name="availability_end_time" placeholder="Enter availability_end_time" value=""
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_available" class="col-sm-12">Is Available</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="is_available" name="is_available" required>
                                    <option value="" disabled selected>Pilih Jenis Transaksi</option>
                                    <option value="Available">Available</option>
                                    <option value="Not_Available">Not_Available</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="simpandata" value="create">Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("#jenis").change(function() {
                var el = $(this).val();
                if (el == 'Jangka') {
                    $("#divTenor").show();
                } else {
                    $("#divTenor").hide();
                }
            });

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,


                'ajax': {
                    'url': '{{ route('admin.ListCar.index') }}',
                    'data': function(data) {
                        var event = $('#filter_event_id').val();
                    }
                },


                dom: 'lBfrtip',
                buttons: [
                    'excel', 'csv', 'pdf', 'copy'
                ],



                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },



                    {
                        data: 'car',
                        name: 'car'
                    },


                    {
                        data: 'type',
                        name: 'type'
                    },


                    {
                        data: 'capacity',
                        name: 'capacity'
                    },


                    {
                        data: 'price_per_day',
                        name: 'price_per_day'
                    },


                    {
                        data: 'price_per_km',
                        name: 'price_per_km'
                    },


                    {
                        data: 'price_per_area',
                        name: 'price_per_area'
                    },

                    {
                        data: 'availability_start_time',
                        name: 'availability_start_time'
                    },

                    {
                        data: 'availability_end_time',
                        name: 'availability_end_time'
                    },


                    {
                        data: 'is_available',
                        name: 'is_available'
                    },




                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
            // {{-- , 'remember_token', 'email_verified_at' --}}
            $('#createNewPost').click(function() {
                $('#simpandata').val("create-post");
                $('#id').val('');
                $('#postForm').trigger("reset");
                $('#modelHeading').html("Tambah User");
                $('#ajaxModelexa').modal('show');
            });

            $('body').on('click', '.editPost', function() {
                var id = $(this).data('id');
                $.get("{{ route('admin.ListCar.index') }}" + '/' + id + '/edit', function(data) {
                    $('#modelHeading').html("Edit User");
                    $('#simpandata').val("edit-user");
                    $('#ajaxModelexa').modal('show');
                    $('#id').val(data.id);
                    $('#car').val(data.car);
                    $('#type').val(data.type);
                    $('#capacity').val(data.capacity);
                    $('#price_per_day').val(data.price_per_day);
                    $('#price_per_km').val(data.price_per_km);
                    $('#price_per_area').val(data.price_per_area);
                    $('#availability_start_time').val(data.availability_start_time);
                    $('#availability_end_time').val(data.availability_end_time);
                    $('#is_available').val(data
                        .is_available); // Make sure `data.is_available` matches the option values
                })
            });

            $('#simpandata').click(function(e) {
                e.preventDefault();

                $.ajax({
                    data: $('#postForm').serialize(),
                    url: "{{ route('admin.ListCar.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            $('#postForm').trigger("reset");
                            $('#ajaxModelexa').modal('hide');
                            $.getScript('{{ asset('/public/notify.min.js') }}', function() {
                                $.notify("Tambah data success", "success");
                            });
                            table.draw();
                        } else {
                            printErrorMsg(data.error);
                        }
                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#simpandata').html('Save Changes');
                    }
                });

            });

            $('body').on('click', '.deletePost', function() {

                var id = $(this).data("id");
                if (confirm("Apakah anda yakin ingin menghapus data ini ? ")) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('admin.ListCar.store') }}" + '/' + id,
                        success: function(data) {


                            $.getScript('{{ asset('/public/notify.min.js') }}', function() {
                                $.notify("Delete data success", "info");
                            });

                            table.draw();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });

                }
            });




            function printErrorMsg(msg) {


                $(".print-error-msg").find("ul").html('');

                $(".print-error-msg").css('display', 'block');

                $.each(msg, function(key, value) {

                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');

                });

            }


        });
    </script>
@endsection
