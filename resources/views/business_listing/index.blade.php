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
                    @if(auth()->user())
                        <div class="col-sm-6">
                            <div class="float-right">
                                <button class="btn btn-primary waves-effect waves-light"
                                        data-toggle="modal" data-target="#accept">Add Listing
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        @if(auth()->user())
                            <th>Action</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($businessListings as $businessListing)
                        <tr>
                            <td>{{ $businessListing->name }}</td>
                            <td>{{ $businessListing->description }}</td>
                            <td>{{ $businessListing->email }}</td>
                            <td>{{ $businessListing->phone }}</td>
                            <td>{{ $businessListing->address }}</td>
                            @if(auth()->user())
                                <td>
                                    <a href="{{ route('business.listing.show', $businessListing->id)
                                     }}"
                                       class="btn btn-primary"
                                       data-edit-listing="{{ $businessListing->id }}">View</a>
                                    <a href="#"
                                       class="btn btn-warning delete_listing"
                                       data-delete-listing="{{ $businessListing->id }}">Delete</a>
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
                    <h5 class="modal-title mt-0" id="myModalLabel">Business Listing
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('business.listing.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name <span class="error">*</span></label>
                            <input type="text"
                                   name="name"
                                   class="form-control"
                                   id="name" required>
                        </div>

                        <div class="form-group">
                            <label for="">Category <span class="error">*</span></label>
                            <select name="category_id[]" class="form-control" id="category_id" multiple
                                    required>
                                <option value="" disabled>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"> {{ $category->name
                                    }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Description <span class="error">*</span></label>
                            <input type="text"
                                   name="description"
                                   class="form-control"
                                   id="description" required/>
                        </div>

                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text"
                                   name="email"
                                   class="form-control"
                                   id="email"/>
                        </div>

                        <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   id="phone"/>
                        </div>

                        <div class="form-group">
                            <label for="name">Address</label>
                            <input type="text"
                                   name="address"
                                   class="form-control"
                                   id="address"
                            />
                        </div>

                        <div class="form-group">
                            <label for="name">Logo</label>
                            <input type="file"
                                   name="image"
                                   class="form-control"
                            />
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

        });
    </script>
@endsection
