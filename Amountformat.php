<?php
namespace flechamobile\amountformat;

class Amountformat
{

    public function GetamountFormatted($amount)
    {

        $return = "0.00";
        $l = strlen($amount);
        if($l < 1){
            //empty
            $return = "0.00";
        }
        elseif($l < 2){
            //one character
            if(is_numeric($amount)){
                $return = $amount.".00";
            }else{
                $return = "0.00";
            }
        }
        elseif($l < 3){
            //two characters
            //.2 ,2
            //22
            if(substr($amount, 0, 1) == "." || substr($amount, 0, 1) == ","){
                $return = "0".$amount."0";
                $return = str_replace(",",".",$return);
            }
            elseif(is_numeric($amount)){
                $return = $amount.".00";
            }
            else{
                $return = "0.00";
            }
        }
        elseif($l < 4){
            //3 characters
            //.30
            //300
            //5.4 5,3

            //decimal divider at beginning
            if(substr($amount, 0, 1) == "." || substr($amount, 0, 1) == ","){
                $amount = str_replace(".","",$amount);
                $amount = str_replace(",","",$amount);
                $return = "0.".$amount;
            }
            //decimal divider in middle
            elseif(substr($amount, -2, 1) == "." || substr($amount, -2, 1) == ","){
                $amount = str_replace(",",".",$amount);
                $return = $amount."0";
            }
            else{
                $amount = str_replace(".","",$amount);
                $amount = str_replace(",","",$amount);
                $return = $amount.".00";
            }
        }else{
            //bigger then 3 characters:
            $chk1 = substr($amount, -2, 1); //weird nr but possible
            $chk2 = substr($amount, -3, 1); //normal nr
            if($chk1 == "," || $chk1 == "."){
                //1 decimal
                $amount = str_replace(".","",$amount);
                $amount = str_replace(",","",$amount);
                $tl = strlen($amount);
                $amount = substr_replace($amount, ".", $tl-1, 0)."0";
                $return = $amount;
            }
            elseif($chk2 == "," || $chk2 == "."){
                //2 decimals
                $amount = str_replace(".","",$amount);
                $amount = str_replace(",","",$amount);
                $tl = strlen($amount);
                $amount = substr_replace($amount, ".", $tl-2, 0);
                $return = $amount;
            }
            else{
                //no decimals
                $amount = str_replace(".","",$amount);
                $amount = str_replace(",","",$amount);
                $return = $amount.".00";
            }
        }
        return $return;

    }

}