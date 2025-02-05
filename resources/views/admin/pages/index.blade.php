@extends('admin.pages.app')

@section('title', 'Admin Dashboard')
@section('content')



    <!-- Full-Page Table -->
    <div class="table-container mt-4">
        <h2>
            
            {{ $batchName->batch_name }}
            
            ROTC Students Grade Record</h2>
        {{-- <div class="text-right mb-3">
            <a href="#" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Student
            </a>
        </div> --}}

        <div id="alertContainer"></div>

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

        <div class="mb-3 row p-2">

                <div class="input-group w-100 col-xl-8 col-lg-8 col-sm-8 col-12">
                <form class="d-flex" action="{{ route('search', $batchName->id) }}" method="POST">
                    @csrf
                    <input type="text" name="search" class="form-control" value="{{ isset($search) ? $search : '' }}" placeholder="Student's Last name" aria-label="Student's name" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                    <button class="btn btn-outline-secondary mr-1" type="submit"><i class="bi bi-search"></i></button>
                    </div>
                    <a class="btn bg-danger" href="{{ route('home.show', $batchName->id) }}"><i class="text-light bi bi-x-circle"></i></a>
                </form>
                </div>

            {{-- <div class="col-6 col-sm-0 col-md-0"></div> --}}

            <div class="d-flex flex-direction-row w-100 justify-content-center col-xl-4 col-lg-4 col-sm-4 col-4 col-12">
                <div class=""></div>
                <div class="">
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form1">
                        Update Exam Limit
                    </button>  
                    <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#form">
                        Add Student
                    </button>  
                </div>
            </div>
        </div>
    
        <!-- Responsive Table Wrapper -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>A1</th>
                        <th>A2</th>
                        <th>A3</th>
                        <th>A4</th>
                        <th>A5</th>
                        <th>A6</th>
                        <th>A7</th>
                        <th>A8</th>
                        <th>A9</th>
                        <th>A10</th>
                        <th>A11</th>
                        <th>A12</th>
                        <th>A13</th>
                        <th>A14</th>
                        <th>A15</th>
                        <th>Prelim</th>
                        <th>Midterm</th>
                        <th>Final</th>
                        <th>Merit</th>
                        <th>Final Grade</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @if($attendance->isNotEmpty())
                        @foreach ($attendance as $attendances)
                        <tr data-student-id={{ $attendances->student_id }}>
                            <td>{{ $attendances->student_id }}</td>
                            <td>{{ $attendances->student->last_name }}</td>
                            <td>{{ $attendances->student->first_name }}</td>
                            <td>{{ $attendances->student->middle_name }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A1">{{ $attendances->A1 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A2">{{ $attendances->A2 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A3">{{ $attendances->A3 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A4">{{ $attendances->A4 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A5">{{ $attendances->A5 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A6">{{ $attendances->A6 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A7">{{ $attendances->A7 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A8">{{ $attendances->A8 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A9">{{ $attendances->A9 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A10">{{ $attendances->A10 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A11">{{ $attendances->A11 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A12">{{ $attendances->A12 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A13">{{ $attendances->A13 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A14">{{ $attendances->A14 }}</td>
                            <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A15">{{ $attendances->A15 }}</td>
                            <td class="attendance-cell grade" contenteditable="true" data-column="prelim">{{ $attendances->prelim }}</td>
                            <td class="attendance-cell grade" contenteditable="true" data-column="midterm">{{ $attendances->midterm }}</td>
                            <td class="attendance-cell grade" contenteditable="true" data-column="final">{{ $attendances->final }}</td>
                            <td class="attendance-cell grade" contenteditable="true" data-column="merit">{{ $attendances->merit }}</td>
                            <td class="final-grade">{{ $attendances->final_grade }}</td>
                            <td>
                                @if($attendances->final_grade >= 75)
                                    <div class="text-success">Passed</div>
                                @elseif ($attendances->final_grade <= 74)
                                    <div class="text-danger">Failed</div>
                                @endif
                            </td>
                        </tr>
                        @endforeach   
                        @else
                        <div class="w-100">No record found</td>
                        @endif     
                </tbody>
                
            </table>
        </div>
    </div>

    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header border-bottom-0">
              <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('addStudents.update', $batchId) }}" method="POST">
                @csrf
                @method('PATCH')
              <div class="modal-body">
                <div class="form-group">
                  <label for="name">First Name</label>
                  <input type="name" name="firstname" class="form-control" id="password1" placeholder="" required>
                </div>
                <div class="form-group">
                    <label for="name">Middle Name</label>
                    <input type="name" name="middlename" class="form-control" placeholder="">
                  </div>
                  <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="name" name="lastname" class="form-control" placeholder="" required>
                  </div>
                  <div class="form-group">
                    <label for="name">Course</label>
                    <input type="name" name="course" class="form-control" placeholder="" required>
                  </div>
              </div>
              <div class="modal-footer border-top-0 d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Add</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal fade" id="form1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header border-bottom-0">
              <h5 class="modal-title" id="exampleModalLabel">Edit Exam Limit</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('home.update', $batchId) }}" method="POST">
                @csrf
                @method('PATCH')
              <div class="modal-body">
                <div class="form-group">
                  <label for="name">Prelim</label>
                  <input type="name" name="prelim" class="form-control" value="{{ $batchName->maxPrelimValue }}" placeholder="" required>
                </div>

                <div class="form-group">
                    <label for="name">Midterm</label>
                    <input type="name" name="midterm" value="{{ $batchName->maxMidtermValue }}" class="form-control" placeholder="" required>
                  </div>

                  <div class="form-group">
                    <label for="name">Final</label>
                    <input type="name" name="final" value="{{ $batchName->maxFinalValue }}" class="form-control" placeholder="" required>
                  </div>
                
                  
              </div>
              <div class="modal-footer border-top-0 d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Edit</button>
              </div>
            </form>
          </div>
        </div>
      </div>

    
</div>

<!-- Custom CSS -->
<style>



    .table-container {
    padding: 15px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    border-radius: 8px;
}

/* Ensure the table scrolls horizontally on smaller screens */
.table-responsive {
    overflow-x: auto;
}

/* Center-align table content */
table th, table td {
    vertical-align: middle;
    text-align: center;
    white-space: nowrap; /* Prevent content wrapping */
}

/* Focus style for editable cells */
[contenteditable="true"]:focus {
    outline: 2px solid #007bff;
    background-color: #eaf4ff;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .table-container h2 {
        font-size: 1.2rem;
    }

    .btn-primary {
        font-size: 0.9rem;
        padding: 6px 10px;
    }

    table th, table td {
        font-size: 0.85rem;
        padding: 6px;
    }
}

</style>

<!-- JavaScript for Validation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const attendanceCells = document.querySelectorAll('#attendance');

        attendanceCells.forEach(cell => {
            // Trim whitespace on blur and validate value
            cell.addEventListener('blur', function () {
                let value = this.textContent.trim();

                // Check if the value is between 0, 1, or 2
                if (value !== '0' && value !== '1' && value !== '2') {
                    alert('Attendance values must be 0, 1, or 2.');
                    this.textContent = ''; // Reset to 0 if invalid
                } else {
                    this.textContent = value; // Set the trimmed valid value
                }
            });
        });

        // const grade = document.querySelectorAll('.grade');

        // grade.forEach(cell => {
        //     // Trim whitespace on blur and validate value
        //     cell.addEventListener('blur', function () {
        //         let values = this.textContent.trim();

        //         if(values === '' || values === null) {
        //             this.textContent = ''; // Reset if invalid
        //             return;
        //         }

        //         value = parseInt(values); // Convert to number

        //         // Check if the value is between 0, 1, or 2
        //          if (value < 0 || value > 100) {
        //             alert('Grade values must be between 0 and 100.');
        //             this.textContent = ''; // Reset to 0 if invalid
        //         } else {
        //             this.textContent = value; // Set the trimmed valid value
        //         }
        //     });
        // });

        const finalGrade = document.querySelectorAll('.final-grade');

        finalGrade.forEach(finalGrades => {
            const value = finalGrades.textContent;

            console.log(value);

            if(value < 75) {
                finalGrades.classList.add('badge-absent');
            } else {
                finalGrades.classList.add('badge-present');
            }
        });

    });
</script>


@endsection
