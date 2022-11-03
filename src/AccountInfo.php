<?php
namespace BankTransection;

interface Account{
    public function checkCurrency($currency);
    public function checkAmount($amount);
    public function checkAccountNumber($account_number);
}

class AccountInfo implements Account{
    public function checkCurrency($currency){
        return !$currency || $currency == "" ? "Currency ID Missing" : $currency;
    }
    
    public function checkAmount($amount){
        return !$amount || $amount == "0" ? 0 : (float) $amount;
    }
    public function checkAccountNumber($account_number){
        return !$account_number ? "Bank account number missing" : (int) $account_number;
    }

    public function calculateSubunits($amount, $multiplier){
        return (int) ($amount * $multiplier);
    }
}