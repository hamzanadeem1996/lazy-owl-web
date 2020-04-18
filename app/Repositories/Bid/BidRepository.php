<?php
namespace App\Repositories\Bid;
use Illuminate\Support\Facades\Auth;
use App\Bids;
use App\Projects;

class BidRepository implements BidRepositoryInterface { 
    public function add($data){
        $check = Bids::where('project_id', $data['project_id'])->where('user_id', Auth::id())->get();
        if (count($check) > 0){
            return $result = array(
                'isSuccess' => false,
                'status' => 400,
                'message' => 'Your bid already exists on this task'
            );
        }else{
            $bid = new Bids();
            $bid->user_id = Auth::id();
            $bid->project_id = $data['project_id'];
            $bid->amount = $data['amount'];
            if ($bid->save()){
                return $result = array(
                    'isSuccess' => true,
                    'status' => 200,
                    'message' => 'Bid added Successfully'
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'status' => 500,
                    'message' => 'Internal Server Error'
                );
            }
        }
    }

    public function all($id){
        $bids = Bids::where('project_id', $id)->where('status', 1)->get();
        return $bids;
    }

    public function acceptBid($id){
        $bid = Bids::find($id);
        $project = Projects::find($bid['project_id']);
        if ($project['assigned_to'] !== null){
            return $result = array(
                'isSuccess' => false,
                'status' => 400,
                'message' => 'Project already assigned'
            );
        }else{
            $project->assigned_to = $bid['user_id'];
            if($project->save()){
                return $result = array(
                    'isSuccess' => true,
                    'status' => 200,
                    'message' => 'Task assigned successfully'
                );
            }else{
                return $result = array(
                    'isSuccess' => false,
                    'status' => 500,
                    'message' => 'Internal Server Error'
                );
            }
        }
    }
}