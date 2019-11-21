@extends('layouts.index')
@include('layouts.index-inc')

@if($cmd=='info')
@section('title')
รางานการทำงาน ราคาสเต็ป ราคาบอลสเต็ป วันนี้
@endsection
@section('description')
รางานการทำงาน สเต็ป ราคาสเต็ป ทรรศนะบอลสเต็ป ฟันธงบอลสเต็ป เที่ยงตรงฉับไว ไว้ใจได้ ประจำวันนี้
@endsection
@section('content')
@yield('adv')
<div class="container">
   <div class="row">
      <div class="col-md-12 p-1 mt-3" style="background-color:#f0f0f0;">
         <div class=" text-center bg-success p-4">
           <h1><i class="fas fa-info-circle text-warning"></i> {{$info}}</h1>
           <p>กลับไปยัง <a href="{{url('/')}}" class="btn btn-outline-warning">หน้าแรก</a>
         </p>
         </div>
      </div>
   </div>
</div>
@endsection

@elseif($cmd=='step-api')
@section('title')
ราคาสเต็ป ราคาบอลสเต็ป วันนี้
@endsection
@section('description')
สเต็ป ราคาสเต็ป ทรรศนะบอลสเต็ป ฟันธงบอลสเต็ป เที่ยงตรงฉับไว ไว้ใจได้ ประจำวันนี้
@endsection

@section('content')
@yield('adv')
<div class="container">
   <div class="row">
      <div class="col-md-12 p-3 mt-3" style="background-color:#f0f0f0;">
         @php
         echo '<h1 style="margin: 0 0 5px 0;">ราคาบอลสเต็ป ทรรศนะบอลสเต็ป, ฟันธงบอลสเต็ป</h1>
         <div id="review-socre">
            <div class="head-tded">
               <h3><span style="color: #909090;">ประจำวันที่</span> '.dateThai(date('d-m-Y'),'off').'</h3>
            </div>
         </div>
         <hr>
         <p><i class="fas fa-home text-danger"></i> <a href="'.url('/').'">หน้าแรก</a> > <span class="small" style="color:#999;">ราคาบอลสเต็ป ทรรศนะบอลสเต็ป, ฟันธงบอลสเต็ป</span></p>
         <hr>';
         $league='';
         foreach($obj->data as $ob) {
            if ($ob->league_name != $league) {
               $league=$ob->league_name;
               echo '<div class="div-table league-name">
                  <div class="div-tablerow">
                     <div class="div-tablecell">
                        <img  src="'.url("/img/007-soccer-ball-1.png").'" class="linkimg" width="25px" height="25px" >&nbsp;';
                        echo $ob->league_name;
                     echo '</div>
                  </div>
               </div>
               <div class="div-table" id="vision-hdp">
                  <div class="div-tablerow">
                     <div class="div-tablecell div-cell-head cell7">เวลา</div>
                     <div class="div-tablecell div-cell-head cell21">คู่แข่ง</div>
                     <div class="div-tablecell div-cell-head cell16">เต็มเวลา</div>
                     <div class="div-tablecell div-cell-head cell16">สูง/ต่ำ</div>
                     <div class="div-tablecell div-cell-head cell7">สกอร์ที่คาด</div>
                     <div class="div-tablecell div-cell-head cell20">ทรรศนะบอล</div>
                     <div class="div-tablecell div-cell-head cell13">ฟันธงสูง-ต่ำ</div> 
                  </div>
               </div>';                   
            }
            $time = explode(':', $ob->clock);
            $styleTorH = $styleTorA = "";
            if($ob->team_tor != null) {
               if($ob->team_tor == 'h') $styleTorH = "style='color:red;'";
               else $styleTorA = "style='color:red;'";
            }
            $priceHomeFull = $priceAwayFull = $priceOver = $priceUnder = "";
            if(strpos($ob->full_hdp_home, '-') !== false) $priceHomeFull = "style='color:red;'";
            if(strpos($ob->full_hdp_away, '-') !== false) $priceAwayFull = "style='color:red;'";
            if(strpos($ob->full_goal_over, '-') !== false) $priceOver = "style='color:red;'";
            if(strpos($ob->full_goal_under, '-') !== false) $priceUnder = "style='color:red;'";
            $clock = $ob->clock;
            $arrClock = explode(' ', $clock);
            if($arrClock[0] != 'LIVE') {
               $date = $arrClock[0].'/'.date('Y');
               $date = str_replace('/', '-', $date);
            }
            else $date='';
            $time = str_replace('AM', ' AM', $arrClock[1]);
            $time = str_replace('PM', ' PM', $time);
            $dateTime = ($date != '') ? $date.' '.$time : $time;
            $dateTime = date('H:i', strtotime($dateTime) - 3600);  
            echo '<div class="div-table" id="vision-hdp">
               <div class="div-tablerow">
                  <div class="div-tablecell cell7 bg-w">'.$dateTime.'</div>
                  <div class="div-tablecell cell21 bg-w team-ab">
                     <span class="team-a" '.$styleTorH.'>'.$ob->team_home_name.'</span>
                     <br/>
                     <span class="team-b" '.$styleTorA.'>'.$ob->team_away_name.'</span>
                  </div>
                  <div class="div-tablecell cell8 bg-g">
                     <span class="team-a">'.$ob->full_hdp_ball.'</span>
                     <br/>
                     <span class="team-b"></span>
                  </div>
                  <div class="div-tablecell cell8 bg-w">
                     <span class="team-a" '.$priceHomeFull.'>'.$ob->full_hdp_home.'</span><br/>
                     <span class="team-b" '.$priceAwayFull.'>'.$ob->full_hdp_away.'</span>
                  </div>
                  <div class="div-tablecell cell8 bg-g"><span class="team-a">'.$ob->full_goal_ball.'</span><br/><span class="team-b">u</span></div>
                  <div class="div-tablecell cell8 bg-w"><span class="team-a"'.$priceOver.'>'.$ob->full_goal_over.'</span><br/><span class="team-b" '.$priceUnder.'> '.$ob->full_goal_under.' </span></div>
                  <div class="div-tablecell cell7 bg-w">'.$ob->vision_score.'</div>
                  <div class="div-tablecell cell20 bg-y">'.$ob->vision.'</div>
                  <div  class="div-tablecell cell13 bg-y2">'.$ob->vision_over_under.'</div>    
               </div>
            </div>';
         }
         @endphp
      </div>
   </div>
