<?php

function checkBot() {
   if(isset($_SERVER['HTTP_USER_AGENT'])) {
      if(preg_match('/bot|crawl|slurp|spider|mediapartners/i', $_SERVER['HTTP_USER_AGENT'])) {
         return $_SERVER['HTTP_USER_AGENT'];
      }
    }
 }

function LineNotify($message, $token="")
{
// $message = 'ข้อความ';
   $token = 'wsWseXjZUFIaxNSWt1yfgQft72GvF6oDOn2bk6o3q0D';
   $ch = curl_init();
   curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
   curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt( $ch, CURLOPT_POST, 1);
   curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=$message");
   curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
   $headers = array( "Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token", );
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
   $result = curl_exec( $ch );
   curl_close( $ch );
   return $result;
}

function run_group() {
   $gs=DB::table('groups')->orderBy('orders','asc')->where('status',1)->get();
   foreach($gs as $g) {
      take_blogs($gs->id);
   }
}

function banner($img,$img2='') {
echo '<div class="container p-1 mt-3
bg-light">
   <div class="" style="display:block; overflow:hidden;">
      <img src="'.url('img/'.$img).'" width="100%" alt="banner">';
      if ($img2!='') echo '<img src="'.url('img/'.$img2).'" width="100%" style="margin-top:4px;" alt="banner">';
   echo '</div>
</div>';
}
function allBox() {
   $grs=DB::table('groups')->where('status',1)->where('type',0)->orderBy('orders','asc')->get();
   $run=0;
   foreach($grs as $gr) {
      $run++;
      if ($run==1) box3($gr->id);
      else {
         box4($gr->id);
         if ($run==2) echo banner('banner.gif');
      }
   }
}

function box3($cid,$limit='3') {
   echo '<div class="container">
   <div class="row pt-3 px-3 mt-3 bg-light">
   <h1 class="col-12 mb-3"><i class="fas fa-quote-left text-danger"></i> <span>'.get_groups($cid).'</span> <i class="fas fa-quote-right text-danger"></i> <span class="small" style="float:right;"><a class="btn btn-primary py-1" href="'.get_link('all',$cid,get_groups($cid)).'">ดูทั้งหมด</a></span></h1>';
   $blogs=DB::table('blogs')->where('cid',$cid)->where('status',1)->orderBy('id','desc')->take($limit)->get();
   foreach($blogs as $blog) {
      echo '<div class="col-sm-4 col-md-4 mb-3 img-hover">';
      if ($blog->switch1!=1 && $blog->image) {
         echo '<div class="pic">
            <a href="'.get_link("item",$blog->id,$blog->slug).'">
               <img src="'.get_image($blog->image).'" width="100%" height="191vh">
            </a>
         </div>         
         <p class="text-muted mt-2" style="height:53px; overflow:hidden;">
         <a href="'.get_link('item',$blog->id,$blog->slug).'">'.$blog->title.'"</a>
         </p>';
      }
      else {
         echo youtube($blog->clip);
         echo '<p class="text-muted mt-2" style="height:53px; overflow:hidden;"><a href="'.get_link("item",$blog->id,$blog->slug).'">'.$blog->title.'</a></p>';
      }
      echo '</div>';
   }
   echo '</div></div>';
}

function box4($cid,$limit='8') {
   echo '<div class="container">
   <div class="row pt-3 px-3 mt-3 bg-light">
   <h1 class="col-12 mb-3"><i class="fas fa-quote-left text-danger"></i> <span>'.get_groups($cid).'</span> <i class="fas fa-quote-right text-danger"></i><span class="small" style="float:right;"><a class="btn btn-primary py-1" href="'.get_link('all',$cid,get_groups($cid)).'">ดูทั้งหมด</a></span></h1>';
   $blogs=DB::table('blogs')->where('cid',$cid)->where('status',1)->orderBy('id','desc')->take($limit)->get();
   foreach($blogs as $blog) {
      echo '
   <div class="col-sm-6 col-md-3 mb-3 img-hover">
      <div class="pic">
         <a href="'.get_link('item',$blog->id,$blog->slug).'">
            <img src="'.get_image($blog->image).'" height="163px">
         </a>
      </div>         
      <p class="text-muted mt-2" style="height:53px; overflow:hidden;"><a href="'.get_link('item',$blog->id,$blog->slug).'">'.$blog->title.'</a></p>
   </div>';
   }
   echo '</div></div>';
}

