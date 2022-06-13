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
                <div>
                    Thông tin bàn : {{ $getTable->number }} / Trạng thái : {{ $getTable->getStatus->name }}
                    {{-- <a class="btn btn-xs btn-primary" href="{{ URL::to('add-banner') }}">{{ __('Add banner') }}</a> --}}
                </div>
            </div>

            <div class="table-responsive d-flex mt-2">
                <div class="col-md-6">
                    <form action="" method="POST">
                        <div class="col-md-6">
                            <div class="chair">
                                <p class="number">{{ $getTable->number }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <select name="authority_id" id="authority_id" class="form-control input-lg m-bot15">
                                @foreach ($getTableStatus as $key)
                                    @if ($key->id == $key->id)
                                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                                    @else
                                        <option value="{{ $key->id }}">{{ $key->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="card rounded border-0 mb-4 hide-1" id="reserved">
                            <input type="date" name="reservation_date" class="form-control" id="txtDate">
                            <input type="time" name="reservation_time" class="form-control" id="txtDate">
                        </div>
                        <div class="card rounded border-0 mb-4 hide-1" id="using">
                            abc
                        </div>
                    </form>
                    {{-- @foreach ($getTable as $table)
                        <a href="{{URL::to('detail-table/'.$table->id)}}" class="chair">
                            <div>
                                <p class="number">{{$table->number}}</p>
                            </div>
                        </a>
                    @endforeach --}}
                </div>
            </div>
        </div>
    </div>
    <style>
        .table {
            width: 60px;
            height: 60px;
            background: red;
        }

        .hide-1 {
            display: none;
        }

        .chair {
            width: 50px;
            height: 50px;
            background: red;
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
    </style>
    <script>
        $(document).ready(function() {
            var reserved = 2;
            var using = 3;
            if ($('#authority_id').val() == reserved) {
                $('#reserved').show();
            }
            if ($('#authority_id').val() == using) {
                $('#using').show();
            }
        });
        $('#authority_id').on('click', function() {
            var reserved = 2;
            var using = 3;
            $('#reserved').hide();
            if ($('#authority_id').val() == reserved) {
                $('#reserved').show();
            }
            $('#using').hide();
            if ($('#authority_id').val() == using) {
                $('#using').show();
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
@endsection
