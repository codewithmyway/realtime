<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Equipment;
use Illuminate\Support\Facades\Http;

/**
 * DateTime and action heading
 */
function tableCommonHeading(){
    $data=[];
    $data[]="DateTime";
    $data[]="Action";
    return $data;
}

/**
 * Logged in user permission check
 */
function checkAuthorization($permissionName){
    return true;
    $user=Auth::user();
    $allPermissions=$user->getAllPermissions();
    // echo "<pre/>";
    // print_r($allPermissions); exit;

    $data=false;
    if($user->can($permissionName)){
        $data=true;
    }
    return $data;
}

function getFloorValue($value){
    return number_format($value,2,'.','');
}

function getNumber($value){
    return number_format($value,2,'.','');
}


function loaderEquipmentTypeId(){
    return config('constants.loader_equipment_type');
}
function dumperEquipmentTypeId(){
    return config('constants.dumper_equipment_type');
}

function surfaceEquipmentTypeId(){
    return config('constants.surface_equipment_type');
}

function excavatorEquipmentTypeId(){
    return config('constants.excavator_equipment_type');
}

function dozerEquipmentTypeId(){
    return config('constants.dozer_equipment_type');
}
function graderEquipmentTypeId(){
    return config('constants.grader_equipment_type');
}

function drazerEquipmentTypeId(){
    return config('constants.drill_equipment_type');
}

function equipmentCount(){
    $data=[];
    $dozer=Equipment::where(['equipment_type_id'=>drazerEquipmentTypeId()])->count();
    $dozer=Equipment::where(['equipment_type_id'=>dozerEquipmentTypeId()])->count();

    $surface=Equipment::where(['equipment_type_id'=>surfaceEquipmentTypeId()])->count();
    $excavator=Equipment::where(['equipment_type_id'=>excavatorEquipmentTypeId()])->count();
    $grader=Equipment::where(['equipment_type_id'=>graderEquipmentTypeId()])->count();
    // $data['dozer']=$dozer;
    // $data['drill']=$drazer;
    // $data['drazer']=$drazer;
    // $data['drazer']=$drazer;
    // $data['drazer']=$drazer;


}


function sensorType($selected=null){
    $data=[];
    $data[1]="Tracker";
    $data[2]="Handshake";
    $data[3]="Proximity";
    $data[4]="Tripper";
    $data[5]="Shovel Moment";
    $data[6]="Load Cell Power";

    if($selected){
        $data=$data[$selected];
    }
    return $data;
}

function getTrackerTypeId(){
    return 1;
}
function getHandshakeTypeId(){
    return 2;
}

function operator($operator){
    return $operator->operatorid."($operator->name)";
}

function mapOverlay(){
        return '';
}

function meterToKm($value){
    if($value){
        $value= $value/1000;
    }
    return $value;
}

function numberFormat($number){
    return number_format($number,'2','.','');
}

function operatorName($operator,$additional=null){
    $data=$operator->name." ($operator->operatorid)";
    return $data;
}

function activeMenu($userdashboard,$selected){
    $img="add.svg";
    $activeclass="";
    if(is_array($userdashboard) && count($userdashboard)){
        foreach($userdashboard as $key=>$value){
            if($key==$selected){
                if($value){
                    $img="remove.svg";
                    $activeclass="append-show";
                }
                else{
                    $img="add.svg";
                    $activeclass="";
                }
            }
        }
    }
    $img=asset('img/'.$img);
   return ['img'=>$img,'activeclass'=>$activeclass];
}

function activeDashboardCount($userdashboard){
    $data=false;
    if(is_array($userdashboard) && count($userdashboard)){
        foreach($userdashboard as $key=>$value){
            if($value){
               $data=true;
               break;
            }
        }
    }
    return $data;
}


function dateRange( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) {
    $dates = [];
    $current = strtotime( $first );
    $last = strtotime( $last );

    while( $current <= $last ) {

        $dates[] = date( $format, $current );
        $current = strtotime( $step, $current );
    }

    return array_reverse($dates);
}


function fileName($data){
   // return time().".xlsx";
    $folder=$data['folder'];
    $shift=$data['shift'];
    $shift_date=$data['shift_date'];
    $filename=$folder."-".date('d-m-Y',strtotime($shift_date)).".xlsx";

    return "report/$folder/".date('Y',strtotime($shift_date))."/".date('m',strtotime($shift_date))."/".date('d',strtotime($shift_date))."/".$shift."/".$filename;
}

function emailNotification(){
    return config('constants.email_notification');
}

function getArachiveTransactionTable(){
    return "arachive_transactions";
}

function cleanNumber($number){
    if($number){
        $number=number_format($number,2,'.','');
    }
    return floatval($number);
}

function getAwsReportUrl($request){
    $type=$request->type;
    $baseUrl="https://adanimine.s3.ap-south-1.amazonaws.com/talabira/production/report/".$type."/";
    $download_filter=$request->download_filter;
    $data=[];
    $explodeDownloadFilter=explode(',',$download_filter);
       if(is_array($explodeDownloadFilter)){
            foreach($explodeDownloadFilter as $key=>$item){
              $item=explode('shift',$item);
              $shift_id=$item[1];
              $shift_date=$item[0];
              if($shift_date){
                $shiftDateExplode=explode('-',$shift_date);

                $filename=$type."-".$shiftDateExplode[2]."-".$shiftDateExplode[1]."-".$shiftDateExplode[0].".xlsx";
                $shift_date=str_replace('-','/',$shift_date)."/".$shift_id."/".$filename;
                $url=$baseUrl.$shift_date;
                $response = Http::get($url);
                if( $response->successful() ) {
                    $data[]=$url;
                }



              }
            }
        }

return $data;

}


function ShiftPlanningZoneTable(){
    return "shift_planning_zone";
}
