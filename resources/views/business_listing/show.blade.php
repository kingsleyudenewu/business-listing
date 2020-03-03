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
                                        data-toggle="modal" data-target="#accept">Add Image
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
                <div class="col-sm-12">
                    <div>Name: {{ $businessListing->name }}</div>
                    <div>Address {{ $businessListing->address }}</div>
                    <div>Phone {{ $businessListing->phone }}</div>
                    <div>Category
                        @foreach($businessListing->categories as $category)
                            <li> {{ $category->name }}</li>
                        @endforeach
                    </div>
                    <div>Image
                        @foreach($businessListing->businessListingImage as $image)
                            <li><img src="{{ asset('storage/'.$image->image) }}" width="100px"
                                     height="auto"
                                     alt=""> </li>
                        @endforeach
                    </div>
                </div>
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
                    <form action="{{ route('business.listing.upload') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="business_listing_id" value="{{
                        $businessListing->id }}">
                        <div class="form-group">
                            <label for="name">Logo</label>
                            <input type="file"
                                   name="image"
                                   class="form-control"
                            />
                        </div>

                        <div class="checkbox-row">
                            <label for="">Default</label>
                            <input type="checkbox" name="is_default" id="is_default" value="1">
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
