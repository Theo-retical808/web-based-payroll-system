<?php

$employeeRecords = require resource_path('data/employees.php');
$employees = array_column($employeeRecords, 'employee_id');

$records = [];
$today = new DateTime('today');
$startDate = (clone $today)->modify('-29 days');

$statusOptions = ['Present', 'Present', 'Present', 'Present', 'Present',
                  'Present', 'Late', 'Late', 'Absent', 'Half-Day'];
$methodOptions = ['QR', 'QR', 'QR', 'Manual'];

srand(42); // Fixed seed for reproducible data

for ($day = 0; $day < 30; $day++) {
    $date = clone $startDate;
    $date->modify("+{$day} days");
    $workDate = $date->format('Y-m-d');

    foreach ($employees as $empId) {
        // Keep today's dashboard cards useful and predictable for a live demo.
        if ($day === 29 && in_array($empId, ['EMP-0010', 'EMP-0015'], true)) {
            continue; // Inactive employees are not scheduled today.
        }

        if ($day === 29) {
            $todayStatuses = [
                'EMP-0001' => 'Present', 'EMP-0002' => 'Late', 'EMP-0003' => 'Present',
                'EMP-0004' => 'Present', 'EMP-0005' => 'Absent', 'EMP-0006' => 'Present',
                'EMP-0007' => 'Late', 'EMP-0008' => 'Half-Day', 'EMP-0009' => 'Present',
                'EMP-0011' => 'Present', 'EMP-0012' => 'Present', 'EMP-0013' => 'Present',
                'EMP-0014' => 'Present',
            ];
            $status = $todayStatuses[$empId] ?? 'Present';
            $method = in_array($empId, ['EMP-0004', 'EMP-0012'], true) ? 'Manual' : 'QR';
        } else {
        $statusIndex = array_rand($statusOptions);
        $status = $statusOptions[$statusIndex];
        $method = $methodOptions[array_rand($methodOptions)];
        }

        if ($status === 'Absent') {
            $timeIn = null;
            $timeOut = null;
        } elseif ($status === 'Late') {
            $minutesLate = $day === 29 ? ($empId === 'EMP-0002' ? 18 : 34) : rand(10, 45);
            $timeIn = sprintf('08:%02d:00', $minutesLate);
            $timeOut = '17:00:00';
        } elseif ($status === 'Half-Day') {
            $timeIn = '08:00:00';
            $timeOut = '12:00:00';
        } else {
            $timeIn = $day === 29 ? '08:00:00' : (rand(0, 1) ? '07:58:00' : '08:00:00');
            $timeOut = ($day === 29 && $empId === 'EMP-0004') ? null : ($day === 29 ? '17:00:00' : (rand(0, 1) ? '17:00:00' : '17:05:00'));
        }

        $records[] = [
            'employee_id' => $empId,
            'work_date'   => $workDate,
            'time_in'     => $timeIn,
            'time_out'    => $timeOut,
            'status'      => $status,
            'method'      => $method,
        ];
    }
}

$adjustments = [
    [
        'id'                  => 1,
        'employee_id'         => 'EMP-0003',
        'date_requested'      => date('Y-m-d', strtotime('-6 days')),
        'work_date'           => date('Y-m-d', strtotime('-11 days')),
        'original_time_in'    => '09:15:00',
        'original_time_out'   => '17:00:00',
        'requested_time_in'   => '08:00:00',
        'requested_time_out'  => '17:00:00',
        'reason'              => 'Forgot to scan on entry, confirmed by supervisor.',
        'status'              => 'Pending',
        'approved_by'         => null,
    ],
    [
        'id'                  => 2,
        'employee_id'         => 'EMP-0001',
        'date_requested'      => date('Y-m-d', strtotime('-5 days')),
        'work_date'           => date('Y-m-d', strtotime('-8 days')),
        'original_time_in'    => '08:00:00',
        'original_time_out'   => null,
        'requested_time_in'   => '08:00:00',
        'requested_time_out'  => '17:00:00',
        'reason'              => 'Time out was not recorded due to system issue.',
        'status'              => 'Approved',
        'approved_by'         => 'Jose Reyes',
    ],
    [
        'id'                  => 3,
        'employee_id'         => 'EMP-0005',
        'date_requested'      => date('Y-m-d', strtotime('-4 days')),
        'work_date'           => date('Y-m-d', strtotime('-7 days')),
        'original_time_in'    => '10:30:00',
        'original_time_out'   => '17:00:00',
        'requested_time_in'   => '08:00:00',
        'requested_time_out'  => '17:00:00',
        'reason'              => 'Was present on time, scanner was malfunctioning.',
        'status'              => 'Rejected',
        'approved_by'         => 'Jose Reyes',
    ],
    [
        'id'                  => 4,
        'employee_id'         => 'EMP-0007',
        'date_requested'      => date('Y-m-d', strtotime('-3 days')),
        'work_date'           => date('Y-m-d', strtotime('-6 days')),
        'original_time_in'    => null,
        'original_time_out'   => null,
        'requested_time_in'   => '08:00:00',
        'requested_time_out'  => '17:00:00',
        'reason'              => 'Absent record is incorrect; was present whole day.',
        'status'              => 'Pending',
        'approved_by'         => null,
    ],
    [
        'id'                  => 5,
        'employee_id'         => 'EMP-0002',
        'date_requested'      => date('Y-m-d', strtotime('-2 days')),
        'work_date'           => date('Y-m-d', strtotime('-4 days')),
        'original_time_in'    => '08:35:00',
        'original_time_out'   => '17:00:00',
        'requested_time_in'   => '08:00:00',
        'requested_time_out'  => '17:00:00',
        'reason'              => 'Was on time but entry scanner was offline.',
        'status'              => 'Approved',
        'approved_by'         => 'Ana Cruz',
    ],
    [
        'id'                  => 6,
        'employee_id'         => 'EMP-0004',
        'date_requested'      => date('Y-m-d', strtotime('-1 day')),
        'work_date'           => date('Y-m-d', strtotime('-2 days')),
        'original_time_in'    => '12:00:00',
        'original_time_out'   => '16:00:00',
        'requested_time_in'   => '08:00:00',
        'requested_time_out'  => '17:00:00',
        'reason'              => 'Full day attendance, QR token was lost.',
        'status'              => 'Rejected',
        'approved_by'         => 'Jose Reyes',
    ],
];

return [
    'records'     => $records,
    'adjustments' => $adjustments,
];
