<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 10px; color: #1e293b; }

        .header {
            text-align: center;
            border-bottom: 3px solid #1e3a5f;
            padding-bottom: 12px;
            margin-bottom: 20px;
        }
        .header .title { font-size: 16px; font-weight: bold; color: #1e3a5f; }
        .header .subtitle { font-size: 11px; color: #475569; margin-top: 3px; }
        .header .period { font-size: 10px; color: #64748b; margin-top: 2px; }

        .section-title {
            background: #1e3a5f;
            color: white;
            padding: 6px 10px;
            font-size: 11px;
            font-weight: bold;
            margin: 16px 0 8px 0;
            border-radius: 3px;
        }

        table { width: 100%; border-collapse: collapse; margin-bottom: 12px; }
        th { background: #1e3a5f; color: white; padding: 6px 8px; text-align: left; font-size: 9px; }
        td { padding: 5px 8px; border-bottom: 1px solid #e2e8f0; font-size: 9px; }
        tr:nth-child(even) td { background: #f8fafc; }

        .badge { display: inline-block; padding: 2px 6px; border-radius: 10px; font-size: 8px; font-weight: bold; }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef9c3; color: #854d0e; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        .badge-primary { background: #dbeafe; color: #1e40af; }

        .footer {
            margin-top: 30px;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
            font-size: 9px;
            color: #64748b;
            text-align: center;
        }

        .page-break { page-break-after: always; }
    </style>
</head>
