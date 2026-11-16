@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stat cards row --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">

    <x-stat-card
        title="Active Employees"
        value="{{ $stats['total_active'] }}"
        color="primary"
    >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
    </x-stat-card>

    <x-stat-card
        title="Present Today"
        value="{{ $stats['present_today'] }}"
        color="success"
    >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </x-stat-card>

    <x-stat-card
        title="Absent Today"
        value="{{ $stats['absent_today'] }}"
        color="danger"
    >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </x-stat-card>

    <x-stat-card
        title="Missing Time Out"
        value="{{ $stats['missing_timeout'] }}"
        color="warning"
    >
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
    </x-stat-card>

</div>

{{-- Charts row --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- Attendance trend bar chart --}}
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200 p-5">
        <h2 class="text-sm font-semibold text-gray-700 mb-4">Attendance Trend — Last 7 Days</h2>
        @if(count($chartLabels) > 0)
            <div class="relative h-56">
                <canvas id="attendanceTrend"></canvas>
            </div>
        @else
            <div class="h-56 flex items-center justify-center text-gray-600 text-sm">No data available</div>
        @endif
    </div>

    {{-- Employment type doughnut chart --}}
    <div class="bg-white rounded-xl border border-gray-200 p-5">
        <h2 class="text-sm font-semibold text-gray-700 mb-4">Employment Types</h2>
        @if(array_sum($employmentTypeDataset['data']) > 0)
            <div class="relative h-56">
                <canvas id="employmentType"></canvas>
            </div>
        @else
            <div class="h-56 flex items-center justify-center text-gray-600 text-sm">No data available</div>
        @endif
    </div>

</div>

{{-- Lower row: Recent attendance + Payroll periods --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">

    {{-- Recent Attendance table --}}
    <div class="lg:col-span-2 bg-white rounded-xl border border-gray-200">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-gray-700">Recent Attendance</h2>
            <a href="{{ route('attendance.records') }}" class="text-sm text-teal-900 hover:underline font-medium">View all →</a>
        </div>
        @if(count($recentAttendance) > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-sm font-semibold text-gray-700 uppercase tracking-wider border-b border-gray-100">
                        <th class="px-5 py-3 text-left">Employee</th>
                        <th class="px-5 py-3 text-left">Date</th>
                        <th class="px-5 py-3 text-left">Time In</th>
                        <th class="px-5 py-3 text-left">Time Out</th>
                        <th class="px-5 py-3 text-left">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($recentAttendance as $record)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-3 font-medium text-gray-900">{{ $record['full_name'] }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ date('M j, Y', strtotime($record['work_date'])) }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $record['time_in'] ? date('h:i A', strtotime($record['time_in'])) : '—' }}</td>
                        <td class="px-5 py-3 text-gray-600">{{ $record['time_out'] ? date('h:i A', strtotime($record['time_out'])) : '—' }}</td>
                        <td class="px-5 py-3"><x-badge :status="$record['status']" /></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="px-5 py-10 text-center text-gray-600 text-sm">No attendance records for today.</div>
        @endif
    </div>

    {{-- Payroll periods card --}}
    <div class="bg-white rounded-xl border border-gray-200">
        <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-gray-700">Payroll Periods</h2>
            <a href="{{ route('payroll.periods') }}" class="text-sm text-teal-900 hover:underline font-medium">View all →</a>
        </div>
        @if(count($payrollPeriods) > 0)
        <div class="divide-y divide-gray-50">
            @foreach($payrollPeriods as $period)
            <div class="flex items-center justify-between px-5 py-3">
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ $period['period_label'] }}</p>
                    <p class="text-sm text-gray-700 mt-0.5">Pay date: {{ date('m/d/Y', strtotime($period['pay_date'])) }}</p>
                </div>
                <x-badge :status="$period['status']" />
            </div>
            @endforeach
        </div>
        @else
        <div class="px-5 py-10 text-center text-gray-600 text-sm">No payroll periods found.</div>
        @endif
    </div>

</div>

{{-- Quick actions --}}
<div class="bg-white rounded-xl border border-gray-200 p-5">
    <h2 class="text-sm font-semibold text-gray-700 mb-4">Quick Actions</h2>
    <div class="flex flex-wrap gap-3">
        <a
            href="{{ route('employees.index', ['modal' => 'add']) }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-teal-700 text-white text-sm font-medium rounded-lg hover:bg-[#163653] transition-colors"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Add Employee
        </a>
        <a
            href="{{ route('attendance.terminal') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
            </svg>
            Open QR Terminal
        </a>
        <a
            href="{{ route('payroll.overview', ['modal' => 'create']) }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-amber-600 text-white text-sm font-medium rounded-lg hover:bg-amber-700 transition-colors"
        >
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            Create Payroll Period
        </a>
    </div>
</div>

@endsection

@push('scripts')
<script>
(function () {
    // Attendance trend bar chart
    const trendLabels   = @json($chartLabels);
    const trendDatasets = @json($attendanceTrendDatasets);

    if (document.getElementById('attendanceTrend')) {
        new Chart(document.getElementById('attendanceTrend'), {
            type: 'bar',
            data: { labels: trendLabels, datasets: trendDatasets },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { font: { size: 12 } } }
                },
                scales: {
                    y: { beginAtZero: true, ticks: { stepSize: 1 } }
                }
            }
        });
    }

    // Employment type doughnut chart
    const typeData = @json($employmentTypeDataset);

    if (document.getElementById('employmentType')) {
        new Chart(document.getElementById('employmentType'), {
            type: 'doughnut',
            data: {
                labels: typeData.labels,
                datasets: [{
                    data: typeData.data,
                    backgroundColor: typeData.backgroundColor,
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { font: { size: 12 } } }
                }
            }
        });
    }
})();
</script>
@endpush
