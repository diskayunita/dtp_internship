<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    <label class="col-sm-3 control-label">Title</label>
    <div class="col-sm-9">
        <input placeholder="Judul" name="title" value="{!! isset($blocked->title) ? $blocked->title : '' !!}" class="form-control border-input" type="text" required>
    </div>
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
  <label class="col-sm-3 control-label">Date</label>
  <div class="col-sm-9">
        <input id="datepicker" placeholder="Tanggal" name="date" value="{!! isset($blocked->date) ? $blocked->date : '' !!}" class="form-control border-input" type="text" required>
  </div>
</div>