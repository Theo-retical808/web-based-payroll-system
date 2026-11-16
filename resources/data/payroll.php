<?php

$periods = [
        [
            'id'            => 1,
            'period_label'  => 'May 1–15, 2025',
            'cutoff_start'  => '2025-05-01',
            'cutoff_end'    => '2025-05-15',
            'pay_date'      => '2025-05-20',
            'status'        => 'Finalized',
            'records'       => [
                ['employee_id'=>'EMP-0001','payroll_period_id'=>1,'position'=>'Cashier',       'pay_type'=>'Daily',   'days_worked'=>11,'basic_pay'=>7150.00,'allowances'=>500.00,'deductions'=>693.75,'gross_pay'=>7650.00,'net_pay'=>6956.25,'status'=>'Finalized'],
                ['employee_id'=>'EMP-0002','payroll_period_id'=>1,'position'=>'HR Officer',    'pay_type'=>'Monthly', 'days_worked'=>11,'basic_pay'=>12500.00,'allowances'=>1000.00,'deductions'=>1181.25,'gross_pay'=>13500.00,'net_pay'=>12318.75,'status'=>'Finalized'],
                ['employee_id'=>'EMP-0003','payroll_period_id'=>1,'position'=>'Accountant',    'pay_type'=>'Monthly', 'days_worked'=>11,'basic_pay'=>14000.00,'allowances'=>1000.00,'deductions'=>1356.25,'gross_pay'=>15000.00,'net_pay'=>13643.75,'status'=>'Finalized'],
                ['employee_id'=>'EMP-0004','payroll_period_id'=>1,'position'=>'Stock Clerk',   'pay_type'=>'Hourly',  'days_worked'=>11,'basic_pay'=>3960.00,'allowances'=>0.00,'deductions'=>247.50,'gross_pay'=>3960.00,'net_pay'=>3712.50,'status'=>'Finalized'],
                ['employee_id'=>'EMP-0005','payroll_period_id'=>1,'position'=>'Sales Associate','pay_type'=>'Daily',  'days_worked'=>11,'basic_pay'=>7480.00,'allowances'=>500.00,'deductions'=>743.75,'gross_pay'=>7980.00,'net_pay'=>7236.25,'status'=>'Finalized'],
                ['employee_id'=>'EMP-0006','payroll_period_id'=>1,'position'=>'Delivery Driver','pay_type'=>'Daily',  'days_worked'=>10,'basic_pay'=>7000.00,'allowances'=>0.00,'deductions'=>437.50,'gross_pay'=>7000.00,'net_pay'=>6562.50,'status'=>'Finalized'],
                ['employee_id'=>'EMP-0007','payroll_period_id'=>1,'position'=>'Payroll Clerk',  'pay_type'=>'Monthly','days_worked'=>11,'basic_pay'=>11000.00,'allowances'=>500.00,'deductions'=>968.75,'gross_pay'=>11500.00,'net_pay'=>10531.25,'status'=>'Finalized'],
                ['employee_id'=>'EMP-0008','payroll_period_id'=>1,'position'=>'Security Guard', 'pay_type'=>'Daily',  'days_worked'=>11,'basic_pay'=>6820.00,'allowances'=>0.00,'deductions'=>426.25,'gross_pay'=>6820.00,'net_pay'=>6393.75,'status'=>'Finalized'],
                ['employee_id'=>'EMP-0009','payroll_period_id'=>1,'position'=>'Receptionist',  'pay_type'=>'Hourly', 'days_worked'=>11,'basic_pay'=>4180.00,'allowances'=>0.00,'deductions'=>261.25,'gross_pay'=>4180.00,'net_pay'=>3918.75,'status'=>'Finalized'],
                ['employee_id'=>'EMP-0010','payroll_period_id'=>1,'position'=>'IT Support',    'pay_type'=>'Monthly','days_worked'=>0, 'basic_pay'=>0.00,'allowances'=>0.00,'deductions'=>0.00,'gross_pay'=>0.00,'net_pay'=>0.00,'status'=>'Finalized'],
            ],
        ],
        [
            'id'            => 2,
            'period_label'  => 'May 16–31, 2025',
            'cutoff_start'  => '2025-05-16',
            'cutoff_end'    => '2025-05-31',
            'pay_date'      => '2025-06-05',
            'status'        => 'Under Review',
            'records'       => [
                ['employee_id'=>'EMP-0001','payroll_period_id'=>2,'position'=>'Cashier',       'pay_type'=>'Daily',   'days_worked'=>12,'basic_pay'=>7800.00,'allowances'=>500.00,'deductions'=>768.75,'gross_pay'=>8300.00,'net_pay'=>7531.25,'status'=>'Under Review'],
                ['employee_id'=>'EMP-0002','payroll_period_id'=>2,'position'=>'HR Officer',    'pay_type'=>'Monthly', 'days_worked'=>12,'basic_pay'=>12500.00,'allowances'=>1000.00,'deductions'=>1181.25,'gross_pay'=>13500.00,'net_pay'=>12318.75,'status'=>'Under Review'],
                ['employee_id'=>'EMP-0003','payroll_period_id'=>2,'position'=>'Accountant',    'pay_type'=>'Monthly', 'days_worked'=>12,'basic_pay'=>14000.00,'allowances'=>1000.00,'deductions'=>1356.25,'gross_pay'=>15000.00,'net_pay'=>13643.75,'status'=>'Under Review'],
                ['employee_id'=>'EMP-0004','payroll_period_id'=>2,'position'=>'Stock Clerk',   'pay_type'=>'Hourly',  'days_worked'=>12,'basic_pay'=>4320.00,'allowances'=>0.00,'deductions'=>270.00,'gross_pay'=>4320.00,'net_pay'=>4050.00,'status'=>'Under Review'],
                ['employee_id'=>'EMP-0005','payroll_period_id'=>2,'position'=>'Sales Associate','pay_type'=>'Daily',  'days_worked'=>12,'basic_pay'=>8160.00,'allowances'=>500.00,'deductions'=>818.75,'gross_pay'=>8660.00,'net_pay'=>7841.25,'status'=>'Under Review'],
                ['employee_id'=>'EMP-0006','payroll_period_id'=>2,'position'=>'Delivery Driver','pay_type'=>'Daily',  'days_worked'=>11,'basic_pay'=>7700.00,'allowances'=>0.00,'deductions'=>481.25,'gross_pay'=>7700.00,'net_pay'=>7218.75,'status'=>'Under Review'],
                ['employee_id'=>'EMP-0007','payroll_period_id'=>2,'position'=>'Payroll Clerk',  'pay_type'=>'Monthly','days_worked'=>12,'basic_pay'=>11000.00,'allowances'=>500.00,'deductions'=>968.75,'gross_pay'=>11500.00,'net_pay'=>10531.25,'status'=>'Under Review'],
                ['employee_id'=>'EMP-0008','payroll_period_id'=>2,'position'=>'Security Guard', 'pay_type'=>'Daily',  'days_worked'=>12,'basic_pay'=>7440.00,'allowances'=>0.00,'deductions'=>465.00,'gross_pay'=>7440.00,'net_pay'=>6975.00,'status'=>'Under Review'],
                ['employee_id'=>'EMP-0009','payroll_period_id'=>2,'position'=>'Receptionist',  'pay_type'=>'Hourly', 'days_worked'=>12,'basic_pay'=>4560.00,'allowances'=>0.00,'deductions'=>285.00,'gross_pay'=>4560.00,'net_pay'=>4275.00,'status'=>'Under Review'],
                ['employee_id'=>'EMP-0010','payroll_period_id'=>2,'position'=>'IT Support',    'pay_type'=>'Monthly','days_worked'=>0, 'basic_pay'=>0.00,'allowances'=>0.00,'deductions'=>0.00,'gross_pay'=>0.00,'net_pay'=>0.00,'status'=>'Under Review'],
            ],
        ],
        [
            'id'            => 3,
            'period_label'  => 'June 1–15, 2025',
            'cutoff_start'  => '2025-06-01',
            'cutoff_end'    => '2025-06-15',
            'pay_date'      => '2025-06-20',
            'status'        => 'Draft',
            'records'       => [
                ['employee_id'=>'EMP-0001','payroll_period_id'=>3,'position'=>'Cashier',       'pay_type'=>'Daily',   'days_worked'=>10,'basic_pay'=>6500.00,'allowances'=>500.00,'deductions'=>625.00,'gross_pay'=>7000.00,'net_pay'=>6375.00,'status'=>'Draft'],
                ['employee_id'=>'EMP-0002','payroll_period_id'=>3,'position'=>'HR Officer',    'pay_type'=>'Monthly', 'days_worked'=>10,'basic_pay'=>12500.00,'allowances'=>1000.00,'deductions'=>1181.25,'gross_pay'=>13500.00,'net_pay'=>12318.75,'status'=>'Draft'],
                ['employee_id'=>'EMP-0003','payroll_period_id'=>3,'position'=>'Accountant',    'pay_type'=>'Monthly', 'days_worked'=>10,'basic_pay'=>14000.00,'allowances'=>1000.00,'deductions'=>1356.25,'gross_pay'=>15000.00,'net_pay'=>13643.75,'status'=>'Draft'],
                ['employee_id'=>'EMP-0004','payroll_period_id'=>3,'position'=>'Stock Clerk',   'pay_type'=>'Hourly',  'days_worked'=>10,'basic_pay'=>3600.00,'allowances'=>0.00,'deductions'=>225.00,'gross_pay'=>3600.00,'net_pay'=>3375.00,'status'=>'Draft'],
                ['employee_id'=>'EMP-0005','payroll_period_id'=>3,'position'=>'Sales Associate','pay_type'=>'Daily',  'days_worked'=>10,'basic_pay'=>6800.00,'allowances'=>500.00,'deductions'=>668.75,'gross_pay'=>7300.00,'net_pay'=>6631.25,'status'=>'Draft'],
                ['employee_id'=>'EMP-0006','payroll_period_id'=>3,'position'=>'Delivery Driver','pay_type'=>'Daily',  'days_worked'=>9, 'basic_pay'=>6300.00,'allowances'=>0.00,'deductions'=>393.75,'gross_pay'=>6300.00,'net_pay'=>5906.25,'status'=>'Draft'],
                ['employee_id'=>'EMP-0007','payroll_period_id'=>3,'position'=>'Payroll Clerk',  'pay_type'=>'Monthly','days_worked'=>10,'basic_pay'=>11000.00,'allowances'=>500.00,'deductions'=>968.75,'gross_pay'=>11500.00,'net_pay'=>10531.25,'status'=>'Draft'],
                ['employee_id'=>'EMP-0008','payroll_period_id'=>3,'position'=>'Security Guard', 'pay_type'=>'Daily',  'days_worked'=>10,'basic_pay'=>6200.00,'allowances'=>0.00,'deductions'=>387.50,'gross_pay'=>6200.00,'net_pay'=>5812.50,'status'=>'Draft'],
                ['employee_id'=>'EMP-0009','payroll_period_id'=>3,'position'=>'Receptionist',  'pay_type'=>'Hourly', 'days_worked'=>10,'basic_pay'=>3800.00,'allowances'=>0.00,'deductions'=>237.50,'gross_pay'=>3800.00,'net_pay'=>3562.50,'status'=>'Draft'],
                ['employee_id'=>'EMP-0010','payroll_period_id'=>3,'position'=>'IT Support',    'pay_type'=>'Monthly','days_worked'=>0, 'basic_pay'=>0.00,'allowances'=>0.00,'deductions'=>0.00,'gross_pay'=>0.00,'net_pay'=>0.00,'status'=>'Draft'],
            ],
        ],
];

