<div 
    x-data="{
        markedImage: @js($getRecord()?->marked_image),

        views: ['front', 'back', 'right', 'left'],
        currentIndex: 0,

        x: 0,
        y: 0,
        visible: false,

        get imageUrl() {
            return '/images/body/' + this.views[this.currentIndex] + '.jpg'
        },

        isLast() {
            return this.currentIndex === this.views.length - 1
        },

        init() {
            this.setView()
        },

        mark(event) {
            let rect = this.$refs.image.getBoundingClientRect()

            this.x = ((event.clientX - rect.left) / rect.width)
            this.y = ((event.clientY - rect.top) / rect.height)

            this.visible = true
        },

        async saveImage() {
            let img = this.$refs.image
            let canvas = this.$refs.canvas
            let ctx = canvas.getContext('2d')

            canvas.width = img.naturalWidth
            canvas.height = img.naturalHeight

            // draw base image
            ctx.drawImage(img, 0, 0)

            let px = this.x * canvas.width
            let py = this.y * canvas.height

            // draw red dot
            ctx.fillStyle = 'red'
            ctx.beginPath()
            ctx.arc(px, py, 10, 0, Math.PI * 2)
            ctx.fill()

            let base64 = canvas.toDataURL('image/png')

            // save to Livewire
            let fileName = await this.$wire.saveMarkedImage(base64)

            // update image instantly
            this.markedImage = fileName
        },

        async next() {
            if (!this.visible) {
                alert('Please mark first!')
                return
            }

            await this.saveImage()

            this.currentIndex++

            if (this.currentIndex >= this.views.length) {
                return
            }

            this.visible = false
            this.setView()
        },

        async saveFinal() {
            if (!this.visible) {
                alert('Please mark first!')
                return
            }

            await this.saveImage()

            console.log('Saved! Click CREATE')
        },

        setView() {
            this.$refs.view.value = this.views[this.currentIndex]
        }
    }"
    x-init="init()"
    style="width: 300px;"
>

    <div style="position: relative;">

      
        <div
            x-text="views[currentIndex].toUpperCase()"
            style="
                position:absolute;
                top:8px;
                left:8px;
                background: rgba(0,0,0,0.7);
                color: white;
                padding: 4px 10px;
                border-radius: 6px;
                font-size: 12px;
                font-weight: bold;
                z-index: 10;
            "
        ></div>

        <img 
            x-ref="image"
            :src="markedImage 
                ? '/storage/' + markedImage 
                : imageUrl"
            @click="mark($event)"
            style="width:100%; cursor:crosshair;"
        >

       


        <div
            x-show="visible"
            :style="`
                position:absolute;
                left:${x * 100}%;
                top:${y * 100}%;
                transform:translate(-50%, -50%);
                width:12px;
                height:12px;
                background:red;
                border-radius:50%;
            `"
        ></div>

    </div>

    
    <canvas x-ref="canvas" style="display:none;"></canvas>

   
    <input type="hidden" x-ref="view" wire:model="view_type">

   
    <div style="margin-top:10px; display:flex; gap:10px;">

        
        <button 
            type="button" 
            x-show="!isLast()" 
            @click="next()"
        >
            Next
        </button>

       
        <button 
            type="button" 
            x-show="isLast()" 
            @click="saveFinal()"
            style="background: green; color: white;"
        >
            Save
        </button>

    </div>

</div>