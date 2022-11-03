<?php
namespace BankTransection;

interface Bank{
    public function checkBranchCode($branch_code);
    public function checkBankCode($bank_code);
    public function checkBankAccountName($bank_account_name);
}

class BankInfo implements Bank{
    public function checkBranchCode($branch_code){
        return !$branch_code ? "Bank branch code missing" : $branch_code;
    }

    public function checkBankCode($bank_code){
        return !$bank_code ? "Bank code missing" : $bank_code;
    }
    
    public function checkBankAccountName($bank_account_name){
        return !$bank_account_name ? "Bank Account Name missing" : str_replace(" ", "_", strtolower($bank_account_name));
    }
}