@extends('layouts.admin')

@push('title')
    Student Attendance
@endpush

@section('content')
    <main class="page-content">

        @push('breadcumb')
            Student Attendance
        @endpush
        @include('components.admin.breadcumb')

        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <h5>Monthly Attendance Report</h5>
                    </div>

                    <div class="card-body">


                        <form method="GET" class="row g-3 mb-4">
                            <div class="col-md-4">
                                <select name="student_id" class="form-select">
                                    <option value="">All Students</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}" @selected(request('student_id') == $student->id)>
                                            {{ $student->full_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <select name="batch_id" class="form-select">
                                    <option value="">All Batches</option>
                                    @foreach ($batches as $batch)
                                        <option value="{{ $batch->id }}" @selected(request('batch_id') == $batch->id)>
                                            {{ $batch->batch_code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <button class="btn btn-primary w-100">
                                    Filter
                                </button>
                            </div>
                        </form>
                        <div class="mb-3 text-end">
                            <a href="{{ route('admin.student-attendance.batch-report.excel', request()->all()) }}"
                                class="btn btn-success btn-sm">
                                Export Excel
                            </a>

                            <a href="{{ route('admin.student-attendance.batch-report.pdf', request()->all()) }}"
                                class="btn btn-danger btn-sm">
                                Export PDF
                            </a>
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Month</th>
                                        <th>Student</th>
                                        <th>Batch</th>
                                        <th>Present</th>
                                        <th>Absent</th>
                                        <th>Late</th>
                                        <th>Excused</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($monthlySummary as $row)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($row->month . '-01')->format('F Y') }}</td>
                                            <td>{{ $row->student?->full_name ?? 'N/A' }}</td>
                                            <td>{{ $row->batch?->batch_code ?? 'N/A' }}</td>
                                            <td class="text-success fw-bold">{{ $row->present }}</td>
                                            <td class="text-danger fw-bold">{{ $row->absent }}</td>
                                            <td class="text-warning fw-bold">{{ $row->late }}</td>
                                            <td>{{ $row->excused }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">
                                                No records found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


            </div>
        </div>

    </main>
@endsection
