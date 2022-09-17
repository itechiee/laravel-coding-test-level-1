@extends('templates.layout')

@section('content')

    <div class="py-3 row text-center">
        <div class="col-2 offset-md-4">
            <h5>Event Name:</h5>
        </div>
        <div class="col col-2">
            <label class="blockquote">{{ $event->name }}</label>
        </div>

        <div class="col-2 offset-md-4">
            <h5>Event Slug:</h5>
        </div>
        <div class="col col-2">
            <label class="blockquote">{{ $event->slug }}</label>
        </div>

        <div class="col-2 offset-md-4">
            <h5>Event Start At:</h5>
        </div>
        <div class="col col-2">
            <label class="blockquote">{{ \Carbon\Carbon::parse($event->startAt) }}</label>
        </div>

        <div class="col-2 offset-md-4">
            <h5>Event End At:</h5>
        </div>
        <div class="col col-2">
            <label class="blockquote">{{ $event->endAt }}</label>
        </div>

        <div class="col-2 offset-md-4">
            <h5>Event Created At:</h5>
        </div>
        <div class="col col-2">
            <label class="blockquote">{{ $event->created_at }}</label>
        </div>

        <div class="col-2 offset-md-4">
            <h5>Event Updated At:</h5>
        </div>
        <div class="col col-2">
            <label class="blockquote">{{ $event->updated_at }}</label>
        </div>

        <div class="text-center py-3">
            <a href="{{ url('/events') }}" ><< Back</a>
        </div>
    </div>

@stop