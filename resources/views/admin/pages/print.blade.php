@extends('admin.pages.app')

@section('title', 'Admin Dashboard')
@section('content')

<style>
     @media print {
    body {
        background: none !important;
        -webkit-print-color-adjust: exact;
    }

    .table {
        width: 100% !important;
        border-collapse: collapse;
        margin: auto;
    }

    .final-grade.badge-danger {
        background-color: rgb(236, 115, 115) !important;
    }

    .final-grade.badge-success {
        background-color: rgb(151, 240, 185) !important;
    }

    .thead-dark th {
        background-color: black !important;
        color: white !important;
        font-weight: bold;
    }

    th, td {
        border: 1px solid black !important;
        padding: 10px !important;
        text-align: center !important;
    }

    strong {
        font-weight: bold !important;
    }

    @page {
        size: A4 landscape;
        margin: 15mm;
    }

    .no-print {
        display: none !important;
    }
}



        
</style>

<div class="row mb-3 p-2 align-items-center">
    <div class="input-group col-xl-8 col-lg-8 col-sm-8 col-12">
        {{-- <form class="d-flex w-100" action="{{ route('search', $batchName->id) }}" method="POST">
            @csrf
            <input type="text" name="search" class="form-control" value="{{ isset($search) ? $search : '' }}" placeholder="Search by Student's Last Name" aria-label="Student's name">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i> Search</button>
            </div>
            <a class="btn btn-danger ml-2 text-light" href="{{ route('home.show', $batchName->id) }}"><i class="bi bi-x-circle"></i> Clear</a>
        </form> --}}
    </div>

    <div class="col-xl-4 col-lg-4 col-sm-4 col-12 text-right no-print">
        <button type="button" class="btn btn-primary" onclick="history.back()">Go back</button>
        <button type="button" class="btn btn-danger" onclick="printTable()">Print</button>
        {{-- <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form1">Update Exam Limit</button>
        <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#form">Add Student</button> --}}
    </div>
</div>

    <!-- Full-Page Table -->
    <div class="table-container mt-4">
        <h2 class="mb-3 font-weight-bold text-primary">
            {{ $batchName->batch_name }} MDC ROTC E-CLASS RECORD
        </h2>

        <div id="alertContainer"></div>

        @if(session('success'))
            <div class="alert alert-success messageAlert" role="alert">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger messageAlert" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="row mb-3 p-2 align-items-center">
            <div class="input-group col-xl-8 col-lg-8 col-sm-8 col-12">
                {{-- <form class="d-flex w-100" action="{{ route('search', $batchName->id) }}" method="POST">
                    @csrf
                    <input type="text" name="search" class="form-control" value="{{ isset($search) ? $search : '' }}" placeholder="Search by Student's Last Name" aria-label="Student's name">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i> Search</button>
                    </div>
                    <a class="btn btn-danger ml-2 text-light" href="{{ route('home.show', $batchName->id) }}"><i class="bi bi-x-circle"></i> Clear</a>
                </form> --}}
            </div>

            {{-- <div class="col-xl-4 col-lg-4 col-sm-4 col-12 text-right">
                <button type="button" class="btn btn-danger" onclick="window.print()">Print</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form1">Update Exam Limit</button>
                <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#form">Add Student</button>
            </div> --}}
        </div>

        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table id="printTable" class="table table-bordered table-hover table-striped text-center" >
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        
                        <th>Final Grade</th>
                      
                    </tr>
                </thead>
                <tbody>
                    @if($attendance->isNotEmpty())
                        @foreach ($attendance as $attendances)
                        <tr data-student-id={{ $attendances->student_id }}>
                            <input class="batchID" type="hidden" value="{{ $attendances->batch_id }}">
                            <td>{{ $attendances->student_id }}</td>
                            <td>{{ $attendances->student->last_name }}</td>
                            <td>{{ $attendances->student->first_name }}</td>
                            <td>{{ $attendances->student->middle_name }}</td>
                            
                            <td class="final-grade">{{ $attendances->final_grade }}</td>
                            
                            
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="25" class="text-center">No record found</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

<script>
    const finalGrade = document.querySelectorAll('.final-grade');

finalGrade.forEach(finalGrades => {
    const value = parseFloat(finalGrades.textContent.trim()) || 0;
    if (value < 75) {
        finalGrades.classList.add('badge-danger');
    } else {
        finalGrades.classList.add('badge-success');
    }
});
</script>

<!-- Custom CSS -->
<style>
    .table-container {
        padding: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        background-color: #fff;
        border-radius: 8px;
    }

    table {
        font-size: 0.9rem;
    }

    [contenteditable="true"]:focus {
        outline: 2px solid #007bff;
        background-color: #eaf4ff;
    }

    .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .alert {
        margin-top: 10px;
    }
</style>


<script>
    function printTable() {
        window.print();
    }
</script>

@endsection
