
    <div class="form-group">
        <label for="title" class="ontrol-label">Survey Title</label>
        <input name="title" id="title" type="text" class="form-control border-input" value="{!! $survey->exists ? $survey->title : old('title') !!}" required>
    </div>

    <div class="form-group">
        <label for="type" class="ontrol-label">Survey Type</label>
        <div class="radio-button">
          <label><input type="radio" name="global_type" value="1" {{isset($survey->global_type) ? ($survey->global_type ? "checked" : "") : '' }} required> Global</label>
          <label><input type="radio" name="global_type" {{isset($survey->global_type) ? ($survey->global_type ? "" : "checked") : '' }} value="0"> Specific</label>
        </div>
    </div>

    <div class="form-group">
        <label for="description" class="control-label">Description</label>
        <textarea name="description" id="description" type="text" class="form-control border-input" rows="4" required>{!! $survey->exists ? $survey->description : old('description') !!}</textarea>
    </div>

    <div class="form-group text-center">
        <a href="{!! route('admin.survey.index') !!}" class="btn btn-default btn-fill btn-wd btn-move-left">
            <i class="ti-angle-left"></i> Back
        </a>
        <button type="submit" class="btn btn-primary btn-fill btn-wd">
            <i class="ti-check"></i>
            Submit
        </button>
    </div>
