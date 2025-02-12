@extends('admin.pages.app')

@section('title', 'Admin Dashboard')
@section('content')

<style>
     @media print {
            body * {
                visibility: hidden; /* Hide everything by default */
            }
            #printTable, th, #printTable * {
                visibility: visible; /* Show only the table */
            }
            #printTable {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }

            thead {
                display: table-header-group !important; /* Ensures table headers are printed */
            }
        }
        
</style>

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
                <form class="d-flex w-100" action="{{ route('search', $batchName->id) }}" method="POST">
                    @csrf
                    <input type="text" name="search" class="form-control" value="{{ isset($search) ? $search : '' }}" placeholder="Search by Student's Last Name" aria-label="Student's name">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i> Search</button>
                    </div>
                    <a class="btn btn-danger ml-2 text-light" href="{{ route('home.show', $batchName->id) }}"><i class="bi bi-x-circle"></i> Clear</a>
                </form>
            </div>

            <div class="col-xl-4 col-lg-4 col-sm-4 col-12 text-right">
                <a href="{{ route('print', $batchName->id) }}" type="button" class="btn btn-danger">Print Data</a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form1">Update Exam Limit</button>
                <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#form">Add Student</button>
            </div>
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
                        <th colspan="15">Attendance (A1 - A15)</th>
                        <th>Prelim</th>
                        <th>Midterm</th>
                        <th>Final</th>
                        <th>Merit</th>
                        <th>Final Grade</th>
                        <th>Status</th>
                        <th>Action</th>
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
                            @php
                                $zeroCount = 0;
                            @endphp
                            @for ($i = 1; $i <= 15; $i++)
                                {{-- @php
                                    if($attendances["A$i"] == 0) {
                                        $zeroCount++;
                                    }
                                @endphp --}}
                                <td id="attendance" class="attendance-cell" contenteditable="true" data-column="A{{ $i }}">{{ $attendances["A$i"] }}</td>
                            @endfor
                            <td class="attendance-cell grade" contenteditable="true" data-column="prelim">{{ $attendances->prelim }}</td>
                            <td class="attendance-cell grade" contenteditable="true" data-column="midterm">{{ $attendances->midterm }}</td>
                            <td class="attendance-cell grade" contenteditable="true" data-column="final">{{ $attendances->final }}</td>
                            <td class="attendance-cell grade" contenteditable="true" data-column="merit">{{ $attendances->merit }}</td>
                            <td class="final-grade">{{ $attendances->final_grade }}</td>
                            <td>
                               {{-- @if ()
                                   
                               @endif($attendances->final_grade >= 75)
                                    <div class="text-success font-weight-bold">Passed</div>
                                @else
                                    <div class="text-danger font-weight-bold">Failed</div>
                                @endif --}}
                            </td>
                            <td class="d-flex text-center">
                                <div class="h5 w-50 editStudent"><a data-toggle="modal" data-target="#form3"><i class="bi bi-pencil-square"></i></a></div>
                                
                                <div class="h5 w-50 deleteStudent"><a class="text-danger" data-toggle="modal" data-target="#form4"><i class="bi bi-trash"></i></a></div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr><td colspan="26" class="text-center">No record found</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    

    <!-- Add Student Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
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
                            <input type="text" name="firstname" class="form-control" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Middle Name</label>
                            <input type="text" name="middlename" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" name="lastname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Course</label>
                            <input type="text" name="course" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Update Exam Limit Modal -->
    <div class="modal fade" id="form1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
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
                            <label for="prelim">Prelim</label>
                            <input type="text" name="prelim" class="form-control" value="{{ $batchName->maxPrelimValue }}" required>
                        </div>
                        <div class="form-group">
                            <label for="midterm">Midterm</label>
                            <input type="text" name="midterm" class="form-control" value="{{ $batchName->maxMidtermValue }}" required>
                        </div>
                        <div class="form-group">
                            <label for="final">Final</label>
                            <input type="text" name="final" class="form-control" value="{{ $batchName->maxFinalValue }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Student Modal -->
    <div class="modal fade" id="form3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="editStudentForm" action="" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" name="firstname" class="form-control firstname" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Middle Name</label>
                            <input type="text" name="middlename" class="form-control middlename">
                        </div>
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" name="lastname" class="form-control lastname" required>
                        </div>
                        <div class="form-group">
                            <label for="name">Course</label>
                            <input type="text" name="course" class="form-control course" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Student Modal -->
    <div class="modal fade" id="form4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation for deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="deleteForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <p><strong class="deleteFirstname"></strong></p>
                            {{-- <input type="hidden" name="firstname" class="form-control firstname" placeholder="" required> --}}
                        </div>
                        <div class="form-group">
                            <label for="name">Middle Name</label>
                            <p><strong class="deleteMiddlename"></strong></p>
                            {{-- <input type="hidden" name="middlename" class="form-control middlename"> --}}
                        </div>
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <p><strong class="deleteLastname"></strong></p>
                            {{-- <input type="hidden" name="lastname" class="form-control lastname" required> --}}
                        </div>
                        <div class="form-group">
                            <label for="name">Course</label>
                            <p><strong class="deleteCourse"></strong></p>
                            {{-- <input type="hidden" name="course" class="form-control course" required> --}}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="submit" class="btn btn-primary">Cancel</button>
                    </div>
                </form>
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
    document.addEventListener('DOMContentLoaded', function () {
        const attendanceCells = document.querySelectorAll('#attendance');

        attendanceCells.forEach(cell => {
            cell.addEventListener('blur', function () {
                let value = this.textContent.trim();
                if (value !== '0' && value !== '1' && value !== '2') {
                    alert('Attendance values must be 0, 1, or 2.');
                    this.textContent = '';
                } else {
                    this.textContent = value;
                }
                updateStatus(this.closest('tr'));
            });
        });

        const finalGrade = document.querySelectorAll('.final-grade');

        finalGrade.forEach(finalGrades => {
            const value = parseFloat(finalGrades.textContent.trim()) || 0;
            if (value < 75) {
                finalGrades.classList.add('badge-danger');
            } else {
                finalGrades.classList.add('badge-success');
            }
        });

        function updateStatus(row) {
            const attendanceCells =  row.querySelectorAll('.attendance-cell[data-column^="A"]');
            const statusCell = row.querySelector('td:nth-last-child(2)');
            let zeroCount = 0;

            attendanceCells.forEach(cell => {
                const value = cell.textContent.trim();
                if(value === '0') {
                    zeroCount++;
                }
            });

            const finalGrade = parseFloat(row.querySelector('.final-grade')?.textContent.trim()) || 0;
            statusCell.innerHTML = '';

            if(zeroCount >= 4) {
                statusCell.innerHTML = '<div class="text-danger font-weight-bold">Dropped</div>';
            } else if (finalGrade >= 75) {
                statusCell.innerHTML = '<div class="text-success font-weight-bold">Passed</div>';
            } else {
                statusCell.innerHTML = '<div class="text-danger font-weight-bold">Failed</div>';
            }
        }

        document.querySelectorAll('tr[data-student-id]').forEach(updateStatus);

    });
