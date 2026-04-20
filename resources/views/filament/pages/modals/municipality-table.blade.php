<div style="
    background:#f9fafb;
    border:1px solid #e5e7eb;
    border-radius:12px;
    padding:0;
    overflow:hidden;
">

    <!-- HEADER -->
    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        padding:14px 16px;
        border-bottom:1px solid #e5e7eb;
        background:#f3f4f6;
    ">
        <span style="
            font-weight:600;
            font-size:14px;
            color:#374151;
        ">
            Municipality Directory
        </span>

        <!-- RECORD COUNT -->
        <span style="
            background:#facc15;
            color:#92400e;
            font-size:12px;
            padding:4px 10px;
            border-radius:999px;
            font-weight:600;
        ">
            {{ $municipalities->count() }} Records
        </span>
    </div>

    <!-- TABLE -->
    <div style="max-height:350px; overflow:auto;">
        <table style="
            width:100%;
            border-collapse:collapse;
            font-size:14px;
            font-family: 'Inter', sans-serif;
        ">

            <!-- TABLE HEADER -->
            <thead>
                <tr style="
                    background:#f9fafb;
                    text-transform:uppercase;
                    font-size:12px;
                    letter-spacing:.05em;
                    color:#6b7280;
                ">
                    <th style="padding:12px; text-align:left;">#</th>
                    <th style="padding:12px; text-align:left;">Municipality</th>
                    <th style="padding:12px; text-align:left;">Province</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>
                @foreach ($municipalities as $index => $m)
                    <tr style="
                        border-top:1px solid #e5e7eb;
                        background: {{ $index % 2 == 0 ? '#ffffff' : '#f9fafb' }};
                    ">

                        <td style="padding:12px; color:#f59e0b; font-weight:500;">
                            {{ $index + 1 }}
                        </td>

                        <td style="padding:12px; color:#111827;">
                            {{ $m->municipality_name }}
                        </td>

                        <td style="padding:12px; color:#6b7280;">
                            {{ $m->province->province_name ?? '-' }}
                        </td>

                    </tr>
                @endforeach

                @if($municipalities->isEmpty())
                    <tr>
                        <td colspan="3" style="
                            padding:20px;
                            text-align:center;
                            color:#9ca3af;
                        ">
                            No municipalities found.
                        </td>
                    </tr>
                @endif
            </tbody>

        </table>
    </div>

</div>