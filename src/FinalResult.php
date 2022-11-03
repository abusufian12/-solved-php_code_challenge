<?php
/**
* I have modified some areas and try to follow OOP
 * check file exists or not then if not display an error.
 * Make some classes and methods to decorate the code and future modifications.
 * add some methods because if need to change any condition or requirement then we can do it perfectly
 * reduce some variables from inside results method
 */

include("BankInfo.php");
include("AccountInfo.php");
include("FileReader.php");

use BankTransection\AccountInfo;
use BankTransection\BankInfo;

class FinalResult {

    private $bank_info;
    private $account_info;
    
    function __construct(){
        $this->bank_info = new BankInfo();
        $this->account_info = new AccountInfo();
    }

    public function checkEndToEndId($end_id_1, $end_id_2){
        return !$end_id_1 && !$end_id_2 ? "End to end id missing" : $end_id_1 . $end_id_2;
    }
    
    public function results($f) {
        $file_reader = new FileReader($f);
        $d = $file_reader->openFile();
        $h = $file_reader->csvFileReader($d);
        $rcs = [];
        while(!feof($d)) {
            $r = $file_reader->csvFileReader($d);
            
            if(count($r) == 16) {
                $amt = $this->account_info->checkAmount($r[8]);
                $rcd = [
                    "amount" => [
                        "currency" => $this->account_info->checkCurrency($h[0]),
                        "subunits" => $this->account_info->calculateSubunits($amt, 100)
                    ],
                    "bank_account_name" => $this->bank_info->checkBankAccountName($r[7]),
                    "bank_account_number" => $this->account_info->checkAccountNumber($r[6]),
                    "bank_branch_code" => $this->bank_info->checkBranchCode($r[2]),
                    "bank_code" => $this->bank_info->checkBankCode($r[0]),
                    "end_to_end_id" => $this->checkEndToEndId($r[10], $r[11]),
                ];
                $rcs[] = $rcd;
            }
        }
        $rcs = array_filter($rcs);
        
        return [
            "filename" => basename($f),
            "document" => $d,
            "failure_code" => $h[1],
            "failure_message" => $h[2],
            "records" => $rcs
        ];
    }
}
?>
