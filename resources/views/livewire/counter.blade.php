{{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

{{-- <div style="text-align:center">
    <button wire:click='increment'>+</button>
    <h1>{{ $count }}</h1>
    <input type="file">
</div> --}}

<div style="text-align:center">
    <h1>hahah</h1>
    
    <input type="file" wire:model="file" id="fileInput" onchange="previewFile()">
    
    @if ($file)
        <img id="preview" src="{{ $file->temporaryUrl() }}" alt="Image Preview" width="200" />
    @endif
</div>

<script>
    function previewFile() {
        const input = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        const file = input.files[0];
        const reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
