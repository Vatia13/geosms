<?php
if ( ! function_exists('sms')) {

    /**
     * @return \Illuminate\Foundation\Application|mixed
     */
    function sms()
    {
        $sms = app('sms');
        return $sms;
    }
}