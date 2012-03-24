<?php
// use custom errorHandler() function
set_error_handler(errorHandler, $error_level);

if (!isset($err_cfg)){
	$err_cfg = array();
	$err_cfg['debug'] = 1;
	$err_cfg['adminEmail'] = 'ryan@rammons.net';
	$err_cfg['logFile'] = $dir_admin."error_log.txt";
}

$err_cfg['clientMessage'] = "<p style='font-weight:bold'>Something went wrong on our end--".
			"and we've been notified of this unintended 'feature'.</p>".
			"<p>We apologize for any inconvenience and ".
			"hope to have the issue resolved soon.</p>".
			"<p>If you would like to give it another go, please try again later. ".
			"<em>Thank you for your patience and understanding.</em></p>".
			"<br><p>-Your friendly technical staff</p>";

function errorHandler($errno, $errstr='', $errfile='', $errline='')
{
    // if error has been supressed with an @
    /*if (error_reporting() == 0) {
        return;
    }*/

    global $err_cfg;

    // check if function has been called by an exception
    if(5 == func_num_args()) {
        // called by trigger_error()
        $exception = null;
        list($errno, $errstr, $errfile, $errline) = func_get_args();

        $backtrace = array_reverse(debug_backtrace());

    }else {
        // caught exception
        $exc = func_get_arg(0);
        $errno = $exc->getCode();
        $errstr = $exc->getMessage();
        $errfile = $exc->getFile();
        $errline = $exc->getLine();

        $backtrace = $exc->getTrace();
    }

    $errorType = array (
               E_ERROR          => 'ERROR',
               E_WARNING        => 'WARNING',
               E_PARSE          => 'PARSING ERROR',
               E_NOTICE         => 'NOTICE',
               E_CORE_ERROR     => 'CORE ERROR',
               E_CORE_WARNING   => 'CORE WARNING',
               E_COMPILE_ERROR  => 'COMPILE ERROR',
               E_COMPILE_WARNING => 'COMPILE WARNING',
               E_USER_ERROR     => 'USER ERROR',
               E_USER_WARNING   => 'USER WARNING',
               E_USER_NOTICE    => 'USER NOTICE',
               E_STRICT         => 'STRICT NOTICE',
               E_RECOVERABLE_ERROR  => 'RECOVERABLE ERROR'
               );

    // create error message
    if (array_key_exists($errno, $errorType)) {
        $err = $errorType[$errno];
    } else {
        $err = 'CAUGHT EXCEPTION';
    }

    $errMsg = "$err: $errstr in $errfile on line $errline";

    // start backtrace
    foreach ($backtrace as $v) {

        if (isset($v['class'])) {

            $trace = 'in class '.$v['class'].'::'.$v['function'].'(';

            if (isset($v['args'])) {
                $separator = '';

                foreach($v['args'] as $arg ) {
                    $trace .= "$separator".getArgument($arg);
                    $separator = ', ';
                }
            }
            $trace .= ')';
        }

        elseif (isset($v['function']) && empty($trace)) {
            $trace = 'in function '.$v['function'].'(';
            if (!empty($v['args'])) {

                $separator = '';

                foreach($v['args'] as $arg ) {
                    $trace .= "$separator".getArgument($arg);
                    $separator = ', ';
                }
            }
            $trace .= ')';
        }
    }

    // display debug error msg
    if($err_cfg['debug'] == 1) {
        echo '<h2>Debug Message</h2>'.nl2br($errMsg).'<br />
            Trace: '.nl2br($trace).'<br />';
    }	

    // what to do
	if ($errno == E_USER_ERROR){ //triggered by app logic, so safe to display errstr/message
		echo "<h3>Sorry, there's been an error:</h3>" . $errstr .
				"<br><br>Technical staff have been notified of the problem.";
	}
	else{
		echo "<h3>Sorry, there's been an internal error.</h3>" .
				"We apologize for the inconvenience. Technical staff have been notified of the problem.";
	}
				
    error_log($errMsg); // write message to default system/server log
	
	if($err_cfg['debug'] == 0){
        // send email to admin
        /*if(!empty($err_cfg['adminEmail'])) {
            @mail($err_cfg['adminEmail'],'Critical error on '.$_SERVER['HTTP_HOST'], 
					$errMsg, 'From: Error Handler');
        }*/
		
        // end
    	exit();
    }
    else
        exit('<p>--Abort from DEBUG mode--</p>');

} // end of errorHandler()


function getArgument($arg)
{
    switch (strtolower(gettype($arg))) {
        case 'string':
            return( '"'.str_replace( array("\n"), array(''), $arg ).'"' );
        case 'boolean':
            return (bool)$arg;
        case 'object':
            return 'object('.get_class($arg).')';
        case 'array':
            $ret = 'array(';
            $separtor = '';
            foreach ($arg as $k => $v) {
                $ret .= $separtor.getArgument($k).' => '.getArgument($v);
                $separtor = ', ';
            }
            $ret .= ')';
            return $ret;
        case 'resource':
            return 'resource('.get_resource_type($arg).')';
        default:
            return var_export($arg, true);
    }
}

function logError($errorMessage)
{
    global $err_cfg;
	
	$log_file = $err_cfg['logFile'];

    $fd = fopen($log_file, 'a');
    if(!$fd) {
        echo "Cannot log error.";
    }
    else {
        if(!fwrite($fd, date('Y-m-d H:i:s')." Error: \n$errorMessage\n\n")) {
            echo "Cannot log error.";
        }
        fclose($fd);
    }
}
?>