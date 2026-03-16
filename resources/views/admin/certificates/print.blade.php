<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.certificates.cert_title') }} - {{ $certificate->certificate_number }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&family=Tajawal:wght@400;500;700;800;900&family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Cairo', 'Tajawal', sans-serif; background: #e5e7eb; }

        .certificate {
            width: 297mm;
            height: 210mm;
            margin: 20px auto;
            position: relative;
            background: #ffffff;
            overflow: hidden;
        }

        /* Outer navy border */
        .border-outer {
            position: absolute;
            inset: 0;
            border: 14px solid #273d8d;
        }

        /* Inner red border */
        .border-inner {
            position: absolute;
            inset: 14px;
            border: 4px solid #ec1933;
        }

        /* Content container */
        .content {
            position: absolute;
            inset: 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 14px 36px 10px;
        }

        /* Top header with logos */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            margin-bottom: 4px;
        }

        .header-side {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 150px;
        }

        .logo-img {
            width: 80px;
            height: auto;
            object-fit: contain;
        }

        .header-side-label {
            font-size: 9px;
            color: #6b7280;
            margin-top: 2px;
            text-align: center;
            line-height: 1.2;
        }

        .header-text {
            text-align: center;
            flex: 1;
        }

        .institute-name-ar {
            font-size: 22px;
            font-weight: 900;
            color: #1a2242;
            letter-spacing: 1px;
            line-height: 1.3;
        }

        .institute-name-en {
            font-size: 12px;
            font-weight: 700;
            color: #4a5568;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-family: 'Inter', sans-serif;
            margin-top: 2px;
        }

        /* Certificate Title Row */
        .cert-title-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin: 10px 0 4px;
            width: 100%;
        }

        .cert-title-ar {
            font-size: 34px;
            font-weight: 900;
            color: #1a2242;
            letter-spacing: 2px;
        }

        .cert-title-divider {
            width: 2px;
            height: 36px;
            background: #ec1933;
        }

        .cert-title-en {
            font-size: 20px;
            font-weight: 800;
            color: #1a2242;
            letter-spacing: 3px;
            text-transform: uppercase;
            font-family: 'Inter', sans-serif;
        }

        /* Certify text */
        .certify-row {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            font-size: 14px;
            color: #4a5568;
            margin-bottom: 4px;
        }

        /* Student name row */
        .student-name-row {
            display: flex;
            justify-content: center;
            align-items: baseline;
            gap: 24px;
            padding: 4px 40px 6px;
            border-bottom: 3px solid #ec1933;
            margin-bottom: 6px;
        }
       
        .student-name-ar {
            font-size: 28px;
            font-weight: 900;
            color: #1a2242;
            direction: rtl;
        }

        .student-name-en {
            font-size: 20px;
            font-weight: 700;
            color: #374151;
            direction: ltr;
            font-family: 'Inter', sans-serif;
        }

        .student-id {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 8px;
        }
        .student-id span { font-weight: 700; color: #1a2242; }

        /* Two-column details area */
        .details-columns {
            display: flex;
            flex-direction: row-reverse;
            width: 92%;
            margin: 4px auto 0;
            gap: 20px;
            flex: 1;
        }

        /* English column (left visually) */
        .col-en {
            flex: 1;
            direction: ltr;
            text-align: left;
            font-family: 'Inter', sans-serif;
            border-right: 2px solid #e5e7eb;
            padding-right: 20px;
        }

        /* Arabic column (right visually) */
        .col-ar {
            flex: 1;
            direction: rtl;
            text-align: right;
            border-left: 2px solid #e5e7eb;
            padding-left: 20px;
        }

        .col-heading {
            font-size: 11px;
            font-weight: 700;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 6px;
            padding-bottom: 4px;
            border-bottom: 1px solid #e5e7eb;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding: 3px 0;
            font-size: 13px;
        }

        .detail-label {
            font-weight: 700;
            color: #1a2242;
            white-space: nowrap;
        }

        .detail-value {
            color: #374151;
            font-weight: 600;
        }

        .detail-dots {
            flex: 1;
            border-bottom: 1px dotted #d1d5db;
            margin: 0 8px;
            min-width: 20px;
            align-self: end;
            margin-bottom: 3px;
        }

        /* Bottom Section: Signature + Stamp + Approval */
        .bottom-section {
            width: 92%;
            margin-top: auto;
            padding-top: 8px;
        }

        .bottom-row {
            display: flex;
            flex-direction: row-reverse;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
        }

        .stamp-block {
            text-align: center;
            min-width: 160px;
        }

        .stamp-circle {
            width: 80px;
            height: 80px;
            border: 2px dashed #d1d5db;
            border-radius: 50%;
            margin: 0 auto 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stamp-circle-text {
            font-size: 8px;
            color: #d1d5db;
        }

        .stamp-label {
            font-size: 10px;
            font-weight: 700;
            color: #1a2242;
        }

        .signature-block {
            text-align: center;
            min-width: 160px;
        }

        .signature-line {
            width: 160px;
            border-bottom: 2px solid #1a2242;
            margin: 0 auto 4px;
        }

        .signature-label-ar {
            font-size: 12px;
            font-weight: 700;
            color: #1a2242;
        }

        .signature-label-en {
            font-size: 10px;
            color: #6b7280;
            font-family: 'Inter', sans-serif;
        }

        .approval-block {
            text-align: center;
            min-width: 160px;
        }

        .approval-circle {
            width: 80px;
            height: 80px;
            border: 2px dashed #d1d5db;
            border-radius: 50%;
            margin: 0 auto 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .approval-label-en {
            font-size: 8px;
            font-weight: 700;
            color: #1a2242;
            text-transform: uppercase;
            line-height: 1.2;
            font-family: 'Inter', sans-serif;
            max-width: 140px;
            margin: 0 auto;
        }

        .approval-label-ar {
            font-size: 9px;
            font-weight: 700;
            color: #1a2242;
            margin-top: 1px;
        }

        /* Certificate number + date bar */
        .info-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 92%;
            margin-top: 6px;
            padding-top: 6px;
            border-top: 1px solid #e5e7eb;
        }

        .info-bar-item {
            font-size: 10px;
            color: #6b7280;
        }

        .info-bar-item span {
            font-weight: 700;
            color: #1a2242;
            font-family: 'Courier New', monospace;
        }

        /* Footer */
        .footer {
            width: 100%;
            margin-top: 4px;
            display: flex;
            justify-content: center;
            gap: 24px;
            font-size: 10px;
            color: #6b7280;
        }

        .footer-item {
            display: flex;
            align-items: center;
            gap: 3px;
            direction: ltr;
        }

        /* Bottom red accent band */
        .bottom-band {
            position: absolute;
            bottom: 14px;
            left: 18px;
            right: 18px;
            height: 5px;
            background: #ec1933;
        }

        /* Print styles */
        @media print {
            body { background: white; margin: 0; }
            .certificate { margin: 0; box-shadow: none; }
            .no-print { display: none !important; }
            @page { size: A4 landscape; margin: 0; }
        }

        /* Print toolbar */
        .print-toolbar {
            text-align: center;
            padding: 15px;
            background: #273d8d;
        }
        .print-toolbar button {
            background: white;
            color: #273d8d;
            border: none;
            padding: 10px 30px;
            border-radius: 8px;
            font-family: Cairo, sans-serif;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
        }
        .print-toolbar button:hover { background: #f3f4f6; }
        .print-toolbar a {
            color: white;
            margin-inline-start: 20px;
            font-family: Cairo, sans-serif;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="no-print print-toolbar">
        <button onclick="window.print()">{{ __('messages.certificates.print') }}</button>
        <a href="{{ route('admin.certificates.index') }}">{{ __('messages.back') }}</a>
    </div>

    <div class="certificate">
        <div class="border-outer"></div>
        <div class="border-inner"></div>

        <div class="content">
            @php
                $enLevels = ['مبتدئ' => 'Beginner', 'متوسط' => 'Intermediate', 'متقدم' => 'Advanced'];
                $enGrades = ['excellent' => 'Excellent', 'very_good' => 'Very Good', 'good' => 'Good', 'pass' => 'Pass'];
                $arGrades = ['excellent' => 'ممتاز', 'very_good' => 'جيد جداً', 'good' => 'جيد', 'pass' => 'مقبول'];
            @endphp
            {{-- Header with logos --}}
            <div class="header">
                <div class="header-side">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="logo-img">
                </div>
                <div class="header-text">
                    <div class="institute-name-ar">معهد النسور للغة الإنجليزية</div>
                    <div class="institute-name-en">Eagles English Institute</div>
                </div>
                <div class="header-side">
                    <img src="{{ asset('images/logo222.png') }}" alt="Logo" class="logo-img" style="width: 120px;">
                </div>
            </div>

            {{-- Certificate Title --}}
            <div class="cert-title-row">
                <div class="cert-title-ar">شهادة إتمام دورة</div>
                
                <div class="cert-title-divider"></div>
                <div class="cert-title-en">Course Completion Certificate</div>
            </div>

            {{-- Certify Text --}}
            <div class="certify-row">
                <span style="direction: rtl;">نشهد بأن</span>
                <span>•</span>
                                <span style="direction: ltr; font-family: Inter, sans-serif;">This is to certify that</span>
            </div>

            {{-- Student Name --}}
            <div class="student-name-row">
                <span class="student-name-ar">{{ $certificate->student->name }}</span>
                    <span style="color: #ec1933; font-size: 20px;">|</span>
                                    <span class="student-name-en">{{ $certificate->student->name_en }}</span>

               
            </div>

            <div class="student-id">
                رقم الهوية / ID Number: <span>{{ $certificate->student->id_number }}</span>
            </div>

            {{-- Two-column details: English LEFT, Arabic RIGHT --}}
            <div class="details-columns">
                {{-- English Column (Left) --}}
                <div class="col-en">
                    <div class="col-heading">Course Details</div>

                    <div class="detail-row">
                        <span class="detail-label">Course</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->course->name_en ?? $certificate->course->name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Level</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $enLevels[$certificate->course->level] ?? $certificate->course->level }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Duration</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->course->duration_hours }} Hours</span>
                    </div>

                    @if($certificate->grade)
                    <div class="detail-row">
                        <span class="detail-label">Grade</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $enGrades[$certificate->grade] ?? $certificate->grade }}</span>
                    </div>
                    @endif

                    @if($certificate->course->start_date)
                    <div class="detail-row">
                        <span class="detail-label">From</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->course->start_date->format('Y/m/d') }}</span>
                    </div>
                    @endif

                    @if($certificate->course->end_date)
                    <div class="detail-row">
                        <span class="detail-label">To</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->course->end_date->format('Y/m/d') }}</span>
                    </div>
                    @endif

                    <div class="detail-row" style="margin-top: 4px;">
                        <span class="detail-label">Issue Date</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->issued_at->format('Y/m/d') }}</span>
                    </div>
                </div>

                {{-- Arabic Column (Right) --}}
                <div class="col-ar">
                    <div class="col-heading" style="letter-spacing: 0;">تفاصيل الدورة</div>

                    <div class="detail-row">
                        <span class="detail-label">الدورة</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->course->name }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">المستوى</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->course->level }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">المدة</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->course->duration_hours }} ساعة</span>
                    </div>

                    @if($certificate->grade)
                    <div class="detail-row">
                        <span class="detail-label">التقدير</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $arGrades[$certificate->grade] ?? $certificate->grade }}</span>
                    </div>
                    @endif

                    @if($certificate->course->start_date)
                    <div class="detail-row">
                        <span class="detail-label">من</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->course->start_date->format('Y/m/d') }}</span>
                    </div>
                    @endif

                    @if($certificate->course->end_date)
                    <div class="detail-row">
                        <span class="detail-label">إلى</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->course->end_date->format('Y/m/d') }}</span>
                    </div>
                    @endif

                    <div class="detail-row" style="margin-top: 4px;">
                        <span class="detail-label">تاريخ الإصدار</span>
                        <span class="detail-dots"></span>
                        <span class="detail-value">{{ $certificate->issued_at->format('Y/m/d') }}</span>
                    </div>
                </div>
            </div>

            {{-- Bottom: Approval + Stamp + Signature + Manager Signature --}}
            <div class="bottom-section">
                <div class="bottom-row">
                    {{-- Approval of Private Education Sector (Right side visually) --}}
                    <div class="approval-block">
                        <div class="approval-circle">
                            <span class="stamp-circle-text">Approval</span>
                        </div>
                        <div class="approval-label-ar">اعتماد قطاع التعليم الأهلي</div>
                        <div class="approval-label-en">Approval of the Private<br>Education Sector</div>
                    </div>

                    {{-- Institute Stamp --}}
                    <div class="stamp-block">
                        <div class="stamp-circle">
                            <span class="stamp-circle-text">Stamp</span>
                        </div>
                        <div class="stamp-label">ختم المعهد</div>
                        <div style="font-size: 9px; color: #6b7280; font-family: Inter, sans-serif;">Institute Stamp</div>
                    </div>

                    {{-- Institute Director Signature --}}
                    <div class="signature-block">
                        <div class="signature-line"></div>
                        <div class="signature-label-ar">مدير المعهد</div>
                        <div class="signature-label-en">Institute Director</div>
                    </div>

                    {{-- Institute Manager Signature --}}
                    <div class="signature-block">
                        <div class="signature-line"></div>
                        <div class="signature-label-ar">مدير الإدارة</div>
                        <div class="signature-label-en">Institute Manager</div>
                    </div>
                </div>
            </div>

            {{-- Certificate Number + Contact Footer --}}
            <div class="info-bar">
                <div class="info-bar-item">رقم الشهادة / Cert. No: <span>{{ $certificate->certificate_number }}</span></div>
                <div class="footer">
                    <span class="footer-item">
                        <svg width="10" height="10" fill="none" stroke="#6b7280" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        0135881133
                    </span>
                    <span class="footer-item">
                        <svg width="10" height="10" fill="none" stroke="#6b7280" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        info@eagles-institute.com
                    </span>
                    <span class="footer-item">
                        <svg width="10" height="10" fill="none" stroke="#6b7280" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        الأحساء - شارع الظهران
                    </span>
                </div>
                <div class="info-bar-item">{{ $certificate->issued_at->format('Y/m/d') }}</div>
            </div>
        </div>

        <div class="bottom-band"></div>
    </div>
</body>
</html>
