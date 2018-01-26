<style>
    .table-info tr td:first-child,label {
        color: #2b542c;
    }
</style>
<span id="so_append" data-link="{{ asset('so_append') }}"></span>
<form action="{{ asset('so_update') }}" method="POST" class="form-submit form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token(); }}">
    <input type="hidden" name="version" value="{{ $info->version }}">
    <div class="col-md-12 wrapper">
        <div class="row" style="text-align: center;">
            <div class="col-sm-2">
                <img height="130" width="130" src="{{ asset('public/img/ro7.png') }}" />
            </div>
            <div class="col-sm-8">
                Repulic of the Philippines <br />
                <strong>DEPARTMENT OF HEALTH REGIONAL OFFICE NO. VII</strong><br />
                Osmeña Boulevard, Cebu City, 6000 Philippines <br />
                Regional Director's Office Tel. No. (032) 253-635-6355 Fax No. (032) 254-0109 <br />
                Official Website:<a target="_blank" href="http://www.ro7.doh.gov.ph"><u>http://www.ro7.doh.gov.ph</u></a> Email Address: dohro7{{ '@' }}gmail.com
            </div>
            <div class="col-sm-2">
                <img height="130" width="130" src="{{ asset('public/img/ro7.png') }}" />
            </div>
        </div>
        <div class="box box-info">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Prepared date</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar-plus-o"></i>
                            </div>
                            <input class="form-control datepickercalendar" value="{{ date('m/d/Y',strtotime($info->prepared_date)) }}" name="prepared_date">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Subject</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-book"></i>
                            </div>
                            <textarea class="form-control" name="subject" rows="3" style="resize:none;">{{ $info->subject }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="proceed_loading"></div>
                <div class="proceed">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Header Body</label>
                        <div class="col-sm-9">
                            <textarea class="form-control wysihtml5" name="header_body" rows="3" style="resize:none;" required>.</textarea>
                        </div>
                    </div>
                </div>
                @if($info->version == 2)
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Header Body</label>
                        <div class="col-sm-9">
                            <textarea class="form-control wysihtml5" name="header_body" rows="5" required>{{ $info->header_body }}</textarea>
                        </div>
                    </div>
                @endif
                <div class="form-group">
                    <label class="col-sm-3 control-label">Check to select all employee</label>
                    <div class="col-sm-9">
                        <input type="checkbox" class="form-control" name="all_employee">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Inclusive Name</label>
                    <div class="col-sm-9">
                        <div class="name_loading"></div>
                        <div class="inclusive_name">
                            <select class='form-control select2' name='inclusive_name[]' multiple='multiple' data-placeholder='Select a name' required>
                                @foreach($users as $row)
                                    <option value='{{ $row['id'] }}'>{{ $row['fname'].' '.$row['mname'].' '.$row['lname'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="p_inclusive_date">
                    <?php
                    $count = 1;
                    foreach($inclusive_date as $row):
                    ?>
                    <div class="form-group" id="{{ $count }}">
                        <label class="col-sm-3 control-label">Inclusive Date and Area</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" value="{{ date('m/d/Y',strtotime($row->start)).' - '.date('m/d/Y',strtotime('-1 day',strtotime($row->end))) }}" id="{{ 'inclusive'.$count }}" name="inclusive[]" placeholder="Input date range here..." required>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-location-arrow"></i>
                                </div>
                                <textarea name="area[]" id="area1" class="form-control" style="resize: none;width: 90%" rows="1" placeholder="Input your area here..." required>{{ $row->area }}</textarea>
                            </div>
                        </div>
                    </div>
                    <?php
                    $count++;
                    endforeach;
                    ?>
                    <input type="hidden" value="{{ $count }}" id="date_count">
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn-xs btn-primary pull-right" type="button" style="color: white" onclick="add_inclusive();"><i class="fa fa-plus"></i> Add inclusive date</button>
                    </div>
                </div>
                <div class="proceed_loading"></div>
                <div class="proceed">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Entitled Body</label>
                        <div class="col-sm-9">
                            <textarea class="form-control wysihtml5_1" name="footer_body" rows="3" style="resize:none;" required>.</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">To be approve by</label>
                        <div class="col-sm-9">
                            <input type="hidden" value="Jaime S. Bernadas, MD, MGM, CESO III" id="proceed_director">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-thumbs-up"></i>
                                </div>
                                <select name="approved_by" id="approved_by" class="form-control" onchange="approved($(this))" required>
                                    <option value="Jaime S. Bernadas, MD, MGM, CESO III">Jaime S. Bernadas, MD, MGM, CESO III</option>
                                    <option value="Ruben S. Siapno,MD,MPH">Ruben S. Siapno,MD,MPH</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Designation</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <input type="text" class="form-control director" readonly/>
                            </div>
                        </div>
                    </div>
                </div>
                @if($info->version == 2)
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Entitled Body</label>
                        <div class="col-sm-9">
                            <textarea class="form-control wysihtml5_1" name="footer_body" rows="5" required>{{ $info->footer_body }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">To be approve by</label>
                        <div class="col-sm-9">
                            <input type="hidden" id="get_director" value="{{ $info->approved_by }}">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-thumbs-up"></i>
                                </div>
                                <select name="approved_by" id="approved_by" class="form-control" onchange="approved($(this))" required>
                                    @if($info->version == 1)
                                        <option value="">Select Name</option>
                                        <option value="Jaime S. Bernadas, MD, MGM, CESO III">Jaime S. Bernadas, MD, MGM, CESO III</option>
                                        <option value="Ruben S. Siapno,MD,MPH">Ruben S. Siapno,MD,MPH</option>
                                        <option value="SOPHIA MANCAO MD, DPSP">SOPHIA MANCAO MD, DPSP</option>
                                    @else
                                        <option value="{{ $info->approved_by }}">{{ $info->approved_by }}</option>
                                        @if($info->approved_by == 'Jaime S. Bernadas, MD, MGM, CESO III')
                                            <option value="SOPHIA MANCAO MD, DPSP">SOPHIA MANCAO MD, DPSP</option>
                                            <option value="Ruben S. Siapno,MD,MPH">Ruben S. Siapno,MD,MPH</option>
                                        @elseif($info->approved_by == 'SOPHIA MANCAO MD, DPSP')    
                                            <option value="Jaime S. Bernadas, MD, MGM, CESO III">Jaime S. Bernadas, MD, MGM, CESO III</option>
                                            <option value="Ruben S. Siapno,MD,MPH">Ruben S. Siapno,MD,MPH</option>
                                        @elseif($info->approved_by == 'Ruben S. Siapno,MD,MPH')    
                                            <option value="Jaime S. Bernadas, MD, MGM, CESO III">Jaime S. Bernadas, MD, MGM, CESO III</option>
                                            <option value="SOPHIA MANCAO MD, DPSP">SOPHIA MANCAO MD, DPSP</option>
                                        @endif
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Designation</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-book"></i>
                                </div>
                                <input type="text" class="form-control director" readonly/>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
         </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
        @if($info->approved_status)
            <button type="button" onclick="warning('update')" class="btn btn-primary btn-submit" style="color:white"><i class="fa fa-pencil"></i> Update</button>
            <a href="#" onclick="warning('proceed')" class="btn btn-info" style="color:white"><i class="fa fa-file"></i> Proceed form into v2</a>
        @else
            <button type="submit" class="btn btn-primary btn-submit" style="color:white"><i class="fa fa-pencil"></i> Update</button>
            @if($info->version == 1)
            <a href="#" class="btn btn-info" onclick="proceed()" style="color:white"><i class="fa fa-file"></i> Proceed form into v2</a>
            @endif
        @endif
        <button type="button" class="btn btn-success" data-dismiss="modal" style="color:white" data-toggle="modal" data-target="#paperSize"><i class="fa fa-barcode"></i> Barcode v1</button>
        <a target="_blank" href="{{ asset('pdf/track') }}" class="btn btn-success" style="color:white"><i class="fa fa-barcode"></i> Barcode v2</a>
        @if($info->version == 1)
            <a onclick="warning('barcode')" class="btn btn-success" style="color:white"><i class="fa fa-barcode"></i> Barcode v3</a>
        @elseif($info->version == 2)
            <a href="{{ asset('/form/so_pdf') }}" target="_blank" class="btn btn-success" style="color:white"><i class="fa fa-barcode"></i> Barcode v3</a>
        @endif
        <button type="button" data-route="{{ $info->route_no }}" data-link="{{ asset('/form/info/'.$info->route_no) }}" style="color:white" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#deleteDocument"><i class="fa fa-trash"></i> Remove</button>
    </div>
</form>
<script>
    $('.datepickercalendar').datepicker({
        autoclose: true
    });
    $(".proceed").hide();
    function proceed(){
        approved($("#proceed_director"));
        $(".proceed_loading").html(loadingState);
        $('input[name=proceed]').val("proceed");
        $('input[name=version]').val('2');
        setTimeout(function(){
            $(".proceed_loading").html('');
            $(".proceed").show()
        },700);
    }
    $(".wysihtml5").wysihtml5();
    $(".wysihtml5_1").wysihtml5();
    $(".select2").select2();
    $('.select2').val(<?php echo $inclusive_name; ?>).trigger('change');
    $("#inclusive1").daterangepicker();

    for(var i = 1; i < $("#date_count").val();i++){
        $(function() {
            $("body").delegate("#inclusive"+i, "focusin", function(){
                $(this).daterangepicker();
            });
        });
    }
    var count = $("#date_count").val();
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
        //make multiple call to remove
        for(var i=0; i<10; i++){
            $("#"+id.val()).remove();
        }
    }

    $('.form-submit').on('submit',function(){
        $('.btn-submit').attr("disabled", true);
    });

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });

    $('input[name=all_employee]').on('ifChecked', function(event){
        $(".name_loading").html(loadingState);
        $(".inclusive_name").hide();
        setTimeout(function(){
            $('.select2').val(<?php echo $all_user;?>).trigger('change');
            $(".name_loading").html('');
            $(".inclusive_name").show();
        },700);
    });

    $('input[name=all_employee]').on('ifUnchecked', function(event){
        $(".name_loading").html(loadingState);
        $(".inclusive_name").hide();
        setTimeout(function(){
            $('.select2').val(<?php echo $inclusive_name;?>).trigger('change');
            $(".name_loading").html('');
            $(".inclusive_name").show()
        },700);
    });

    function warning(data){
        if(data == 'update')
            var message = "Cannot update if your OFFICE_ORDER is already approved..";
        else if(data == 'proceed')
            var message = "Cannot proceed if your OFFICE_ORDER is already approved..";
        else if(data == 'barcode')
            var message = "Please proceed you're form into version 2 before you generate the barcode version 3!";
        Lobibox.alert('info', //AVAILABLE TYPES: "error", "info", "success", "warning"
        {
            msg: message
        });
    }

    approved($("#get_director"));
    function approved(data){
        if(data.val() == 'Jaime S. Bernadas, MD, MGM, CESO III')
            $(".director").val('Director IV');
        else if(data.val() == 'Ruben S. Siapno,MD,MPH')
            $(".director").val('Director III');
        else if(data.val() == 'SOPHIA MANCAO MD, DPSP')
            $(".director").val('OIC - Director III');
        else
            $(".director").val('');
    }
</script>