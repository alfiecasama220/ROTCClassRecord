@extends('admin.pages.app')

@section('title', 'Home')
@section('content')

<style>
    /* Custom styles for elegant box design */
    .box {
        border-radius: 15px; /* Rounded corners */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth hover transition */
        background-color: #4e73df; /* Primary color */
        color: white;
        text-align: center;
        font-size: 1.2rem;
    }

    .box:hover {
        transform: translateY(-5px); /* Lift effect */
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15); /* Enhanced shadow on hover */
    }

    .box .content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
    }

    /* Optional: Responsive adjustments for smaller screens */
    @media (max-width: 767px) {
        .box {
            font-size: 1rem;
        }
    }
</style>

<div class="container mt-4">
    <div class=" w-100 d-flex mb-5 justify-content-between align-items-center">
        <div><h4>Dashboard</h4></div>
        <div></div>
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form">
            Add Batch
        </button>  
         
    </div>

    @if(session('success'))
                <div class="pt-3 pl-3 pr-3">
                    <div class="alert alert-success messageAlert" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            @elseif(session('error'))
                <div class="pt-3 pl-3 pr-3">
                    <div class="alert alert-danger messageAlert" role="alert">
                        {{ session('error') }}
                    </div>
                </div>
            @endif
    
    <div class="row">
        
        @foreach ($batches as $batch )
             <!-- Box 1 -->
            <div class="col-md-3 mb-4">
                <a href="{{ route('home.show', $batch->id) }}" class="box p-5 d-flex justify-content-center align-items-center">
                    <div class="content d-flex flex-column">
                        {{ $batch->batch_name }}
                        <p>{{ $batch->yearFrom }} - {{ $batch->yearTo }}</p>
                    </div>
                    
                </a>
            </div>
        @endforeach
        
    </div>
</div>

<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header border-bottom-0">
          <h5 class="modal-title" id="exampleModalLabel">Add a batch</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('home.store') }}" method="POST">
            @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="email1">Batch name</label>
              <input type="name" name="batchName" class="form-control" id="email1" aria-describedby="emailHelp" placeholder="Enter batch name">
              {{-- <small id="emailHelp" class="form-text text-muted">Your information is safe with us.</small> --}}
            </div>
            <div.form-group>
                <div class="container mt-5">
                    <h3>Input Year from</h3>
                    <input type="text" name="yearFrom" id="yearpicker" class="form-control" placeholder="Select Year">
                </div>

                <div class="container mt-5">
                    <h3>Input Year to</h3>
                    <input type="text" name="yearTo" id="yearpicker" class="form-control" placeholder="Select Year">
                </div>
          </div>
          
          <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{-- <script>
    $(document).ready(function () {
        // Initialize the year-only datepicker
        $('#yearpicker').datepicker({
            format: "yyyy", // Show year only
            viewMode: "years", // Show only years
            minViewMode: "years", // Set the minimum view mode to year
            startView: 4, // Set the default view to "year"
            autoclose: true, // Close the picker once the year is selected
            orientation: "bottom auto" // Open the calendar below the input field
        });
    });
</script> --}}

@endsection