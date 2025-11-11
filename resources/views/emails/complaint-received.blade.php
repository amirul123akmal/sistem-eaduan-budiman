<!DOCTYPE html>
<html lang="ms">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aduan Baharu Diterima</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header {
            background: linear-gradient(135deg, #132A13 0%, #2F4F2F 100%);
            color: white;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0 0 10px 0;
            font-size: 24px;
        }
        .header p {
            margin: 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .alert-badge {
            display: inline-block;
            background-color: #f59e0b;
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            margin: 15px 0;
        }
        .content {
            padding: 20px 0;
        }
        .info-section {
            background-color: #F0F7F0;
            border-left: 4px solid #132A13;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #e5e7eb;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #132A13;
            min-width: 140px;
        }
        .info-value {
            color: #333;
            text-align: right;
            flex: 1;
        }
        .complaint-id {
            background: linear-gradient(135deg, #132A13 0%, #2F4F2F 100%);
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
        }
        .description-box {
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 2px solid #F0F7F0;
            text-align: center;
            color: #666;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            background: linear-gradient(135deg, #132A13 0%, #2F4F2F 100%);
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .priority-box {
            background-color: #fef3c7;
            border: 2px solid #f59e0b;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>🔔 Aduan Baharu Diterima</h1>
            <p>Tindakan Segera Diperlukan</p>
        </div>
        
        <div class="content">
            <div style="text-align: center;">
                <span class="alert-badge">⚠ Aduan Baharu</span>
            </div>
            
            <p>Yang Dihormati <strong>Pentadbir</strong>,</p>
            
            <p>Satu aduan baharu telah diterima melalui sistem E-Aduan Budiman. Sila semak dan ambil tindakan yang sewajarnya.</p>
            
            <div class="complaint-id">
                ID Aduan: {{ $complaint->public_id ?? '#' . $complaint->id }}
            </div>
            
            <div class="priority-box">
                <strong>⚠ Status:</strong> 
                @php
                    $statusLabels = [
                        'menunggu' => 'Menunggu Tindakan',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                        'selesai' => 'Selesai',
                    ];
                @endphp
                <span style="color: #f59e0b; font-weight: bold;">
                    {{ $statusLabels[$complaint->status] ?? ucfirst($complaint->status) }}
                </span>
            </div>
            
            <div class="info-section">
                <h3 style="margin-top: 0; color: #132A13;">Maklumat Pengadu</h3>
                
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
            </div>
            
            <div class="info-section">
                <h3 style="margin-top: 0; color: #132A13;">Maklumat Aduan</h3>
                
                <div class="info-row">
                    <span class="info-label">Jenis Aduan:</span>
                    <span class="info-value">{{ $complaint->complaintType->type_name ?? 'N/A' }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Tarikh Dihantar:</span>
                    <span class="info-value">{{ $complaint->created_at->format('d/m/Y H:i') }}</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Masa Dihantar:</span>
                    <span class="info-value">{{ $complaint->created_at->diffForHumans() }}</span>
                </div>
            </div>
            
            <div class="description-box">
                <h4 style="margin-top: 0; color: #132A13;">Penerangan Aduan:</h4>
                <p style="margin-bottom: 0; white-space: pre-wrap;">{{ $complaint->description }}</p>
            </div>
            
            @if($complaint->hasImages())
                <div style="margin: 20px 0; padding: 15px; background-color: #f0f9ff; border-left: 4px solid #3b82f6; border-radius: 5px;">
                    <strong>📎 Lampiran:</strong> Aduan ini mengandungi {{ count($complaint->images) }} gambar.
                </div>
            @endif
            
            <p><strong>Tindakan yang perlu diambil:</strong></p>
            <ul>
                <li>Semak maklumat aduan di panel pentadbir</li>
                <li>Kemaskini status aduan mengikut tindakan yang diambil</li>
                <li>Berikan komen atau maklum balas kepada pengadu jika perlu</li>
            </ul>
            
            <div style="text-align: center;">
                <a href="{{ config('app.url') }}/admin/complaints/{{ $complaint->id }}" class="button">Lihat Aduan di Panel</a>
            </div>
        </div>
        
        <div class="footer">
            <p><strong>Sistem E-Aduan Kg. Budiman</strong></p>
            <p>© {{ date('Y') }} Sistem E-Aduan Kg. Budiman. All rights reserved.</p>
            <p style="margin-top: 10px; font-size: 11px; color: #999;">
                Emel ini dihantar secara automatik. Sila jangan membalas emel ini.
            </p>
        </div>
    </div>
</body>
</html>

