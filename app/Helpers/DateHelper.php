<?php
use Carbon\Carbon;

/**
 * Return current datetime
 */
function currentDateTime(){
    return now();
}

/**
 * Return current time
 */
function currentTime(){
    return date('H:i:s');
}

/**
 * Return current date
 */
function currentDate(){
    return date('Y-m-d');
}

function currentDateFormat(){
    return date('j F Y');
}
/**
 *  Convert date
 */
function convertDate($date,$format="Y-m-d"){
    return date($format,strtotime($date));
}

/**
 * Add n of day to date
 */
function addDay($day,$date=null){
    return Carbon::now()->addDays($day)->format('Y-m-d');
 }

/**
 * Before day
 */
function subDay($day,$date=null){
   return Carbon::now()->subDays($day)->format('Y-m-d');
}

function previousDay($date,$minus=1){
    return Carbon::parse($date)->subDays($minus)->format('Y-m-d');
 }

/**
 * Two Date difference
 */
function diffInDays($startDate,$endDate){
    $startDate    = Carbon::parse($startDate);
    $endDate      = Carbon::parse($endDate);
    $diffInDays   = $startDate->diffInDays($endDate);
    return $diffInDays;
}

function diffInMinutes($startTime,$endTime=null){
    $startTime    = Carbon::parse($startTime);
    if(empty($endTime)){
        $endTime      = Carbon::now();
    }
    $diffInMinutes   = $startTime->diffInMinutes($endTime);
    return $diffInMinutes;
}


function dayPassedTime(){
    $shiftIdAndDate   = shiftIdAndDate();
    $shift_id          = $shiftIdAndDate['shift_id'];
    $shift_date       = $shiftIdAndDate['shift_date'];
    $updatedShiftDate = date('Y-m-d H:i:s',strtotime($shift_date. "06:00:00"));
    $diffInMinutes   = diffInMinutes($updatedShiftDate);
    return $diffInMinutes;
}

function shiftPassedTime(){
    $shiftIdAndDate   = shiftIdAndDate();
    $shift_id          = $shiftIdAndDate['shift_id'];
    $data_from         =$shiftIdAndDate['start_time'];
    $shift_date       = $shiftIdAndDate['shift_date'].date('H:i:s',strtotime($data_from));

    $updatedShiftDate = date('Y-m-d H:i:s',strtotime($shift_date));
    $diffInMinutes   = diffInMinutes($updatedShiftDate);
    return $diffInMinutes;
}

function displayTime($dateTime){
    if($dateTime){
        $dateTime=Carbon::parse($dateTime)->format('h:i:s a');
    }
    return $dateTime;
}

function displayDuration($minutes,$unit='hour'){
    $hours=0;
    if($minutes){
        if($unit=="hour"){
            $hours = floor($minutes / 60).' hrs '.($minutes -   floor($minutes / 60) * 60)." min";
        }
    }
    return $hours;
}


function displayMinute($minute){
    return number_format($minute,0);
}

function displayMinuteSecond($seconds){
    //Second
    $minute=intval($seconds/60);
    $second=$seconds%60;
    $time = $minute." min ".$second." sec";
    return $time;

}


function displaySecondMinut($seconds){
    $minute=intval($seconds/60);
    return $minute;

}

