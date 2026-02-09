<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>شهادة - {{ $certificate->certificate_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Cairo', sans-serif; background: #f3f4f6; }
        .certificate {
            width: 297mm; height: 210mm;
            margin: 20px auto; padding: 30px;
            background: white; position: relative;
            border: 3px solid #1e40af;
            overflow: hidden;
        }
        .certificate::before {
            content: ''; position: absolute; top: 8px; left: 8px; right: 8px; bottom: 8px;
            border: 2px solid #93c5fd; pointer-events: none;
        }
        .corner-decoration {
            position: absolute; width: 80px; height: 80px;
            border: 3px solid #1e40af;
        }
        .corner-tl { top: 15px; left: 15px; border-right: none; border-bottom: none; }
        .corner-tr { top: 15px; right: 15px; border-left: none; border-bottom: none; }
        .corner-bl { bottom: 15px; left: 15px; border-right: none; border-top: none; }
        .corner-br { bottom: 15px; right: 15px; border-left: none; border-top: none; }
        .content { position: relative; z-index: 1; text-align: center; padding: 20px 40px; }
        .logo { display: flex; align-items: center; justify-content: center; gap: 12px; margin-bottom: 20px; }
        .logo-icon { background: #fff; color: white; width: 120px; height: 120px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 24px; }
        .institute-name { font-size: 28px; font-weight: 800; color: #1e40af; }
        .certificate-title { font-size: 36px; font-weight: 800; color: #1e3a5f; margin: 15px 0; letter-spacing: 2px; }
        .subtitle { font-size: 16px; color: #6b7280; margin-bottom: 20px; }
        .student-name { font-size: 32px; font-weight: 700; color: #1e40af; border-bottom: 3px solid #f59e0b; padding-bottom: 8px; display: inline-block; margin: 15px 0; }
        .course-info { font-size: 18px; color: #374151; margin: 15px 0; line-height: 1.8; }
        .course-name { font-weight: 700; color: #1e3a5f; font-size: 22px; }
        .details { display: flex; justify-content: space-between; margin-top: 30px; padding: 0 40px; }
        .detail-item { text-align: center; }
        .detail-label { font-size: 12px; color: #9ca3af; margin-bottom: 4px; }
        .detail-value { font-size: 14px; font-weight: 600; color: #374151; }
        .cert-number { position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); font-size: 11px; color: #9ca3af; font-family: monospace; }
        @media print {
            body { background: white; }
            .certificate { margin: 0; border: 3px solid #1e40af; box-shadow: none; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="no-print" style="text-align: center; padding: 15px; background: #1e40af;">
        <button onclick="window.print()" style="background: white; color: #1e40af; border: none; padding: 10px 30px; border-radius: 8px; font-family: Cairo; font-weight: 700; font-size: 16px; cursor: pointer;">طباعة الشهادة</button>
        <a href="{{ route('admin.certificates.index') }}" style="color: white; margin-right: 20px; font-family: Cairo; text-decoration: none;">العودة</a>
    </div>

    <div class="certificate">
        <div class="corner-decoration corner-tl"></div>
        <div class="corner-decoration corner-tr"></div>
        <div class="corner-decoration corner-bl"></div>
        <div class="corner-decoration corner-br"></div>

        <div class="content">
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-icon">
                
            </div>
            <span class="institute-name">معهد النسور للغة الإنجليزية</span>

            <div class="certificate-title">شهادة إتمام دورة</div>
            <div class="subtitle">رقم الهوية: {{ $certificate->student->id_number }}</div>

            <p style="font-size: 16px; color: #6b7280;">يشهد معهد النسور للغة الإنجليزية بأن</p>

            <div class="student-name">{{ $certificate->student->name }}</div>

            <div class="course-info">
                قد أتم بنجاح دورة
                <br>
                <span class="course-name">{{ $certificate->course->name }}</span>
                <br>
                المستوى: {{ $certificate->course->level }}
                @if($certificate->grade)
                    | التقدير: {{ $certificate->grade }}
                @endif
            </div>

            <div class="details">
                <div class="detail-item">
                    <div class="detail-label">تاريخ الإصدار</div>
                    <div class="detail-value">{{ $certificate->issued_at->format('Y/m/d') }}</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">مدة الدورة</div>
                    <div class="detail-value">{{ $certificate->course->duration_hours }} ساعة</div>
                </div>
                <div class="detail-item">
                    <div class="detail-label">المدير</div>
                    <div class="detail-value" style="border-top: 2px solid #d1d5db; padding-top: 4px; min-width: 120px;">التوقيع</div>
                </div>
            </div>
        </div>

        <div class="cert-number">{{ $certificate->certificate_number }}</div>
    </div>
</body>
</html>
