
@extends('layouts.app')

@section('content')
    <div class="col-md-12 wrapper" >
        <div class="alert alert-jim">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><strong style="color: #f0ad4e;font-size:medium;">Your current time logs for this month</strong></div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form-inline" method="GET" action="{{ asset('personal/search') }}"  id="searchForm">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="filter_dates" name="filter_range1" placeholder="Filter date range here..." >
                                                </div>
                                                <button type="submit" name="filter" class="btn btn-success form-control" value="Filter">
                                                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Filters
                                                </button>
                                                <button type="button" name="filter" class="btn btn-primary form-control" onclick="generate_dtr(this);" data-link="{{ asset('generate/dtr') }}">
                                                    <span class="glyphicon glyphicon-print" aria-hidden="true"></span> Generate DTR
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <br />
                                <div class="row">
                                    <div class="col-md-12">
                                        @if(isset($lists) and count($lists) >0)
                                            <div class="table-responsive">
                                                <table class="table table-list table-hover table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th class="text-center">Attendance Date</th>
                                                        <th class="text-center">Attendance Time</th>
                                                        <th class="text-center">Event Type</th>
                                                        <th class="text-center">Remarks</th>
                                                        <th><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($lists as $list)
                                                        <tr>
                                                            <td class="text-center">
                                                                <a href="#">
                                                                    <strong>{{ $list->datein }}</strong>
                                                                </a>

                                                            </td>
                                                            <td class="text-center"><strong><a href="#"> {{ $list->time }}</a></strong></td>
                                                            <td class="text-center"><strong><a href="#">{{ $list->event }}</a> </strong></td>
                                                            <td class="text-center">
                                                               <strong><a href="#">{{ $list->remark }}</a> </strong>
                                                            </td>
                                                            <td>
                                                                @if($list->edited == "1")
                                                                    <a class="btn btn-danger" href="{{ asset('delete/edited/logs/'.$list->userid .'/'. $list->datein .'/'. $list->time .'/'. $list->event) }}">
                                                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                                                    </a>
                                                                @else
                                                                    <span>-----</span>
                                                                @endif

                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            {{ $lists->links() }}
                                        @else
                                            <div class="alert alert-danger" role="alert">DTR records are empty.</div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    @parent

    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker("clearDates");
        });
        $('#inclusive3').daterangepicker();
        $('#filter_dates').daterangepicker();
        $('#print_pdf').submit(function(){
            $('#upload').button('loading');
            $('#print_individual').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        });
        function generate_dtr(el){
            var url = $(el).data('link');
            $('#generate_dtr_employee').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        }
    </script>
@endsection