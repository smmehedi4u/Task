@extends('layout')

@section('content')
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="dashboard__inner__item dashboard__card bg__white padding-20 radius-10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mt-4 shadow">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4>Cities</h4>
                                    <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="bi bi-database-add"></i> ADD
                                    </button>
                                </div>
                                <div class="card-body">
                                    <table id="myTable" class="display">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>City Name</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add City
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="city-form" method="post">
                                            @csrf

                                            <div class="row">
                                                <div class="col-lg">
                                                    <label>City Name</label>
                                                    <input type="text" name="name" id="name"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg">
                                                    <label>State Name</label>
                                                    <select name="state_id" id="state_id" class="form-control">
                                                        <option value="">Select State</option>
                                                        @foreach ($states as $state)
                                                            <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"
                                            form="city-form">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- edit modal --}}

                <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                    aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit City</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="edit-form" method="post">
                                    <input type="hidden" id="edit-id" name="id">
                                    <div class="row">
                                        <div class="col-lg">
                                            <label>City Name</label>
                                            <input type="text" id="edit-name" name="name"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg">
                                            <label>State Name</label>
                                            <select name="state_id" id="state_id" class="form-control">
                                                <option value="">Select State</option>
                                                @foreach ($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" form="edit-form">Edit</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('javascript')

<script>
    // show city
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            "ajax": {
                "url": "{{ route('city.getall') }}",
                "type": "GET",
                "dataType": "json",
                "headers": {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                "dataSrc": function(response) {
                    if (response.status === 200) {
                        return response.cities;
                    } else {
                        return [];
                    }
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "name"
                },
                {
                    "data": "state_id",
                    "render": function(data, type, row) {
                        return row.state.name;
                    }
                },
                {
                    "data": null,
                    "render": function(data, type, row) {
                        return '<a href="#" class="btn btn-sm btn-success edit-btn" data-id="' +
                            data.id + '" data-name="' + data.name + '" data-state_id="' +
                            data.state_id + '">Edit</a> ' +
                            '<a href="#" class="btn btn-sm btn-danger delete-btn" data-id="' +
                            data.id + '">Delete</a>';


                    }
                }
            ]
        });

        // create city

        $('#myTable tbody').on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var name = $(this).data('name');
            var state_id = $(this).data('state_id');

            $('#edit-id').val(id);
            $('#edit-name').val(name);
            $('#edit-state_id').val(state_id);
            $('#editModal').modal('show');
        });


        $('#city-form').submit(function(e) {
            e.preventDefault();
            const cityData = new FormData(this);

            $.ajax({
                url: '{{ route('city.store') }}',
                method: 'POST',
                data: cityData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == 200) {
                        alert("Saved successfully");
                        $('#city-form')[0].reset();
                        $('#exampleModal').hide();
                        $('.modal-backdrop').remove();
                        $('#myTable').DataTable().ajax.reload();
                    }
                }
            });
        });

    });


    // update city
    $('#edit-form').submit(function(e) {
        e.preventDefault();
        const cityData = new FormData(this);

        $.ajax({
            url: '{{ route('city.update') }}',
            method: 'POST',
            data: cityData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status === 200) {
                    alert(response.message);
                    $('#edit-form')[0].reset();
                    $('#editModal').hide();
                    $('.modal-backdrop').remove();
                    $('#myTable').DataTable().ajax.reload();
                } else {
                    alert(response.message);
                }
            }
        });
    });

    // delete city
    $(document).on('click', '.delete-btn', function() {
        var id = $(this).data('id');

        if (confirm('Are you sure you want to delete this city?')) {
            $.ajax({
                url: '{{ route('city.delete') }}',
                type: 'DELETE',
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response); // Debugging: log the response
                    if (response.status === 200) {
                        alert(response.message); // Show success message
                        $('#myTable').DataTable().ajax.reload(); // Reload the table data
                    } else {
                        alert(response.message); // Show error message
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr); // Debugging: log the error
                    alert('Error: ' + error); // Show generic error message
                }
            });
        }
    });
</script>

@endpush