$monthStart = new DateTimeImmutable('first day of this month');
$previousMonth = $monthStart->modify('-1 month');
$periodDates = [
    1 => [$previousMonth->modify('+15 days'), $previousMonth->modify('last day of this month'), $monthStart->modify('+4 days')],
    2 => [$monthStart, $monthStart->modify('+14 days'), $monthStart->modify('+19 days')],
    3 => [$monthStart->modify('+15 days'), $monthStart->modify('last day of this month'), $monthStart->modify('+1 month')->modify('+4 days')],
];
foreach ($periods as &$period) {
    [$cutoffStart, $cutoffEnd, $payDate] = $periodDates[$period['id']];
    $period['cutoff_start'] = $cutoffStart->format('Y-m-d');
    $period['cutoff_end'] = $cutoffEnd->format('Y-m-d');
    $period['pay_date'] = $payDate->format('Y-m-d');
    $period['period_label'] = $cutoffStart->format('F j').'–'.$cutoffEnd->format('j, Y');
}
unset($period);

// Give every added sample employee payroll history so period tables, totals,
// and payslip previews all use the same expanded roster.
$additionalEmployees = [
    'EMP-0011' => ['position' => 'Store Supervisor', 'pay_type' => 'Monthly', 'rate' => 32000, 'allowance' => 1000, 'active' => true],
    'EMP-0012' => ['position' => 'Accounting Assistant', 'pay_type' => 'Hourly', 'rate' => 125, 'allowance' => 300, 'active' => true],
    'EMP-0013' => ['position' => 'Warehouse Associate', 'pay_type' => 'Daily', 'rate' => 700, 'allowance' => 250, 'active' => true],
    'EMP-0014' => ['position' => 'Sales Lead', 'pay_type' => 'Monthly', 'rate' => 28000, 'allowance' => 750, 'active' => true],
    'EMP-0015' => ['position' => 'Delivery Driver', 'pay_type' => 'Daily', 'rate' => 750, 'allowance' => 0, 'active' => false],
];
$daysByPeriod = [1 => 11, 2 => 12, 3 => 10];

foreach ($periods as &$period) {
    foreach ($additionalEmployees as $employeeId => $employee) {
        $daysWorked = $employee['active'] ? $daysByPeriod[$period['id']] : 0;
        $basicPay = match ($employee['pay_type']) {
            'Monthly' => $employee['active'] ? $employee['rate'] / 2 : 0,
            'Hourly' => $employee['rate'] * 4 * $daysWorked,
            default => $employee['rate'] * $daysWorked,
        };
        $allowances = $employee['active'] ? $employee['allowance'] : 0;
        $grossPay = $basicPay + $allowances;
        $deductions = round($grossPay * 0.05, 2);

        $period['records'][] = [
            'employee_id' => $employeeId,
            'payroll_period_id' => $period['id'],
            'position' => $employee['position'],
            'pay_type' => $employee['pay_type'],
            'days_worked' => $daysWorked,
            'basic_pay' => round($basicPay, 2),
            'allowances' => round($allowances, 2),
            'deductions' => $deductions,
            'gross_pay' => round($grossPay, 2),
            'net_pay' => round($grossPay - $deductions, 2),
            'status' => $period['status'],
        ];
    }
}
unset($period);

return ['periods' => $periods];
