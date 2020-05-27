<?php

if(!function_exists( 'random_code')){
    function random_code(){
        return rand(111,555);
    }
}


if(!function_exists( 'work')){
    function work($data){
        $fact = []; 
        // dd($data);
        $idFormat = $data->id;
        switch (strlen(strval($idFormat))) {
            case 1:
                $idFormat = '000'.$data->id;
                 $fact['idFormat'] = $idFormat ;
                break;
            case 2:
                $idFormat = '00'.$data->id;
                $fact['idFormat'] = $idFormat ;
                break;
            case 3:
                $idFormat = '0'.$data->id;
                $fact['idFormat'] = $idFormat ;
                break;
            default:
                $idFormat = $data->id;
                $fact['idFormat'] = $idFormat ;
                break;
        }
        // dd($data->documents);
        $attaches = explode(",", $data->documents);
        $fact['attaches'] = $attaches ;
// dd(  $fact['attaches']);
        return $fact;
    }
}


if(!function_exists( 'job_id')){
    function job_id($jobOrder){
        $idFormat = $jobOrder;
        switch (strlen(strval($idFormat))) {
            case 1:
                $idFormat = '000'.$jobOrder;
                break;
            case 2:
                $idFormat = '00'.$jobOrder;
                break;
            case 3:
                $idFormat = '0'.$jobOrder;
                break;
            default:
                $idFormat = $jobOrder;
                break;
        }
        return $idFormat;
    }
}



?>