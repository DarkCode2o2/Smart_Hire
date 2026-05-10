<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SmartHire AI - {{ $resume->full_name }} Report</title>
    <style>
        /* الأساسيات */
        body {
            font-family: 'Helvetica', Arial, sans-serif;
            color: #1e293b;
            line-height: 1.5;
            margin: 0;
            padding: 0;
        }
        .container { padding: 30px; }
        
        /* الهيدر */
        .header {
            border-bottom: 2px solid #2563eb;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .brand {
            color: #2563eb;
            font-size: 26px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .report-date {
            float: right;
            font-size: 12px;
            color: #64748b;
            margin-top: 10px;
        }

        /* صندوق النتيجة (Score) */
        .score-container {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            margin-bottom: 30px;
        }
        .score-label {
            display: block;
            font-size: 14px;
            color: #3b82f6;
            font-weight: bold;
            text-transform: uppercase;
            margin-bottom: 5px;
        }
        .score-value {
            font-size: 40px;
            color: #1d4ed8;
            font-weight: 900;
        }

        /* العناوين والبيانات */
        .section-title {
            color: #1e40af;
            font-size: 18px;
            font-weight: bold;
            border-left: 4px solid #2563eb;
            padding-left: 10px;
            margin: 25px 0 15px 0;
            background-color: #f8fafc;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
        }
        .info-table td { padding: 5px 0; font-size: 14px; }
        .label { color: #64748b; font-weight: bold; width: 120px; }

        /* المهارات (Badges) */
        .skills-container { margin-top: 20px; }
        .badge {
            display: inline-block;
            background-color: #dbeafe;
            color: #1e40af;
            padding: 4px 12px;
            margin: 3px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            border: 1px solid #bfdbfe;
        }

        /* الملخص */
        .summary-text {
            font-size: 16px;
            color: #334155;
            text-align: justify;
            white-space: pre-wrap;
            line-height: 1.6;
        }

        /* الفوتر */
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #94a3b8;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <span class="brand">SmartHire AI</span>
        <span class="report-date">Generated on: {{ date('F d, Y') }}</span>
    </div>

    <div class="score-container">
        <span class="score-label">AI Match Score</span>
        <span class="score-value">{{ $resume->point }} / 100</span>
    </div>

    <div class="section-title">Candidate Profile</div>
    <table class="info-table">
        <tr>
            <td class="label">Full Name:</td>
            <td><strong>{{ $resume->full_name }}</strong></td>
        </tr>
        <tr>
            <td class="label">Job Title:</td>
            <td>{{ $resume->job_title }}</td>
        </tr>
        <tr>
            <td class="label">Email:</td>
            <td>{{ $resume->email ?? 'N/A' }}</td>
        </tr>
    </table>

    <div class="section-title">Key Competencies</div>
    <div class="skills-container">
        @foreach(json_decode($resume->skills) as $skill)
            <div class="badge">
                {{ ucfirst($skill) }}
            </div>
        @endforeach
    </div>

    <div class="section-title">AI Analysis Summary</div>
    <div class="summary-text">{{ trim($resume->ai_summary) }}</div>

    <div class="footer">
        © {{ date('Y') }} SmartHire AI - Automated Resume Analysis System. Professional Use Only.
    </div>
</div>

</body>
</html>