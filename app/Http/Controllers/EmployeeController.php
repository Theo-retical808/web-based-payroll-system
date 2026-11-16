<?php

namespace App\Http\Controllers;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = require resource_path('data/employees.php');
        return view('employees.index', compact('employees'));
    }

    public function show($id)
    {
        $data = require resource_path('data/attendance.php');
        $employees = require resource_path('data/employees.php');
        $employee = collect($employees)->firstWhere('employee_id', $id);
        abort_if(!$employee, 404);
        $attendance = array_values(array_filter($data['records'], fn ($r) => $r['employee_id'] === $id));
        $payrollData = require resource_path('data/payroll.php');
        $payrollHistory = [];
        foreach ($payrollData['periods'] as $period) {
            foreach ($period['records'] as $record) if ($record['employee_id'] === $id) $payrollHistory[] = array_merge($record, ['period_label' => $period['period_label']]);
        }
        $attendanceStats = ['Present' => 0, 'Absent' => 0, 'Late' => 0];
        foreach ($attendance as $record) if (isset($attendanceStats[$record['status']])) $attendanceStats[$record['status']]++;
        return view('employees.show', compact('employee', 'attendance', 'attendanceStats', 'payrollHistory'));
    }
}
