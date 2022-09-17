@extends('templates.layout')

@section('content')

<div class="row">
    <div class="col-6 offset-3">

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        @if (Session::has('success'))
            <div class="alert alert-success">
                <ul>
                    <li>{{ Session::get('success') }}</li>
                </ul>
            </div>
        @endif
        <form id="editEventForm" name="editEventForm" action="{{ url('/events/'.$event->id.'/update') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="eventName" class="form-label">Event Name</label>
                <input type="text" name="eventName" class="form-control" id="eventName" placeholder="Event Name" value="{{ $event->name }}" required>
            </div>

            <div class="mb-3">
                <label for="eventSlug" class="form-label">Event Slug</label>
                <input type="text" name="eventSlug" class="form-control element-disabled" id="eventSlug" placeholder="Event Slug" value="{{ $event->slug }}" readonly required>
            </div>

            <div class="mb-3">
                <label for="eventStartAt" class="form-label">Start At</label>
                <input type="datetime-local" class="form-control" name="eventStartAt" id="eventStartAt" value="{{ $event->startAt }}"  required>
            </div>

            <div class="mb-3">
                <label for="eventEndAt" class="form-label">End At</label>
                <input type="datetime-local" class="form-control" name="eventEndAt" id="eventEndAt" value="{{ $event->endAt }}"  required>
            </div>
            
            <div class="text-center py-3">
                <a href="{{ url('/events') }}"  > << Back</a>
                <button type="submit" name="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</div>

@stop

@section('view-scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('.alert').fadeIn().delay(2000).fadeOut();
    });
</script>
@stop