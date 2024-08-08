<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
</head>
<body>
    <p>Dear {{ $students->first_name }},</p>

    <p>Congratulations! You have successfully completed the "{{ $event->activity_title }}" activity.</p>

    <p>Attached to this email is your Certificate of Completion.</p>

    <p>Thank you for your participation.</p>

    <p>Best regards,</p>
    <p>{{ $students->organization1 }}</p>
</body>
</html>