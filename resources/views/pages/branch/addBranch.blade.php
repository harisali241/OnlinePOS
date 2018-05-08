@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Add New Branch</h5>

        </div>

    </div>


    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Add Branch</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-wrap">
                                    <form data-toggle="validator" role="form" method="POST" action="{{route('branch.store')}}">
                                        {{csrf_field()}}

                                        <div class="form-group">
                                            <div class="form-group{{ $errors->has('company_id') ? ' has-error' : '' }}">

                                                <label for="inputName" class="control-label mb-10">Companies</label>
                                            <select class="form-control select2" name="company_id" style="background:#f2f2f2;">
                                                <option disabled selected>Select Company</option>
                                                @foreach($companies as $company)
                                                     <option value="{{$company->id}}">{{$company->company_name}}</option>
                                                @endforeach

                                            </select>

                                                @if ($errors->has('company_id'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('company_id') }}</strong>
                                                    </span>
                                                @endif

                                        </div>

                                        <div class="form-group">

                                            <div class="form-group{{ $errors->has('branch_name') ? ' has-error' : '' }}">
                                            <label for="inputName" class="control-label mb-10">Branch Name</label>
                                            <input type="text" class="form-control"  name="branch_name" style="background:#f2f2f2;">
                                            @if ($errors->has('branch_name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('branch_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                        <div class="form-group">

                                                <div class="form-group{{ $errors->has('branch_address') ? ' has-error' : '' }}">
                                                    <label for="inputName" class="control-label mb-10">Address</label>
                                                    <textarea class="form-control" name="branch_address" style="background:#f2f2f2;" rows="5"></textarea>
                                                    @if ($errors->has('branch_address'))
                                                        <span class="help-block">
                                                    <strong>{{ $errors->first('branch_address') }}</strong>
                                                </span>
                                                    @endif
                                                </div>


                                                <div class="form-group">

                                                    <div class="form-group{{ $errors->has('branch_phoneNo') ? ' has-error' : '' }}">
                                                        <label for="inputName" class="control-label mb-10">PhoneNo</label>
                                                        <input  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="11" class="form-control" name="branch_phoneNo" style="background:#f2f2f2;">
                                                        @if ($errors->has('branch_phoneNo'))
                                                            <span class="help-block">
                                                    <strong>{{ $errors->first('branch_phoneNo') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">

                                                        <label class="control-label mb-10">Status</label>
                                                        <div>
                                                            <input id="check_box_switch" name="status" type="checkbox" data-off-text="Inactive" data-on-text="Active"  class="bs-switch" />
                                                        </div>
                                                    </div>

                                            <br>
                                        <div class="form-group mb-0">
                                            <button type="submit" class="btn btn-success btn-anim"><i class="icon-arrow-right-circle"></i><span class="btn-text">Save</span></button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->

@endsection