<?php 
    
    function insert($field,$data,$table,$con){
        $col = "";
        $val = "";
        $i=1;
        foreach($field as $lahan){
            $col = $col.$lahan;
            if($i<sizeof($field)){
                $col = $col.",";
            }
            $i++;
        }
        $i=1;
        foreach($data as $nilai){
            $val = "$val'$nilai'";
            if($i<sizeof($data)){
                $val = $val.",";
            }
            $i++;
        }
        $sql = "INSERT INTO $table($col) VALUES($val)";
        //echo $sql;
        mysqli_query($con,$sql);
    }

    function update($field,$data,$table,$id,$cond,$con){
        $set = "";
        for($i=0;$i<sizeof($field);$i++){
            $set = "$set$field[$i]='$data[$i]'";
            if($i+1<sizeof($field)){$set = $set.",";}
        }
        $sql = "UPDATE $table SET $set WHERE $cond = '$id'";
        //echo $sql;
        mysqli_query($con,$sql);
    }

    function delete($field,$table,$id,$con){
        $sql = "DELETE FROM $table WHERE $field = '$id'";
        //echo $sql;
        mysqli_query($con,$sql);
    }

 ?>