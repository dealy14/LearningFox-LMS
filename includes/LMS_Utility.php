<?php

class LMS_Utility {
    private static $expiration_period_in_days = '180';

    public static function get_expiration_date(/*string*/ $enroll_date){
        $exp_date = date('Y-m-d', strtotime($enroll_date." + ".self::$expiration_period_in_days." days"));
        //echo $enroll_date." + ".self::$expiration_period_in_days." days";
        return $exp_date;
    }

    public static function is_enrollment_expired_by_enroll_date(/*string*/ $enroll_date){
        $expire_date = date('Y-m-d', strtotime($enroll_date." + ".self::$expiration_period_in_days." days"));
        if ($expire_date > date('Y-m-d')){
            return true;
        }
        else
            return false;
    }
    public static function is_enrollment_expired_by_expire_date(/*string*/ $expire_date){
        if ($expire_date < date('Y-m-d')){
            return true;
        }
        else
            return false;
    }

    public static function date_diff($date1, $date2) {
        $current = $date1;
        $datetime2 = date_create($date2);
        $count = 0;
        while(date_create($current) < $datetime2){
            $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current)));
            $count++;
        }
        return $count;
    }
}