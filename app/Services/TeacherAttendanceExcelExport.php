<?php

namespace App\Services;

use App\Models\Attendance\TeacherAttendance;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TeacherAttendanceExcelExport
{
    public static function export($request)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header row
        $sheet->setCellValue('A1', 'Teacher');
        $sheet->setCellValue('B1', 'Batch');
        $sheet->setCellValue('C1', 'Subject');
        $sheet->setCellValue('D1', 'Date');
        $sheet->setCellValue('E1', 'Status');

        // Query with filters
        $query = TeacherAttendance::with(['teacher', 'batch', 'subject']);

        if ($request->teacher_id) {
            $query->where('teacher_id', $request->teacher_id);
        }

        if ($request->batch_id) {
            $query->where('batch_id', $request->batch_id);
        }

        if ($request->from_date && $request->to_date) {
            $query->whereBetween('date', [
                $request->from_date,
                $request->to_date
            ]);
        }

        $attendances = $query->orderBy('attendance_date')->get();


        // Fill rows
        $row = 2;
        foreach ($attendances as $attendance) {
            $sheet->setCellValue("A{$row}", $attendance->teacher->full_name ?? '-');
            $sheet->setCellValue("B{$row}", $attendance->batch->batch_code ?? '-');
            $sheet->setCellValue("C{$row}", $attendance->subject->subject_name ?? '-');
            $sheet->setCellValue("D{$row}", $attendance->attendance_date);
            $sheet->setCellValue("E{$row}", ucfirst($attendance->status));
            $row++;
        }

        // Auto size columns
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Download
        $fileName = 'teacher_attendance_' . now()->format('Ymd_His') . '.xlsx';

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"{$fileName}\"");
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
