# Prototype Development Blueprint

## Web-Based Employee Records, Attendance, and Payroll Management System

**Target area:** Local businesses of Barangay Burgos-Padlan, San Carlos
City, Pangasinan\
**Prototype framework:** Laravel\
**Initial database:** SQLite\
**Deployment decision:** Pending (on-premises dedicated server or cloud
hosting)

------------------------------------------------------------------------

## 1. Project Overview

The proposed system is a centralized web-based workforce management
application for participating local businesses. It will consolidate
three core processes:

1.  **Employee Records Management** -- maintain employee profiles and
    employment information.
2.  **Attendance Management** -- record time-in and time-out through QR
    scanning, with manual Employee ID entry as a fallback.
3.  **Payroll Management** -- calculate employee compensation using
    validated attendance, configured pay rates, and applicable
    deductions.

The prototype should demonstrate the complete workflow from employee
registration to attendance recording and payroll preparation.

### Initial design principles

-   **Simple:** usable by small-business owners and authorized staff.
-   **Flexible:** supports different employee schedules, pay types, and
    payroll periods.
-   **Traceable:** important changes and attendance transactions are
    logged.
-   **Secure:** each business can access only its own records.
-   **Portable:** avoid deployment-specific assumptions so the
    application can later run on a local server or cloud infrastructure.

------------------------------------------------------------------------

## 2. Recommended Prototype Technology Stack

  ---------------------------------------------------------------------------
  Layer                   Recommended tool            Purpose
  ----------------------- --------------------------- -----------------------
  Backend framework       Laravel                     Routing, application
                                                      logic, validation,
                                                      authentication
                                                      integration

  Language                PHP                         Backend development

  Frontend                Blade                       Server-rendered
                                                      application views

  Interactive UI          Livewire                    Dynamic forms, tables,
                                                      and attendance
                                                      interactions without a
                                                      separate SPA

  CSS                     Tailwind CSS                Responsive interface
                                                      styling

  UI components           Flowbite or custom Blade    Reusable interface
                          components                  elements; choose one
                                                      approach and keep it
                                                      consistent

  Database                SQLite                      Initial relational
                                                      database stored as a
                                                      local file

  ORM                     Eloquent                    Database models and
                                                      relationships

  Schema management       Laravel migrations          Version-controlled
                                                      database structure

  Authentication          Laravel starter kit /       Login, logout, password
                          Laravel Breeze if           flows
                          compatible with the         
                          selected Laravel version    

  Authorization           Laravel policies, gates,    Role and permission
                          and middleware              checks

  QR generation           `endroid/qr-code` or a      Generate employee QR
                          Laravel-compatible QR       codes
                          package                     

  QR scanning             `html5-qrcode`              Scan QR codes through a
                                                      browser camera

  PDF output              `barryvdh/laravel-dompdf`   Payslips and printable
                                                      reports

  Charts                  Chart.js                    Dashboard summaries and
                                                      attendance charts

  Testing                 Pest or PHPUnit             Unit and feature tests

  Version control         Git + GitHub                Source control and
                                                      collaboration

  Local development       Laravel Herd, or PHP +      Run the application
                          Composer + Node.js          locally

  Database inspection     DB Browser for SQLite       Inspect SQLite data
                                                      during development
  ---------------------------------------------------------------------------

**Version note:** Select a currently supported Laravel release and
install packages compatible with that release. Check package maintenance
and compatibility before adding dependencies.

### Keep the prototype lean

For the first version, Blade + Livewire is sufficient. A separate
React/Vue frontend, microservices, Redis, Docker orchestration, and
cloud-specific services are not necessary unless a demonstrated
requirement emerges.

------------------------------------------------------------------------

## 3. High-Level Application Architecture

