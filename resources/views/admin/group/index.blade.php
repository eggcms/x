@extends('layouts.admin')
@include('layouts.admin-main')

@if($cmd=='index')
   @section('content')
   <div class="card-body rounded mb-4">
      <div style="margin-bottom:15px;">
         <h1 id="" class="open_create_group mylink mb-4">Create group/tag/album</h1>
         <div id="create_group" style="display:none;">   
            <table style="width:100%">
               <tr>
                  <td style="width:50%;">
                     {{ Form::open(['action' => ['Admin\GroupController@store'], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                     <div class="form-group ">
                        {{ Form::text('title','',['class'=>'form-control ','placeholder'=>'ชื่อกลุ่ม','required']) }}
                     </div>
                     <div class="form-group ">
                        {{ Form::textarea('description','',['class'=>'form-control ','placeholder'=>'คำบรรยาย','required','rows'=>'3']) }}
                        <i class="small clr-gray">*** ควรใส่ มีผลกับการทำ seo ***</i>
                     </div>
                     <div class="form-group">
                        <select name="type" id="type" class="form-control">
                           <option value="0" class="form-control" selected>Group</option>
                           <option value="1">#Tag</option>
                           <option value="2">Album</option>
                        </select>
                     </div>
                  </td>
                  <td valign="top">
                     <div class="form-group ml-2">
                        {{Form::submit('บันทึกข้อมูล',['class'=>'btn btn-success'])}}
                        {{Form::button('&nbsp; ยกเลิก &nbsp;',['class'=>'btn btn-primary open_create_group'])}}
                     </div>
                     @csrf
                     {{ Form::hidden('status', '1') }}
                     {{ Form::close() }}
                  </td>
               </tr>
            </table>
         </div> 
      </div>
      <table width="100%">
         <tr>
            <th width="5%" style="text-align:center">#</th>
            <th>Groups</th>
            <th width="7%"  style="text-align:center">blog use</th>
            <th width="8%" colspan="2" style="text-align:center">Order</th>            
            <th width="5%"  style="text-align:center">Status</th>
            <th width="5%"  style="text-align:center">Action</th>
         </tr>
         @foreach($groups as $group)
            @if($group->type == '0')
            <tr class="hover" style="vertical-align:text-top">
               <td align="center">{{$group->id}}</td>
               <td>
                  <a href="{{Url('/admin/group/'.$group->id.'/edit')}}">
                  {{$group->title}}</a> (<i class="small" >{{$group->description}}</i>)</td>
               @php
               if ($group->status == 1) {
                  $change='เปิด';
                  $status='0';
                  $btn='btn-outline-success';
               }
               else {
                  $change=' ปิด';
                  $status='1';
                  $btn='btn-outline-dark';
               }
               @endphp
               <td style="text-align:center">
                  @php
                  $items=DB::table('blogs')->where('cid',$group->id)->get();
                  $item=count($items);
                  echo $item;   
                  @endphp
               </td>
               <td style="text-align:center">
                  @if ($group->orders == 1)
                  <span class="small" style="text-decoration: line-through; color:#999">&nbsp; ขึ้น &nbsp; </span>
                  @else
                     {!! Form::open(['action'=>['Admin\GroupController@update',$group->id],'method'=>'POST', ]) !!}
                     {!! Form::hidden('_method', 'PUT')!!}
                     {!!Form::hidden('switch','oup')!!}
                     {!! Form::submit(' &nbsp; ขึ้น &nbsp; ',['class'=>'btn border-0 btn-outline-primary pt-1 pb-1']) !!}
                     @csrf
                     {!! Form::close() !!}
                  @endif
               </td>
               <td style="text-align:center">
                  @if ($group->orders == count($groups))
                  <span class="small" style="text-decoration: line-through; color:#999">&nbsp; ลง &nbsp; </span>
                  @else
                     {!! Form::open(['action'=>['Admin\GroupController@update',$group->id],'method'=>'POST', ]) !!}
                     {!! Form::hidden('_method', 'PUT')!!}
                     {!!Form::hidden('switch','odown')!!}
                     {!! Form::submit(' &nbsp; ลง &nbsp; ',['class'=>'btn border-0 btn-outline-primary pt-1 pb-1']) !!}
                     @csrf
                     {!! Form::close() !!}
                  @endif
               </td>
               <td style="vertical-align:text-top" align="center">
                  {!! Form::open(['action'=>['Admin\GroupController@update',$group->id],'method'=>'POST', ]) !!}
                  {!! Form::hidden('_method', 'PUT')!!}
                  {!!Form::hidden('switch','status')!!}
                  {!! Form::submit(' &nbsp; '.$change.' &nbsp; ',['class'=>'btn border-0 '.$btn.' pt-1 pb-1']) !!}
                  @csrf
                  {!! Form::close() !!}          
               </td>
               <td style="vertical-align:text-top">
                  @if($item > 0)
                  <div class="small" style="text-decoration: line-through; cursor: text; color:#999"> &nbsp; ลบ &nbsp; </div>
                  @else
                  {!! Form::open(['action'=>['Admin\GroupController@destroy',$group->id],'method'=>'POST', ]) !!}
                  {!! Form::hidden('_method', 'DELETE')!!}
                  {!! Form::submit(' &nbsp; ลบ &nbsp; ',['class'=>'btn border-0 btn-outline-danger pt-1 pb-1','onclick'=>"return confirm('ลบบทความ #$group->id แน่ใจ?');"]) !!}
                  @csrf
                  {!! Form::close() !!}
                  @endif         
               </td>
            </tr>
            @endif
         @endforeach
      </table>
<hr class="my-4">
      <h3 >จัดการเกี่ยวกับ Tags</h3>
      <div class="py-3">
         @php $tags=DB::table('groups')->where('type',1)->orderBy('orders','asc')->get(); @endphp
         @foreach($tags as $tag)
            @php
            if ($tag->status == 1) {
               $change='เปิด';
               $status='0';
               $btn='btn-outline-primary';
            }
            else {
               $change=' ปิด';
               $status='1';
               $btn='btn-outline-secondary';
            }
            @endphp
            @if($tag->type == '1')
               <a class="btn {{$btn}} btn-sm mb-2" href="{{Url('/admin/group/'.$tag->id.'/edit')}}">{{$tag->title}}</a>
            @endif
         @endforeach
      </div>
   </div>
   @endsection

@elseif($cmd=='edit')
   @section('content')
   <div class="card-body rounded mb-4">
      <div style="margin-bottom:15px;">
         <table style="width:100%">
            <tr>
               <td colspan="3">
                  <h1 class="mb-4"><a style="text-decoration:none;" href="{{url('/admin/group/')}}">Back to group</a></h1>
               </td>
            </tr>
            <tr>
               <td style="width:50%;">
                  {{ Form::open(['action' => ['Admin\GroupController@update',$group->id], 'method' => 'POST', 'enctype' =>'multipart/form-data']) }}
                  <div class="form-group ">
                     {{ Form::text('title',$group->title,['class'=>'form-control ','placeholder'=>'ชื่อกลุ่ม','required']) }}
                  </div>
                  <div class="form-group ">
                     {{ Form::textarea('description',$group->description,['class'=>'form-control ','placeholder'=>'คำบรรยาย','required','rows'=>'3']) }}
                     <i class="small clr-gray">*** ควรใส่ มีผลกับการทำ seo ***</i>
                  </div>
                  <div class="form-group">
                     <select name="type" id="type" class="form-control">
                        <option value="0" class="form-control">Group</option>
                           @if($group->type==0) 
                           <option value="0" class="form-control" selected>Group</option>
                           @else
                           <option value="0" class="form-control">Group</option>
                           @endif
                           @if($group->type==1) 
                           <option value="1" class="form-control" selected>Tag</option>
                           @else
                           <option value="1" class="form-control">Tag</option>
                           @endif
                           @if($group->type==2) 
                           <option value="2" class="form-control" selected>Album</option>
                           @else
                           <option value="2" class="form-control">Album</option>
                           @endif
                     </select>
                  </div>                  
               </td>
               <td valign="top">
                  <div class="form-group ml-2">
                     {{ Form::hidden('id', $group->id) }}
                     {{ Form::hidden('status', $group->status) }}
                     {{ Form::hidden('_method','PUT')}}
                     {{Form::submit('แก้ไขข้อมูล',['class'=>'btn btn-primary'])}}
                  </div>
                  <a href="{{url('/admin/group')}}" class="ml-2 btn btn-success">&nbsp; &nbsp;ยกเลิก &nbsp; &nbsp;</a>
                  @csrf
                  {{ Form::close() }}
                  <div class="form-group ml-2 mt-3">
                  {!! Form::open(['action'=>['Admin\GroupController@destroy',$group->id],'method'=>'POST', ]) !!}
                  {!! Form::hidden('_method', 'DELETE')!!}
                  {!! Form::submit(' &nbsp; &nbsp; &nbsp; ลบ &nbsp; &nbsp; &nbsp;',['class'=>'btn btn-outline-danger pt-1 pb-1','onclick'=>"return confirm('ลบบทความ #$group->id แน่ใจ?');"]) !!}
                  @csrf
                  {!! Form::close() !!} 
                  </div>
               </td>
            </tr>
            <tr>
               <td colspan="2">
                     @php
                     if ($group->status == 1) {
                        $change='เปิดการใช้งานอยู่';
                        $status='0';
                        $btn='btn-outline-success';
                     }
                     else {
                        $change=' ปิดการใช้งานอยู่';
                        $status='1';
                        $btn='btn-outline-dark';
                     }
                     @endphp
                  {!! Form::open(['action'=>['Admin\GroupController@update',$group->id],'method'=>'POST', ]) !!}
                  {!! Form::hidden('_method', 'PUT')!!}
                  {!!Form::hidden('switch','status')!!}
                  <span style="float:left;">{!! Form::submit(' &nbsp; '.$change.' &nbsp; ',['class'=>'btn '.$btn.' pt-1 pb-1']) !!}</span>
                  @csrf
                  {!! Form::close() !!}          
               </td>
            </tr>
         </table>
      </div>
   </div>
   @endsection
@endif
