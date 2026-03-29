<?php
declare(strict_types=1);

class TransactionRepository{
    private array $transactions =[];


    function addTransaction(Transaction $transaction): void{
        array_push($this->transactions, $transaction);
    }

    function removeTransactionById(int $id): void{

        for ($i = 0; $i < count($this->transactions); $i++) {
        if ($this->transactions[$i]->getId() === $id) {
            array_splice($this->transactions, $i, 1);
            return;
        }
    }
    }

    public function getAllTransactions(): array{
        $this->transactions;
    }

    function findById(int $id): ?Transaction{
        foreach($this->transactions as $transaction){
            if ($transaction->getTransactionID() == $id){
                return $transaction;
            }
        }

        return null;
    }
}