<div style="text-align:center">
    <div 
        id="dropZone" 
        class="drag-drop-zone" 
        ondrop="handleDrop(event)" 
        ondragover="handleDragOver(event)" 
        ondragleave="handleDragLeave(event)">
        <p>Drag & Drop your file here or click to upload</p>
        <input type="file" wire:model="file" id="fileInput" onchange="previewFile()" style="display: none;" />
    </div>
    
    <div class="image-container" style="position: relative;">
        <img id="preview" src="" alt="Image Preview" width="300" style="display: none;"/>
        
        <!-- Draggable Element 1 -->
        <div id="draggable1" class="draggable" style="display: none;">Description</div>
        
        <!-- Draggable Element 2 -->
        <div id="draggable2" class="draggable" style="display: none;">Unique Id</div>
    </div>

    <!-- Coordinates display -->
    <div id="coordinates">
        <p>Coordinates of Element 1: <span id="coords1">X: 0, Y: 0</span></p>
        <p>Coordinates of Element 2: <span id="coords2">X: 0, Y: 0</span></p>
    </div>

    <style>
        .drag-drop-zone {
            border: 2px dashed #ccc;
            padding: 40px;
            cursor: pointer;
            border-radius: 10px;
            width: 300px;
            margin: 0 auto;
            text-align: center;
            transition: background-color 0.2s ease;
        }
    
        .drag-drop-zone.dragover {
            background-color: #f0f0f0;
            border-color: #666;
        }

        .draggable {
            width: 100px;
            height: 50px;
            background-color: #f1c40f;
            color: #000;
            text-align: center;
            line-height: 50px;
            position: absolute;
            top: 50px;
            left: 50px;
            cursor: move;
        }

        .image-container {
            position: relative;
            display: inline-block;
        }

        #coordinates {
            margin-top: 20px;
        }
    </style>
</div>

<script>
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');
    const draggable1 = document.getElementById('draggable1');
    const draggable2 = document.getElementById('draggable2');
    const coords1 = document.getElementById('coords1');
    const coords2 = document.getElementById('coords2');

    // Drag over effect
    function handleDragOver(event) {
        event.preventDefault();
        dropZone.classList.add('dragover');
    }

    // Drag leave effect
    function handleDragLeave(event) {
        event.preventDefault();
        dropZone.classList.remove('dragover');
    }

    // Drop handler
    function handleDrop(event) {
        event.preventDefault();
        dropZone.classList.remove('dragover');

        const files = event.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            previewFile();
        }
    }

    // Handle file selection and preview
    function previewFile() {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
            
            // Display draggable elements when image is loaded
            draggable1.style.display = 'block';
            draggable2.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    // Click to trigger file input
    dropZone.addEventListener('click', function() {
        fileInput.click();
    });

    // Dragging logic with boundary constraints
    function makeElementDraggable(draggableElement, coordsElement) {
        let offsetX = 0, offsetY = 0, mouseX = 0, mouseY = 0;

        draggableElement.onmousedown = function(e) {
            e.preventDefault();
            mouseX = e.clientX;
            mouseY = e.clientY;

            document.onmousemove = function(e) {
                e.preventDefault();

                offsetX = mouseX - e.clientX;
                offsetY = mouseY - e.clientY;
                mouseX = e.clientX;
                mouseY = e.clientY;

                // Get the image container dimensions
                const rect = preview.getBoundingClientRect();
                const imageWidth = rect.width;
                const imageHeight = rect.height;

                // Calculate the new position
                let newTop = draggableElement.offsetTop - offsetY;
                let newLeft = draggableElement.offsetLeft - offsetX;

                // Ensure the element stays within the image boundaries
                if (newTop < 0) newTop = 0;
                if (newLeft < 0) newLeft = 0;
                if (newTop + draggableElement.offsetHeight > imageHeight) {
                    newTop = imageHeight - draggableElement.offsetHeight;
                }
                if (newLeft + draggableElement.offsetWidth > imageWidth) {
                    newLeft = imageWidth - draggableElement.offsetWidth;
                }

                // Update the draggable element's position
                draggableElement.style.top = newTop + "px";
                draggableElement.style.left = newLeft + "px";

                // Calculate and update position relative to the image
                const elemX = newLeft;
                const elemY = newTop;

                coordsElement.innerText = `X: ${Math.round(elemX)}, Y: ${Math.round(elemY)}`;
            };

            document.onmouseup = function() {
                document.onmousemove = null;
                document.onmouseup = null;
            };
        };
    }

    // Make both draggable elements draggable and display their coordinates
    makeElementDraggable(draggable1, coords1);
    makeElementDraggable(draggable2, coords2);
</script>
