@extends('layouts.master')
@section('content')

    <div class="row heading-bg">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">

            <h5 class="txt-dark">Add New Terminal</h5>

        </div>

    </div>


    <!-- Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Add Terminal</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-wrap">
                                    <form data-toggle="validator" role="form" method="POST" action="{{route('terminal.store')}}">
                                        {{csrf_field()}}

                                        <div class="form-group{{ $errors->has('company_id') ? ' has-error' : '' }}">

                                            <label for="inputName" class="control-label mb-10">Company</label>
                                            <select class="companyId form-control select2" name="company_id" style="background:#f2f2f2;">
                                                <option disabled selected>Select Company</option>
                                                @foreach($companies as $company)
                                                    <option value="{{$company->id}}" >{{$company->company_name}}</option>
                                                @endforeach

                                            </select>

                                            @if ($errors->has('company_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('company_id') }}</strong>
                                                </span>
                                            @endif

                                        </div>

                                        <div class="form-group{{ $errors->has('branch_id') ? ' has-error' : '' }}">

                                            <label for="inputName" class="control-label mb-10">Branch</label>
                                            <select class="branchId form-control select2" name="branch_id" style="background:#f2f2f2;" disabled>



                                            </select>

                                            @if ($errors->has('branch_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('branch_id') }}</strong>
                                                </span>
                                            @endif

                                        </div>

                                        <div class="form-group{{ $errors->has('terminal_name') ? ' has-error' : '' }}">
                                            <label for="inputName" class="control-label mb-10">Terminal Name</label>
                                            <input type="text" class="form-control"  name="terminal_name" style="background:#f2f2f2;">
                                            @if ($errors->has('terminal_name'))
                                                <span class="help-block">
                                            <strong>{{ $errors->first('terminal_name') }}</strong>
                                        </span>
                                            @endif
                                        </div>

                                        <div class="form-group{{ $errors->has('terminal_code') ? ' has-error' : '' }}">
                                            <label for="inputName" class="control-label mb-10">Terminal Code</label>
                                            <input  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" type="number" maxlength="11" class="form-control" name="terminal_code" style="background:#f2f2f2;">
                                            @if ($errors->has('terminal_code'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('terminal_code') }}</strong>
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

@section('script')
    <script type="text/javascript">
        $(document).ready(function (e) {
            $('.branchId').attr('disabled', 'disabled');

            $(".companyId").on('change', function () {
                $('.branchId').text('');
                var id = $(this).val();

                $.ajax({
                    url:'/reqBranches',
                    method:'POST',
                    dataType:'JSON',
                    data:{ 'id' : id , '_token': '{{csrf_token()}}' },
                    success: function (data) {

                        $('.branchId').removeAttr('disabled');

                        $('.branchId').append('<option disabled selected>Select Branch</option>');

                        data.forEach(function (result) {
                            $('.branchId').append('<option value="'+result.id+'">'+result.branch_name+'</option>');
                            //console.log(result.branch_name);
                        })

                    },
                });
            });
        });
    </script>
@endsection