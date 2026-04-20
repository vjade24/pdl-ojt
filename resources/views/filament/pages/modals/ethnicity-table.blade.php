<div style="max-height: 400px; overflow:auto; border:1px solid #e5e7eb; border-radius:8px;">

    <table style="width:100%; border-collapse: collapse; font-size:14px;">

        <thead style="position: sticky; top: 0; z-index: 1;">
            <tr style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                <th style="padding:10px; text-align:left; font-weight:600; width:60px;">#</th>
                <th style="padding:10px; text-align:left; font-weight:600;">Ethnicity Name</th>
            </tr>
        </thead>

        <tbody>
            @foreach($ethnicities as $index => $ethnicity)
                <tr style="border-bottom:1px solid #f1f5f9;">
                    
                    <td style="padding:10px;">
                        {{ $index + 1 }}
                    </td>

                    <td style="padding:10px;">
                        {{ $ethnicity->ethnicity_name }}
                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

</div>