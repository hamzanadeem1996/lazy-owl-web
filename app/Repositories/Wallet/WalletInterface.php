<?php
namespace App\Repositories\Wallet;

interface WalletInterface {
    public function add($data);
    public function get($id);
    public function minus($data);
}