@extends('admin.pages.app')

@section('title', 'Home')
@section('content')

<style>
    /* Import clean professional font */
    
</style>

<div class="container shadow p-4 bg-white rounded">
    <div class="header-section">
        <p>Goodmorning, <span class="text-success font-weight-bold">{{ Auth::user()->name }}</span>!</p>
        <h3>Batch Records</h3>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#form">
            Add Batch
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        @foreach ($batches as $batch)
            <div class="col-md-4 mb-4">
                <a href="{{ route('home.show', $batch->id) }}" class="card d-flex justify-content-center align-items-center">
                    <div class="content d-flex flex-column">
                        <h4 class="text-primary">{{ $batch->batch_name }}</h4>
                        <p class="batch-record">{{ $batch->yearFrom }} - {{ $batch->yearTo }}</p>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a Batch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('home.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="batchName">Batch Name</label>
                        <input type="text" name="batchName" class="form-control" id="batchName" placeholder="Enter batch name">
                    </div>
                    <div class="form-group mt-3">
                        <label for="yearFrom">Year From</label>
                        <input type="text" name="yearFrom" id="yearpicker" class="form-control" placeholder="Select Year">
                    </div>
                    <div class="form-group mt-3">
                        <label for="yearTo">Year To</label>
                        <input type="text" name="yearTo" id="yearpicker" class="form-control" placeholder="Select Year">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- <footer>
    &copy; 2025 ROTC Class Record. All rights reserved.
</footer> --}}
@endsection