``` text
Users' browsers
      |
      v
Laravel web application
      |
      +-- Authentication and authorization
      |
      +-- Business management
      |
      +-- Employee records
      |
      +-- Attendance services
      |      +-- QR scan input
      |      +-- Manual Employee ID input
      |      +-- Attendance validation
      |      +-- Attendance logs
      |
      +-- Payroll services
      |      +-- Attendance review
      |      +-- Pay calculation
      |      +-- Deductions and adjustments
      |      +-- Payroll approval
      |
      +-- Reports and payslips
      |
      v
Eloquent ORM
      |
      v
SQLite database (prototype)
```

Keep business rules in service classes rather than placing all
computation inside controllers or Livewire components. This makes the
application easier to test and migrate to another database or hosting
environment.

### Suggested Laravel directory organization

``` text
app/
├── Enums/
│   ├── AttendanceMethod.php
│   ├── AttendanceStatus.php
│   ├── EmploymentStatus.php
│   └── PayrollStatus.php
├── Http/
│   ├── Controllers/
│   └── Middleware/
├── Livewire/
│   ├── Attendance/
│   ├── Employees/
│   └── Payroll/
├── Models/
│   ├── Business.php
│   ├── BusinessUser.php
│   ├── Employee.php
│   ├── Attendance.php
│   ├── AttendanceLog.php
│   ├── PayrollPeriod.php
│   └── PayrollRecord.php
├── Policies/
├── Services/
│   ├── AttendanceService.php
│   ├── PayrollService.php
│   └── PayslipService.php
└── Support/
```

The exact folder structure can evolve as the project grows. Avoid
creating abstractions that do not yet solve a real problem.

------------------------------------------------------------------------

## 4. User Roles and Access

The prototype should support multiple businesses in one application.
Each business's records must be isolated from other businesses.

  -----------------------------------------------------------------------
  Role                                Main permissions
  ----------------------------------- -----------------------------------
  System Administrator                Register and manage businesses,
                                      manage system-level settings

  Business Owner                      Manage their business, users,
                                      employees, attendance, and payroll

  HR / Manager                        Manage employee profiles and review
                                      attendance

  Payroll Officer                     Prepare payroll, apply authorized
                                      adjustments, generate payslips

  Employee                            View their own permitted profile,
                                      attendance history, and payslips
  -----------------------------------------------------------------------

For a small business, one person may hold more than one operational
role. The application should allow role assignment without requiring
every business to have separate HR and payroll staff.

### Multi-tenant rule

Every business-owned record should be associated with a `business_id`,
directly or through a carefully designed relationship. Authorization
must be enforced on the server side. Do not rely on hiding records in
the frontend.

With SQLite, application-level authorization and scoped Eloquent queries
are essential. If PostgreSQL is adopted later, PostgreSQL Row-Level
Security can provide an additional database-level isolation layer.

------------------------------------------------------------------------

## 5. Main Application Modules

### 5.1 Business Management

Functions: - Register a business. - Edit business details. - Configure
business address and contact information. - Assign business users and
roles. - Configure basic attendance and payroll settings.

Suggested business settings: - Business name and contact details. - Time
zone (use `Asia/Manila` for the target area). - Standard work hours and
workweek. - Payroll frequency and cutoff dates. - Attendance grace
period. - Default break rules. - Applicable payroll rule configuration.

### 5.2 Employee Records Management

Employee profile sections:

**Personal information** - Employee ID (human-readable identifier,
e.g. `EMP-0001`) - First, middle, and last name - Contact details -
Address - Emergency contact, if collected and justified

**Employment information** - Date hired - Position - Department, if
used - Employment type and status - Assigned work schedule - Pay type
(hourly, daily, or monthly, as supported by the prototype) - Pay rate
and effective date

**Optional statutory information** - SSS, PhilHealth, Pag-IBIG, and TIN
identifiers, only if genuinely needed and handled with appropriate
access restrictions.

Functions: - Create, view, update, and search employee records. - Assign
schedules and compensation. - Archive separated employees rather than
deleting historical records. - View employment and compensation history.

### 5.3 Attendance Management

Provide two ways to record attendance:

1.  QR code scanning.
2.  Manual Employee ID entry as a fallback.

Both methods must call the same backend attendance service so they use
identical validation and business rules.

#### QR code workflow