</div>
@endsection


@elseif($cmd=='index')
@section('title')
{{ cfg('meta-title') }}
@endsection
@section('description')
{{ cfg('meta-description') }}
@endsection
@section('content')
@yield('adv')

<div class="container">
   <div class="row">
      <div class="col-md-8 p-3 mt-3" style="background-color:#f0f0f0;">
         {!!youtube('https://www.youtube.com/embed/vLZcjhMuA1I')!!}
      </div>
      <div class="col-md-4 px-3 mt-3" style="background-color:#f0f0f0;">
         @yield('signup')
      </div>
   </div>
</div>
@php allBox(); @endphp
@endsection


@elseif($cmd=='page')
@section('title')
{{ $page->title }}
@endsection
@section('description')
{{ $page->description }}
@endsection

@section('content')
@yield('adv2')
<div class="container">
   <div class="row">
      <div class="col-md-8 p-3 mt-3" style="background-color:#f0f0f0;">
         @if($page->title)
         <h1>{{$page->title}}</h1>
         <hr>
         <p><i class="fas fa-home text-danger"></i> <a href="{{url('/')}}">หน้าแรก</a> > <span class="small" style="color:#999;">{{$page->title}}</span></p>
         <hr>   
         <b>{{$page->description}}</b>
         {!!$page->content!!}
         @else
         <h1>ขออภัย ไม่มีข้อมูลในการนำมาแสดง</h1>
         @endif
         <hr>
         <div style="display:block;">
            <div class="p-0 my-4">
               <h2><i class="fas fa-users text-danger"></i> ยอดนิยม</h2>
               @php
               $ups=DB::table('blogs')->orderBy('visit','desc')->where('status',1)->take(5)->get();
               @endphp
               <ul class="update-main">
               @foreach($ups as $up)
                  <li style="padding:0 5px 5px;">
                     <div>
                        <a href="{{get_link('item',$up->id,$up->slug)}}"><img src="{{get_image($up->image)}}">{{$up->title}}</a>
                        <p class="small p-0" style="color:#999;"><i class="far fa-eye"></i> {{ visit($up->id,'add') }} views |  {{DateThai($up->created_at)}} <i class="fas fa-feather-alt"></i> {{get_creator($up->uid)}}</p>
                     </div>
                  </li>
               @endforeach
               </ul>
            </div>
         </div>
      </div>
      <div class="col-md-4 px-3 mt-3 py-3" style="background-color:#f0f0f0;">
         @yield('sidebar')
      </div>
   </div>
</div>
@endsection


