@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul>
                        @foreach ($ratings as $rating)
                           <li> <b> {{$rating->rateable->name}} </b> <i> Puntuación : {{$rating->score}} </i> por <b>{{$rating->qualifier->name}}</b> </li>
                        @endforeach
                    </ul>

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
