{{-- The whole world belongs to you. --}}
{{-- <div>
    <x-filament::input.wrapper class="mb-5">
    <x-filament::input
        type="text"
        wire:model="name"
    />
</x-filament::input.wrapper>

<x-filament::input.wrapper>
    <x-filament::input.select wire:model="status">
        <option value="draft">Draft</option>
        <option value="reviewing">Reviewing</option>
        <option value="published">Published</option>
    </x-filament::input.select>
</x-filament::input.wrapper>
</div> --}}

<div >
    <div class="flex justify-start gap-8 w-full items-center">
        <div>
    <div
        id="dropZone"
        class="drag-drop-zone"
        ondrop="handleDrop(event)"
        ondragover="handleDragOver(event)"
        ondragleave="handleDragLeave(event)">
        <p>Drag & Drop your file here or click to upload</p>
        <input type="file" wire:model="file" id="fileInput" onchange="previewFile()" style="display: none;" />
    </div>


    <div id="coordinates" class="w-full">
        <div class="flex gap-6">
            <div>
        <label for="xCoord1" class="block text-sm font-medium text-gray-700 mb-2">Description X Coordinate:</label>
    <x-filament::input.wrapper class="mb-5">
        <x-filament::input
            type="number"
            wire:model="xCoord1"
            min="0"
            id="xCoord1"
            onchange="updatePosition('draggable1', this.value, 'Y')"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
        />
    </x-filament::input.wrapper>
            </div>

            <div>
    <label for="yCoord1" class="block text-sm font-medium text-gray-700 mb-2">Description Y Coordinate:</label>
    <x-filament::input.wrapper class="mb-5">
        <x-filament::input
            type="number"
            wire:model="yCoord1"
            id="yCoord1"
            min="0"
            onchange="updatePosition('draggable1', this.value, 'X')"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
        />
    </x-filament::input.wrapper>
            </div>
        </div>

        <div class="flex gap-6">
            <div>
    <label for="xCoord2" class="block text-sm font-medium text-gray-700 mb-2">Unique Id X Coordinate:</label>
    <x-filament::input.wrapper class="mb-5">
        <x-filament::input
            type="number"
            wire:model="xCoord2"
            id="xCoord2"
            min="0"
            onchange="updatePosition('draggable2', this.value, 'Y')"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
        />
    </x-filament::input.wrapper>
            </div>

            <div>
    <label for="yCoord2" class="block text-sm font-medium text-gray-700 mb-2">Unique Id Y Coordinate:</label>
    <x-filament::input.wrapper class="mb-5">
        <x-filament::input
            type="number"
            wire:model="yCoord2"
            id="yCoord2"
            min="0"
            onchange="updatePosition('draggable2', this.value, 'X')"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200"
        />
    </x-filament::input.wrapper>
            </div>
        </div>
</div>


        </div>

    <div class="image-container" style="position: relative;">
        <img id="preview" src="" alt="Image Preview" width="300" class="w-full" style="display: none;"/>

        <!-- Draggable Element 1 -->
        <div id="draggable1" class="draggable" style="display: none;">Description</div>

        <!-- Draggable Element 2 -->
        <div id="draggable2" class="draggable" style="display: none;">Unique Id</div>
    </div>
    </div>

    <style>
        .drag-drop-zone {
            border: 2px dashed #ccc;
            padding: 40px;
            cursor: pointer;
            border-radius: 10px;
            width: 26rem;
            height: 16rem;
            margin: 2rem 0.6rem;
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
    </style>
</div>

<script>
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const preview = document.getElementById('preview');
    const draggable1 = document.getElementById('draggable1');
    const draggable2 = document.getElementById('draggable2');

    function handleDragOver(event) {
        event.preventDefault();
        dropZone.classList.add('dragover');
    }

    function handleDragLeave(event) {
        event.preventDefault();
        dropZone.classList.remove('dragover');
    }

    function handleDrop(event) {
        event.preventDefault();
        dropZone.classList.remove('dragover');
        const files = event.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files;
            previewFile();
        }
    }

    function previewFile() {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
            preview.style.display = 'block';
            draggable1.style.display = 'block';
            draggable2.style.display = 'block';
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }

    dropZone.addEventListener('click', function() {
        fileInput.click();
    });

    function makeElementDraggable(draggableElement, coordXInput, coordYInput) {
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

                const rect = preview.getBoundingClientRect();
                const imageWidth = rect.width;
                const imageHeight = rect.height;

                let newTop = draggableElement.offsetTop - offsetY;
                let newLeft = draggableElement.offsetLeft - offsetX;

                if (newTop < 0) newTop = 0;
                if (newLeft < 0) newLeft = 0;
                if (newTop + draggableElement.offsetHeight > imageHeight) {
                    newTop = imageHeight - draggableElement.offsetHeight;
                }
                if (newLeft + draggableElement.offsetWidth > imageWidth) {
                    newLeft = imageWidth - draggableElement.offsetWidth;
                }

                draggableElement.style.top = newTop + "px";
                draggableElement.style.left = newLeft + "px";

                coordXInput.value = Math.round(newLeft);
                coordYInput.value = Math.round(newTop);
            };

            document.onmouseup = function() {
                document.onmousemove = null;
                document.onmouseup = null;
            };
        };
    }

    makeElementDraggable(draggable1, document.getElementById('xCoord1'), document.getElementById('yCoord1'));
    makeElementDraggable(draggable2, document.getElementById('xCoord2'), document.getElementById('yCoord2'));

    function updatePosition(draggableId, value, axis) {
        const draggable = document.getElementById(draggableId);
        const previewRect = preview.getBoundingClientRect();
        const imageWidth = previewRect.width;
        const imageHeight = previewRect.height;

        let newPos = parseInt(value);

        if (axis === 'X') {
            if (newPos < 0) newPos = 0;
            if (newPos + draggable.offsetWidth > imageWidth) {
                newPos = imageWidth - draggable.offsetWidth;
            }
            draggable.style.left = newPos + "px";
        } else {
            if (newPos < 0) newPos = 0;
            if (newPos + draggable.offsetHeight > imageHeight) {
                newPos = imageHeight - draggable.offsetHeight;
            }
            draggable.style.top = newPos + "px";
        }
    }
</script>
