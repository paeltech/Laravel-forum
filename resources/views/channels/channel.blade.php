@extends('layouts.app')

@section('content')

            <div class="panel panel-default">
                <div class="panel-heading">Discussions</div>

                <div class="panel-body">
                    @foreach($discussions as $d)
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <img src="{{ $d->user->avatar }}" alt="avatar" width="70px" height="70px" class="img-circle">&nbsp; &nbsp;
                                <span>{{ $d->user->name }}, &nbsp; <b>{{ $d->created_at->diffForHumans() }}</b></span>

                                <a href="{{ route('discussion', ['slug'=> $d->slug]) }}"class="btn btn-default pull-right">View discussion</a>
                            </div>
                            <div class="panel-body">
                                <h4>{{ $d->title }}</h4>
                                {{ str_limit($d->content, 50) }}
                            </div>
                            <div class="panel-footer">
                                <span>
                                    {{ $d->replies->count()}} Replies <a href="{{ route('channel', ['slug'=> $d->channel->slug])}}" class="pull-right btn btn-default btn-xs">{{ $d->channel->title }}</a>
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

@endsection