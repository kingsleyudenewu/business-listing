@extends('layouts.app')

@section('content')

    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <h4 class="page-title">{{ $pageTitle }}</h4>
                    </div>
                    @if(auth()->user()->id)
                        <div class="col-sm-6">
                            <div class="float-right">
                                <button class="btn btn-primary waves-effect waves-light"
                                        data-toggle="modal" data-target="#accept">Add Category
                                </button>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @include('includes.alert')
                </div>
            </div>

            <div class="row">
                <table id="datatable"
                       class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        @if(auth()->user()->id)
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            @if(auth()->user()->id)
                                <td>
                                    <a href="#"
                                       class="btn btn-primary edit_category"
                                       data-edit-category="{{ $category->id }}">Edit</a>
                                    <a href="#"
                                       class="btn btn-warning delete_category"
                                       data-delete-category="{{ $category->id }}">Delete</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="accept" class="modal fade show" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name <span class="error">*</span></label>
                            <input type="text" name="name" class="form-control"
                                   id="name" required>
                        </div>

                        <div class="form-group">
                            <input type="submit"
                                   value="Submit"
                                   class="btn btn-info waves-effect waves-light"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div id="update-modal" class="modal fade show" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-modal="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myModalLabel">Category
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="editCategoryForm">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="name">Name <span class="error">*</span></label>
                            <input type="text" name="name" class="form-control"
                                   id="name" required>
                        </div>

                        <div class="form-group">
                            <input type="submit"
                                   value="Submit"
                                   class="btn btn-info waves-effect waves-light"/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect"
                            data-dismiss="modal">Close
                    </button>
                </div>
            </div><!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on('click', '.edit_category', function (ev) {
                ev.preventDefault();
                var val = $(this).data('edit-category');
                $.ajax({
                    url: 'category/' + val,
                    type: 'GET',
                    beforeSend: function () {
                    },
                    success: function (response) {
                        console.log(response.data);
                        $('#editCategoryForm')
                            .find('[name="name"]').val(response.data.name).end();

                        $("#editCategoryForm").attr("action", "category/" + response.data.id);
                        $("#update-modal").modal({backdrop: 'static', keyboard: true});
                    },
                    error: function (response) {
                        console.log(response);
                        alert('Operation failed');
                    }
                });
            });

            $(document).on('click', '.delete_category', function (ev) {
                ev.preventDefault();
                var val = $(this).data('delete-category');
                var r = confirm("Do you want to delete this user");
                if (r === true) {
                    $.ajax({
                        type: 'post',
                        url: "category/" + val,
                        data: {
                            '_method': 'DELETE',
                            "_token": "{{ csrf_token() }}",
                            'id': val
                        },
                        success: function (response) {
                            console.log(response.data);
                            if (response.data === 'ok') {
                                alert('Operation successful');
                                window.location.href = "{{ route('category.index') }}";
                            }
                        }
                    });
                }
            });

        });
    </script>
@endsection
