<form action="logic.php" method="POST" enctype="multipart/form-data">
<div class="form-group">
                        <label class="col-sm-3 control-label">
                            logo ลายน้ำ
                        </label>
                        <div class="col-sm-9">
                            <span class="btn btn-default btn-file">
                                <input id="input_water_marks" name="input_water_marks[]" type="file" class="file" multiple data-show-upload="true" data-show-caption="true">
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-3 control-label">
                            รูป
                        </label>
                        <div class="col-sm-9">
                            <span class="btn btn-default btn-file">
                                <input id="input_images" name="input_images[]" type="file" class="file" multiple data-show-upload="true" data-show-caption="true">
                            </span>
                        </div>
                    </div>
                    <button type="subnit">start</button>
</form>