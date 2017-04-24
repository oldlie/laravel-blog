<div class="form-group">
    <label for="inputName" class="col-sm-2 control-label">栏目名称：</label>
    <div class="col-sm-10">
        <input type="text" name="name" class="form-control" id="inputName" placeholder="栏目名称" value="{{$name}}">
    </div>
</div>

<div class="form-group">
    <label for="inputParentID" class="col-sm-2 control-label">上级栏目：</label>

    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-4">
                <button class="btn btn-default" type="button"
                        data-toggle="modal" data-target="#selectParentIDModal"
                        style="width: 100%;"> 选择上一级栏目</button>
            </div>
            <div class="col-sm-8">
                <input name="p_name" type="text" readonly="readonly" class="form-control" id="inputParentCategory" value="{{$p_name}}">
            </div>
        </div>
        <input type="hidden" name="parent_id" id="inputParentID" value="{{$parent_id}}">
    </div>
</div>

<div class="form-group">
    <label for="inputImage" class="col-sm-2 control-label">栏目题图：</label>

    <div class="col-sm-10">
        <input type="file" class="form-control" id="fileImage">
        <div id="fileImageProgressBar" class="progress hide">
            <div class="progress-bar progress-bar-primary progress-bar-striped active"
                 role="progressbar"
                 aria-valuenow="0" aria-valuemin="0"
                 aria-valuemax="100" style="width: 100%">
                <span class="sr-only">0% Complete (success)</span>
            </div>
        </div>
        @if ($image != '')
            <img id="imgCategory" class="img img-thumbnail" src="{{url('uploads/images/category') . $image}}">
        @else
            <img id="imgCategory" class="img img-thumbnail">
        @endif
        <input type="hidden" name="image" class="form-control" id="inputImage" placeholder="栏目题图">
    </div>
</div>

<div class="form-group">
    <label for="inputOrder" class="col-sm-2 control-label">显示顺序：</label>
    <div class="col-sm-10">
        <input type="number" name="order" class="form-control" id="inputOrder" placeholder="显示顺序" value="{{$order or 0}}">
    </div>
</div>