<?php

class Util extends Model {

     /**
     * @param $length integer
     * @return random characters
     */
    public static function generateRandomCode($length = 50) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /**
     * @param $length integer
     * @return random characters capitalized only
     */
    public static function generateRandomCodeCapital($length = 4) {
        return substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /**
     * @param $value mixed
     * @param $decimal integer
     * @return 
     */
    public static function number_format($value, $decimal = 2){
        return number_format((float)$value, $decimal, '.', ',');
    }
	    
    /**
     * @param $value string
     * @param $format string {'Y/m/d h:m A', 'Y/m/d', etc.}
     * @return formated date string
     */
    public static function date_format($value, $format = 'Y-m-d'){
        return date_format(new DateTime($value), $format);
    }

    /**
     * @param $value string
     * @return string 
     */
    public static function get_chat_time($value){
        $to_time = strtotime($value);
        $from_time = strtotime("now");

        $time = $from_time - $to_time;

       // return $to_time.' - '.$from_time;

        $seconds = floor($time);
        $minutes = floor($seconds / 60);
        $hours = floor($minutes / 60);
        $days = floor($hours / 24);
        $months = floor($days / 30);
        $years = floor($months / 12);

        if ( $years > 0 ) {
           return ($years == 1) ? '1 year ago' : $years.' years ago';
        } else if ( $months > 0 ) {
            return ($months == 1) ? '1 month ago' : $months.' months ago';
        } else if ( $days > 0 ) {
            return ($days == 1) ? '1 day ago' : $days.' days ago';
        } else if ( $hours > 0 ) {
            return ($hours == 1) ? '1 hour ago' : $hours.' hours ago';
        } else if ( $minutes > 0 ) {
            return ($minutes == 1) ? '1 minute ago' : $minutes.' minutes ago';
        } else {
            return ($seconds == 1) ? '1 second ago' : $seconds.' seconds ago';
        }

    }

    /**
     * convert number to words
     * @param $number mixed
     * @return string
     */
    public static function NumbertoWords($number){

        //get whole number
        $wholenumber = floor($number);

        //get decimal number and convert to words
        $decimal = $number - $wholenumber;
        $decimal = ($decimal > 0 ? 'and '.floor($decimal * 100).'/100 Centavos' : '');

        $formater = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        return  $formater->format($wholenumber).' Pesos '.$decimal;   // outpout : five hundred sixty-six thousand five hundred sixty
    }

    /**
     * get ip address of client/visitor
     * @return ipaddress
     */
    public static function getIpAddress(){
        // Get real visitor IP behind CloudFlare network
        if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
            $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
            $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
        }
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        } elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        }else{
            $ip = $remote;
        }

        return $ip;
    }

    /**
     * get browser name of client/visitor
     * @return string
     */
    public static function getBrowserName()
    {
        $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
        
        //add space to so that strpos won't return 0
        $user_agent = " ".$user_agent;

        if (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR/')) return 'Opera';
        elseif (strpos($user_agent, 'Edge')) return 'Microsoft Edge';
        elseif (strpos($user_agent, 'Chrome')) return 'Google Chrome';
        elseif (strpos($user_agent, 'Safari')) return 'Safari';
        elseif (strpos($user_agent, 'Firefox')) return 'Mozilla Firefox';
        elseif (strpos($user_agent, 'MSIE') || strpos($user_agent, 'Trident/7')) return 'Internet Explorer';
        
        return 'Other';
    }

    public static function draw_calendar($month,$year, $check_in, $check_out){

        $day_from = $check_in->format('d');

        $num_of_days = date_diff($check_in, $check_out);
        $num_of_days = $num_of_days->d;
        $to = $day_from + $num_of_days;

        $style = "";
        $days = array();
        for ($x = $day_from; $x <= $to; $x++){
            array_push($days, $x);
        }


        /* draw table */
        $months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'Nomvember', 'December');
        $calendar = '<table cellpadding="0" cellspacing="0" class="calendar" style="width: 100%;">
        <tr>
            <td colspan="7"><div class="btn btn-primary" style="width: 100%; font-weight: bold; font-size: 18px; padding: 20px; text-align: center;">'.$months[$month-1].' '.$year.'</div></td>
        </tr>
        ';

        /* table headings */
        $headings = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
        $calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

        /* days and weeks vars now ... */
        $running_day = date('w',mktime(0,0,0,$month,1,$year));
        $days_in_month = date('t',mktime(0,0,0,$month,1,$year));
        $days_in_this_week = 1;
        $day_counter = 0;
        $dates_array = array();

        /* row for week one */
        $calendar.= '<tr class="calendar-row">';

        /* print "blank" days until the first of the current week */
        for($x = 0; $x < $running_day; $x++):
            $calendar.= '<td class="calendar-day-np"> </td>';
            $days_in_this_week++;
        endfor;

        /* keep going with days.... */
        for($list_day = 1; $list_day <= $days_in_month; $list_day++):
            $calendar.= '<td class="calendar-day">';
            /* add in the day number */
            if (in_array($list_day, $days)) {
                $style = " style='background: #faaf40;'";
            }else {
                $style = "";
            }
            $calendar.= '<div class="day-number" '.$style.'>'.$list_day.'</div>';

            /** QUERY THE DATABASE FOR AN ENTRY FOR THIS DAY !!  IF MATCHES FOUND, PRINT THEM !! **/
            $calendar.= str_repeat('<p> </p>',2);

            $calendar.= '</td>';
            if($running_day == 6):
                $calendar.= '</tr>';
                if(($day_counter+1) != $days_in_month):
                    $calendar.= '<tr class="calendar-row">';
                endif;
                $running_day = -1;
                $days_in_this_week = 0;
            endif;
            $days_in_this_week++; $running_day++; $day_counter++;
        endfor;

        /* finish the rest of the days in the week */
        if($days_in_this_week < 8):
            for($x = 1; $x <= (8 - $days_in_this_week); $x++):
                $calendar.= '<td class="calendar-day-np"> </td>';
            endfor;
        endif;

        /* final row */
        $calendar.= '</tr>';

        /* end the table */
        $calendar.= '</table>';

        /* all done, return result */
        return $calendar;
    }


}