1.  Generate a unique, random QR token for each employee.
2.  Display or print the employee's QR code.
3.  Open the attendance terminal on a camera-enabled device.
4.  Scan the QR code.
5.  Resolve the token to an active employee belonging to that business.
6.  Check the employee's open attendance session.
7.  If there is no open session, record Time In.
8.  If there is an open session, record Time Out.
9.  Display the employee name, action, and recorded time.
10. Log the transaction and its recording method.

**Do not encode only the Employee ID in the QR code.** Use an
unpredictable token so changing a visible ID cannot generate another
employee's code. Treat the QR token as an identifier, not as proof that
the person holding it is the employee.

#### Manual fallback workflow

1.  An authorized operator opens the manual attendance option.
2.  The operator enters the employee's Employee ID.
3.  The system validates the employee and business association.
4.  The system checks the current attendance state.
5.  The system determines Time In or Time Out.
6.  The operator confirms the action.
7.  The system records the transaction as `manual` and logs the
    operator.

For the prototype, manual entry should be restricted to authenticated,
authorized staff. If employees will use the terminal themselves, add an
appropriate identity check rather than allowing anyone to enter another
person's ID.

#### Attendance state rules

  -----------------------------------------------------------------------
  Current state           New valid scan / entry  Result
  ----------------------- ----------------------- -----------------------
  No open attendance      First scan              Record Time In
  session                                         

  Open attendance session Next valid scan         Record Time Out

  Already timed out for   Another scan            Reject and show a clear
  the work session                                message

  Unknown QR token        Scan                    Reject

  Unknown Employee ID     Manual entry            Reject

  Employee belongs to     Scan or entry           Reject
  another business                                

  Duplicate request /     Repeated submission     Prevent duplicate
  rapid repeated scan                             transaction
  -----------------------------------------------------------------------

Add a short cooldown (for example, 5--10 seconds) for accidental
repeated scans, but do not rely on cooldown alone. Use server-side
duplicate-request protection and database transactions.

#### Attendance records and exceptions

The system should also support: - Late detection based on assigned
schedule and grace period. - Absence review. - Early departure review. -
Overtime review and approval. - Attendance correction requests. -
Authorized correction with reason and audit log. - Missing Time Out
review. - Daily and monthly attendance reports.

**Overnight shifts:** Do not assume every attendance session begins and
ends on the same calendar date. Associate a session with its assigned
work shift or schedule so a 10:00 PM Time In and 6:00 AM next-day Time
Out can belong to the same shift.

### 5.4 Payroll Management

Payroll should use validated attendance and the employee's compensation
terms that applied during the payroll period.

Core functions: - Create payroll periods and cutoff dates. - Review
attendance exceptions before processing. - Calculate basic pay according
to pay type. - Calculate approved overtime and applicable premiums. -
Apply configured deductions and adjustments. - Review payroll entries. -
Approve and finalize payroll. - Generate payslips and payroll
summaries. - Preserve historical payroll records.

#### Payroll workflow

``` text
Create payroll period
        |
        v
Review attendance records
        |
        v
Resolve missing / incorrect records
        |
        v
Load employee pay terms
        |
        v
Calculate earnings and premiums
        |
        v
Apply deductions and adjustments
        |
        v
Review payroll results
        |
        v
Approve and finalize
        |
        v
Generate payslips and reports
```

#### Payroll integrity

-   Store monetary values using fixed-precision decimal columns, not
    floating-point values.
-   Preserve a snapshot of the pay rate and relevant calculation inputs
    used for each payroll record.
-   Do not silently recalculate finalized payroll when an employee's
    current salary or old attendance record changes.
-   Lock finalized payroll records.
-   Make corrections through authorized adjustment or reversal records
    with reasons and audit history.
-   Keep employee deductions distinct from employer contributions.

#### Legal and policy caution

Philippine payroll rules can depend on employee classification, wage
orders, workday, rest days, holidays, overtime, night work, and other
circumstances. Do not hardcode a single universal formula or assume
every employee has the same entitlements.

