<?php

include 'compile.php';

################입력하는 곳###################
$input_file = fopen($argv[1], "r");
$input = fread($input_file, filesize($argv[1]));
fclose($input_file);
$output = fopen($argv[2], "w");
/*
    ROT: *
    CRZ: p
    MOVD: j
    NOP: o
    INPUT: /
    STOP: v
    PRINT: <
    JMP: i
*/
###########################################

$ROT = "'&%$#\"!~}|{zyxwvutsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+*)("; //*
$CRZ = ">=<;:9876543210/.-,+*)('&%$#\"!~}|{zyxwvutsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?"; //p
$MOVD = "('&%$#\"!~}|{zyxwvutsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+*)"; //j
$NOP = "DCBA@?>=<;:9876543210/.-,+*)('&%$#\"!~}|{zyxwvutsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSRQPONMLKJIHGFE"; //o
$INPUT = "utsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+*)('&%$#\"!~}|{zyxwv"; // /
$STOP = "QPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+*)('&%$#\"!~}|{zyxwvutsrqponmlkjihgfedcba`_^]\\[ZYXWVUTSR"; //v
$PRINT = "cba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+*)('&%$#\"!~}|{zyxwvutsrqponmlkjihgfed"; //<
$JMP = "ba`_^]\\[ZYXWVUTSRQPONMLKJIHGFEDCBA@?>=<;:9876543210/.-,+*)('&%$#\"!~}|{zyxwvutsrqponmlkjihgfedc"; //i

$tty = fopen('/dev/tty', 'w'); #현재 콘솔 장치를 의미

$t = Array();

$cnt = 0;

#fprintf($tty, "%s", $input);

if($tty){
#   fprintf($tty, "test");
    fprintf($tty, "input: $input\nresult: ");
    foreach(($in_ = str_split($input)) as $regex){
        /*
        $t = (function($type){
            global $ROT, $CRZ, $MOVD, $NOP, $INPUT, $STOP, $PRINT, $JMP;
            $NONE = Array();
            $in = ($type == "*" ? $ROT   : 
                  ($type == "p" ? $CRZ   : 
                  ($type == "j" ? $MOVD  :
                  ($type == "o" ? $NOP   :
                  ($type == "/" ? $INPUT :
                  ($type == "v" ? $STOP  :
                  ($type == "<" ? $PRINT :
                  ($type == "i" ? $JMP   :
                  $NONE))))))));
            return str_split($in);
        })($regex);
        */
        fprintf($tty, "%s", ($t = (function($type){
            global $ROT, $CRZ, $MOVD, $NOP, $INPUT, $STOP, $PRINT, $JMP;
            $NONE = Array();
            $in = ($type == "*" ? $ROT   : 
                  ($type == "p" ? $CRZ   : 
                  ($type == "j" ? $MOVD  :
                  ($type == "o" ? $NOP   :
                  ($type == "/" ? $INPUT :
                  ($type == "v" ? $STOP  :
                  ($type == "<" ? $PRINT :
                  ($type == "i" ? $JMP   :
                  $NONE))))))));
            return str_split($in);
        })($regex))[$cnt++ % 94]);
        fprintf($output, "%s", $t[($cnt-1) % 94]);
    }
    fprintf($tty, "\n");
    compile_malbolge($tty);
}
?>