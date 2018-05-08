@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <h5 class="txt-dark">Edit Company</h5>
            <br><br>
            <a href="{{url('company/create')}}" class="btn btn-primary btn-anim"><strong><i class=" icon-plus "></i><span class="btn-text">ADD NEW</span></strong></a>

            <a href="{{url('company')}}" class="btn btn-default btn-anim" style="float: right;"><strong><i class="icon-arrow-left-circle"></i><span class="btn-text">BACK</span></strong></a>
            <br><br>

        </div>

    </div>



    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Edit Company</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-wrap">
                                    <form data-toggle="validator" role="form" method="POST" action="{{url('company/'.$company->id)}}">
                                        {{csrf_field()}}
                                        {{ method_field('PATCH') }}


                                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                            <label for="inputName" class="control-label mb-10">Name</label>
                                            <input type="text" class="form-control"  name="company_name" style="background:#f2f2f2;" value="{{$company->company_name}}">
                                            @if ($errors->has('company_name'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('company_name') }}</strong>
                                            </span>
                                            @endif
                                        </div>


                                        <div class="form-group{{ $errors->has('company_address') ? ' has-error' : '' }}">
                                            <label for="inputName" class="control-label mb-10">Address</label>
                                            <textarea class="form-control" name="company_address" style="background:#f2f2f2;" rows="5" >{{$company->company_address}}</textarea>
                                            @if ($errors->has('company_address'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('company_address') }}</strong>
                                        </span>
                                            @endif
                                        </div>


                                        <div class="form-group">

                                            <div class="form-group{{ $errors->has('company_phoneNo') ? ' has-error' : '' }}">
                                                <label for="inputName" class="control-label mb-10">PhoneNo</label>
                                                <input  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="11" class="form-control" name="company_phoneNo" style="background:#f2f2f2;" value="{{$company->company_phoneNo}}">
                                                @if ($errors->has('company_phoneNo'))
                                                    <span class="help-block">
                                            <strong>{{ $errors->first('company_phoneNo') }}</strong>
                                        </span>
                                                @endif
                                            </div>

                                            <div class="form-group">

                                                <label class="control-label mb-10">Status</label>
                                                <div>
                                                    <input id="check_box_switch" name="status" type="checkbox" data-off-text="Inactive" data-on-text="Active" data-toggle="Inactive" class="bs-switch @php if($company->status == 0){ echo'switch'; } @endphp"/>
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

@section('script')
    <script type="text/javascript">

            $(document).ready(function (e) {
                $('.switch').click();
            })

    </script>
@endsection