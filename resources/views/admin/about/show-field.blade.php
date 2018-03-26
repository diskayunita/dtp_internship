<div class="tab-pane active" id="id">
      <label for="content" class="col-md-2 control-label">Isi</label>
      <div class="col-md-10">
        {!! $about->translation('id')->first() ? $about->translation('id')->first()->content : '' !!}
      </div>
      <label for="video" class="col-md-2 control-label">link video</label>
      <div class="col-md-10">
        {!! $about->video  !!}
      </div>       
</div>
<div class="tab-pane" id="en">

    <label for="content" class="col-md-2 control-label">Content</label>
    <div class="col-md-10">
      <div class="form-line">
        {!! $about->translation('id')->first() ? ($about->translation('en')->first() ? $about->translation('en')->first()->content : '') : '' !!}
      </div>
    </div> 
      <label for="video" class="col-md-2 control-label">link video</label>
      <div class="col-md-10">
        {!! $about->video  !!}
      </div> 
</div>
