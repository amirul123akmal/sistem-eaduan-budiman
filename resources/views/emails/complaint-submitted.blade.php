<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light dark">
    <meta name="supported-color-schemes" content="light dark">
    <title>Aduan Diterima</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* Light mode (default) */
        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #f4f4f4;
            --bg-info: #F0F7F0;
            --bg-footer: #F0F7F0;
            --text-primary: #333;
            --text-secondary: #555;
            --text-muted: #666;
            --text-footer: #999;
            --border-color: #e5e7eb;
            --header-gradient: linear-gradient(135deg, #132A13 0%, #2F4F2F 100%);
            --description-bg: linear-gradient(135deg, #2F4F2F 0%, #132A13 100%);
            --button-gradient: linear-gradient(135deg, #132A13 0%, #2F4F2F 100%);
        }
        
        /* Dark mode */
        @media (prefers-color-scheme: dark) {
            :root {
                --bg-primary: #1a1a1a;
                --bg-secondary: #0f0f0f;
                --bg-info: #2a2a2a;
                --bg-footer: #252525;
                --text-primary: #e5e5e5;
                --text-secondary: #d0d0d0;
                --text-muted: #b0b0b0;
                --text-footer: #888;
                --border-color: #404040;
                --header-gradient: linear-gradient(135deg, #1a3a1a 0%, #2a5a2a 100%);
                --description-bg: linear-gradient(135deg, #2a5a2a 0%, #1a3a1a 100%);
                --button-gradient: linear-gradient(135deg, #1a3a1a 0%, #2a5a2a 100%);
            }
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            max-width: 650px;
            margin: 0 auto;
            padding: 20px;
            background-color: var(--bg-secondary);
        }
        
        .email-container {
            background-color: var(--bg-primary);
            border-radius: 12px;
            padding: 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        @media (prefers-color-scheme: dark) {
            .email-container {
                box-shadow: 0 4px 12px rgba(0,0,0,0.5);
            }
        }
        
        .header {
            background: var(--header-gradient);
            color: white;
            padding: 30px 25px;
            text-align: center;
            position: relative;
        }
        
        .logo-container {
            margin-bottom: 20px;
        }
        
        .logo-container img {
            max-width: 200px;
            height: auto;
            display: block;
            margin: 0 auto;
            background-color: white;
            padding: 10px;
            border-radius: 8px;
        }
        
        @media (prefers-color-scheme: dark) {
            .logo-container img {
                background-color: rgba(255, 255, 255, 0.95);
            }
        }
        
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 28px;
            font-weight: 700;
            color: #fff;
        }
        
        .header p {
            margin: 0;
            font-size: 16px;
            opacity: 0.95;
            color: #fff;
        }
        
        .content {
            padding: 30px 25px;
            color: var(--text-primary);
            background-color: var(--bg-primary);
        }
        
        .success-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 12px 24px;
            border-radius: 25px;
            font-size: 15px;
            font-weight: 600;
            margin: 20px 0;
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.3);
        }
        
        .success-badge::before {
            content: '✓';
            font-size: 18px;
            font-weight: bold;
        }
        
        .greeting {
            font-size: 16px;
            color: var(--text-primary);
            margin: 20px 0;
        }
        
        .greeting strong {
            color: #132A13;
            font-weight: 600;
        }
        
        @media (prefers-color-scheme: dark) {
            .greeting strong {
                color: #4ade80;
            }
        }
        
        .intro-text {
            font-size: 15px;
            color: var(--text-secondary);
            margin-bottom: 25px;
            line-height: 1.7;
        }
        
        .complaint-id {
            background: var(--header-gradient);
            color: white;
            padding: 18px 20px;
            border-radius: 10px;
            text-align: center;
            font-size: 20px;
            font-weight: 700;
            margin: 25px 0;
            box-shadow: 0 4px 12px rgba(19, 42, 19, 0.2);
            letter-spacing: 0.5px;
        }
        
        @media (prefers-color-scheme: dark) {
            .complaint-id {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            }
        }
        
        .info-section {
            background: var(--bg-info);
            border: 2px solid var(--border-color);
            border-left: 5px solid #132A13;
            padding: 25px;
            margin: 25px 0;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        
        @media (prefers-color-scheme: dark) {
            .info-section {
                background: var(--bg-info);
                border-color: var(--border-color);
                border-left-color: #4ade80;
                box-shadow: 0 2px 8px rgba(0,0,0,0.3);
            }
        }
        
        .info-section h3 {
            margin: 0 0 20px 0;
            color: #132A13;
            font-size: 18px;
            font-weight: 700;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border-color);
        }
        
        @media (prefers-color-scheme: dark) {
            .info-section h3 {
                color: #4ade80;
                border-bottom-color: var(--border-color);
            }
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 12px 0;
            border-bottom: 1px solid var(--border-color);
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 600;
            color: #132A13;
            min-width: 140px;
            font-size: 14px;
        }
        
        @media (prefers-color-scheme: dark) {
            .info-label {
                color: #4ade80;
            }
        }
        
        .info-value {
            color: var(--text-primary);
            text-align: right;
            flex: 1;
            font-size: 14px;
            word-break: break-word;
        }
        
        .description-box {
            background: var(--description-bg);
            border: none;
            padding: 20px;
            border-radius: 10px;
            margin: 25px 0;
            box-shadow: 0 4px 12px rgba(19, 42, 19, 0.2);
        }
        
        @media (prefers-color-scheme: dark) {
            .description-box {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            }
        }
        
        .description-box h4 {
            margin: 0 0 12px 0;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
        }
        
        .description-box p {
            margin: 0;
            white-space: pre-wrap;
            color: #fff;
            font-size: 14px;
            line-height: 1.7;
        }
        
        .next-steps {
            background-color: var(--bg-info);
            border-left: 4px solid #132A13;
            padding: 20px;
            border-radius: 8px;
            margin: 25px 0;
        }
        
        @media (prefers-color-scheme: dark) {
            .next-steps {
                background-color: var(--bg-info);
                border-left-color: #4ade80;
            }
        }
        
        .next-steps strong {
            color: #132A13;
            font-size: 16px;
            display: block;
            margin-bottom: 12px;
        }
        
        @media (prefers-color-scheme: dark) {
            .next-steps strong {
                color: #4ade80;
            }
        }
        
        .next-steps ul {
            margin: 0;
            padding-left: 20px;
            color: var(--text-secondary);
        }
        
        .next-steps li {
            margin: 8px 0;
            font-size: 14px;
            line-height: 1.6;
        }
        
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        
        .button {
            display: inline-block;
            background: var(--button-gradient);
            color: white;
            padding: 14px 32px;
            text-decoration: none;
            border-radius: 8px;
            margin: 10px 0;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 4px 12px rgba(19, 42, 19, 0.3);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        @media (prefers-color-scheme: dark) {
            .button {
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            }
        }
        
        .button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(19, 42, 19, 0.4);
        }
        
        @media (prefers-color-scheme: dark) {
            .button:hover {
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.6);
            }
        }
        
        .footer {
            background: var(--bg-footer);
            margin-top: 30px;
            padding: 25px;
            border-top: 3px solid var(--border-color);
            text-align: center;
            color: var(--text-muted);
            font-size: 13px;
        }
        
        .footer p {
            margin: 8px 0;
            color: var(--text-muted);
        }
        
        .footer strong {
            color: #132A13;
            font-size: 14px;
        }
        
        @media (prefers-color-scheme: dark) {
            .footer strong {
                color: #4ade80;
            }
        }
        
        .footer-note {
            margin-top: 15px;
            font-size: 11px;
            color: var(--text-footer);
            font-style: italic;
        }
        
        /* Status colors - work in both modes */
        .status-menunggu { color: #f59e0b !important; }
        .status-diterima { color: #3b82f6 !important; }
        .status-ditolak { color: #ef4444 !important; }
        .status-selesai { color: #10b981 !important; }
        
        @media only screen and (max-width: 600px) {
            body {
                padding: 10px;
            }
            .email-container {
                border-radius: 8px;
            }
            .header {
                padding: 25px 20px;
            }
            .header h1 {
                font-size: 24px;
            }
            .content {
                padding: 25px 20px;
            }
            .info-row {
                flex-direction: column;
                gap: 5px;
            }
            .info-label {
                min-width: auto;
            }
            .info-value {
                text-align: left;
            }
            .logo-container img {
                max-width: 150px;
            }
        }
        
        /* Force light mode for email clients that don't support dark mode well */
        [data-ogsc] .email-container {
            background-color: #ffffff !important;
            color: #333 !important;
        }
        
        /* Outlook specific fixes */
        <!--[if mso]>
        <style type="text/css">
            .email-container {
                background-color: #ffffff !important;
            }
            .content {
                background-color: #ffffff !important;
                color: #333333 !important;
            }
        </style>
        <![endif]-->
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo-container">
                <img src="{{ asset('images/logoKgBudiman.png') }}" alt="Logo Kampung Budiman" />
            </div>
            <h1>Terima Kasih!</h1>
            <p>Aduan Anda Telah Berjaya Diterima</p>
        </div>
        
        <div class="content">
            <div style="text-align: center;">
                <span class="success-badge">Aduan Diterima</span>
            </div>
            
            <p class="greeting">Yang Dihormati <strong>{{ $complaint->name }}</strong>,</p>
            
            <p class="intro-text">
                Terima kasih kerana menghantar aduan kepada kami. Aduan anda telah berjaya direkodkan dan sedang dalam proses semakan oleh pihak pentadbir. Kami akan memaklumkan anda melalui emel atau telefon sekiranya terdapat kemas kini.
            </p>
            
            <div class="complaint-id">
                ID Aduan: {{ $complaint->public_id ?? '#' . $complaint->id }}
            </div>
            
            <div class="info-section">
                <h3>Maklumat Aduan</h3>
                
                <div class="info-row">
                    <span class="info-label">Nama:</span>
                    <span class="info-value">{{ $complaint->name }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Nombor Telefon:</span>
                    <span class="info-value">{{ $complaint->phone_number }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Emel:</span>
                    <span class="info-value">{{ $complaint->email }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Alamat:</span>
                    <span class="info-value">{{ $complaint->address }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Jenis Aduan:</span>
                    <span class="info-value">{{ $complaint->complaintType->type_name ?? 'N/A' }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="info-value">
                        @php
                            $statusLabels = [
                                'menunggu' => 'Menunggu',
                                'diterima' => 'Diterima',
                                'ditolak' => 'Ditolak',
                                'selesai' => 'Selesai',
                            ];
                            $statusColors = [
                                'menunggu' => '#f59e0b',
                                'diterima' => '#3b82f6',
                                'ditolak' => '#ef4444',
                                'selesai' => '#10b981',
                            ];
                            $status = $statusLabels[$complaint->status] ?? ucfirst($complaint->status);
                            $color = $statusColors[$complaint->status] ?? '#6b7280';
                            $statusClass = 'status-' . $complaint->status;
                        @endphp
                        <span class="{{ $statusClass }}" style="color: {{ $color }}; font-weight: 600;">{{ $status }}</span>
                    </span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Tarikh Dihantar:</span>
                    <span class="info-value">{{ $complaint->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
            
            <div class="description-box">
                <h4>Penerangan Aduan:</h4>
                <p>{{ $complaint->description }}</p>
            </div>
            
            <div class="next-steps">
                <strong>Seterusnya:</strong>
                <ul>
                    <li>Aduan anda akan disemak oleh pihak pentadbir dalam masa terdekat</li>
                    <li>Anda akan dimaklumkan melalui emel atau telefon sekiranya terdapat kemas kini status</li>
                    <li>Anda boleh menyemak status aduan anda di laman web kami pada bila-bila masa</li>
                </ul>
            </div>
            
            <div class="button-container">
                <a href="{{ config('app.url') }}{{ route('public.status.check', [], false) }}" class="button">Semak Status Aduan</a>
            </div>
        </div>
        
        <div class="footer">
            <p><strong>Sistem E-Aduan Kg. Budiman</strong></p>
            <p>© {{ date('Y') }} Sistem E-Aduan Kg. Budiman. Hak cipta terpelihara.</p>
            <p class="footer-note">
                Emel ini dihantar secara automatik. Sila jangan membalas emel ini.
            </p>
        </div>
    </div>
</body>
</html>
