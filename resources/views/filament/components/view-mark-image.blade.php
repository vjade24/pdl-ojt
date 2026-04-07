<div style="
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
    padding: 25px;
    background: linear-gradient(135deg, #1F2A44 100%);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    max-width: 1200px;
    margin: 0 auto;
">
    
    <!-- LEFT COLUMN: IMAGE -->
    <div style="
        position: relative;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        background: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: fit-content;
    ">
        <img 
            src="{{ $getRecord()->marked_image 
                ? url('storage/' . $getRecord()->marked_image) 
                : 'https://via.placeholder.com/500x500?text=No+Image+Available' }}"
            alt="Marked Image"
            style="
                width: 100%;
                height: auto;
                min-height: 400px;
                max-height: 500px;
                object-fit: contain;
                display: block;
                background: #f9fafb;
            "
            onerror="this.src='https://via.placeholder.com/500x500?text=Image+Not+Found'"
        >
        
        <!-- Image Badge -->
        @if($getRecord()->marked_image)
        
        @endif
    </div>

    <!-- RIGHT COLUMN: MARK DETAILS -->
    @php
        $marks = is_array($getRecord()->mark_details)
        ? $getRecord()->mark_details
        : json_decode($getRecord()->mark_details ?? '[]', true);
    @endphp

    <div style="
        background: white;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        display: flex;
        flex-direction: column;
        height: fit-content;
        max-height: 500px;
        overflow-y: auto;
    ">
        
        @if(!empty($marks))
            <!-- Header with Icon -->
            <div style="
                display: flex;
                align-items: center;
                gap: 10px;
                margin-bottom: 20px;
                padding-bottom: 15px;
                border-bottom: 2px solid #e0e7ff;
                position: sticky;
                top: 0;
                background: white;
                z-index: 10;
            ">
                
                <strong style="font-size: 18px; color: #1f2937;">Mark Details</strong>
                <span style="
                    background: #e0e7ff;
                    color: #4f46e5;
                    padding: 3px 10px;
                    border-radius: 20px;
                    font-size: 12px;
                    font-weight: 600;
                    margin-left: auto;
                ">
                    {{ count($marks) }} Mark(s)
                </span>
            </div>

            <!-- Marks List -->
            <div style="display: flex; flex-direction: column; gap: 12px;">
                @foreach($marks as $index => $mark)
                    <div style="
                        background: #f9fafb;
                        border-radius: 12px;
                        padding: 14px;
                        transition: all 0.2s ease;
                        border-left: 4px solid {{ $mark['side'] == 'left' ? '#10b981' : ($mark['side'] == 'right' ? '#3b82f6' : '#8b5cf6') }};
                        cursor: pointer;
                    " 
                    onmouseover="this.style.transform='translateX(5px)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'"
                    onmouseout="this.style.transform='translateX(0)'; this.style.boxShadow='none'">
                        
                        <!-- Mark Number and Side Badge -->
                        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <span style="
                                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                                    color: white;
                                    width: 30px;
                                    height: 30px;
                                    display: inline-flex;
                                    align-items: center;
                                    justify-content: center;
                                    border-radius: 50%;
                                    font-weight: bold;
                                    font-size: 14px;
                                    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                ">{{ $index + 1 }}</span>
                                <strong style="color: #1f2937; font-size: 14px;">Mark Point</strong>
                            </div>
                            
                            <!-- Side Indicator -->
                            <span style="
                                padding: 4px 12px;
                                border-radius: 20px;
                                font-size: 11px;
                                font-weight: 600;
                                text-transform: uppercase;
                                display: inline-flex;
                                align-items: center;
                                gap: 5px;
                                {{ $mark['side'] == 'left' ? 'background: #d1fae5; color: #065f46;' : ($mark['side'] == 'right' ? 'background: #dbeafe; color: #1e40af;' : 'background: #ede9fe; color: #5b21b6;') }}
                            ">
                                {{ ucfirst($mark['side'] ?? 'unspecified') }}
                                @if($mark['side'] == 'left') 
                                @elseif($mark['side'] == 'right') 
                                @else 
                                @endif
                            </span>
                        </div>
                        
                        <!-- Description -->
                        <div style="color: #4b5563; font-size: 13px; line-height: 1.5; padding-left: 40px;">
                            <span style="font-weight: 600; color: #6b7280;">Description:</span>
                            {{ $mark['desc'] ?? 'No description provided' }}
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Footer Note -->
            <div style="
                margin-top: 20px;
                padding-top: 15px;
                border-top: 1px solid #e5e7eb;
                font-size: 12px;
                color: #6b7280;
                text-align: center;
                background: white;
                position: sticky;
                bottom: 0;
            ">
                <span>ℹ️ Scroll to see all {{ count($marks) }} mark(s)</span>
            </div>
        @else
            <!-- Empty State -->
            <div style="
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 60px 20px;
                text-align: center;
                min-height: 400px;
            ">
                <div style="
                    font-size: 64px;
                    margin-bottom: 20px;
                    opacity: 0.7;
                ">🔍</div>
                <strong style="font-size: 16px; color: #374151; display: block; margin-bottom: 10px;">No Mark Details Available</strong>
                <p style="color: #6b7280; font-size: 13px; margin: 0;">No marks have been added to this image yet.</p>
            </div>
        @endif
    </div>
</div>


<style>
    @media (max-width: 768px) {
        div[style*="grid-template-columns: 1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 20px !important;
            padding: 15px !important;
        }
        
        div[style*="max-height: 500px"] {
            max-height: 400px !important;
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    div[style*="border-left: 4px solid"] {
        animation: fadeIn 0.3s ease-out forwards;
    }
    
    /* Custom scrollbar for mark details column */
    div[style*="overflow-y: auto"]::-webkit-scrollbar {
        width: 8px;
    }
    
    div[style*="overflow-y: auto"]::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    div[style*="overflow-y: auto"]::-webkit-scrollbar-thumb {
        background: #c7d2fe;
        border-radius: 10px;
    }
    
    div[style*="overflow-y: auto"]::-webkit-scrollbar-thumb:hover {
        background: #818cf8;
    }
</style>