</script>

<script>
    let editStudent = document.querySelectorAll('.editStudent');
    let deleteStudent = document.querySelectorAll('.deleteStudent');

    editStudent.forEach(element => {
        element.addEventListener('click', () => {
           const userID = element.closest('tr').getAttribute('data-student-id');
           const batchID = element.closest('tr').querySelector('.batchID').value;
        
            let editStudentForm = document.querySelector('.editStudentForm');
            let postURL = "{{ route('editStudent', ['id' => ':id' , 'batch' => ':batch']) }}";
            let finalURL = postURL.replace(':id', userID).replace(':batch', batchID);
            editStudentForm.setAttribute('action', finalURL);

            // console.log(finalURL)

           let URL = `/home/student/${userID}/${batchID}`;
            fetch(URL)
            .then(response => response.json())
            .then(data => {
                
                if(!data.data) {
                    console.log('No data')
                    return;
                }

                document.querySelector('.firstname').setAttribute('value', data.data.first_name);
                if(data.data.middle_name == null) {
                    document.querySelector('.middlename').setAttribute('value', '');
                } else {
                    document.querySelector('.middlename').setAttribute('value', data.data.middle_name);
                }
                
                document.querySelector('.lastname').setAttribute('value', data.data.last_name);
                document.querySelector('.course').setAttribute('value', data.data.course);

                document.querySelector('.deleteFirstname').innerHTML = data.data.first_name;
                document.querySelector('.deleteMiddlename').innerHTML = data.data.middle_name;
                document.querySelector('.deleteLastname').innerHTML = data.data.last_name;
                document.querySelector('.deleteCourse').innerHTML = data.data.course;

                // console.log(data.data.first_name)
            })
            .catch(error => console.error(error))
        });
    });


    deleteStudent.forEach(element => {
        element.addEventListener('click', () => {
            const userID = element.closest('tr').getAttribute('data-student-id');
            const batchID = element.closest('tr').querySelector('.batchID').value;

            let deleteForm = document.querySelector('.deleteForm');
            let url = "{{ route('addStudents.destroy', ':id') }}";
            let finalURL = url.replace(':id', userID);
            deleteForm.setAttribute('action', finalURL);

            let URL = `/home/student/${userID}/${batchID}`;
            fetch(URL)
            .then(response => response.json())
            .then(data => {
                
                if(!data.data) {
                    console.log('No data')
                    return;
                }

                document.querySelector('.deleteFirstname').innerText = data.data.first_name;
                document.querySelector('.deleteMiddlename').innerText = data.data.middle_name;
                document.querySelector('.deleteLastname').innerText = data.data.last_name;
                document.querySelector('.deleteCourse').innerText = data.data.course;

                // console.log(data.data.first_name)
            })
            .catch(error => console.error(error))
        });
    })
</script>
@endsection
