<?php

namespace App\Services;

use App\Repository\ReviewRepository;


class ReviewService
{
        public $reviewRepository;

    public function __construct(ReviewRepository $reviewRepository)
    {
      $this->reviewRepository = $reviewRepository;
    }

    public function storeReview($request)
    {
        return $this->reviewRepository->storeReview($request);
      
    }

    public function updateReview($request)
    {
        return $this->reviewRepository->updateReview($request);
    }

    public function deleteReview($id)
    {
       return $this->reviewRepository->deleteReview($id);
    }
}