Before using the prototype for real payroll, validate calculation rules
with authoritative current sources and a qualified payroll practitioner.
The prototype may initially use clearly labeled sample rates and
configurable rules for demonstration; it should not claim full legal
compliance until verified.

### 5.5 Dashboard and Reports

Possible dashboard indicators: - Total active employees. - Present,
absent, and late employees today. - Employees with missing Time Out. -
Pending attendance corrections. - Payroll period status. - Payroll
totals for a selected period.

Reports: - Employee masterlist. - Daily attendance. - Monthly attendance
summary. - Late and absence report. - Overtime report. - Payroll
summary. - Individual payslip. - Audit history for authorized
administrators.

------------------------------------------------------------------------

## 6. Initial Database Design

Use Laravel migrations to define the schema. The following is a planning
list; finalize columns, keys, constraints, and relationships in the ERD
before implementation.

  -----------------------------------------------------------------------
  Table                               Purpose / important fields
  ----------------------------------- -----------------------------------
  `businesses`                        Business name, contact information,
                                      address, settings

  `users`                             Login accounts

  `business_users`                    `business_id`, `user_id`, role

  `employees`                         `business_id`, Employee ID,
                                      personal and employment
                                      information, QR token, status

  `departments`                       Optional business departments

  `positions`                         Job positions

  `work_schedules`                    Work days, start/end times, break
                                      rules, effective dates

  `employee_schedules`                Employee-to-schedule assignment and
                                      effective dates

  `attendance`                        Employee, shift/work date, time-in,
                                      time-out, status

  `attendance_logs`                   Every attendance attempt, action,
                                      method, timestamp, result, operator

  `attendance_adjustments`            Requested/approved corrections,
                                      reason, approver

  `leave_requests`                    Leave dates, type, status, approver

  `payroll_periods`                   Business, cutoff start/end, pay
                                      date, status

  `payroll_records`                   Employee, period, pay snapshot,
                                      earnings, deductions, net pay,
                                      status

  `payroll_adjustments`               Authorized earning/deduction
                                      corrections and reason

  `deduction_types`                   Configurable deduction categories

  `employee_deductions`               Employee-specific recurring or
                                      one-time deductions

  `payslips`                          Generated document reference and
                                      payroll relationship

  `audit_logs`                        Important user actions and changes
  -----------------------------------------------------------------------

### Important relationships

``` text
Business
 ├── Business Users └── Users
 ├── Employees
 │    ├── Employee Schedules ── Work Schedules
 │    ├── Attendance ── Attendance Logs
 │    ├── Attendance Adjustments
 │    ├── Leave Requests
 │    ├── Employee Deductions ── Deduction Types
 │    └── Payroll Records
 │          ├── Payroll Periods
 │          ├── Payroll Adjustments
 │          └── Payslips
 ├── Departments
 └── Positions
```

Use foreign keys and indexes. Add unique constraints for identifiers
such as `(business_id, employee_id)` and, where appropriate, one payroll
record per employee per payroll period.

------------------------------------------------------------------------

## 7. SQLite Setup and Portability

SQLite is suitable for the initial prototype because it is simple to set
up and requires no separate database server.

Typical setup:

``` bash
# Create the Laravel project (choose a supported Laravel release)
composer create-project laravel/laravel employee-management

cd employee-management

# Create the SQLite database file
# Linux/macOS:
touch database/database.sqlite

# Windows PowerShell:
New-Item database/database.sqlite -ItemType File
```

Configure `.env`:

