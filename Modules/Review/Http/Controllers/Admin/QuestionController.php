<?php

namespace Modules\Review\Http\Controllers\Admin;

use Modules\Review\Entities\Question;
use Modules\Admin\Traits\HasCrudActions;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class QuestionController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'Questions';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'review::admin.questions';


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::getQuestion($id);
        $questionReply = Question::getQuestionReply($id);
        return view('review::admin.questions.edit', compact('question', 'questionReply'));
    }

    public function storeReply(Request $request, $id) {
        DB::table('product_question_replys')->insert([
            'user_id' => auth()->id(),
            'product_question_id' => $id,
            'user_name' => Auth::user()->first_name,
            'user_email' => Auth::user()->email,
            'question_reply' => $request->question_reply,
            'created_at' => Carbon::now()
        ]);

        return back()->withSuccess(trans('admin::messages.resource_saved', ['resource' => $this->getLabel()]));
    }

    public function destroyReply($id) {
        DB::table('product_question_replys')
            ->where('id', '=', $id)
            ->delete();

        return back()->withSuccess(trans('admin::messages.resource_saved', ['resource' => $this->getLabel()]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

}

