@extends('layouts.app')
@section('content')
    <div class="col-md-12 wrapper">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Office Order</h3>
            </div>
            <input type="hidden" name="inclusive_name" value="{{ $inclusive_name[0] }}"/>
            <span id="inclusive_name_page" data-link="{{ asset('inclusive_name_page') }}"></span>
            <span id="so_append" data-link="{{ asset('so_append') }}"></span>
            <form action="{{ asset('so_addv1') }}" method="POST" class="form-submit form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-body">
                    <div class="form-group">
                        <label for="prepared_by" class="col-sm-2 control-label">Prepared By</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-bookmark"></i>
                                </div>
                                <input type="text" class="form-control" value="Office Order" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Prepared date</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar-plus-o"></i>
                                </div>
                                <input class="form-control datepickercalendar" value="{{ date('m/d/Y') }}" name="prepared_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Subject</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <textarea class="form-control" name="subject" rows="3" style="resize:none;" required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Inclusive Name</label>
                        <div class="col-sm-10">
                            <select class="form-control select2" name="inclusive_name[]" multiple="multiple" data-placeholder="Select a name" required>
                                @foreach($users as $row)
                                    <option value="{{ $row['id'] }}">{{ $row['fname'].' '.$row['mname'].' '.$row['lname'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="p_inclusive_date">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Inclusive Date and Area</label>
                            <div class="col-sm-4">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input type="text" class="form-control" id="inclusive1" name="inclusive[]" placeholder="Input date range here..." required>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <i class="fa fa-location-arrow"></i>
                                    </div>
                                    <textarea name="area[]" id="area1" class="form-control" rows="1" placeholder="Input your area here..." required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button class="btn btn-primary pull-right" type="button" style="color: white" onclick="add_inclusive();"><i class="fa fa-plus"></i> Add inclusive date</button>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="{{ asset('/form/so_list') }}" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</a>
                        <button type="submit" class="btn btn-success btn-submit" style="color:white;"><i class="fa fa-send"></i> Submit</button>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $('.datepickercalendar').datepicker({
            autoclose: true
        });
        $(".select2").select2();
        $(function(){
            $("body").delegate("#inclusive1","focusin",function(){
                $(this).daterangepicker();
            });
        });
        var count = 1;
        function add_inclusive(){
            event.preventDefault();
            count++;
            var url = $("#so_append").data('link')+"?count="+count;
            $.get(url,function(result){
                $(".p_inclusive_date").append(result);
            });
            $(function() {
                $("body").delegate("#inclusive"+count, "focusin", function(){
                    $(this).daterangepicker();
                });
            });
        }

        function remove_row(id){
            //make two call to remove
            for(var i=0; i<2; i++){
                $("#"+id.val()).remove();
            }
        }

        $.get($("#inclusive_name_page").data("link"),function(result){
            $('select').val(result).trigger('change');
        });

        $('.form-submit').on('submit',function(){
            $('.btn-submit').attr("disabled", true);
        });

    </script>
@endsection

        <!-- <form action="{{ asset('so_addv1') }}" method="POST" class="form-submit">
    <input type="hidden" name="_token" value="{{ csrf_token(); }}"> -->

        <!--
        <table class="table table-hover table-form table-striped table-info">
            <tr>
                <td class="col-sm-3"><label>Document Type</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-bookmark"></i>
                        </div>
                        <input type="text" class="form-control" value="Office Order" readonly>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Prepared date</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar-plus-o"></i>
                        </div>
                        <input class="form-control datepickercalendar" value="{{ date('m/d/Y') }}" name="prepared_date" required>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Subject</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-book"></i>
                        </div>
                        <textarea class="form-control" name="subject" rows="3" style="resize:none;" required></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Check to select all employee</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <input type="checkbox" class="form-control" name="all_employee">
                </td>
            </tr>
            <tr>
                <td class="col-sm-3"><label>Inclusive Name</label></td>
                <td class="col-sm-1">:</td>
                <td class="col-sm-8">
                    <div class="name_loading"></div>
                    <div class="inclusive_name">
                        <select class='form-control select2' name='inclusive_name[]' multiple='multiple' data-placeholder='Select a name' required>
                            @foreach($users as $row)
        <option value='{{ $row['id'] }}'>{{ $row['fname'].' '.$row['mname'].' '.$row['lname'] }}</option>
                            @endforeach
        </select>
    </div>
</td>
</tr>
<tbody class="p_inclusive_date">
<tr>
<td class="col-sm-3"><label>Inclusive Date and Area</label></td>
<td class="col-sm-1">:</td>
<td class="col-sm-8">
    <div class="input-group">
        <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
        </div>
        <input type="text" class="form-control" id="inclusive1" name="inclusive[]" placeholder="Input date range here..." style="width: 40%;" required>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <textarea name="area[]" id="area1" class="form-control" rows="1" cols="30" placeholder="Input your area here..." style="resize: none;width: 100%;" required></textarea>
                        </div>
                    </div>
                </td>
            </tr>
            </tbody>
            <tr>
                <td class="col-sm-3"></td>
                <td class="col-sm-1"></td>
                <td class="col-sm-8" id="border-top">
                    <button class="btn-xs btn-primary pull-right" type="button" style="color: white" onclick="add_inclusive();"><i class="fa fa-plus"></i> Add inclusive date</button>
                </td>
            </tr>
        </table>
    </div> -->