``` env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

Depending on the Laravel version and environment, the database path may
need to be an absolute path. Confirm the configuration in
`config/database.php`.

Run migrations:

``` bash
php artisan migrate
```

### SQLite considerations

-   SQLite is file-based and convenient for a prototype.
-   It supports relational tables, transactions, and foreign keys when
    configured correctly.
-   It has more limited write concurrency than a dedicated database
    server.
-   A single database file needs a deliberate backup strategy.
-   Do not put the SQLite file in a public web directory.
-   Avoid SQLite-only SQL if migration to PostgreSQL or MySQL is likely.
-   Test the schema and application against the intended production
    database before deployment.

**Deployment remains undecided.** Keep the application database access
behind Eloquent and migrations, and use environment configuration for
database selection. A future move to PostgreSQL or MySQL will still
require compatibility testing and possibly schema/query adjustments; it
is not guaranteed to be a one-click switch.

------------------------------------------------------------------------

## 8. QR Attendance Interface and Device Setup

### Attendance terminal screen

The attendance terminal should be a focused screen, separate from the
management dashboard.

Suggested layout: - Business name and terminal identity. - Camera
scanning area. - Camera permission / camera unavailable message. -
Employee identification result. - Large `TIME IN` or `TIME OUT`
confirmation. - Manual Employee ID fallback for authorized operators. -
Recent successful transaction indicator. - Clear error messages.

Employees should not need access to the business management dashboard
simply to record attendance.

### Browser camera requirements

-   Browser camera access normally requires HTTPS, except on localhost.
-   A local network deployment must be configured securely if phones or
    tablets access the terminal over the LAN.
-   Test on the actual phones, tablets, browsers, and cameras expected
    at participating businesses.
-   Provide manual fallback whenever camera permission, camera hardware,
    QR recognition, or network access fails.

### QR security and operational safeguards

-   Generate a random token per employee.
-   Do not expose personal information in the QR payload.
-   Allow authorized QR token regeneration if a code is lost or
    compromised.
-   Do not treat possession of a static QR code as strong identity
    verification.
-   Consider a staff-supervised terminal or an additional identity
    check.
-   Record method (`qr` or `manual`) and operator identity where
    applicable.
-   Protect against repeated submissions and concurrent scans.

------------------------------------------------------------------------

## 9. Security, Privacy, and Auditability

The application will process employee personal information and payroll
data. Design for privacy from the start.

Minimum safeguards: - Use Laravel's authentication and password handling
rather than implementing password storage yourself. - Apply server-side
authorization to every business-owned resource. - Restrict payroll and
statutory identifiers to authorized roles. - Validate and sanitize user
input. - Use CSRF protection for state-changing web forms. - Use HTTPS
in deployed environments. - Keep secrets in environment configuration,
not source control. - Store uploaded documents outside public access and
authorize downloads. - Log sensitive actions such as attendance
corrections, payroll approval, and changes to employee pay. - Back up
the database and test restoration. - Define data retention and account
deactivation procedures. - Collect only personal data required for a
documented purpose.

Consider the Philippine Data Privacy Act of 2012 (RA 10173) and seek
appropriate institutional or legal guidance for privacy notices, lawful
processing, retention, and data-subject rights.

------------------------------------------------------------------------

## 10. Prototype Scope: What to Build First

Keep the first prototype small enough to finish and demonstrate.

### Minimum viable prototype

**Must-have** 1. Login and logout. 2. Business registration / business
selection. 3. Role-based access. 4. Employee create, view, update,
search, and archive. 5. Employee QR token generation. 6. QR attendance
scanning. 7. Automatic Time In / Time Out state handling. 8. Manual
Employee ID fallback for authorized staff. 9. Attendance history and
basic correction workflow. 10. Payroll period creation. 11. Basic
configurable payroll computation using sample rules. 12. Payroll review
and finalization. 13. Basic payslip PDF. 14. Business-level data
isolation. 15. Basic audit logging.

**Later enhancements** - Employee self-service portal. - Leave
management. - Advanced dashboards and charts. - More detailed statutory
contribution and tax rules. - Multiple shift patterns and complex
overtime policies. - Automated notifications. - Cloud storage
integration. - Offline-first attendance synchronization. - Biometric
integration.

Do not promise all enhancements as completed prototype features. Clearly
distinguish implemented features from proposed future work in the
thesis.

------------------------------------------------------------------------

## 11. Development Phases and Deliverables

  -----------------------------------------------------------------------
  Phase                   Work                    Deliverable
  ----------------------- ----------------------- -----------------------
  0\. Requirements        Interview local         Validated requirements
  validation              businesses; document    and scope
                          current employee,       
                          attendance, and payroll 
                          processes               

  1\. Project setup       Create Laravel project, Running starter
                          configure SQLite, Git   application
                          repository, frontend    
                          tooling                 

  2\. Data design         Create ERD, migrations, Working database
                          models, relationships,  foundation
                          seed data               

  3\. Authentication and  Login, roles, business  Secure multi-business
  tenancy                 membership,             foundation
                          business-scoped         
                          authorization           

  4\. Employee records    Employee CRUD,          Employee management
                          schedules, positions,   module
                          compensation history    

  5\. Attendance          QR generation, scanner  End-to-end attendance
                          terminal, manual        workflow
                          fallback, logs,         
                          validation              

  6\. Attendance review   Late detection, missing Validated attendance
                          Time Out, corrections,  data
                          approvals               

  7\. Payroll             Payroll periods,        Payroll workflow
                          computation service,    
                          adjustments, approval,  
                          locking                 

  8\. Reports             Payslips, attendance    Printable outputs
                          summaries, payroll      
                          reports                 

  9\. Testing             Unit, feature,          Test results and fixes
                          authorization,          
                          concurrency, and        
                          usability testing       

  10\. Deployment         Compare local server    Deployment
  evaluation              and cloud costs,        recommendation
                          connectivity, backup,   
                          and maintenance         
  -----------------------------------------------------------------------

### Suggested build order

Build the database and authorization foundation before the dashboard.
Then implement employee records, attendance, and payroll in that order.
The dashboard should display real data from completed modules rather
than drive the architecture.

------------------------------------------------------------------------

## 12. Testing Plan

Test normal workflows and failure cases.

### Employee tests

-   Employee ID uniqueness within a business.
-   Required field validation.
-   Employee archive behavior.
-   Cross-business access rejection.

### QR and manual attendance tests

-   First scan creates Time In.
-   Second scan creates Time Out.
-   Unknown token is rejected.
-   Unknown Employee ID is rejected.
-   Employee from another business is rejected.
-   Rapid duplicate scans do not create false Time In/Time Out pairs.
-   Simultaneous scans do not create duplicate open sessions.
-   Manual entry records the correct method and operator.
-   Missing Time Out can be reviewed and corrected by an authorized
    user.
-   Overnight shifts work correctly.
-   Camera unavailable / permission denied shows a usable fallback.

### Payroll tests

-   Daily, hourly, or monthly pay cases supported by the prototype.
-   Attendance corrections affect unfinalized payroll appropriately.
-   Finalized payroll remains unchanged.
-   Adjustments require authorization and a reason.
-   Monetary calculations use decimal-safe arithmetic.
-   Payroll records preserve the pay rate and calculation inputs used.
-   Cross-business payroll access is rejected.

### Security and usability tests

-   Role permissions.
-   Session and authentication behavior.
-   Unauthorized document access.
-   Backup and restore.
-   Usability testing with representative business users.

------------------------------------------------------------------------

## 13. Local Server vs. Cloud Deployment: Keep the Decision Open

### Option A: On-premises / local server

The Laravel application and database run on a dedicated computer or
server at the selected site. Devices on the same local network access it
through a browser.

Consider: - Hardware purchase and replacement. - Electricity and backup
power. - Local network and Wi-Fi reliability. - HTTPS for camera
access. - Physical security. - Automated backups to a separate device or
secure off-site destination. - Remote access requirements. - Who is
responsible for updates and maintenance.

A local server may support attendance within the LAN even when external
internet access is unavailable, provided the server and local network
remain operational. Remote access and off-site backup still need
connectivity.

### Option B: Cloud hosting

The Laravel application is hosted on a cloud provider such as AWS or
Azure.

Consider: - Application hosting and database costs. - Storage and
backups. - Network egress and other usage charges. - Security
configuration and updates. - Availability and monitoring. - Internet
connectivity at each business. - Data location and privacy requirements.

### Deployment-neutral design choices now

-   Use `.env` configuration for database and service settings.
-   Keep business logic in Laravel services.
-   Use migrations and Eloquent.
-   Avoid hardcoding filesystem paths and hostnames.
-   Store files through Laravel's storage abstraction.
-   Keep secrets out of Git.
-   Document backup and restore procedures.
-   Test on the intended production database before launch.

Do not finalize a cloud provider or purchase server hardware until
requirements, expected users, internet reliability, support
responsibilities, and total cost of ownership have been assessed.

------------------------------------------------------------------------

## 14. Initial Project Setup Checklist

``` bash
# 1. Create project
composer create-project laravel/laravel employee-management