function take_blogs($cid){
   echo '<div class="container">
      <div class="row pt-3 px-3 mt-3 bg-light">';
      $blogs=DB::table('blogs')->where('cid',$cid)->where('status',1)->orderBy('id','desc')->take(12)->get();
      foreach($blogs as $blog) {
         echo '<div class="col-sm-3 col-md-3 mb-3 img-hover">
            <div class="pic">
               <a href="'.get_link('item',$blog->id,$blog->slug).'">
                  <img src="'.get_image($blog->image).'" width="100%" height="150vmin">
               </a>
            </div>         
            <p class="text-muted mt-2" style="height:45px; overflow:hidden;"><a href="'.get_link('item',$blog->id,$blog->slug).'">'.$blog->title.'</a></p>
         </div>';
      }
   echo '</div></div>';
}

function cfg($key,$value="") {
   if ($value!="") {
      $k_exists = DB::table('configs')->where('item', $key)->exists();
      if($k_exists) {
         $key = DB::table('configs')->where('item', $key)-first();
         $key->data=$value;
         $key->save();
      }
   }
   else {
      $key=DB::table('configs')->where('item',$key)->first();
      return $key->data;
   }
}

function visit($id, $act='show') { 
   $v = DB::table('blogs')->where('id', $id)->first();
   if ($act == 'show') return $v->visit;
   else {
      DB::table('blogs')->where('id',$id)->increment('visit');
      $vc=$v->visit +1;
      return $vc;
   }
}

function reset_db_col($key,$value) {
   // ตั้งค่าใน column ทั้งหมดใน table
   return DB::table('blogs')->update(array($key => $value));
}

function set_menu($act='') {
   $ms=DB::table('groups')->where('menu', 1)->orderBy('order','asc')->get();
   foreach($ms as $m) {
      if ($m->status != 0) {     
         echo '<li class="nav-item">
            <a class="nav-link" href="'.url('../item/all/'.$m->id).'">'.$m->title.'</a>
         </li>';
      }                     
   }
}

function get_adv($img,$link='') {
   echo '<div class="container bg-light mt-2 rounded">
      <div class="row">
         <div class="col-lg-12 p-2">
            <a href="'.$link,'" target="_blank"><img src="images/'.$img.'" width="100%" /></a>
         </div>
      </div>
   </div>';
}

function loop_widget() {
    $loops = DB::table('groups')->get();
    if (count($loops)) {
        foreach($loops as $loop) {  
            $chk_item=DB::table('blogs')->where('cid', $loop->id)->get(); 
            if (count($chk_item)) {
                get_widget($loop->id);
            }
        }
    }
}

function get_widget($id,$block=6) {
    $dbs = DB::table('blogs')->where([['cid', '=', $id],['hot', '=', 0]])->orderBy('id', 'desc')->take($block)->get();
    if (count($dbs)) {
        echo '
        <div class="row  bg-light mt-3">
            <div class="col-md-12 mt-2 pt-2 pb-0" style="color:crimson;">
                <h1 class="title">'.get_groups($id).'</h1>
            </div>';
            foreach($dbs as $db) {
            echo '<div class="ct-item col-sm-6 col-md-4">
                <div class="inner">';
                    if ($db->youhot == 1 && $db->misc != null) {
                        echo '<div class="youtube">'.youtube($db->misc).'</div>';
                    }
                    else {
                        echo '<div class="fauxcrop">
                            <a href="'.url('/item/'.$db->id).'"><img src="'.url('../storage/thumb/'.$db->cover_image).'"></a>
                        </div>';
                    }

                    echo '<div class="ct-item-content">
                        <a href="'.url('/item/'.$db->id).'">'.$db->title.'</a>
                    </div>
                </div>
            </div>';
            }
            echo '<div style="padding:20px; padding-top:10px; text-align:right;" class="col-lg-12 mt-3">
                <a href="'.url('../item/all/'.$id).'" class="all rounded ">เพิ่มเติม...</a>
            </div>
        </div>';
    }
}


function get_from($a,$b,$c=null) {
   $c=array_pluck($a, $b); 
   return $c;
}

function get_image($img) {
   if(file_exists(public_path('storage/images/'.$img))) return url('storage/images/'.$img);
   else return url('/img/noImg.jpg');
}

