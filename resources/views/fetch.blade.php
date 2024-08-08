<!DOCTYPE html>
<html>
<head>
    <title>Students</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .container {
            width: 80%;
            margin: auto;
        }
    </style>
</head>
<body>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

    <div class="container">
        <h1>Students</h1>
        <!-- Add Student Button -->
        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#addStudentModal">
            Add Student
        </button>

        <!-- Add Student Modal -->
        <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="student_name">Name</label>
                                <input type="text" id="student_name" name="student_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="class">Class</label>
                                <input type="text" id="class" name="class" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="admission_date">Admission Date</label>
                                <input type="date" id="admission_date" name="admission_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="yearly_fees">Yearly Fees</label>
                                <input type="number" id="yearly_fees" name="yearly_fees" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="class_teacher_id">Class Teacher</label>
                                <select id="class_teacher_id" name="class_teacher_id" class="form-control" required>
                                    @foreach($teachers as $teacher)
                                        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Add Student</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Students Table -->
        <table id="studentsTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>Admission Date</th>
                    <th>Yearly Fees</th>
                    <th>Class Teacher</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->class }}</td>
                        <td>{{ $student->admission_date }}</td>
                        <td>{{ $student->yearly_fees }}</td>
                        <td>{{ $student->teacher->name ?? 'None' }}</td>
                        <td>
                            <!-- Edit Student Button -->
                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editStudentModal{{ $student->id }}">
                                Edit
                            </button>

                            <!-- Edit Student Modal -->
                            <div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" aria-labelledby="editStudentModalLabel{{ $student->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editStudentModalLabel{{ $student->id }}">Edit Student</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('update', $student->id) }}" method="POST">
                                                @csrf
                                             
                                                <div class="form-group">
                                                    <label for="student_name">Name</label>
                                                    <input type="text" id="student_name" name="student_name" class="form-control" value="{{ $student->student_name }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="class">Class</label>
                                                    <input type="text" id="class" name="class" class="form-control" value="{{ $student->class }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="admission_date">Admission Date</label>
                                                    <input type="date" id="admission_date" name="admission_date" class="form-control" value="{{ $student->admission_date }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="yearly_fees">Yearly Fees</label>
                                                    <input type="number" id="yearly_fees" name="yearly_fees" class="form-control" value="{{ $student->yearly_fees }}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="class_teacher_id">Class Teacher</label>
                                                    <select id="class_teacher_id" name="class_teacher_id" class="form-control" required>
                                                        @foreach($teachers as $teacher)
                                                            <option value="{{ $teacher->id }}" {{ $teacher->id == $student->class_teacher_id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success">Update Student</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            
                            <!-- Delete Student Button -->
                            <form action="{{ route('destroy', $student->id) }}" method="get" style="display:inline;">
                                @csrf
                               
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <!-- {{ $students->links() }} -->
    </div>

    <script>
$(document).ready(function() {
    $('#studentsTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true
    });
});
</script>

</body>
</html>
