<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $attendance  = require resource_path('data/attendance.php');
        $employees   = require resource_path('data/employees.php');
        $payrollData = require resource_path('data/payroll.php');

        $records = $attendance['records'];
        $today   = date('Y-m-d');

        // --- Stat cards ---
        $totalActive = count(array_filter($employees, fn($e) => $e['employment_status'] === 'Active'));

        $todayRecords = array_filter($records, fn($r) => $r['work_date'] === $today);

        $presentToday = count(array_filter($todayRecords, fn($r) => in_array($r['status'], ['Present', 'Late', 'Half-Day'])));

        $absentToday = count(array_filter($todayRecords, fn($r) => $r['status'] === 'Absent'));

        $missingTimeout = count(array_filter($todayRecords, fn($r) => $r['time_in'] !== null && $r['time_out'] === null));

        $stats = [
            'total_active'    => $totalActive,
            'present_today'   => $presentToday,
            'absent_today'    => $absentToday,
            'missing_timeout' => $missingTimeout,
        ];

        // --- Recent attendance (last 5 by date desc, then merge employee name) ---
        $employeeMap = array_column($employees, null, 'employee_id');
        $recordsWithName = array_map(function ($r) use ($employeeMap) {
            $r['full_name'] = $employeeMap[$r['employee_id']]['full_name'] ?? $r['employee_id'];
            return $r;
        }, $records);

        // Sort by work_date desc, then time_in desc
        usort($recordsWithName, function ($a, $b) {
            $dateCompare = strcmp($b['work_date'], $a['work_date']);
            if ($dateCompare !== 0) return $dateCompare;
            return strcmp($b['time_in'] ?? '', $a['time_in'] ?? '');
        });

        $recentAttendance = array_slice($recordsWithName, 0, 5);

        // --- Payroll periods (up to 10) ---
        $payrollPeriods = array_slice($payrollData['periods'], 0, 10);

        // --- Chart: 7-day attendance trend ---
        $chartLabels = [];
        $presentCounts = [];
        $lateCounts    = [];
        $absentCounts  = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-{$i} days"));
            $dayRecords = array_filter($records, fn($r) => $r['work_date'] === $date);
            $chartLabels[]   = date('M j', strtotime($date));
            $presentCounts[] = count(array_filter($dayRecords, fn($r) => $r['status'] === 'Present'));
            $lateCounts[]    = count(array_filter($dayRecords, fn($r) => $r['status'] === 'Late'));
            $absentCounts[]  = count(array_filter($dayRecords, fn($r) => $r['status'] === 'Absent'));
        }

        $attendanceTrendDatasets = [
            ['label' => 'Present', 'data' => $presentCounts, 'backgroundColor' => '#0f766e'],
            ['label' => 'Late',    'data' => $lateCounts,    'backgroundColor' => '#0b1f33'],
            ['label' => 'Absent',  'data' => $absentCounts,  'backgroundColor' => '#b91c1c'],
        ];

        // --- Chart: Employment type doughnut ---
        $typeCounts = ['Full-Time' => 0, 'Part-Time' => 0, 'Contractual' => 0];
        foreach ($employees as $e) {
            if ($e['employment_status'] === 'Active' && isset($typeCounts[$e['employment_type']])) {
                $typeCounts[$e['employment_type']]++;
            }
        }
        $employmentTypeDataset = [
            'labels' => array_keys($typeCounts),
            'data'   => array_values($typeCounts),
            'backgroundColor' => ['#0b1f33', '#0f766e', '#5eead4'],
        ];

        return view('dashboard.index', compact(
            'stats',
            'recentAttendance',
            'payrollPeriods',
            'chartLabels',
            'attendanceTrendDatasets',
            'employmentTypeDataset'
        ));
    }
}
