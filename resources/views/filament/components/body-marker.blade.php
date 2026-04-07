<div 
x-data="{
    markedImage: @js($getRecord()?->marked_image),
    dots: [],
    selectedIndex: null,
    isDragging: false,

    mark(event) {
        let rect = this.$refs.image.getBoundingClientRect()
        let x = (event.clientX - rect.left) / rect.width
        let y = (event.clientY - rect.top) / rect.height
        
        // Validate coordinates are within image bounds
        x = Math.min(Math.max(x, 0), 1)
        y = Math.min(Math.max(y, 0), 1)

        this.dots.push({ 
            x, 
            y, 
            side: '', 
            desc: '',
            createdAt: new Date().toISOString()
        })

        this.selectedIndex = this.dots.length - 1
        this.updateDots()
    },

    updateDots() {
        this.$wire.set('dots', this.dots)
    },

    selectDot(index) {
        this.selectedIndex = index
    },

    deleteDot() {
        if (this.selectedIndex === null) return
        
        if (confirm('Are you sure you want to delete this mark?')) {
            this.dots.splice(this.selectedIndex, 1)
            this.selectedIndex = null
            this.updateDots()
        }
    },

    undo() {
        if (this.dots.length === 0) return
        this.dots.pop()
        this.selectedIndex = null
        this.updateDots()
    },

    clearAll() {
        if (this.dots.length === 0) return
        if (confirm('Are you sure you want to clear all marks?')) {
            this.dots = []
            this.selectedIndex = null
            this.updateDots()
        }
    },
    
    getSideColor(side) {
        const colors = {
            'left': '#10b981',
            'right': '#3b82f6',
            'front': '#8b5cf6',
            'back': '#f59e0b'
        }
        return colors[side] || '#ef4444'
    }
}"
style="
    background: linear-gradient(135deg, #1F2A44 100%);
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
">

<div style="
    display: grid;
    grid-template-columns: 1fr 400px;
    gap: 25px;
    max-width: 1400px;
    margin: 0 auto;
">
    
    
    <div style="
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    ">
       
        <div style="position: relative; background: #f8f9fa; border-radius: 12px; overflow: hidden;">
            <img 
                x-ref="image"
                :src="markedImage || '/images/body/combined.png'"
                @click="mark($event)"
                style="
                    width: 100%;
                    height: auto;
                    cursor: crosshair;
                    display: block;
                    border-radius: 8px;
                    transition: all 0.3s ease;
                "
                @dragstart.prevent
            >
            
           
            <template x-for="(dot, index) in dots" :key="index">
                <div
                    @click.stop="selectDot(index)"
                    @mouseenter="showTooltip = index"
                    @mouseleave="showTooltip = null"
                    :style="`
                        position: absolute;
                        left: ${dot.x * 100}%;
                        top: ${dot.y * 100}%;
                        transform: translate(-50%, -50%);
                        width: ${selectedIndex === index ? '28px' : '24px'};
                        height: ${selectedIndex === index ? '28px' : '24px'};
                        background: ${selectedIndex === index ? '#fbbf24' : (dot.side ? getSideColor(dot.side) : '#ef4444')};
                        border-radius: 50%;
                        cursor: pointer;
                        border: 3px solid white;
                        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        font-size: 12px;
                        color: white;
                        font-weight: bold;
                        transition: all 0.2s ease;
                        z-index: ${selectedIndex === index ? 10 : 5};
                    `"
                >
                    <span x-text="index + 1"></span>
                    
                   
                    <div x-show="showTooltip === index" 
                         style="
                             position: absolute;
                             bottom: 100%;
                             left: 50%;
                             transform: translateX(-50%);
                             margin-bottom: 8px;
                             background: #1f2937;
                             color: white;
                             padding: 4px 8px;
                             border-radius: 6px;
                             font-size: 11px;
                             white-space: nowrap;
                             pointer-events: none;
                             z-index: 20;
                         ">
                        <span x-text="dot.desc || 'No description'"></span>
                    </div>
                </div>
            </template>
        </div>
        
       
        <div style="
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding: 10px;
            background: #f3f4f6;
            border-radius: 8px;
        ">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 14px; color: #6b7280;">Click on image to add marks</span>
                <span style="
                    background: #e5e7eb;
                    padding: 2px 8px;
                    border-radius: 12px;
                    font-size: 12px;
                    font-weight: 600;
                    color: #374151;
                ">
                    <span x-text="dots.length"></span> mark(s)
                </span>
            </div>
            
            <div style="display: flex; gap: 8px;">
                <button 
            type="button" 
            @click="undo()"
            style="
            background:#374151;
            color:white;
            padding:6px 12px;
            border-radius:6px;
            border:none;
            cursor:pointer;
        "
    >
            Undo
            </button>

        <button 
        type="button" 
        @click="clearAll()"
        style="
        background:#dc2626;
        color:white;
        padding:6px 12px;
        border-radius:6px;
        border:none;
        cursor:pointer;
        "
        >
        Clear
        </button>
            </div>
        </div>
        
     
        <div style="margin-top: 12px; font-size: 11px; color: #9ca3af; text-align: center;">
            Click on any dot to edit its details
        </div>
    </div>

   
    <div style="
        background: white;
        border-radius: 16px;
        padding: 0;
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        overflow: hidden;
    ">
        
        <div style="
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
            color: white;
        ">
            <div style="display: flex; align-items: center; gap: 10px;">
                
                <div>
                    <h3 style="margin: 0; font-size: 18px; font-weight: 600;">Mark Details Editor</h3>
                    <p style="margin: 5px 0 0 0; font-size: 12px; opacity: 0.9;">
                        <span x-text="dots.length"></span> total mark(s) on image
                    </p>
                </div>
            </div>
        </div>
        
    
        <div style="padding: 20px;">
          
            <div x-show="selectedIndex !== null" style="animation: fadeIn 0.3s ease-out;">
                <div style="
                    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
                    padding: 12px;
                    border-radius: 10px;
                    margin-bottom: 20px;
                    border-left: 4px solid #f59e0b;
                ">
                    <div style="display: flex; align-items: center; gap: 8px;">
                       
                        <div>
                            <div style="font-weight: 700; color: #92400e; font-size: 14px;">
                                Editing Mark #<span x-text="selectedIndex + 1"></span>
                            </div>
                            <div style="font-size: 11px; color: #b45309;">
                                Click on image to add more marks
                            </div>
                        </div>
                    </div>
                </div>
                
            
                <label style="
                    display: block;
                    font-size: 13px;
                    font-weight: 600;
                    color: #374151;
                    margin-bottom: 8px;
                ">
                    Body Side
                </label>
                <select 
                    x-model="dots[selectedIndex].side"
                    @change="updateDots()"
                    style="
                        width: 100%;
                        margin-bottom: 20px;
                        background: white;
                        border: 2px solid #e5e7eb;
                        padding: 10px 12px;
                        border-radius: 10px;
                        font-size: 14px;
                        color: #1f2937;
                        cursor: pointer;
                        transition: all 0.2s ease;
                    "
                    @focus="event.target.style.borderColor='#667eea'"
                    @blur="event.target.style.borderColor='#e5e7eb'"
                >
                    <option value="">Select Side</option>
                    <option value="left">Left Side</option>
                    <option value="right">Right Side</option>
                    <option value="front">Front</option>
                    <option value="back">Back</option>
                </select>
                
             
                <label style="
                    display: block;
                    font-size: 13px;
                    font-weight: 600;
                    color: #374151;
                    margin-bottom: 8px;
                ">
                    Description
                </label>
               <style>
        :root {
            --text-color: #1f2937;
            --bg-color: white;
            --border-color: #e5e7eb;
            }
    
    
            @media (prefers-color-scheme: dark) {
        :root {
            --text-color: #f3f4f6;
            --bg-color: #1f2937;
            --border-color: #374151;
            }
         }
    
   
        .dark-mode {
        --text-color: #f3f4f6;
        --bg-color: #1f2937;
        --border-color: #374151;
        }
    
        .light-mode {
        --text-color: #1f2937;
        --bg-color: white;
        --border-color: #e5e7eb;
        }
    </style>

        <input 
        type="text"
        x-model="dots[selectedIndex].desc"
        @blur="updateDots()"
        placeholder="e.g., tattoo, scar, mole, birthmark..."
        style="
        width: 100%;
        padding: 10px 12px;
        border: 2px solid var(--border-color);
        border-radius: 10px;
        font-size: 14px;
        margin-bottom: 20px;
        transition: all 0.2s ease;
        color: var(--text-color);
        background: var(--bg-color);
    "
    >
                
                
                <div style="
                    background: #f9fafb;
                    border-radius: 10px;
                    padding: 15px;
                    margin-bottom: 20px;
                    border: 1px solid #e5e7eb;
                ">
                    <div style="font-size: 12px; color: #6b7280; margin-bottom: 10px;">Current Mark Info</div>
                    <div style="display: flex; gap: 15px; font-size: 13px;">
                        <div>
                            <span style="color: #9ca3af;">Side:</span>
                            <strong x-text="dots[selectedIndex]?.side || 'Not set'" style="color: #1f2937; margin-left: 5px;"></strong>
                        </div>
                        <div>
                            <span style="color: #9ca3af;">Description:</span>
                            <strong x-text="dots[selectedIndex]?.desc || 'Not set'" style="color: #1f2937; margin-left: 5px;"></strong>
                        </div>
                    </div>
                </div>
                
               
                <button 
                    type="button" 
                    @click="deleteDot()"
                    style="
                        width: 100%;
                        background: #fee2e2;
                        color: #dc2626;
                        padding: 10px;
                        border: 2px solid #fecaca;
                        border-radius: 10px;
                        cursor: pointer;
                        font-size: 14px;
                        font-weight: 600;
                        transition: all 0.2s ease;
                    "
                    @mouseover="event.target.style.background='#fecaca'"
                    @mouseout="event.target.style.background='#fee2e2'"
                >
                    Delete This Mark
                </button>
            </div>
            
          
            <div x-show="selectedIndex === null" 
                 style="
                     text-align: center;
                     padding: 60px 20px;
                 ">
               
                <div style="font-size: 16px; font-weight: 600; color: #374151; margin-bottom: 8px;">
                    No Mark Selected
                </div>
                <div style="font-size: 13px; color: #9ca3af;">
                    Click on any dot on the image to edit its details
                </div>
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid #e5e7eb;">
                    <div style="font-size: 12px; color: #6b7280;">
                        <span x-text="dots.length === 0 ? 'Click on the image to add your first mark' : `${dots.length} mark(s) available - click one to edit`"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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
    
    @media (max-width: 768px) {
        div[style*="grid-template-columns: 1fr 400px"] {
            grid-template-columns: 1fr !important;
        }
    }
    
   
    button, select, input {
        transition: all 0.2s ease;
    }
    
    button:active {
        transform: scale(0.98);
    }
</style>
</div>