---
layout: default
title: Modules and sample data
---

# Modules and sample data

## Dashboard

The dashboard shows active employee count, employees clocked in today, absences, and clock-ins without a time-out. Its charts summarize the last seven days and active employee types. The recent-attendance table uses the latest five records, and the payroll card lists the sample pay periods.

The attendance dataset is generated at request time for the 30 calendar days ending today. Today's examples include present, late, half-day, absent, QR, manual, and a missing time-out case. This keeps the dashboard illustrative after the calendar advances.

## Sample data files

| File | Contents |
| --- | --- |
| `resources/data/employees.php` | 15 employees across departments, employment types, statuses, and pay types |
| `resources/data/attendance.php` | Rolling 30-day attendance records and pending, approved, and rejected adjustments |
| `resources/data/payroll.php` | Three sample periods with records for all 15 employees and mixed period statuses |
| `resources/data/users.php` | Example accounts for each application role |
| `resources/data/audit_logs.php` | Sample employee, attendance, payroll, and settings events |

Each PHP file returns arrays. Controllers load the arrays and pass the resulting data to Blade views. Payroll period dates are calculated relative to the current month; attendance dates are relative to today.

## Exploring the interface

- Use the employee search, status, and department filters; more than one page of employees demonstrates pagination.
- Compare recent attendance statuses from the dashboard and open the attendance module for date and status filtering.
- Use payroll periods to compare Draft, Under Review, and Finalized states, then open employee records and payslips.
- Demo form submissions and status changes update the current page only. Reloading restores the sample data.

## Adding sample records

Add employee fields in `employees.php` using the existing record keys. Include the employee in generated attendance by relying on the employee array, and add payroll data in `payroll.php` so period records and totals stay aligned. If a new payroll category or employee type is added, update the relevant view options and dashboard chart aggregation too.
