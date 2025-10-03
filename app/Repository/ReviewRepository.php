<?php

namespace App\Repository;
use App\Models\Review;
use Illuminate\Support\Facades\Storage;

class ReviewRepository
{

   
    public function storeReview($request)
    {
      $path = Storage::putFile('review', $request->file('image'));
       return Review::create([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $path,
        ]);

    }

    public function updateReview( $request)
    {
        $review = Review::findOrFail($request->id);
        
        $path = $review->image; // Keep the old image path by default
        if($request->hasFile('image')){
            // Delete old image
            if($review->image && Storage::exists($review->image)){
                Storage::delete($review->image);
            }
            $path = Storage::putFile('review', $request->file('image'));
        }

        return $review->update([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $path,
        ]);
    }

    public function deleteReview($id)
    {
       $review = Review::findOrFail($id);
         if($review->image && Storage::exists($review->image)){
          Storage::delete($review->image);
         }
            return $review->delete();
    }
}