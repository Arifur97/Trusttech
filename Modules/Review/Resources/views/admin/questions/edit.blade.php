@extends('admin::layout')

@component('admin::components.page.header')
    @slot('title', trans('Questions Reply', ['resource' => trans('Questions Reply')]))

    <li><a href="{{ route('admin.questions.index') }}">{{ trans('Questions') }}</a></li>
    <li class="active">{{ trans('Question Reply', ['resource' => trans('Question Reply')]) }}</li>
@endcomponent

@section('content')
    <form method="POST" action="{{ route('admin.questions.reply.store', ['id' => $question->id]) }}" class="form-horizontal">
        {{ csrf_field() }}

        <div class="panel">
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">User Email</th>
                            <th scope="col">Question</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $question->user_name }}</td>
                            <td>{{ $question->user_email }}</td>
                            <td>{{ $question->question }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel mt-3">
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Admin Name</th>
                            <th scope="col">Admin Email</th>
                            <th scope="col">Reply</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        @foreach ($questionReply as $reply)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $reply->user_name }}</td>
                                <td>{{ $reply->user_email }}</td>
                                <td>{{ $reply->question_reply }}</td>
                                <td>
                                    <a onclick="return confirm('Are you sure?');" href="{{ route('admin.questions.reply.destroy', ['id' => $reply->id]) }}"><i class="fa fa-trash text-danger" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
        
                <div class="box-content clearfix">
                    {{ Form::textarea('question_reply', 'Add Reply:', $errors) }}
                    <button type="submit" class="btn btn-primary" data-loading>
                        {{ trans('admin::admin.buttons.save') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection

