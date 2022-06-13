@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="" style="display: flex;align-items: center;">
                    Thêm danh mục /
                    <!-- Button trigger modal -->
                    <a type="button" class="btn btn-primary ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        style="background:#ddede0;border:1px solid gray;color:black ">
                        Thêm danh mục
                    </a>
                    <!-- Modal -->

                </div>
            </div>
            <div>
                <table class="table border mt-2">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Từ khóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getCategory as $category)
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->category_name}}</td>
                            <td>{{$category->category_slug}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" class="addCategory">
                        @csrf

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control category_name" id="floatingInput nameSlug"
                                placeholder="Tên danh mục">
                            <label for="floatingInput">Tên danh mục</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control category_slug" id="floatingInput nameToSlug"
                                placeholder="Từ khóa">
                            <label for="floatingInput">Từ khóa</label>
                        </div>
                        <select name="status" class="form-control input-lg m-bot15 mb-2 select status">
                            @foreach ($getStatus as $key)
                                @if ($key->id == $key->id)
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @else
                                    <option value="{{ $key->id }}">{{ $key->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <input type="button" id="addCategory" class="btn btn-primary" value="Lưu">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#addCategory").on('click', function() {
                var category_name = $('.category_name').val();
                var category_slug = $('.category_slug').val();
                var status = $('.status').val();
                var _token = $('input[name= "_token"]').val();
                if (category_name == '' || category_slug == '') {
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
                        title: 'Không được để trống các trường',
                        icon: 'error'
                    });
                    $('.addCategory')[0].reset();
                } else {
                    $.ajax({
                        url: '{{ URL::to('/add-category') }}',
                        method: "POST",
                        data: {
                            category_name: category_name,
                            category_slug: category_slug,
                            status: status,
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
                                title: 'Thêm danh mục thành công'
                            });
                            $('.addCategory')[0].reset();
                            $(function() {
                                $('.btn-close').click();
                            });
                        }
                    });
                }
            });
        });
    </script>
    <script src="{{ 'public/backend/js/slug.js' }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
