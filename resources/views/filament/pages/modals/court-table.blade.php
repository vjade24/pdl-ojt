<div style="max-height: 400px; overflow:auto; border:1px solid #e5e7eb; border-radius:8px;">

    <table style="width:100%; border-collapse: collapse; font-size:14px;">

        <thead style="position: sticky; top: 0; z-index: 1;">
            <tr style="background:#f9fafb; border-bottom:1px solid #e5e7eb;">
                <th style="padding:10px; text-align:left; font-weight:600; width:60px;">#</th>
                <th style="padding:10px; text-align:left; font-weight:600;">Court Name</th>
                <th style="padding:10px; text-align:center; font-weight:600; width:180px;">Actions</th>
            </tr>
        </thead>

        <tbody>
            @foreach($courts as $index => $court)
                <tr style="border-bottom:1px solid #f1f5f9;">
                    
                    <td style="padding:10px;">
                        {{ $index + 1 }}
                    </td>

                    <td style="padding:10px;">
                        {{ $court->court_name }}
                    </td>

                    <td style="padding:10px; text-align:center;">

                        <!-- Edit Button -->
                        <button
                            type="button"
                            wire:click="editCourt({{ $court->id }})"
                            style="
                                background:#3b82f6;
                                color:white;
                                border:none;
                                padding:6px 12px;
                                border-radius:6px;
                                cursor:pointer;
                                margin-right:5px;
                                font-size:13px;
                            "
                        >
                            Edit
                        </button>

                        <!-- Delete Button -->
                        <button
                            type="button"
                            wire:click="deleteCourt({{ $court->id }})"
                            onclick="return confirm('Are you sure you want to delete this court?')"
                            style="
                                background:#ef4444;
                                color:white;
                                border:none;
                                padding:6px 12px;
                                border-radius:6px;
                                cursor:pointer;
                                font-size:13px;
                            "
                        >
                            Delete
                        </button>

                    </td>

                </tr>
            @endforeach
        </tbody>

    </table>

</div>


@if($this->editingCourtId)
    <div style="margin-top:20px; padding:20px; border:1px solid #e5e7eb; border-radius:8px; background:#f9fafb;">
        
        <h3 style="margin-bottom:15px; font-size:16px; font-weight:600;">
            Edit Court
        </h3>

        <input
            type="text"
            wire:model="court_name"
            placeholder="Court Name"
            style="
                width:100%;
                padding:10px;
                border:1px solid #d1d5db;
                border-radius:6px;
                margin-bottom:15px;
            "
        >

        <button
            type="button"
            wire:click="updateCourt"
            style="
                background:#10b981;
                color:white;
                border:none;
                padding:8px 16px;
                border-radius:6px;
                cursor:pointer;
                margin-right:8px;
            "
        >
            Update
        </button>

        <button
            type="button"
            wire:click="$set('editingCourtId', null)"
            style="
                background:#6b7280;
                color:white;
                border:none;
                padding:8px 16px;
                border-radius:6px;
                cursor:pointer;
            "
        >
            Cancel
        </button>

    </div>
@endif
