@extends('templates.layout')

@section('content')
    <div class="row py-3">
        <div class="col">
            <div class="row">
                <div class="col">
                    <!-- <a href="{{ url('events/create') }}" class="btn btn-primary btn-sm"> <i class="bi bi-file-plus"></i> Add Event </a> -->

                    <a  href="{{ url('events/create') }}"  class="btn btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-file-plus" viewBox="0 0 18 18">
                            <path d="M8.5 6a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V10a.5.5 0 0 0 1 0V8.5H10a.5.5 0 0 0 0-1H8.5V6z"></path>
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm10-1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1z"></path>
                        </svg>
                        Add Event
</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Start At</th>
                    <th scope="col">End At</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($events as $key => $event)
                        <tr>
                            <!-- <td>{{ $event['id'] }}</td> -->
                            <td>
                                {{ $key +1 }}
                            </td>
                            <td>
                                <a href="{{ url('/events/' . $event['id']) }}">{{ $event['name'] }}</a>
                            </td>
                            <td>{{ $event['slug'] }}</td>
                            <td>{{ $event['startAt'] }}</td>
                            <td>{{ $event['endAt'] }}</td>
                            <td>{{ $event['created_at'] }}</td>
                            <td>{{ $event['updated_at'] }}</td>
                            <td>
                                <!-- <button type="button" class="btn btn-primary btn-sm" onclick="openEditEventModal('{{ $event->id }}')" >Edit</button> -->
                                <a href="{{ url('/events/' . $event->id . '/edit' ) }}" >Edit</a>
                                &nbsp;
                                <button type="button" class="btn btn-danger btn-sm" onclick="openDeleteEventModal('{{ $event->id }}')" >Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {!! $events->links() !!}
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editEvent" tabindex="-1" aria-labelledby="editEventLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form  id="editEventForm" name="editEventForm">
                
                    <div class="modal-header">
                        <h5 class="modal-title" id="editEventLabel">Edit Event</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-success d-none" id="successAlert" role="alert">
                                Event updated successfully
                        </div>

                        <div class="alert alert-danger d-none" id="errorAlert" role="alert">
                                <ul id="errorList"></ul>
                        </div>
                        
                        <input type="hidden" id="eventId">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" name="eventName" id="eventName" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Slug:</label>
                            <input type="text" class="form-control" name="eventSlug" id="eventSlug" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Start At:</label>
                            <input type="datetime-local" class="form-control" name="eventStartAt" id="eventStartAt" required>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">End At:</label>
                            <input type="datetime-local" class="form-control" name="eventEndAt" id="eventEndAt" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit"  class="btn btn-primary" >Update</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <!-- Delete Modal -->
    <div class="modal fade" id="deleteEvent" tabindex="-1" aria-labelledby="deleteEventLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteEventLabel">Confirm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="deleteEventId">
                    <div class="alert alert-success d-none" id="deleteEventSuccessAlert" role="alert">
                            Event deleted successfully
                    </div>

                    <p>Are you sure to delete this event?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button"  class="btn btn-danger" onclick="deleteEvent()">Delete</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('view-scripts')
<script type="text/javascript">

    $("#editEventForm").validate({
        submitHandler: function(form) {
            updateEvent();
        }
    });
    function updateEvent() {
        let id = $('#eventId').val();
        let name = $('#eventName').val();
        let slug = $('#eventSlug').val();
        let startAt = $('#eventStartAt').val();
        let endAt = $('#eventEndAt').val();
        $.ajax({
            url: '/api/v1/events/' + id,
            type:"PATCH",
            data:{
                "_token": "{{ csrf_token() }}",
                id:id,
                name:name,
                slug:slug,
                startAt:startAt,
                endAt:endAt,
            },
            success:function(response){
                console.log(response);
                if(response.error){
                    let errorList = $('#errorList');
                    $.each(response.error, function(key, value){
                        errorList.append('<li>'+ key +':'+ value +'</li>');
                    });   
                    $('#errorAlert').removeClass('d-none');
                } else {
                    $('#successAlert').removeClass('d-none');
                    setTimeout(function() { 
                        location.reload();
                    }, 1000);
                }
            },
            error: function(response) {
                console.log(response);
            },
        });
    }
    function openEditEventModal(id) {
        $('#errorList').html('');
        $('#errorAlert').addClass('d-none');
        $.get('/api/v1/events/' + id , function (data) {
            $('#eventId').val(id);
            $('#eventName').val(data.name);
            $('#eventSlug').val(data.slug);
            $('#eventStartAt').val(data.startAt);
            $('#eventEndAt').val(data.endAt);
            $('#editEvent').modal('show');
        })
    }

    function openDeleteEventModal(id) {
        $('#deleteEventId').val(id);
        $('#deleteEvent').modal('show');
        
    }

    function deleteEvent() {
        let id = $('#deleteEventId').val();
        $.ajax({
            url: '/api/v1/events/' + id,
            type:"DELETE",
            success:function(response){
                console.log(response);

                $('#deleteEventSuccessAlert').removeClass('d-none');
                    setTimeout(function() { 
                        location.reload();
                }, 1000);
            },
            error: function(response) {
                console.log(response);
            },
        });
    }
</script>
@stop