<style>
    .barangay-table-container {
        max-height: 500px;
        overflow: auto;
        border-radius: 16px;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    /* Custom scrollbar */
    .barangay-table-container::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    .barangay-table-container::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .barangay-table-container::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
        transition: background 0.2s ease;
    }

    .barangay-table-container::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }

    .barangay-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-family: system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
    }

    .barangay-table thead {
        position: sticky;
        top: 0;
        z-index: 10;
        background: #f8fafc;
        backdrop-filter: blur(8px);
    }

    .barangay-table th {
        padding: 14px 16px;
        text-align: left;
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #475569;
        border-bottom: 2px solid #e2e8f0;
        background: #f8fafc;
        white-space: nowrap;
    }

    .barangay-table td {
        padding: 12px 16px;
        font-size: 14px;
        color: #1e293b;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }

    .barangay-table tbody tr {
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .barangay-table tbody tr:hover {
        background: linear-gradient(90deg, #fefce8 0%, #fffbeb 100%);
        transform: scale(1.002);
        cursor: pointer;
    }

    .barangay-table tbody tr:active {
        transform: scale(0.998);
    }

    /* Zebra striping */
    .barangay-table tbody tr:nth-child(even) {
        background-color: #fafafa;
    }

    .barangay-table tbody tr:nth-child(even):hover {
        background: linear-gradient(90deg, #fefce8 0%, #fffbeb 100%);
    }

    /* Number column styling */
    .barangay-table td:first-child,
    .barangay-table th:first-child {
        font-weight: 600;
        color: #f59e0b;
        width: 60px;
        border-right: 1px solid #f1f5f9;
    }

    .barangay-table th:first-child {
        background: #f8fafc;
        border-right: 1px solid #e2e8f0;
    }

    /* Name column styling */
    .barangay-table td:nth-child(2) {
        font-weight: 500;
    }

    /* Municipality column styling */
    .barangay-table td:nth-child(3) {
        color: #64748b;
    }

    /* Empty state styling */
    .empty-state {
        text-align: center;
        padding: 48px 24px;
        color: #94a3b8;
    }

    .empty-state-icon {
        font-size: 48px;
        margin-bottom: 12px;
        opacity: 0.5;
    }

    .empty-state-text {
        font-size: 14px;
        font-weight: 500;
    }

    /* Loading animation */
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }

    .barangay-table.loading tbody tr {
        animation: shimmer 2s infinite linear;
        background: linear-gradient(90deg, #f1f5f9 0%, #e2e8f0 50%, #f1f5f9 100%);
        background-size: 1000px 100%;
    }

    /* Responsive design */
    @media (max-width: 640px) {
        .barangay-table-container {
            border-radius: 12px;
            max-height: 400px;
        }

        .barangay-table th,
        .barangay-table td {
            padding: 10px 12px;
            font-size: 13px;
        }

        .barangay-table td:first-child,
        .barangay-table th:first-child {
            width: 50px;
        }

        /* Make table horizontally scrollable on very small screens */
        .barangay-table {
            min-width: 500px;
        }
        
        .barangay-table-container {
            overflow-x: auto;
        }
    }

    /* Tooltip styling */
    .barangay-table tbody tr {
        position: relative;
    }

    .barangay-table tbody tr:hover::after {
        content: 'Click to view details';
        position: absolute;
        bottom: -30px;
        left: 50%;
        transform: translateX(-50%);
        background: #1e293b;
        color: white;
        padding: 4px 8px;
        border-radius: 6px;
        font-size: 11px;
        white-space: nowrap;
        z-index: 20;
        pointer-events: none;
        animation: fadeInUp 0.2s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateX(-50%) translateY(5px);
        }
        to {
            opacity: 1;
            transform: translateX(-50%) translateY(0);
        }
    }

    /* Selection styling */
    .barangay-table tbody tr:active {
        background: #fef3c7;
    }

    /* Header with counter badge */
    .table-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        background: #ffffff;
        border-bottom: 1px solid #e5e7eb;
        border-radius: 16px 16px 0 0;
    }

    .table-title {
        font-size: 14px;
        font-weight: 600;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .table-title-icon {
        font-size: 18px;
    }

    .record-count {
        background: #fef3c7;
        color: #d97706;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    /* Search input styling */
    .table-search {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 13px;
        width: 200px;
        transition: all 0.2s ease;
    }

    .table-search:focus {
        outline: none;
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .barangay-table-container {
            background: #1e293b;
            border-color: #334155;
        }

        .barangay-table thead th {
            background: #1e293b;
            color: #cbd5e1;
            border-bottom-color: #334155;
        }

        .barangay-table td {
            color: #e2e8f0;
            border-bottom-color: #334155;
        }

        .barangay-table tbody tr:nth-child(even) {
            background-color: #0f172a;
        }

        .barangay-table tbody tr:hover {
            background: linear-gradient(90deg, #1e293b 0%, #334155 100%);
        }

        .barangay-table td:first-child {
            border-right-color: #334155;
            color: #fbbf24;
        }

        .table-header {
            background: #1e293b;
            border-bottom-color: #334155;
        }

        .table-title {
            color: #f1f5f9;
        }

        .record-count {
            background: #334155;
            color: #fbbf24;
        }

        .table-search {
            background: #0f172a;
            border-color: #334155;
            color: #e2e8f0;
        }

        .table-search:focus {
            border-color: #f59e0b;
        }

        .barangay-table-container::-webkit-scrollbar-track {
            background: #0f172a;
        }

        .barangay-table-container::-webkit-scrollbar-thumb {
            background: #475569;
        }
    }
</style>

<div class="barangay-table-container">
    
    <div class="table-header">
        <div class="table-title">
            
            <span>Barangay Directory</span>
        </div>
        <div style="display: flex; gap: 12px; align-items: center;">
            <span class="record-count">{{ $barangays->count() }} Records</span>
            <input type="text" class="table-search" placeholder="Search barangay..." id="searchBarangay" style="display: none;">
        </div>
    </div>

    <table class="barangay-table" id="barangayTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Barangay Name</th>
                <th>Municipality</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($barangays as $index => $b)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 8px;">
                           
                            <span>{{ $b->barangay_name }}</span>
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 6px;">
                            
                            <span>{{ $b->municipality->municipality_name ?? '—' }}</span>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="empty-state">
                       
                        <div class="empty-state-text">No barangays found</div>
                        <div style="font-size: 12px; margin-top: 4px;">Click to add new barangay</div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


<script>
  
</script>