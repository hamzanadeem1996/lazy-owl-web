<?php
namespace App\Repositories\Transactions;

interface TransactionsInterface {
    public function add($data);
    public function get($userId, $userRole);
}