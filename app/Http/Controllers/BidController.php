<?php

namespace App\Http\Controllers;
use App\Repositories\Bid\BidRepositoryInterface;
use Illuminate\Http\Request;
use Jleon\LaravelPnotify\Notify;
use Alert;

class BidController extends Controller
{
    protected $bid;
    public function __construct(
        BidRepositoryInterface $bid
    ) {
        $this->bid = $bid;
    }
    public function addBidToTask(Request $request){
        $data = $request->all();
        $addBid = $this->bid->add($data);
        if ($addBid['isSuccess'] === true){
            Notify::success($addBid['message']);
        }else{
            Notify::error($addBid['message']);
        }
        return redirect()->back();
    } 

    public function getTaskBidsById($id){
        $bids = $this->bid->all($id);
        foreach($bids as $bid){
            $bid['user'] = $bid->user;
        }
        return json_encode($bids);
    }

    public function acceptBid($id){
        $assignTask = $this->bid->acceptBid($id);
        if ($assignTask['isSuccess'] === true){
            Notify::success($assignTask['message']);
        }else{
            Notify::error($assignTask['message']);
        }
        return redirect()->back();
    }
}
