@props(['status' => 'default', 'size' => 'md'])

@php
$colors = [
    'Present'      => 'bg-green-100 text-green-800',
    'Active'       => 'bg-green-100 text-green-800',
    'Approved'     => 'bg-green-100 text-green-800',
    'Finalized'    => 'bg-green-100 text-green-800',
    'Late'         => 'bg-amber-100 text-amber-800',
    'Under Review' => 'bg-amber-100 text-amber-800',
    'Draft'        => 'bg-gray-100 text-gray-700',
    'Absent'       => 'bg-red-100 text-red-800',
    'Inactive'     => 'bg-red-100 text-red-800',
    'Rejected'     => 'bg-red-100 text-red-800',
    'Half-Day'     => 'bg-sky-100 text-sky-800',
    'Pending'      => 'bg-sky-100 text-sky-800',
    'QR'           => 'bg-purple-100 text-purple-800',
    'Manual'       => 'bg-orange-100 text-orange-800',
    'Full-Time'    => 'bg-slate-100 text-slate-900',
    'Part-Time'    => 'bg-indigo-100 text-indigo-800',
    'Contractual'  => 'bg-teal-100 text-teal-800',
    'default'      => 'bg-gray-100 text-gray-700',
];
$color = $colors[$status] ?? $colors['default'];
$sizeClass = $size === 'sm' ? 'px-1.5 py-0.5 text-sm' : 'px-2.5 py-0.5 text-sm';
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center font-medium rounded-full $color $sizeClass"]) }}>
    {{ $status }}
</span>
