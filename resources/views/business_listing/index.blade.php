@extends('layout::app')

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
                                        data-toggle="modal" data-target="#accept">Add Association
                                </button>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    @include('layout::includes.alert')
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
                        @if(auth()->user()->id)
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
                            @if(auth()->user()->id)
                                <td>
                                    <a href="{{ route('associations.edit', $association->id) }}"
                                       class="btn btn-primary">View</a>
                                    <a href="{{ route('associations.destroy', $association->id) }}"
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
                    <form action="{{ route('associations.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name <span class="error">*</span></label>
                            <input type="text" name="name" class="form-control"
                                   id="name" required>
                        </div>

                        <div class="form-group">
                            <label for="federation_id">Federation <span
                                    class="error">*</span></label>
                            <select name="federation_id" id="federation_id" class="form-control"
                                    required>
                                <option value="" disabled> Select Federation</option>
                                @foreach($federations as $key => $federation)
                                    <option
                                        value="{{ $federation->id }}">{{ $federation->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="staus">Type <span class="error">*</span></label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="" disabled> Select Type</option>
                                @foreach($types as $key => $type)
                                    <option
                                        value="{{ $type }}">{{ $type }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Acronym</label>
                            <input type="text"
                                   name="acronym"
                                   class="form-control"
                                   id="acronym"/>
                        </div>

                        <div class="form-group">
                            <label for="name">Postal Code</label>
                            <input type="text"
                                   name="postal_code"
                                   class="form-control"
                                   id="postal_code"/>
                        </div>

                        <div class="form-group">
                            <label for="name">Phone</label>
                            <input type="text"
                                   name="phone"
                                   class="form-control"
                                   id="phone"/>
                        </div>

                        <div class="form-group">
                            <label for="name">Fax</label>
                            <input type="text"
                                   name="fax"
                                   class="form-control"
                                   id="fax"/>
                        </div>

                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text"
                                   name="email"
                                   class="form-control"
                                   id="email"/>
                        </div>

                        <div class="form-group">
                            <label for="name">Website</label>
                            <input type="text"
                                   name="website"
                                   class="form-control"
                                   id="website"
                            />
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
                            <label for="name">Observation</label>
                            <input type="text"
                                   name="observation"
                                   class="form-control"
                                   id="observation"
                            />
                        </div>

                        <div class="form-group">
                            <label for="staus">Recruitment Responsible</label>
                            <select name="recruitment_responsible" id="recruitment_responsible"
                                    class="form-control">
                                <option value="" disabled> Select Type</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name">Logo</label>
                            <input type="file"
                                   name="image"
                                   class="form-control"
                            />
                        </div>

                        <fieldset>
                            <div class="row">
                                <div class="col-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               id="is_active"
                                               name="is_active" checked
                                               value="1">
                                        <label class="custom-control-label" for="customCheck2">
                                            Active
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox"
                                               class="custom-control-input"
                                               id="official"
                                               name="official"
                                               value="1">
                                        <label class="custom-control-label" for="customCheck3">
                                            Official
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>


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
