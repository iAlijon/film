<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Kenglik nisbati (Width Ratio)</label>
            <input type="number"
                   name="width_ratio"
                   class="form-control @error('width_ratio') border-danger @enderror"
                   value="{{ old('width_ratio', $widthRatio ?? 16) }}"
                   min="1" max="100"
                   placeholder="16">
            @error('width_ratio')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Balandlik nisbati (Height Ratio)</label>
            <input type="number"
                   name="height_ratio"
                   class="form-control @error('height_ratio') border-danger @enderror"
                   value="{{ old('height_ratio', $heightRatio ?? 9) }}"
                   min="1" max="100"
                   placeholder="9">
            @error('height_ratio')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <label>Tezkor proporsiya tanlash</label>
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-outline-secondary btn-sm ratio-btn" data-w="16" data-h="9">16:9</button>
        <button type="button" class="btn btn-outline-secondary btn-sm ratio-btn" data-w="4" data-h="3">4:3</button>
        <button type="button" class="btn btn-outline-secondary btn-sm ratio-btn" data-w="1" data-h="1">1:1</button>
        <button type="button" class="btn btn-outline-secondary btn-sm ratio-btn" data-w="9" data-h="16">9:16</button>
        <button type="button" class="btn btn-outline-secondary btn-sm ratio-btn" data-w="21" data-h="9">21:9</button>
    </div>
</div>
