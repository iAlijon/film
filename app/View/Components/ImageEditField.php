<?php

namespace App\View\Components;


use Illuminate\View\Component;

class ImageEditField extends Component
{
    public string $currentImage;
    public string $inputName;
    public string $fieldId;

    public function __construct(?string $image = null, string $inputName = 'image', string $fieldId = 'image')
    {
        $this->currentImage = $image ? asset($image) : '';
        $this->inputName = $inputName;
        $this->fieldId = $fieldId . '_' . uniqid();
    }

    public function render()
    {
        return view('admin.components.image-edit-field');
    }
}
