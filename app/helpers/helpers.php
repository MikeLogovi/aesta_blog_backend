<?php

  if(!function_exists('fileUpload')){
      function fileUpload($file,$folder){
          $path=$file->store('/'.config('aesta.uploadsFolder').'/'.$folder,'public');
          return $path;
        }
  }
  if(!function_exists('unlinkFile')){
      function unlinkFile($path){
           Storage::delete($path);
      }
  }
  if(!function_exists('unlinkAndUpload')){
      function unlinkAndUpload($file,$path,$folder){
          Storage::disk('public')->delete($path);
          return fileUpload($file,$folder);
      }
  }
  if(!function_exists('formatMyDate')){
      function formatMyDate($date){
          return date_format(date_create($date),'d/m/Y');
      }
  }
  if(!function_exists('getEventStatus')){
      function getEventStatus($dateEvent){
        $dateEvent=new Datetime($dateEvent);
        $dateNow=new Datetime(date('d-m-Y'));
        if($dateEvent<$dateNow)
            return config('samk.status.passed');
        elseif($dateEvent==$dateNow)
            return config('samk.status.today');
        else
            return config('samk.status.upcoming');;
      }
  }
  if(!function_exists('createSocialites')){
      function createSocialites($request,$team){
        $index=0;
        $urls=$request->urls;
        if($request->icons){
            foreach($request->icons as $icon){
                $team->socialites()->create([
                                'url'=>$urls[$index],
                                'icon'=>$icon
                ]);
                $index++;
            }
        }
      }
  }
  if(!function_exists('getStatusClass')){
    function getStatusClass($status){
      if($status==config('samk.status.passed'))
          return 'danger';
      elseif($status==config('samk.status.today'))
          return "success";
      else
          return "info";
    }
}

if(!function_exists('initializeData')){
   function initializeData(){
        $comments=Cache::remember('comments',now()->addMinutes(1),function(){
              return Comment::all();
         });
         $events=Cache::remember('events',now()->addMinutes(1),function(){
               return Event::all();
         });
         $messages=Cache::remember('messages',now()->addMinutes(1),function(){
              return Message::all();
         });
         $partners=Cache::remember('partners',now()->addMinutes(1),function(){
              return Partner::all();
         });
         $portfolioCategories=Cache::remember('portfolioCategories',now()->addMinutes(1),function(){
              return PortfolioCategory::all();
         });
         $portfolioImages=Cache::remember('portfolioImages',now()->addMinutes(1),function(){
              return PortfolioImage::all();
         });
         $sliders=Cache::remember('Sliders',now()->addMinutes(1),function(){
              return Slider::all();
         });
          $teams=Cache::remember('teams',now()->addMinutes(1),function(){
              return Team::all();
         });
          $users=Cache::remember('users',now()->addMinutes(1),function(){
              return User::all();
         });
        $videos=Cache::remember('users',now()->addMinutes(1),function(){
              return Video::all();
         });

        $data=[
            [
                'title'=>'USERS',
                'value'=>$users->count(),
                'icon'=>'icon-fa fa-user',
                'color'=>'#1E88E5'
            ],
            [
                'title'=>"TEAM'S MEMBERS",
                'value'=>$teams->count(),
                'icon'=>'icon-fa fa-user-circle',
                'color'=>'##3E2723'
            ],
             [
                'title'=>"PORTFOLIO'S CATEGORY",
                'value'=>$portfolioCategories->count(),
                'icon'=>'icon-fa fa-object-group',
                'color'=>'#651FFF'
            ],
            [
                'title'=>"VIDEOS",
                'value'=>$sliders->count(),
                'icon'=>'icon-fa fa-video-camera',
                'color'=>'#8E24AA'
            ],
             [
                'title'=>"PORTFOLIO'S IMAGE",
                'value'=>$portfolioImages->count(),
                'icon'=>'icon-fa fa-picture-o',
                'color'=>'#E91E63'
            ],
            [
                'title'=>"SLIDERS",
                'value'=>$sliders->count(),
                'icon'=>'icon-fa fa-sliders',
                'color'=>'#26C6DA'
            ],
            [
                'title'=>'COMMENTS',
                'value'=>$comments->count(),
                'icon'=>'icon-fa fa-comment',
                'color'=>'#3949AB'
            ],
            [
                'title'=>'PARTNERS',
                'value'=>$partners->count(),
                'icon'=>'icon-fa fa-handshake-o',
                'color'=>'#388E3C'
            ],
             [
                'title'=>'EVENTS',
                'value'=>$events->count(),
                'icon'=>'icon-fa fa-cc',
                'color'=>'#EF6C00'
            ],
             [
                'title'=>'MESSAGES',
                'value'=>$messages->count(),
                'icon'=>'icon-fa fa-envelope-o',
                'color'=>'#546E7A'
            ]
             
        ];
    return $data;
   }
}