<?php

namespace Modules\Review\Entities;

use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Modules\Support\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Review\Admin\QuestionTable;

class Question extends Model
{
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'product_questions';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'timestamp',
    ];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        //
    }

    protected function getAllQuestions() {
        return DB::table('product_questions')
        ->join('product_translations', 'product_translations.product_id', '=', 'product_questions.product_id')
        ->orderBy('id', 'desc')
        ->select(
            'product_translations.name as product_name',
            'product_questions.*'
        )->get();
    }

    protected static function getQuestion($questionId) {
        return DB::table('product_questions')
        ->where('product_questions.id', '=', $questionId)
        ->join('product_translations', 'product_translations.product_id', '=', 'product_questions.product_id')
        ->orderBy('id', 'desc')
        ->select(
            'product_translations.name as product_name',
            'product_questions.*'
        )->first();
    }

    protected static function getQuestionReply($questionId) {
        return DB::table('product_questions')
            ->where('product_questions.id', '=', $questionId)
            ->join('product_translations', 'product_translations.product_id', '=', 'product_questions.product_id')
            ->rightJoin('product_question_replys', 'product_question_replys.product_question_id', '=', 'product_questions.id')
            ->orderBy('id', 'desc')
            ->select(
                'product_translations.name as product_name',
                'product_question_replys.*',
            )->get();
    }

    /**
     * Get table data for the resource
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function table(Request $request)
    {
        $query = $this->getAllQuestions();
        
        return new QuestionTable($query);
    }
}

