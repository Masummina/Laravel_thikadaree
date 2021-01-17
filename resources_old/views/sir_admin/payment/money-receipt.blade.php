@extends('admin.layouts.layout')
@section('content')
    <style>

    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="">
                                        <p class="pull-right" onclick="PrintElem('#print_able')" style="cursor: pointer">  &nbsp;&nbsp;&nbsp;
                                            Print : <span class="glyphicon glyphicon-print  " > </span>
                                        </p> <br/>

                                        {{--<div class="box-header with-border" style="text-align: center">--}}
                                            {{--<p> {!! Config('app.project_name'); !!} </p>--}}
                                            {{--<h3 class="box-title"> {!! Config('app.project_address'); !!} </h3>--}}
                                        {{--</div>--}}
                                        @php
                                            $mr = 2000+$details->id;
                                            $number = $details->amount;
                                           $no = round($number);
                                           $point = round($number - $no, 2) * 100;
                                           $hundred = null;
                                           $digits_1 = strlen($no);
                                           $i = 0;
                                           $str = array();
                                           $words = array('0' => '', '1' => 'one', '2' => 'two',
                                            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
                                            '7' => 'seven', '8' => 'eight', '9' => 'nine',
                                            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
                                            '13' => 'thirteen', '14' => 'fourteen',
                                            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
                                            '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
                                            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
                                            '60' => 'sixty', '70' => 'seventy',
                                            '80' => 'eighty', '90' => 'ninety');
                                           $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
                                           while ($i < $digits_1) {
                                             $divider = ($i == 2) ? 10 : 100;
                                             $number = floor($no % $divider);
                                             $no = floor($no / $divider);
                                             $i += ($divider == 10) ? 1 : 2;
                                             if ($number) {
                                                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                                                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                                                $str [] = ($number < 21) ? $words[$number] .
                                                    " " . $digits[$counter] . $plural . " " . $hundred
                                                    :
                                                    $words[floor($number / 10) * 10]
                                                    . " " . $words[$number % 10] . " "
                                                    . $digits[$counter] . $plural . " " . $hundred;
                                             } else $str[] = null;
                                          }
                                          $str = array_reverse($str);
                                          $result = implode('', $str);
                                          $points = ($point) ?
                                            "." . $words[$point / 10] . " " .
                                                  $words[$point = $point % 10] : '';
                                          //echo $result . "Taka only";

                                        @endphp
                                        <div id="print_able" style="width: 90%; margin: 0 auto;">
                                            <h2 class="" style="text-align: right;">Money Receipt</h2>
                                            <div class="receipt-header">
                                                <div class="company-logo" style="width: 50%; float: left;"><h3 style="margin: 0"><img src="{{ asset('/img/udd_logo_base_web.png') }}" style="width: 75px;"><span style="vertical-align: middle;"> Urban Design & <br> Development Ltd.</span> </h3></div>
                                                <div class="receipt-date" style="width: 50%; float: left; text-align: right;">
                                                    <p style="font-size: 18px; margin-top: 30px; margin-bottom: 0">Date <span style="border-bottom: 1px solid; vertical-align: super; display: inline-block; text-align: left; min-width: 90px;">{{ $details->payment_date }}</span> No. <span style="border-bottom: 1px solid; vertical-align: super ;display: inline-block; text-align: left; min-width: 90px;">E{{ $mr }}</span></p>
                                                </div>
                                                <div style="clear: both;"></div>
                                            </div>
                                            <div class="receipt-body" style="margin-top: 80px;font-size: 18px;">
                                                <p>Received with thanks from Mr./ Mrs./ Ms <span style="@if($details->name=='')vertical-align: baseline; min-width: 350px; @else vertical-align: super; @endif border-bottom: 1px solid; display: inline-block; padding: 0 15px;">{{ $details->name }}</span> of <span style=" @if($details->address=='')vertical-align: baseline;min-width: 500px; @else vertical-align: super; @endif border-bottom: 1px solid; display: inline-block; padding: 0 15px;">{{ $details->address }}</span> a sum of Taka <span style="vertical-align: super; border-bottom: 1px solid; display: inline-block; padding: 0 15px;">{!! number_format($details->amount) !!}</span>
                                                 (in words) <span style="vertical-align: super; border-bottom: 1px solid; display: inline-block; padding: 0 15px; text-transform: capitalize;">{{ $result }} Taka only</span>. Vide Cash/ P.O/ Cheque No. <span style="vertical-align: baseline; min-width: 250px; border-bottom: 1px solid; display: inline-block; padding: 0 15px;"></span> Dated <span style="vertical-align: baseline; min-width: 150px; border-bottom: 1px solid; display: inline-block; padding: 0 15px;"></span>
                                                 Drawn on <span style="vertical-align: baseline; min-width: 450px; border-bottom: 1px solid; display: inline-block; padding: 0 15px;"></span> On account of <span style="@if($details->name=='')vertical-align: baseline; min-width: 350px; @else vertical-align: super; @endif border-bottom: 1px solid; display: inline-block; padding: 0 15px;">{{ $details->remark }} </span>.</p>
                                            </div>
                                            <div class="receipt-footer" style="margin-top: 30px;">
                                                @if(isset($sign->photo))
                                                    <img src="{{ asset('img/'.$sign->photo) }}" width="100%">
                                                @endif
                                            </div>
                                            <div class="clear"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
