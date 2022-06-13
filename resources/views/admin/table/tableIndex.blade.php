@extends('admin_layout')
@section('admin_content')
    <?php
    $message = Session::get('message');
    if ($message) {
        echo "<script>alert('$message')</script>";
        Session::put('message', null);
    }
    ?>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="" style="display: flex;justify-content: space-between;">
                    Danh sách bàn
                    <div class="flex" style="align-items: center">
                        <div class="box box-1"></div>
                        <p>Trống</p>
                        <div class="box box-2"></div>
                        <p>Đặt trước</p>
                        <div class="box box-3"></div>
                        <p>Đang sử dụng</p>
                        <div class="box box-4"></div>
                        <p>Đã hết thời gian đặt</p>
                    </div>
                    <div class="pull-right" style="float: right">
                        <select id="authority_id" name="authority_id">
                            <option value="" selected>---chọn---</option>
                            <option value="5">Thêm bàn</option>
                            <option value="6">Thêm </option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="flex mt-2 hide-1" style="align-items: center;margin-left:5px" id="addTable">
                <form action="" method="post" class="addTableForm">
                    @csrf
                    <span>Thêm</span><input type="number" class="times" name="times" style="margin: 0 5px">
                    <span>bàn</span>
                    <input type="button" class="btn btn-success" id="addTableForm" value="Thêm">
                </form>
            </div>

            <div class="table-responsive d-flex mt-2">
                <div class="flex">
                    @foreach ($getTable as $table)
                        <button type="button" class="btn btn-primary chair" data-bs-toggle="modal"
                            data-id="{{ $table->id }}" data-bs-target="#exampleModal-{{ $table->id }}"
                            style="background:
                                            @if ($table->type == 1) #fff
                            @elseif($table->type == 2)#ee7006
                            @elseif($table->type == 3)#00a218
                            @elseif($table->type == 4)#e72222
                            @elseif($table->type == 5)#7a7676 @endif">
                            <span style="color: #000"> {{ $table->name }}</span>
                            <input type="hidden" value="{{ $table->id }}">
                        </button>
                        <div class="modal fade" id="exampleModal-{{ $table->id }}" tabindex="-1" {{-- -{{ $table->id }} --}}
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Chọn trạng thái bàn</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="{{ URL::to('/creat-table') }}" method="post" autocomplete="off">
                                        @csrf
                                        <div class="modal-body">
                                            <select name="type" class="form-control input-lg m-bot15 mb-2 select" id="type">
                                                @foreach ($getTableStatus as $key)
                                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="hide-1" id="reserved">
                                                <input type="hidden" name="id" value="{{ $table->id }}">
                                                <div class="form-floating mb-2">
                                                    <input type="date" class="form-control" name="reservation_date"
                                                        id="floatingInput txtDate ">
                                                    <label for="floatingInput">Ngày đặt</label>
                                                </div>
                                                <div class="form-floating mb-2">
                                                    <input type="time" class="form-control" name="reservation_time"
                                                        id="floatingTime ">
                                                    <label for="floatingTime">Thời gian</label>
                                                </div>
                                                <div class="form-floating mb-2">
                                                    <input type="text" class="form-control" name="customer_name"
                                                        id="floatingInput " placeholder="Name">
                                                    <label for="floatingInput">Tên người đặt</label>
                                                </div>
                                                <div class="form-floating mb-2">
                                                    <input type="text" class="form-control" name="customer_phone"
                                                        id="floatingInput " placeholder="Phone">
                                                    <label for="floatingInput">Số điện thoại</label>
                                                </div>
                                                <div class="form-floating mb-2">
                                                    <input type="mail" class="form-control" name="customer_email"
                                                        id="floatingInput " placeholder="Email">
                                                    <label for="floatingInput">Email</label>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Đóng</button>
                                                    <input type="submit" class="btn btn-primary" value="Lưu">
                                                </div>
                                            </div>
                                            <div class="hide-1" id="using">
                                                abc
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- <div id="loadTable"></div> --}}

        </div>
    </div>
    <style>
        .chair {
            width: 50px;
            height: 50px;
            margin: 5px;
            flex: 10%;
            position: relative;
        }

        .flex {
            display: flex;
            flex-wrap: wrap;
        }

        .mt-2 {
            margin-top: 10px;
        }

        .number {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #000 !important;
            font-weight: bold;
        }

        .hide-1 {
            display: none;
        }

        .box {
            width: 10px;
            height: 10px;
            border: 1px solid;
            margin: 0 5px 0 20px;
        }

        .flex p {
            text-transform: none !important;
        }

        .box-1 {
            background: #ffffff;
        }

        .box-2 {
            background: #ee7006;
        }

        .box-3 {
            background: #00a218;
        }

        .box-4 {
            background: #e72222;
        }
    </style>
    {{-- <script>
        $(document).ready(function() {
            // loadTable();

            // function loadTable() {
            //     var _token = $('input[name="_token"]').val();
            //     $.ajax({
            //         url: '{{ URL::to('/table-page') }}',
            //         method: "POST",
            //         data: {
            //             _token: _token
            //         },
            //         success: function(data) {
            //             $('#loadTable').html(data);
            //             window.setTimeout(function() {
            //                 loadTable();
            //             }, 100000);
            //         }
            //     });
            // }
            //insert table
            $('#saveTableInfor').on('click', function() {
                var id = $(this).data('id_table');
                var type = $('.type_' + id).val();
                var reservation_date = $('.reservation_date_' + id).val();
                var reservation_time = $('.reservation_time_' + id).val();
                var customer_name = $('.customer_name_' + id).val();
                var customer_phone = $('.customer_phone_' + id).val();
                var customer_email = $('.customer_email_' + id).val();
                var _token = $('input[name= "_token"]').val();
                if (reservation_date == '' || reservation_time == '' || customer_name == '' ||
                    customer_phone == '') {
                    var toastMixin = Swal.mixin({
                        toast: true,
                        icon: 'success',
                        title: 'General Title',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    toastMixin.fire({
                        title: 'Các mục không được để trống',
                        icon: 'error'
                    });
                    $(function() {
                        $('.btn-close').click();
                    });
                } else {
                    $.ajax({
                        url: '{{ URL::to('/creat-table') }}',
                        method: 'POST',
                        data: {
                            id: id,
                            type: type,
                            reservation_date: reservation_date,
                            reservation_time: reservation_time,
                            customer_name: customer_name,
                            customer_phone: customer_phone,
                            customer_email: customer_email,
                            _token: _token
                        },
                        success: function(data) {
                            var toastMixin = Swal.mixin({
                                toast: true,
                                icon: 'success',
                                title: 'General Title',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                            toastMixin.fire({
                                animation: true,
                                title: 'Đặt bàn thành công'
                            });
                            $('#insert_table')[0].reset();
                            $(function() {
                                $('.btn-close').click();
                            });
                        }
                    });
                }
            });
        });
    </script> --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            var addTable = 5;
            if ($('#authority_id').val() == addTable) {
                $('#addTable').show();
            }
        });
        $('#authority_id').on('click', function() {
            var addTable = 5;
            $('#addTable').hide();
            if ($('#authority_id').val() == addTable) {
                $('#addTable').show();
            }
        });
        $(function() {
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var minDate = year + '-' + month + '-' + day;

            $('#txtDate').attr('min', minDate);
        });
    </script>
    <script>
        $(document).ready(function() {
            var reserved = 2;
            console.log($('#type').val());
            if ($('#type').val() == reserved) {
                $('#reserved').show();
            }
        });
        $('#type').on('click', function() {
            var reserved = 2;
            console.log($('#type').val());
            $('#reserved').hide();
            if ($('#type').val() == reserved) {
                $('#reserved').show();
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            function loadTable() {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: '{{ URL::to('/table-page') }}',
                    method: "POST",
                    data: {
                        _token: _token
                    },
                    success: function(data) {
                        $('#loadTable').html(data);
                        window.setTimeout(function() {
                            loadTable().reload();
                        }, 100000);
                    }
                });
            }
            $("#addTableForm").on('click', function() {
                var times = $('.times').val();
                var _token = $('input[name= "_token"]').val();
                if (times < 0) {
                    var toastMixin = Swal.mixin({
                        toast: true,
                        icon: 'success',
                        title: 'General Title',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });
                    toastMixin.fire({
                        title: 'Số bàn phải lớn hơn 0',
                        icon: 'error'
                    });
                    $('.addTableForm')[0].reset();
                } else {
                    $.ajax({
                        url: '{{ URL::to('/add-table') }}',
                        method: "POST",
                        data: {
                            times: times,
                            _token: _token
                        },
                        success: function(data) {
                            loadTable();
                            $('.addTableForm')[0].reset();
                            var toastMixin = Swal.mixin({
                                toast: true,
                                icon: 'success',
                                title: 'General Title',
                                animation: false,
                                position: 'top-right',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });
                            toastMixin.fire({
                                animation: true,
                                title: 'Thêm bàn thành công'
                            });
                        }
                    });
                }
            });
        });
    </script>
    <script>
        function change_type() {
            $("#reserved").hide(); //which element you want to hide or show
            function typeofdate() {
                var type = $("#type").val();
                console.log($("#type").val());
                if (type == 2) {
                    $("#reserved").show();
                } else {
                    $("#reserved").hide();
                }
            }
        }
    </script>
@endsection
