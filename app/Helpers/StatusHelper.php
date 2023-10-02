<?php
/**
 * Status option
 */
function status(){
    $data=[1=>'Active',2=>'InActive'];
    return $data;
}
function activeStatus(){
    return 1;
}

function shiftPlanningStatus($selected=null){
    $data=[1=>'Stand-by','Delay','Running','Down'];
    if($selected){
        $data=$data[$selected];
    }
    return $data;
}
function getStandBy(){
    return 1;
}
function getDelay(){
    return 2;
}
function getRunning(){
    return 3;
}
function getDown(){
    return 4;
}
function transactionStatusChange($oldStatus,$newStatus){
    //echo $oldStatus.$newStatus; exit;
    $data=[];
    $data[1]="standby";
    $data[2]="delay";
    $data[3]="running";
    $data[4]="down";
    return @$data[$oldStatus]."_".@$data[$newStatus];
}

function exceptionUnResolved(){
    return 1;
}
function exceptionResolved(){
    return 2;
}


function loaderMapIcon($status){
    $map_status_icon="";
    if($status==getStandBy()){
        $map_status_icon="standby";
    }
    elseif($status==getDelay()){
        $map_status_icon="delay";
    }
    elseif($status==getRunning()){
        $map_status_icon="running";
    }
    elseif($status==getDown()){
        $map_status_icon="down";
    }
    $map_icon=config('constants.loader.'.$map_status_icon);
    return $map_icon;
}
function dumperMapIcon($status){
    $map_status_icon="";
    if($status==getStandBy()){
        $map_status_icon="standby";
    }
    elseif($status==getDelay()){
        $map_status_icon="delay";
    }
    elseif($status==getRunning()){
        $map_status_icon="empty";
    }
    elseif($status==getDown()){
        $map_status_icon="down";
    }


    $map_icon=config('constants.dumper.'.$map_status_icon);
    return $map_icon;
}

function dumperLoadedIcon(){
    $map_icon=config('constants.dumper.full');
    return asset($map_icon);
}

function dumperEmptyIcon(){
    $map_icon=config('constants.dumper.empty');
    return asset($map_icon);
}





