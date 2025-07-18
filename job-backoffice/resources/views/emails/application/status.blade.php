<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        .panel {
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .primary {
            background-color: #cce5ff;
            color: #004085;
        }
    </style>
</head>

<body>
    <h1>🌟 Application Status Update</h1>

    <p>Dear {{ $jobApplication->user->name }},</p>

    <p>We’re thrilled to share an update regarding your application for:</p>

    <p><strong>Position:</strong> {{ $jobApplication->jobVacancy->title }}</p>
    <p><strong>Status:</strong></p>

    <div class="panel {{ match ($jobApplication->status) {
    'Accepted' => 'success',
    'Rejected' => 'error',
    default => 'primary',
} }}">
        {{ strtoupper($jobApplication->status) }}
    </div>

    @if($jobApplication->status === 'Accepted')
        <p>🎉 <strong>Congratulations!</strong> Your skills impressed us.<br>
            Our team will reach out within <strong>3 business days</strong> with next steps.</p>
    @elseif($jobApplication->status === 'Rejected')
        <p>We sincerely appreciate your time and effort.<br>
            While this role wasn’t the right fit, we’d love to stay connected for future opportunities.</p>
    @else
        <p>We’re actively reviewing applications and will provide another update soon.<br>
            Thank you for your patience!</p>
    @endif

    <p>
        <a href="http://localhost:8000/job-applications" style="
            background-color: #3490dc;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        ">
            View Your Dashboard
        </a>
    </p>

    <p>Warm regards,<br>
        <strong>The {{ config('app.name') }} Team</strong>
    </p>

    <hr>
    <p style="font-size: 12px; color: #888;">
        Need help? Contact us at {{ config('mail.contact_email') }}
    </p>
</body>

</html>