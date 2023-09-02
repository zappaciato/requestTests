<?php

class Log {


    public static function displayLog($logMsg)
    {
        echo $logMsg;
    }

    public static function getLog($logInfo, $data = "No log data provided.") {

        $class = get_class();
    
        $logMsg = date("F j, Y, g:i a") . " ------ "
        . "| File location: " . __FILE__ . "| Class Name: " . $class . "| Method Name: " . __METHOD__ 
        . "|" . " This is the log INFO:: ". $logInfo . " || Logged Data: " . $data . " || " . json_encode($data) . PHP_EOL;

        error_log($logMsg, 3, 'log_list.log');

        Self::displayLog($logMsg);
    }

    

}