function get_link($item,$id,$slug='') {
   return url($item.'/'.$id.'/'.Str::slug($slug));
}

function get_meta($id='') {
   if ($id) return DB::table('groups')->where('id', $id)->first();
   else {
      $m=DB::table('configs')->where('item', 'meta')->first();
      $ms=explode('|',$m->data);
      return array('title' => $ms['0'],'description' => $ms['1']);
   }
}

function getMenu(){
   $menus=DB::table('menus')->orderBy('orders','asc')->where('status',1)->get();
   if (count($menus)!=null) {
      $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
      foreach($menus as $menu) {
         echo '<li class="nav-item active">';
         if(preg_match($reg_exUrl, $menu->link, $url)) echo '<a class="nav-link" href="'.$menu->link.'" title="'.$menu->title.'" target="_blank" style="font-size:17px;">'.$menu->title.'</a>';
         else echo '<a class="nav-link" href="'.url($menu->link).'" title="'.$menu->title.'" target="_self" style="font-size:17px;">'.$menu->title.'</a>';  
         echo '</li>';                     
      }
   }
}

function get_groups($cid) {
   $ggs = DB::table('groups')->where('id', $cid)->first();
   return $ggs->title;
}

function get_creator($uid) {
   if ($uid==0) $uid=1;
   $gcc = DB::table('users')->where('id', $uid)->first();
   return ($gcc->nickname)?$gcc->nickname:false;
}

function youtube($clip) {
   return '<div class="youtube"><iframe src="'.$clip.'" frameborder="0" allowfullscreen class="video"></iframe></div>';
}

// homepage
function tag_links($tag) {
   $tag=explode(',',$tag);
   $num=count($tag);
   for ($i=0;$i<$num;$i++) {
      $tagx=Str::slug(trim($tag[$i]));
      echo '<a href="'.url('/item/tag/'.$tagx).'">'.$tagx.'</a> ';
   }
   return;
}

function getImg($img) {
   $array = array();
   preg_match( '/src="([^"]*)"/i', $img, $array );
   return $array[1];
}

function getYoutube($url) {
   $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
   $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
   if (preg_match($longUrlRegex, $url, $matches)) $youtube_id = $matches[count($matches) - 1];
   if (preg_match($shortUrlRegex, $url, $matches)) $youtube_id = $matches[count($matches) - 1];
   return 'https://www.youtube.com/embed/' . $youtube_id;
}

function DateThai($strDate,$noTime='') {
   $strYear = date("Y",strtotime($strDate))+543;
   $strMonth= date("n",strtotime($strDate));
   $strDay= date("j",strtotime($strDate));
   $strHour= date("H",strtotime($strDate));
   $strMinute= date("i",strtotime($strDate));
   $strSeconds= date("s",strtotime($strDate));
   $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
   $strMonthThai=$strMonthCut[$strMonth];
   if ($noTime=='') return $strDay.' '.$strMonthThai.' '.$strYear.' '.$strHour.':'.$strMinute;
   else return $strDay.' '.$strMonthThai.' '.$strYear;
}

function thai_date($time){
   global $thai_day_arr,$thai_month_arr;
   $thai_date_return= " ".date("j",strtotime($time));
   $thai_date_return=" ".$thai_month_arr[date("n",strtotime($time))];
   $thai_date_return= " ".(date("Y",strtotime($time))+543);
   // $thai_date_return.= "  ".date("H:i",$time)." น.";
   return $thai_date_return;
}

function ranking($level='') {
   if ($level=='') {
      return array([
         ['lv' => '0','pos' => 'NormalUser'],
         ['lv' => '1','pos' => 'Creator'],
         ['lv' => '10','pos' => 'Admin'],
         ['lv' => '100','pos' => 'SuperAdmin']
      ]);
   }
   else {
      if ($level>=0 && $level < 10) return 'Creator';
      elseif($level>=10 && $level < 100) return 'Admin';
      elseif($level>=100) return 'SuperAdmin';
      else return 'NormalUser';
   }
}

function getIP() {
   //whether ip is from share internet
   if (!empty($_SERVER['HTTP_CLIENT_IP'])) $ip_address = $_SERVER['HTTP_CLIENT_IP'];
   //whether ip is from proxy
   elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
   //whether ip is from remote address
   else $ip_address = $_SERVER['REMOTE_ADDR'];
   return $ip_address;
}

?>