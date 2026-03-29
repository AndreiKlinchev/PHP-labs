<?php 
declare(strict_types=1);
class Transaction{
    private $id, $date, $amount , $description, $merchant;


    function __construct($id, $date, $amount , $description, $merchant){
        $this->id = $id;
        $this->date = new Date($date);
        $this->amount = (int) $amount;
        $this->description = $description;
        $this->merchant = $merchant;
    }

    function getDaysSinceTransaction(): int{
        return (int) $this->date->diff(new DateTime())->days;
    }

    function getTransactionID():int{
        return $this->id;
    }

    function getTransactionDate():DateTime{
        return $this->date;
    }

    public function getTransactionAmount():int{
        return $this->amount;
    }

    function getTransactionDescription():string{
        return $this->description;
    }

    function getTransactionMerchant():string{
        return $this->merchant;
    }

}