@extends('layouts.admin')
@include('layouts.admin-main')

@if($cmd=='edit')
@section('content')
<div class="card-body rounded mb-4">
   <div style="margin-bottom:15px;">
      <h1>Setup User</h1>

      <div class="row">   
         <table style="width:100%">
            </tr>   
            <td style="vertical-align:bottom" width="50%;">
                  {{ Form::open(['action' => ['Admin\UserController@update',$user->id], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
               <div style="text-align:right;">
                  
                  @if($user->image!='')
                     Avatar: <img src="{{asset('/storage/avatar/'.$user->image)}}" style="margin-right:10px; padding:5px; border:1px solid #ddd; object-fit:cover; border-radius: 50%; height: 50px; width: 50px;" />
                  @endif
               </div>
            </td>
            <td>
               <div>
                  <div class="custom-file mt-3">
                     <input type="file" name="image" class="custom-file-input" id="customFileLang" lang="en">
                     <label class="custom-file-label" for="customFileLang">เปลี่ยนรูปภาพ</label>
                  </div>
               </div>
            </td>
         </tr>      
            <tr>
               <td>
                  <div>
                     <label for="level">Username</label>
                     <input name="name" value="{{$user->name}}" class="form-control">
                  </div>
               </td>
               <td>
                  <div>
                     <label for="level">Nickname</label>            
                     <input name="nickname" value="{{$user->nickname}}" class="form-control">
                  </div>
               </td>
            </tr>
            <tr>
               <td>
                  <div>
                  <label for="level">Rank</label>
                     <select name="level" id="level" class="form-control">
                     @php
                        if ($user->level==0) echo '<option value="0" selected>Normal User</option>';
                        else echo '<option value="0" >Normal User</option>';
                        if ($user->level==1) echo '<option value="1" selected>Creator</option>';
                        else echo '<option value="1">Creator</option>';
                        if ($user->level==10) echo '<option value="10" selected>Admin</option>';
                        else echo '<option value="10">Admin</option>';
                        if ($user->level==100) echo '<option value="100" selected>SuperAdmin</option>';
                        else echo '<option value="100">SuperAdmin</option>';
                     @endphp
                     </select>
                     {{-- <input name="level"  class="form-control" value="{{rank($user->level)}}"> --}}
                  </div>
               </td>
               <td>
                  <div>
                     <label for="level">Email</label>
                     <input name="email" value="{{$user->email}}" class="form-control">
                  </div>
               </td>
            </tr>      
            <tr>
               <td>
                  <div>
                     <label for="level">Facebook</label>
                     <input name="facebook" value="{!!$user->facebook!!}" class="form-control">
                  </div>
               </td>
               <td>
                  <div>
                     <label for="level">Line ID</label>
                     <input name="line" value="{!!$user->line!!}" class="form-control">
                  </div>
               </td>
            <tr>
         </table>

         <div class="form-group mt-4">
            {{Form::hidden('old_image',$user->image)}}
            {{Form::hidden('status',$user->status)}}
            {{Form::hidden('_method','PUT')}}
            {{-- <button name="submit" class="btn btn-primary" style="width:150px; ">Add data</button> --}}
            {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
            <a class="btn btn-primary" style="text-decoration:none;" href="{{url('/admin/user/')}}"> &nbsp; &nbsp; Cancel &nbsp; &nbsp; </a>
         </div>
         @csrf
         {{ Form::close() }}
         </form>      
      </div>
   </div>
</div>
@endsection


@elseif($cmd=='index')
@section('content')
<div class="card-body rounded mb-4">
   <div style="margin-bottom:15px;">
      <h1 id="" class="open_create_user mylink mb-4">Members</h1>


      <div id="create_user" style="display:none;">   
         <table style="width:100%">
             <tr>
               <td>
            
               </td>
               <td>
                   
               </td>
            </tr>





          















               </table>
            </div>


         <div>  
         <table width="100%" style="text-align:center;">
            <tr>
               <th width="5%">ID</th>
               <th width="10%" style="text-align:left;">Username</th>
               
               <th width="10%" style="text-align:left;" >email</th>
               <th width="10%">Social</th>
               <th width="10%">Level</th>
               <th width="5%">Status</th>
            </tr>
            @foreach($users as $user)
               @php
               if (isset($user->facebook)) $facebook='facebook';
               if (isset($user->line)) $line='line';
               if (isset($facebook) || isset($line)) $social= $facebook.' '.$line;
               else $social='ยังไม่มีการเก็บข้อมูล';
               if ($user->status == 1) {
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
               <tr class="hover">
                  <td>{{$user->id}}</td>
                  <td style="text-align:left;">
                     <a href="{{url('/admin/user/'.$user->id.'/edit')}}">{{$user->name}}</a> ( <i class="small">{{$user->nickname}}</i> )
                  </td>
                  <td style="text-align:left;">{{$user->email}}</td>
                  
                  <td>{{$social}}</td>
                  <td>{{$user->level}}</td>
                  
                  <td>
                        {!! Form::open(['action'=>['Admin\UserController@update',$user->id],'method'=>'POST']) !!}
                        {!! Form::hidden('_method', 'PUT')!!}
                        {!!Form::hidden('switch','status')!!}
                        {!! Form::submit(' &nbsp; '.$change.' &nbsp; ',['class'=>'btn border-0 '.$btn.' pt-1 pb-1']) !!}
                        @csrf
                        {!! Form::close() !!}     
                  </td>
               </tr>
            @endforeach
         </table>
      </div>
   </div>
</div>
@endsection
@endif