@elseif($cmd=='group')
@php $meta=get_meta($groupID); @endphp
@section('title')
{{$meta->title}}
@endsection
@section('description')
{{$meta->description}}
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-lg-8 bg-light p-4">
         <h1 class="mt-0">{{$meta->title}}</h1>
         <hr>
         <p><i class="fas fa-home text-danger"></i> <a href="{{url('/')}}">หน้าแรก</a> > <span class="small" style="color:#777;">{{$meta->title}}</span></p>
         <hr>
         @yield('adv2')
         <div class="container p-0">
            <div class="row pt-3 px-0 mt-3 bg-light">         
               @foreach($blogs as $blog)
               <div class="col-sm-4 col-md-4 mb-4 img-hover">
                  <div class="pic">
                     <a href="{{get_link('item',$blog->id,$blog->slug)}}"><img src="{{get_image($blog->image)}}" width="100%" height="150px"></a>
                  </div>         
                  <p class="text-muted mt-2" style="height:55px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
                  <span class="small p-0" style="color:#999;">{{ DateThai($blog->created_at) }} / {{ $blog->visit }}views</span>
               </div>
               @endforeach 
            </div>   
         </div>
         <hr class="my-3">
         @yield('adv')
         <hr>
         @yield('recom')
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4 bg-light py-4 px-4">
         @yield('sidebar2')
      </div>
   </div>
</div>
@endsection


@elseif($cmd=='item')
@section('title')
   {{$blog->title}}
@endsection
@section('description')
   {{$blog->description}}
@endsection

@section('content')
@yield('adv2')
<div class="container mt-3">
   <div class="row">
      <div class="col-lg-8 bg-light p-4 pb-0">
         <h1>{{$blog->title}}</h1>
         <hr>
         @php $group=get_groups($blog->cid); @endphp
         <p><i class="fas fa-home text-danger"></i> <a href="{{url('/')}}">หน้าแรก</a> > <a href="{{get_link('all',$blog->cid,$group)}}">{{$group}}</a> > <span class="small" style="color:#999;">{{$blog->title}}</span></p>
         <hr>   
         <p class="small" style="text-align:right; color:#999;"><i class="far fa-eye"></i> {{ visit($blog->id,'add') }} views |  {{DateThai($blog->created_at)}} <i class="fas fa-feather-alt"></i> {{get_creator($blog->uid)}}</p>
         <div class="mb-3">
         @if($blog->clip!=null)
            {!! youtube($blog->clip) !!}
         @else
            <img class="img-fluid" src="{{get_image($blog->image)}}" width="100%" alt="{{$blog->title}}">
         @endif
         </div>
         <b>{{$blog->description}}</b>
         {!!$blog->content!!}
         @if($blog->clip!=null)
            <img class="img-fluid" src="{{get_image($blog->image)}}" width="100%" alt="{{$blog->title}}">
         @endif
         <hr class="mt-4">
         <blockquote class="blockquote mt-3">
            <footer class="blockquote-footer"><i class="fa fa-tag" aria-hidden="true"></i>
               <cite title="Source Title">{{tag_links($blog->tag)}}</cite>
            </footer>
         </blockquote>
         @yield('recom')
         @yield('adv')
      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4 bg-light py-4 px-4">
         @yield('sidebar2')
      </div>
   </div>
</div>
@endsection


@elseif($cmd=='tags')
@php $meta=get_meta(); @endphp
@section('title')
{{$meta['title']}}
@endsection
@section('description')
{{$meta['description']}}
@endsection

@section('content')
<div class="container">
   <div class="row">
      <div class="col-lg-8 bg-light p-4">
         <h1 class="mt-0">{{$tag}}</h1>
         <hr>
         <p><i class="fas fa-home text-danger"></i> <a href="{{url('/')}}">หน้าแรก</a> > <span class="small" style="color:#777;">{{$tag}}</span></p>
         <hr>
         @yield('adv2')
         <div class="container p-0">
            <div class="row pt-3 px-0 mt-3 bg-light">         
               @foreach($blogs as $blog)
               <div class="col-sm-4 col-md-4 mb-4 img-hover">
                  <div class="pic">
                     <a href="{{get_link('item',$blog->id,$blog->slug)}}"><img src="{{get_image($blog->image)}}" width="100%" height="150px"></a>
                  </div>         
                  <p class="text-muted mt-2" style="height:50px; overflow:hidden;"><a href="{{get_link('item',$blog->id,$blog->slug)}}">{{$blog->title}}</a></p>
                  <span class="small p-0" style="color:#999;">{{ DateThai($blog->created_at) }} / {{ $blog->visit }}views</span>
               </div>
               @endforeach 
            </div>   
         </div>
         <hr class="my-3">
         @yield('adv')
         <hr>
         @yield('recom')
      </div>
      <!-- Sidebar Widgets Column -->
      <div class="col-md-4 bg-light py-4 px-4">
         @yield('sidebar2')
      </div>
   </div>
</div>
@endsection
@endif

