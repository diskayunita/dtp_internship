<!-- Nama Category -->

<div class="form-group">
  <label class="col-sm-3 control-label">Minimal</label>
  <div class="col-sm-4">
    <input placeholder="0" name="minimal" value="{!! $participant_limit->exists ? $participant_limit->minimal : 0 !!}" class="form-control border-input" type="text" required>
  </div>
</div>
<div class="form-group">
  <label class="col-sm-3 control-label">Maximal</label>
  <div class="col-sm-4">
    <input placeholder="0" name="maximal" value="{!! $participant_limit->exists ? $participant_limit->maximal : 0 !!}" class="form-control border-input" type="text" required>
  </div>
</div>

<!-- /Nama Category -->

<!-- Description Category -->

<div class="form-group">
  <label class="col-sm-3 control-label">Decription</label>
  <div class="col-sm-9">
    <textarea placeholder="Decription" name="description" class="form-control border-input">{!! $participant_limit->exists ? $participant_limit->description : '' !!}</textarea>
  </div>
</div>

<!-- /Description Category -->