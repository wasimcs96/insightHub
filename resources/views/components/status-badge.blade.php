@props([
    'status' => null, // integer status key
    'wrapperClass' => 'custom-badge',
    'defaultClass' => 'custom-badge',
])

@php
    $statusClasses = [
        1 => 'badge-applied', // Applied
        2 => 'badge-sent', // Assessment Link Sent
        3 => 'badge-pending', // Assessment Pending
        4 => 'badge-pending', // Assessment Completed
        5 => 'badge-shortlisted', // Shortlisted
        6 => 'badge-interview', // Interview Scheduled
        7 => 'badge-interview', // Interview Completed
        8 => 'badge-sent', // Offered
        9 => 'badge-sent', // Offer Accepted
        10 => 'badge-declined', // Offer Declined
        11 => 'badge-declined', // Offer Expired
        12 => 'badge-sent', // Hired
    ];
    $statusLabels = config('helpers.application_status');
    $label = $statusLabels[$status] ?? 'N/A';
    $class = $statusClasses[$status] ?? $defaultClass;
@endphp

<div class="{{ trim($wrapperClass . ' ' . $class) }}">
    {{ strtoupper($label) }}
</div>
