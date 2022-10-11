<?php

namespace Modules\Review\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProductQuestionController
{
    /**
     * Display a listing of the resource.
     *
     * @param int $productId
     * @return \Illuminate\Http\Response
     */
    public function index($productId)
    {
        return DB::table('product_questions')
            ->where('product_questions.product_id', '=', $productId)
            ->leftJoin('product_question_replys', 'product_question_replys.product_question_id', '=', 'product_questions.id')
            ->orderBy('id', 'desc')
            ->select(
                'product_question_replys.user_email as adminEmail',
                'product_question_replys.question_reply',
                'product_question_replys.created_at as adminCreated',
                'product_questions.*'
            )
            ->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $productId
     * @param \Modules\Review\Http\Requests\StoreReviewRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($productId, Request $request)
    {
        return DB::table('product_questions')->insert([
            'user_id' => auth()->id(),
            'product_id' => $productId,
            'user_name' => $request->user_name,
            'user_email' => $request->user_email,
            'question' => $request->question,
            'created_at' => Carbon::now()
        ]);
    }
}

