@extends('layouts.admin')
@include('layouts.admin-main')

@if($cmd=='edit')
@section('content')
<div class="card-body rounded mb-4">
   <div style="margin-bottom:15px;">
         <h1 class="mb-4"><a style="text-decoration:none;" href="{{url('/admin/review/')}}">Back to review</a></h1>
      <div>   
         <table style="width:75%">
            <tr>
               <td style="width:50%;">
                  {{ Form::open(['action' => ['Admin\ReviewController@update',$review->id], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                  <div class="form-group ">
                     <label for="league">ลีค</label>
                     <select name="league" class="form-control">
                        @php
                        $ls=DB::table('leagues')->orderBy('orders','asc')->get();
                        foreach($ls as $l) {
                           if ($l->id==$review->league) echo '<option value="'.$l->id.'" selected>'.$l->title_th.'</option>';
                           else echo '<option value="'.$l->id.'">'.$l->title_th.'</option>';                           
                        }
                        // $l=league();
                        // for ($i=0; $i < count($l); $i++) {
                        //    if ($i==$review->league) echo '<option value="'.$i.'" selected>'.$l[$i].'</option>';
                        //    else echo '<option value="'.$i.'">'.$l[$i].'</option>';
                        // }
                        @endphp
                     </select>
                  </div>
               </td>
               <td>

               </td>
            </tr>
            <tr>
               <td style="width:50%;">
                  <div class="form-group ">
                     <label for="team1">ทีม A</label>
                     {{ Form::text('team1',$review->team1,['class'=>'form-control ','placeholder'=>'ใส่ชื่อทีม A','required']) }}
                  </div>
               </td>
               <td>
                  <div class="form-group ">
                     <label for="team2">ทีม B</label>
                     {{ Form::text('team2',$review->team2,['class'=>'form-control ','placeholder'=>'ใส่ชื่อทีม B','required']) }}
                  </div>
               </td>
            </tr>
            <tr>
            <td>
               <label for="over">ทีมต่อ-ทีมรอง</label>
               <select name="over" class="form-control">
                  
                  @php
                  if ($review->over == 0) echo '<option value="0" selected>เสมอ</option>';
                  elseif ($review->over == 1) echo '<option value="1" selected>ทีม A</option>';
                  else echo '<option value="2" selected>ทีม B</option>';
                  @endphp
                  <option value="2">ทีม B</option>
               </select>
            </td>
            <td>
               <label for="bet">ราคา</label>
               {!! Form::text('bet',$review->bet,['class'=>'form-control ','placeholder'=>'ราคา','required']) !!}
            </tr>
            <tr>
               <td colspan="2">
                  <div class="form-group mt-3 mb-4">
                     <label for="content">บทวิเคราะห์</label>
                     <textarea name="content" class="form-control" placeholder="ใส่ข้อมูลบทวิเคราะห์">{!!$review->content!!}</textarea>
                  </div>
               </td>
            </tr>
            <tr>
               <td>
                  <div class="form-group mb-5">
                     <label for="content">เซียนฟันธง</label>
                     {!! Form::text('prevision',$review->prevision,['class'=>'form-control ','placeholder'=>'ฟันธง','required']) !!}
                  </div>
               </td>
               <td align="right">
                  <div class="form-group mt-5 mb-5">
                     {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
                  <a href="{{url('admin/review')}}" class="btn btn-primary">&nbsp; ยกเลิก &nbsp;</a>
                  </div>
                  @csrf
                  {!! Form::hidden('_method', 'PUT')!!}
                  {{ Form::hidden('status', $review->status) }}
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
         <h1 id="" class="open_create_review mylink mb-4">Create Reviews</h1>

         <div id="create_review" style="display:none;">   
            <table style="width:75%">
               <tr>
                  <td style="width:50%;">
                     {{ Form::open(['action' => ['Admin\ReviewController@store'], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                     <div class="form-group ">
                        <label for="league">ลีค</label>
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
                  <td>

                  </td>
               </tr>
               <tr>
                  <td style="width:50%;">
                     <div class="form-group ">
                        <label for="team1">ทีม A</label>
                        {{ Form::text('team1','',['class'=>'form-control ','placeholder'=>'ใส่ชื่อทีม A','required']) }}
                     </div>
                  </td>
                  <td>
                     <div class="form-group ">
                        <label for="team2">ทีม B</label>
                        {{ Form::text('team2','',['class'=>'form-control ','placeholder'=>'ใส่ชื่อทีม B','required']) }}
                     </div>
                  </td>
               </tr>
               <tr>
               <td>
                  <label for="over">ทีมต่อ-ทีมรอง</label>
                  <select name="over" class="form-control">
                     <option value="0">เสมอ</option>
                     <option value="1">ทีม A</option>
                     <option value="2">ทีม B</option>
                  </select>
               </td>
               <td>
                  <label for="bet">ราคา</label>
                  {{ Form::text('bet','',['class'=>'form-control ','placeholder'=>'ราคา','required']) }}
               </tr>
               <tr>
                  <td colspan="2">
                     <div class="form-group mt-3 mb-4">
                        <label for="content">บทวิเคราะห์</label>
                        <textarea name="content" class="form-control" placeholder="ใส่ข้อมูลบทวิเคราะห์"></textarea>
                     </div>
                  </td>
               </tr>
               <tr>
                  <td>
                     <div class="form-group mb-5">
                        <label for="content">เซียนฟันธง</label>
                        {{ Form::text('prevision','',['class'=>'form-control ','placeholder'=>'ฟันธง','required']) }}
                     </div>
                  </td>
                  <td align="right">
                     <div class="form-group mt-5 mb-5">
                        {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
                        {{Form::button('&nbsp; ยกเลิก &nbsp;',['class'=>'btn btn-primary open_create_review'])}}
                     </div>
                     @csrf
                     {{ Form::hidden('status', '1') }}
                     {{ Form::close() }}
                  </td>
               </tr>
            </table>
         </div>
         <table width="100%">
            <tr>
               <th width="80%">Reviews list</th>
               <th>Example preview</th>
            </tr>
            <tr>
               <td style="vertical-align:top">
                  <table width="100%">
                     <tr>
                        <th width="5%">#</th>
                        <th>Title</th>
                        <th width="20%">Update</th>
                        <th width="5%">Status</th>
                        <th width="5%">&nbsp;</th>
                     </tr>
                     @if (isset($reviews) && count($reviews))
                        @foreach($reviews as $review)
                     <tr class="hover">
                        <td>{{$review->id}}</td>
                        <td><a href="{{url('/admin/review/'.$review->id.'/edit')}}">{{$review->team1}} vs {{$review->team2}}</a> &nbsp; (<i class="small">โดย: {{get_creator($review->uid)}}</i>)</td>  
                        @php
                           if ($review->status==1) {
                              $change="เปิด";
                              $status='0';
                              $btn='btn-outline-success';
                           }
                           else {
                              $change="ปิด";
                              $status='1';
                              $btn='btn-outline-dark';
                           }
                        @endphp 
                        <td align="left"><i class="small">{{DateThai($review->created_at)}}</i></td>
                        <td align="center">
                           {!! Form::open(['action'=>['Admin\ReviewController@update',$review->id],'method'=>'POST']) !!}
                           {!! Form::hidden('_method', 'PUT')!!}
                           {!!Form::hidden('switch','status')!!}
                           {!! Form::submit(' &nbsp; '.$change.' &nbsp; ',['class'=>'btn border-0 '.$btn.' pt-1 pb-1']) !!}
                           @csrf
                           {!! Form::close() !!}          

                        </td>   
                        <td align="center">
                           {!! Form::open(['action'=>['Admin\ReviewController@destroy',$review->id],'method'=>'POST']) !!}
                           {!! Form::hidden('_method', 'DELETE')!!}
                           {!! Form::submit(' &nbsp; ลบ &nbsp; ',['class'=>'btn border-0 btn-outline-danger pt-1 pb-1','onclick'=>"return confirm('ลบบทความ #$review->id แน่ใจ?');"]) !!}
                           @csrf
                           {!! Form::close() !!}  
                        </td>
                     </tr>
                        @endforeach
                     @else
                     <tr>
                        <td colspan="4" align="center">
                           <p class="mt-5">ไม่มีข้อมูลกิจกรรม</p>
                        </td>
                     </tr> 
                     @endif
                  </table>
               </td>
               <td>
                  <img src="{{url('/img/review1.jpg')}}" alt="reviews" width="100%" >
               </td>
            </tr>   
         </table>
      </div>
   </div>
@endsection
@endif
