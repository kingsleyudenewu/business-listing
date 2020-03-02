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
                <table id="datatable-buttons"
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
                                    <a href="{{ route('category.edit', $category->id) }}"
                                       class="btn btn-primary">View</a>
                                    <a href="{{ route('category.destroy', $category->id) }}"
                                       class="btn btn-warning">Delete</a>
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Association
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
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#datatable").DataTable();
        });
    </script>
@endsection
