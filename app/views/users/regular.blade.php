@extends('layouts.app')

@section('content')
    @if(Session::has('msg_sched'))
        <div class="alert alert-success">
            <strong>{{ Session::get('msg_sched') }}</strong>
        </div>
    @endif
    <div class="alert alert-jim" id="inputText">
        <h2 class="page-header">Regular Employees</h2>
        <form class="form-inline form-accept" action="{{ asset('/search/user/r') }}" method="GET">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Quick Search" autofocus>
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i> Search</button>
            </div>
        </form>
        <div class="clearfix"></div>
        <div class="page-divider"></div>

        @if(isset($regulars) and count($regulars) > 0)
            <div class="table-responsive">
                <table class="table table-list table-hover table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">User ID</th>
                        <th class="text-center">Name </th>
                        <th class="text-center">Work Schedule</th>
                        <th class="text-center">Designation</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($regulars as $regular)
                        @if($regular->emptype == 'REG')
                            <tr>
                                <td class="text-center"><a href="#user" data-id="{{ $regular->userid }}"  class="title-info">{{ $regular->userid }}</a></td>
                                <td class="text-center"><a href="#user" data-id="{{ $regular->id }}" data-link="{{ asset('user/edit') }}" class="text-bold">{{ $regular->fname ." ". $regular->mname." ".$regular->lname }}</a></td>
                                <td class="text-center">
                                    <span class="text-bold">{{ $regular->description }}</span>
                                    <button data-id="{{ $regular->userid }}" type="button" class="btn btn-info btn-xs change_sched">Change</button>
                                </td>
                                <td class="text-center">REGULAR EMPLOYEE</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
            <span id="data_link" data-link="{{ asset('change/work-schedule') }}" />
            {{ $regulars->links() }}
        @else
            <div class="alert alert-danger">
                <strong><i class="fa fa-times fa-lg"></i>No users found.</strong>
            </div>
        @endif
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="change_schedule">
        <div class="modal-dialog modal-md" role="document" id="size">
            <div class="modal-content">
                <div class="modal-header" style="background-color: #9900cc;">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i>Change working schedule</h4>
                </div>
                <div class="modal-body" id="schedule_modal">
                    <div class="modal_content"><center><img src="{{ asset('public/img/spin.gif') }}" width="150" style="padding:10px;"></center></div>
                </div>
            </div><!-- .modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('js')
    @parent
    <script>
        (function($){
            $('.form-accept').submit(function(event){
                $(this).submit();
            });
        })($);
        $('.change_sched').click(function(){
            $('#change_schedule').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
            var url = $('#data_link').data('link');

            var data = {
                id : $(this).data('id')
            };

            $.get(url,data, function(res){
                $('#schedule_modal').html(res);
            });

        });
    </script>
@endsection



