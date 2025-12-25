@extends('layouts.admin')

@section('content')
<main class="page-content">

@include('components.admin.breadcumb', ['title' => 'Batch Attendance Report'])

<div class="card">
    <div class="card-body">

        {{-- Filters --}}
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-4">
                <label class="form-label">Batch</label>
                <select name="batch_id" class="form-select">
                    <option value="">All Batches</option>
                    @foreach($batches as $batch)
                        <option value="{{ $batch->id }}"
                            @selected(request('batch_id') == $batch->id)>
                            {{ $batch->batch_code }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label">From Date</label>
                <input type="date" name="from_date" class="form-control"
                       value="{{ request('from_date') }}">
            </div>

            <div class="col-md-3">
                <label class="form-label">To Date</label>
                <input type="date" name="to_date" class="form-control"
                       value="{{ request('to_date') }}">
            </div>

            <div class="col-md-2 d-flex align-items-end">
                <button class="btn btn-primary w-100">
                    Filter
                </button>
            </div>
        </form>

        {{-- Table --}}
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Student</th>
                        <th>Batch</th>
                        <th>Present</th>
                        <th>Absent</th>
                        <th>Late</th>
                        <th>Excused</th>
                        <th>Total</th>
                        <th>Attendance %</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($records as $index => $row)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $row['student']->full_name }}</td>
                        <td>{{ $row['batch']->batch_code }}</td>
                        <td class="text-success fw-bold">{{ $row['present'] }}</td>
                        <td class="text-danger fw-bold">{{ $row['absent'] }}</td>
                        <td class="text-warning fw-bold">{{ $row['late'] }}</td>
                        <td>{{ $row['excused'] }}</td>
                        <td>{{ $row['total'] }}</td>
                        <td>
                            <span class="badge bg-primary">
                                {{ $row['percentage'] }}%
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-muted">
                            No attendance data found
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

</main>
@endsection
