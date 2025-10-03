<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Services\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

    public $reviewService;
    public function __construct(ReviewService $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function AllReview(){
        $review = Review::latest()->get();
        return view('admin.backend.review.all_review')->with([
            'review' => $review,
        ]);
    }

    public function AddReview(){
        return view('admin.backend.review.add_review');
    }

    public function StoreReview(ReviewRequest $request){
        $validated = $request->validated();
        try{

            $this->reviewService->storeReview($request);
            $notification = array(
                'message' => 'Review Inserted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.review')->with($notification);
        }catch(\Exception $e){
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
   
    }

    public function EditReview($id){
        $review = Review::findOrFail($id);
        return view('admin.backend.review.edit_review')->with([
            'review' => $review,
        ]);
    }

    public function UpdateReview(ReviewRequest $request){
        $validated = $request->validated();

        try{
            $this->reviewService->updateReview($request);
            $notification = array(
                'message' => 'Review Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.review')->with($notification);
        }catch(\Exception $e){
            $notification = array(
                'message' => $e->getMessage(),
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

    public function DeleteReview($id){
        try{
            $this->reviewService->deleteReview($id);
            $notification = array(
                'message' => 'Review Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.review')->with($notification);
        }catch(\Exception $e){
            $notification = array(
                'message' => 'Something Went Wrong',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }


    
}
