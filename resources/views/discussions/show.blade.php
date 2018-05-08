@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">
                    <img src="{{ $discussion->user->avatar }}" alt="avatar" width="70px" height="70px" class="img-circle">&nbsp; &nbsp;
                    <span>{{ $discussion->user->name }}, &nbsp; <b>{{ $discussion->created_at->diffForHumans() }}</b></span>

                    <!-- <a href="{{ route('discussion', ['slug'=> $discussion->slug]) }}"class="btn btn-default pull-right">View discussion</a> -->
                </div>
                <div class="panel-body">
                    <h4>{{ $discussion->title }}</h4>
                    {{ str_limit($discussion->content, 50) }}
                </div>
                <div class="panel-footer">
                    <p>
                        {{ $discussion->replies->count()}} Replies
                    </p>
                </div>
        </div>

                @foreach($discussion->replies as $reply)
                    <div class="panel panel-default" style="margin-left: 40px;">
                        <div class="panel-heading">
                            <img src="{{ $discussion->user->avatar }}" alt="avatar" width="70px" height="70px" class="img-circle">&nbsp; &nbsp;
                            <span>{{ $reply->user->name }}, &nbsp; <b>{{ $reply->created_at->diffForHumans() }}</b></span>
                        </div>
                        <div class="panel-body">
                            <p>
                                {{ $reply->content }}
                            </p>
                        </div>
                        <div class="panel-footer">
                            @if($reply->is_liked_by_auth_user())
                                <a href="{{ route('reply.unlike', ['id'=> $reply->id]) }}" class="btn btn-success btn-xs">Unlike <span class="badge">{{ $reply->likes->count() }}</span></a>
                            @else
                                <a href="{{ route('reply.like', ['id'=> $reply->id]) }}" class="btn btn-success btn-xs">Like <span class="badge">{{ $reply->likes->count() }}</span></a>
                            @endif
                        </div>
                    </div>
                @endforeach


            
            <div class="panel-default">
                <div class="panel-body">
                    <form action="{{ route('discussion.reply', ['id'=> $discussion->id]) }}" method="POST">
                        {{ csrf_field() }} 
                        <div class="form-group">
                            <label for="reply">Leave a reply...</label>
                            <textarea name="reply" id="reply" cols="30" rows="10" class="form-control">
                                
                            </textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" type="submit">Leave a reply</button>
                        </div>
                    </form>
                </div>
            </div>
@endsection
