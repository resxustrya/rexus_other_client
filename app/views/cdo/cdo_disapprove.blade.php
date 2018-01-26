@if(isset($cdo['paginate_disapprove']) and count($cdo['paginate_disapprove']) >0)
    <div class="table-responsive" style="margin-top: -20px;">
        <label style="padding-bottom: 10px;">Check to select all to approve </label>
        <input type="checkbox" id="click_approve">
        <label class="button" style="font-weight: normal !important;"></label>
        <table class="table table-list table-hover table-striped">
            <thead>
            <tr>
                <th></th>
                <th class="text-center">Route #</th>
                <th class="text-center">Prepared Date</th>
                @if(\Illuminate\Support\Facades\Auth::user()->usertype)
                    <th class="text-center">Prepared Name</th>
                @else
                    <th class="text-center">Document Type</th>
                @endif
                <th class="text-center">Subject</th>
                <th class="text-center" width="17%">Option</th>
            </tr>
            </thead>
            <tbody style="font-size: 10pt;">
            @foreach($cdo['paginate_disapprove'] as $row)
                <tr>
                    <td><a href="#track" data-link="{{ asset('form/track/'.$row->route_no) }}" data-route="{{ $row->route_no }}" data-toggle="modal" class="btn btn-sm btn-success col-sm-12" style="background-color:darkmagenta;color:white;"><i class="fa fa-line-chart"></i> Track</a></td>
                    <td><a class="title-info" data-backdrop="static" data-route="{{ $row->route_no }}" style="color: #f0ad4e;" data-link="{{ asset('/form/info/'.$row->route_no.'/cdo') }}" href="#document_info" data-toggle="modal">{{ $row->route_no }}</a></td>
                    <td>{{ date('M d, Y',strtotime($row->prepared_date)) }}<br>{{ date('h:i:s A',strtotime($row->prepared_date)) }}</td>
                    @if(\Illuminate\Support\Facades\Auth::user()->usertype)
                        <td>{{ pdoController::user_search1($row['prepared_name'])['fname'].' '.pdoController::user_search1($row['prepared_name'])['mname'].' '.pdoController::user_search1($row['prepared_name'])['lname'] }}</td>
                    @else
                        <td>CTO</td>
                    @endif
                    <td>{{ $row->subject }}</td>
                    <td><button type="submit" class="btn-xs btn-info" value="{{ $row->id }}" onclick="disapproved_status($(this))" style="color:white;"><i class="fa fa-smile-o"></i> Approve</button></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $cdo['paginate_disapprove']->links() }}
@else
    <div class="alert alert-danger" role="alert"><span style="color:red;">Documents records are empty.</span></div>
@endif

<script>
    //document information
    $("a[href='#document_info']").on('click',function(){
        var route_no = $(this).data('route');
        $('.modal_content').html(loadingState);
        $('.modal-title').html('Route #: '+route_no);
        var url = $(this).data('link');
        setTimeout(function(){
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.modal_content').html(data);
                    $('#reservation').daterangepicker();
                    var datePicker = $('body').find('.datepicker');
                    $('input').attr('autocomplete', 'off');
                }
            });
        },1000);
    });

    $("a[href='#document_form']").on('click',function(){
        $('.modal-title').html('CTO');
        var url = $(this).data('link');
        $('.modal_content').html(loadingState);
        setTimeout(function(){
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    $('.modal_content').html(data);
                    $('#reservation').daterangepicker();
                    var datePicker = $('body').find('.datepicker');
                    $('input').attr('autocomplete', 'off');
                }
            });
        },1000);
    });

    function disapproved_status(data){
        var page = "<?php echo Session::get('page_disapprove') ?>";
        var url = $("#cdo_updatev1").data('link')+'/'+data.val()+'/disapprove?page='+page;
        $.post(url,function(result){
            console.log(url);
            $('.ajax_disapprove').html(loadingState);
            setTimeout(function(){
                if(result['count_disapprove'] && !result['paginate_disapprove']){
                    console.log("asin1");
                    getPosts(page-1,'');
                } else {
                    console.log("asin2");
                    $('.ajax_disapprove').html(result['view']);
                }
                Lobibox.notify('info',{
                    msg:'Approve!'
                });
                $(".disapprove").html(result["count_disapprove"]);
                $(".approve").html(result["count_approve"]);
            },700);
        });
    }

    function click_all(type){
        var url = "<?php echo asset('click_all');?>"+"/"+type.val();
        $.get(url,function(result){
            if(type.val() == 'disapprove'){
                $('.ajax_approve').html(loadingState);
                setTimeout(function(){
                    Lobibox.notify('error',{
                        msg:'Disapprove!'
                    });
                    $('.ajax_approve').html(result['view']);
                    $(".disapprove").html(result['disapprove']);
                    $(".approve").html(result['approve']);
                },700);
            }
            else if(type.val() == 'approve'){
                $('.ajax_disapprove').html(loadingState);
                setTimeout(function(){
                    Lobibox.notify('info',{
                        msg:'Approve!'
                    });
                    $('.ajax_disapprove').html(result['view']);
                    $(".disapprove").html(result['disapprove']);
                    $(".approve").html(result['approve']);
                },700);
            }
        });
    }

    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });

    $('#click_approve').on('ifChecked', function(event){
        $(".button").html("<button type='button' value='approve' onclick='click_all($(this))' class='btn-group-sm btn-info'><i class='fa fa-smile-o'></i> Approve all cdo/cto</button>");
    });
    $('#click_approve').on('ifUnchecked', function(event){
        $(".button").html("");
    });
</script>