<?php
    $filename = '../json/totalrecord.json';
    $pass = 0;

    if(file_exists($filename)){
        $contant_data = file_get_contents($filename);
        $arra_data = json_decode($contant_data.true);
        for($i=1;$i<=12;$i++){
            $filename_record = '../json/class'.$i.'/studentRecord-'.$i.'.json';
            $filename_result = '../json/class'.$i.'/studentResult-'.$i.'.json';
            if(file_exists($filename_record)||file_exists($filename_result)){
                $contant_data_record = file_get_contents($filename_record);
                $contant_data_result = file_get_contents($filename_result);

                $array_data_record = json_decode($contant_data_record,true);
                $array_data_result = json_decode($contant_data_result,true);

                foreach($array_data_result as $key => $value){
                    if($value['status'] == 'pass'){
                        $pass++;
                    }
                }
            }
            $new_record = array(
                'class' => $i,
                'total_student' => (count($array_data_record)),
                'total_result_of_class' => count($array_data_result),
                'total_pass_student' => $pass,
                'total_fail_student' => (count($array_data_result) - $pass)
            );
            $array_data[] = $new_record;
        }
        if(file_put_contents($filename,json_encode($array_data,JSON_PRETTY_PRINT))){
            echo 'success';
        }else{
            echo 'unsuccess';
        }
    }else{
        echo 'file does not exits';
    }
?>