cd employee-management

# 2. Install frontend dependencies
npm install

# 3. Create SQLite file (Windows PowerShell)
New-Item database/database.sqlite -ItemType File

# 4. Configure .env for SQLite
# DB_CONNECTION=sqlite
# DB_DATABASE=database/database.sqlite

# 5. Run migrations
php artisan migrate

# 6. Start Laravel development server
php artisan serve

# 7. Start frontend asset development server (another terminal)
npm run dev
```

Useful Artisan commands:

``` bash
php artisan make:model Employee -m
php artisan make:model Attendance -m
php artisan make:model AttendanceLog -m
php artisan make:controller EmployeeController
php artisan make:controller AttendanceController
php artisan make:service AttendanceService
php artisan migrate
php artisan migrate:status
php artisan db:seed
php artisan test
```

Note: `make:service` is not included in a default Laravel installation.
Create service classes manually (for example,
`app/Services/AttendanceService.php`) unless a project-specific
generator has been installed.

------------------------------------------------------------------------

## 15. Useful Official Documentation

-   Laravel documentation: https://laravel.com/docs
-   Laravel starter kits: https://laravel.com/docs/starter-kits
-   Laravel database and migrations: https://laravel.com/docs/migrations
-   Laravel Eloquent ORM: https://laravel.com/docs/eloquent
-   Laravel authorization: https://laravel.com/docs/authorization
-   Laravel filesystem: https://laravel.com/docs/filesystem
-   SQLite documentation: https://www.sqlite.org/docs.html
-   html5-qrcode: https://github.com/mebjas/html5-qrcode
-   Chart.js: https://www.chartjs.org/docs/
-   Dompdf for Laravel: https://github.com/barryvdh/laravel-dompdf

------------------------------------------------------------------------

## 16. Decisions to Validate Before Full Implementation

These items should be confirmed through interviews with the target
businesses and the thesis adviser:

1.  Will all participating businesses use one centralized application?
2.  Who owns and operates the server if local deployment is selected?
3.  How many businesses and employees are expected in the pilot?
4.  Will employees scan their own QR codes at a shared terminal, or will
    an authorized staff member operate the terminal?
5.  Is the QR code printed on an employee ID card, displayed on a phone,
    or both?
6.  Will employees be allowed to view their own attendance and payslips?
7.  What pay types and payroll frequencies are actually used by the
    participating businesses?
8.  Which statutory payroll rules are within the approved prototype
    scope?
9.  How are breaks, overnight shifts, rest days, holidays, overtime, and
    missed punches handled?
10. What internet and local network conditions exist at each
    participating business?
11. Who will maintain the application, perform backups, and respond to
    technical problems?
12. What personal information is necessary to collect, and who is
    authorized to access it?

------------------------------------------------------------------------

## Final Recommendation

For the prototype, proceed with:

**Laravel + PHP + Blade + Livewire + Tailwind CSS + SQLite**, using a
centralized multi-tenant application structure.

Prioritize the core workflow:

**Business Setup → Employee Registration → QR / Manual Attendance →
Attendance Validation → Payroll Computation → Payroll Approval → Payslip
Generation.**

Keep the deployment decision open. SQLite is the initial prototype
database, not a promise that it must be the final production database.
The final hosting and database choices should follow the pilot's actual
usage, connectivity, security, maintenance, and cost requirements.
