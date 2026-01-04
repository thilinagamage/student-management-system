@extends('layouts.admin')

@push('title')
    Edit Student Attendance
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Edit Student Attendance
        @endpush
        @include('components.admin.breadcumb')

        <div class="row justify-content-center">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            Batch: {{ $batch->batch_code }} |
                            Date: {{ \Carbon\Carbon::parse($date)->format('d M Y') }}
                        </h5>
                    </div>

                    <form method="POST" action="{{ route('admin.student-attendance.update', [$batch->id, $date]) }}">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <table class="table table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Student</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($attendances as $index => $attendance)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>

                                            <td>
                                                <strong>{{ $attendance->student->full_name }}</strong>
                                            </td>

                                            <td>
                                                <select name="attendance[{{ $attendance->id }}][status]"
                                                    class="form-select form-select-sm" required>
                                                    @foreach (['present', 'absent', 'late', 'excused', 'cancelled'] as $status)
                                                        <option value="{{ $status }}"
                                                            {{ $attendance->status === $status ? 'selected' : '' }}>
                                                            {{ ucfirst($status) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>

                                            <td>
                                                <input type="text" name="attendance[{{ $attendance->id }}][remarks]"
                                                    value="{{ $attendance->remarks }}" class="form-control form-control-sm"
                                                    placeholder="Optional">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>

                        <div class="card-footer text-end">
                            <button class="btn btn-primary">
                                Update Attendance
                            </button>

                            <a href="{{ route('admin.student-attendance.index') }}" class="btn btn-outline-secondary">
                                Cancel
                            </a>
                        </div>

                    </form>
                </div>

            </div>
        </div>

    </main>
@endsection
