@extends('layouts.admin')
@include('layouts.admin-main')

@if($cmd=='edit')
@section('content')
<div class="card-body rounded mb-4">
   <div style="margin-bottom:15px;">
         <h1 class="mb-4"><a style="text-decoration:none;" href="{{url('/admin/result/')}}">Back to result</a></h1>
      <div>   
            <table style="width:70%;">
               {{ Form::open(['action' => ['Admin\ResultController@update',$result->id], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
               <tr>
                  <td width="60%">
                     <div class="form-group ">
                        <label for="league">เลือกลีก</label>
                        <select name="league" class="form-control">
                           @php
                              $ls=DB::table('leagues')->orderBy('orders','asc')->get();
                              foreach($ls as $l) {
                                 if ($result->league == $l->id) echo '<option value="'.$l->id.'" selected>'.$l->title_th.'</option>'; 
                                 else echo '<option value="'.$l->id.'">'.$l->title_th.'</option>';                           
                              }
                           @endphp
                        </select>
                     </div>
                  </td>
                  <td>&nbsp;</td>
               </tr>
               <tr>
                  <td>
                     <div class="form-group ">
                        <label for="channel">ช่องถ่ายทอดสด</label>
                        {{ Form::text('channel',$result->channel,['class'=>'form-control ','placeholder'=>'ช่องถ่ายทอดสด']) }}
                     </div>
                  </td>
                  <td>
                     <div class="form-group ">
                        <label for="date">เวลาแข่งขัน ตย. 2019-05-31 17:30</label> 
                           {{-- echo date("d-m-Y H:i",strtotime("2019-05-31 07:30")); --}}
                        {{ Form::text('date',$result->date,['class'=>'form-control ','placeholder'=>'เวลาแข่งขัน']) }}
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>
                     <div class="form-group ">
                        <label for="team1">ชื่อทีม A &nbsp; ( ทีมเหย้า )</label>
                        {{ Form::text('team1',$result->team1,['class'=>'form-control ','placeholder'=>'ชื่อทีม A','required']) }}
                     </div>
                  </td>
                  <td>
                  {{ Form::open(['action' => ['Admin\ResultController@store'], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                  <div class="form-group ">
                     <label for="score1">ผลประตูทีม A</label>
                     {{ Form::text('score1',$result->score1,['class'=>'form-control ','placeholder'=>'จำนวนประตู A']) }}
                  </div>
               </td>
               </tr>
               <tr>
                  <td>
                     <div class="form-group ">
                        <label for="team2">ชื่อทีม B &nbsp; ( ทีมเยือน )</label>
                        {{ Form::text('team2',$result->team2,['class'=>'form-control ','placeholder'=>'ชื่อทีม B','required']) }}
                     </div>
                  </td>
                  <td>
                     <div class="form-group ">
                        <label for="score2">ผลประตูทีม B</label>
                        {{ Form::text('score2',$result->score2,['class'=>'form-control ','placeholder'=>'จำนวนประตู B']) }}
                     </div>
                  </td>
               </tr>

               <tr>
                  <td colspan="2">
                     <div class="form-group mt-3 mb-5">
                        {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
                        <a href="{{url('admin/result')}}" class="btn btn-primary">&nbsp; ยกเลิก &nbsp;</a>
                     </div>
                     @csrf
                     {!! Form::hidden('_method', 'PUT')!!}
                     {{ Form::close() }}
                  </td>
               </tr>
            </table>
         </div>
   </div>
</div>
@endsection

@elseif($cmd=='index')
   @section('content')
   <div class="card-body rounded mb-4">
      <div style="margin-bottom:15px;">
            <h1 id="" class="open_create_result mylink mb-4">Create Result</h1>
            <div id="create_result" style="display:none;">   
               <table style="width:70%;">
                  {{ Form::open(['action' => ['Admin\ResultController@store'], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                  <tr>
                     <td width="60%">
                        <div class="form-group ">
                           <label for="league">เลือกลีก</label>
                           <select name="league" class="form-control">
                              @php
                                 $ls=DB::table('leagues')->orderBy('orders','asc')->get();
                                 foreach($ls as $l) {
                                    echo '<option value="'.$l->id.'">'.$l->title_th.'</option>';                           
                                 }
                              @endphp
                           </select>
                        </div>
                     </td>
                     <td>&nbsp;</td>
                  </tr>
                  <tr>
                     <td>
                        <div class="form-group ">
                           <label for="channel">ช่องถ่ายทอดสด</label>
                           {{ Form::text('chammel','',['class'=>'form-control ','placeholder'=>'ช่องถ่ายทอดสด']) }}
                        </div>
                     </td>
                     <td>
                        <div class="form-group ">
                           <label for="date">เวลาแข่งขัน ตย. 2019-05-31 17:30</label> 
                              {{-- echo date("d-m-Y H:i",strtotime("2019-05-31 07:30")); --}}
                           {{ Form::text('date','',['class'=>'form-control ','placeholder'=>'เวลาแข่งขัน']) }}
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="form-group ">
                           <label for="team1">ชื่อทีม A &nbsp; ( ทีมเหย้า )</label>
                           {{ Form::text('team1','',['class'=>'form-control ','placeholder'=>'ชื่อทีม A','required']) }}
                        </div>
                     </td>
                     <td>
                        {{ Form::open(['action' => ['Admin\ResultController@store'], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                        <div class="form-group ">
                           <label for="score1">ผลประตูทีม A</label>
                           {{ Form::text('score1','',['class'=>'form-control ','placeholder'=>'จำนวนประตู A']) }}
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td>
                        <div class="form-group ">
                           <label for="team2">ชื่อทีม B &nbsp; ( ทีมเยือน )</label>
                           {{ Form::text('team2','',['class'=>'form-control ','placeholder'=>'ชื่อทีม B','required']) }}
                        </div>
                     </td>
                     <td>
                        <div class="form-group ">
                           <label for="score2">ผลประตูทีม B</label>
                           {{ Form::text('score2','',['class'=>'form-control ','placeholder'=>'จำนวนประตู B']) }}
                        </div>
                     </td>
                  </tr>
                  <tr>
                     <td colspan="2">
                        <div class="form-group mt-3 mb-5">
                           {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
                           {{Form::button('&nbsp; ยกเลิก &nbsp;',['class'=>'btn btn-primary open_create_result'])}}
                        </div>
                        @csrf
                        {{ Form::hidden('order', '0.4') }}
                        {{ Form::close() }}
                     </td>
                  </tr>
               </table>
            </div>
         <div>
            <table style="width:100%">
               <tr>
                  <th>ID</th>
                  <th>Team-A VS Team-B</th>
                  <th style="width:10%; text-align:center;">Score</th>
                  <th style="width:15%; text-align:left;">Date</th>
                  <th style="width:12%; text-align:left;">Channel</th>
                  <th style="width:8%; text-align:center;">Action</th>
               </tr>
               @foreach($results as $result)
               <tr class="hover">
                  <td>{{$result->id}}</td>
                  <td><a href="{{url('/admin/result/'.$result->id.'/edit')}}">{{$result->team1}} VS {{$result->team2}}</a> ( <i class="small">{{$result->home}}</i> )</td>
                  <td style="text-align:center">
                     {{$result->score1}} - {{$result->score2}}
                  </td>
                  <td style="text-align:left;">
                     <i class="small">{{$result->date}}</i>
                  </td>
                  <td style="text-align:left;">
                     <i class="small">{{$result->channel}}</i>
                  </td>
                  <td style="text-align:center;">
                     {!! Form::open(['action'=>['Admin\ResultController@destroy',$result->id],'method'=>'POST', ]) !!}
                     {!! Form::hidden('_method', 'DELETE')!!}
                     {!! Form::submit(' &nbsp; ลบ &nbsp; ',['class'=>'btn border-0 btn-outline-danger pt-1 pb-1','onclick'=>"return confirm('ลบบทความ #$result->id แน่ใจ?');"]) !!}
                     @csrf
                     {!! Form::close() !!}
                  </<td>
               </tr>
               @endforeach
            </table>
         </div>
      </div>
   </div>
@endsection
@endif
