<div>
    <!-- The biggest battle is the war against ignorance. - Mustafa Kemal Atatürk -->

    <div class="form-group">
        <label>{{ labels('image') }}</label>

        <div class="image-edit-wrapper mb-2">
            <img id="currentImage_{{ $fieldId }}"
                 src="{{ $currentImage }}"
                 data-original="{{ $currentImage }}"
                 alt="{{ labels('image') }}"
                 style="max-width: 200px; display: {{ $currentImage ? 'block' : 'none' }}; margin-bottom: 10px;">

            <input type="file" name="{{ $inputName }}" id="imageInput_{{ $fieldId }}"
                   class="form-control @error($inputName) border-danger @enderror"
                   accept="image/jpeg,image/jpg,image/png,image/gif"
                   style="{{ $currentImage ? 'display: none;' : '' }}">

            @if($currentImage)
                <div id="imageButtons_{{ $fieldId }}">
                    <button type="button" class="btn btn-primary btn-sm mt-2 edit-image-btn"
                            data-target="{{ $fieldId }}">
                        O'zgartirish
                    </button>
                </div>

                <div id="editControls_{{ $fieldId }}" style="display: none;">
                    <button type="button" class="btn btn-secondary btn-sm mt-2 cancel-image-btn"
                            data-target="{{ $fieldId }}">
                        Bekor qilish
                    </button>
                </div>
            @endif
        </div>

        <small class="text-danger">{{ $errors->first($inputName) }}</small>
    </div>
</div>
