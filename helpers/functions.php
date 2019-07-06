<?php

function createToken(int $length = 40){
    $token = '';
    $initString = '0123456789qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
    for($i = 1; $i <= $length; $i++){
        $position = rand(0, strlen($initString)-1);
        // $token .= $initString[$position];
        $token .= substr($initString,$position,1);
    }
    return $token;
}
// echo createToken();
//CqSWdCAmOkl2ZZQGPC9w9Q7T6hLVdO0V6kATuolQ
//0H4hfcc6ODPRjyWLYNwuf7xHFnCCwKhKh9ca0XiG
//TliqVsHFG2IxrrsVCGDMFp7yCwlRpfFzjdYpn8Fb

?>