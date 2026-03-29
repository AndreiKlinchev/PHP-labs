<?php
declare(strict_types=1);


class TransactionManager {
    public function __construct(private TransactionRepository $repository) 
    {


    }

    public function calculateTotalAmount(): float{
        $totalAmount =0.0;
        
        foreach($this->repository->getAllTransactions() as $transaction){
            $totalAmount += $transaction->getTransactionAmount();
        }

        return totalAmount;
    }

    public function calculateTotalAmountByDateRange(string $startDate, string $endDate): float{
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);

        $total = 0.0;

        foreach ($this->repository->getAllTransactions() as $transaction) {
            $transactionDate = $transaction->getDate();

            if ($transactionDate >= $start && $transactionDate <= $end) {
                $total += $transaction->getAmount();
            }
        }

        return $total;
    }

        public function countTransactionsByMerchant(string $merchant): int
    {
        $count = 0;

        foreach ($this->repository->getAllTransactions() as $transaction) {
            if ($transaction->getMerchant() === $merchant) {
                $count++;
            }
        }

        return $count;
    }

      public function sortTransactionsByDate(): array
    {
        $transactions = $this->repository->getAllTransactions();

        usort($transactions, function (Transaction $a, Transaction $b): int {
            return $a->getDate() <=> $b->getDate();
        });

        return $transactions;
    }

    public function sortTransactionsByAmountDesc(): array
    {
        $transactions = $this->repository->getAllTransactions();

        usort($transactions, function (Transaction $a, Transaction $b): int {
            return $b->getAmount() <=> $a->getAmount();
        });

        return $transactions;
    }


}