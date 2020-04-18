<?php
namespace App\Repositories\Bid;
interface BidRepositoryInterface {
    public function add($data);
    public function all($id); 
    public function acceptBid($id);
}
?>