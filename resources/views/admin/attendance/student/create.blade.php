@extends('layouts.admin')
@push('title')
    Add Student
@endpush
@section('content')

    <main class="page-content">
        @push('breadcumb')
            Add Student
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="mb-0">Add Student</h5>
                        <hr>

                        <form method="POST" action="{{ route('admin.attendance.student.store') }}">
                            @csrf

                            <input type="date" name="attendance_date" required>

                            @if (count($students) > 0)
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->full_name }}</td>
                                        <td>
                                            <select name="attendance[{{ $student->id }}]">
                                                <option value="present">Present</option>
                                                <option value="absent">Absent</option>
                                                <option value="late">Late</option>
                                                <option value="excused">Excused</option>
                                            </select>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2">No students found for this batch</td>
                                </tr>
                            @endif

                            <button type="submit">Save Attendance</button>
                        </form>



                    </div>
                </div>
            </div>
        </div>

    </main>

@endsection
