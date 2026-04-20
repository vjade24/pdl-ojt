<x-filament::page>
    <style>
        .lib-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
            padding: 8px 0;
        }

        .lib-card {
            background: linear-gradient(135deg, #ffffff 0%, #fefefe 100%);
            border-radius: 20px;
            padding: 24px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .lib-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .lib-card:hover::before {
            transform: scaleX(1);
        }

        .lib-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px -12px rgba(0, 0, 0, 0.15);
            border-color: rgba(245, 158, 11, 0.2);
        }

        .lib-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .lib-title {
            font-size: 15px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #6b7280;
        }

        .lib-icon {
            font-size: 28px;
            opacity: 0.7;
            transition: transform 0.2s ease, opacity 0.2s ease;
        }

        .lib-card:hover .lib-icon {
            opacity: 1;
            transform: scale(1.05);
        }

        .lib-stat {
            margin: 16px 0 20px 0;
        }

        .lib-count {
            font-size: 42px;
            font-weight: 800;
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            line-height: 1.1;
            letter-spacing: -1px;
        }

        .lib-sub {
            font-size: 13px;
            color: #9ca3af;
            font-weight: 500;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .lib-badge {
            display: inline-block;
            background: rgba(245, 158, 11, 0.1);
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
            color: #f59e0b;
        }

        /* Button Styles */
        .lib-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            width: 100%;
            margin-top: auto;
            position: relative;
            overflow: hidden;
        }

        .lib-button::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .lib-button:hover::before {
            width: 300px;
            height: 300px;
        }

        .lib-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
        }

        .lib-button:active {
            transform: translateY(0);
        }

        .lib-button span {
            position: relative;
            z-index: 1;
        }

        .lib-button-icon {
            font-size: 18px;
            transition: transform 0.2s ease;
            position: relative;
            z-index: 1;
        }

        .lib-button:hover .lib-button-icon {
            transform: translateX(4px);
        }

        /* Dark mode support */
        @media (prefers-color-scheme: dark) {
            .lib-card {
                background: linear-gradient(135deg, #1f2937 0%, #111827 100%);
                border-color: rgba(255, 255, 255, 0.05);
            }
            
            .lib-title {
                color: #9ca3af;
            }
            
            .lib-sub {
                color: #6b7280;
            }
        }

        /* Mobile optimization */
        @media (max-width: 640px) {
            .lib-grid {
                gap: 16px;
            }
            
            .lib-card {
                padding: 20px;
            }
            
            .lib-count {
                font-size: 36px;
            }
            
            .lib-icon {
                font-size: 24px;
            }
            
            .lib-button {
                padding: 8px 16px;
                font-size: 13px;
            }
        }

        /* Focus state for accessibility */
        .lib-button:focus-visible {
            outline: 2px solid #f59e0b;
            outline-offset: 2px;
            transform: translateY(-2px);
        }
    </style>

    <div class="lib-grid">
       
        <div class="lib-card">
            <div class="lib-header">
                <div class="lib-title">Barangay</div>
               
            </div>

            <div class="lib-stat">
                <div class="lib-count">{{ number_format($barangayCount) }}</div>
                <div class="lib-sub">
                    Total Records
                    <span class="lib-badge">Active</span>
                </div>
            </div>

            <button class="lib-button"
    wire:click="mountAction('viewBarangay')"
    aria-label="View Barangay records">
    
    <span>View Barangays</span>
    <span class="lib-button-icon">→</span>
</button>
        </div>

       
        <div class="lib-card">
            <div class="lib-header">
                <div class="lib-title">Municipality</div>
               
            </div>

            <div class="lib-stat">
                <div class="lib-count">{{ number_format($municipalityCount) }}</div>
                <div class="lib-sub">
                    Total Records
                    <span class="lib-badge">Active</span>
                </div>
            </div>

            <button class="lib-button"
    wire:click="mountAction('viewMunicipality')"
    aria-label="View Municipality records">
    
    <span>View Municipalities</span>
    <span class="lib-button-icon">→</span>
</button>
        </div>

     
        <div class="lib-card">
            <div class="lib-header">
                <div class="lib-title">Province</div>
              
            </div>

            <div class="lib-stat">
                <div class="lib-count">{{ number_format($provinceCount) }}</div>
                <div class="lib-sub">
                    Total Records
                    <span class="lib-badge">Active</span>
                </div>
            </div>

            <button class="lib-button"
    wire:click="mountAction('viewProvince')"
    aria-label="View Province records">
    
    <span>View Provinces</span>
    <span class="lib-button-icon">→</span>
</button>
        </div>


        <div class="lib-card">
            <div class="lib-header">
                <div class="lib-title">Ethnicities</div>
               
            </div>

            <div class="lib-stat">
                <div class="lib-count">{{ number_format($ethnicityCount) }}</div>
                <div class="lib-sub">
                    Total Records
                    <span class="lib-badge">Active</span>
                </div>
            </div>

            <button class="lib-button"
    wire:click="mountAction('viewEthnicity')"
    aria-label="View Ethnicity records">

    <span>View Ethnicities</span>
    <span class="lib-button-icon">→</span>
    </button>
        </div>
    </div>
</x-filament::page>