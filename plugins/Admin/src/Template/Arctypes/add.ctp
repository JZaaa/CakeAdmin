<script type="text/javascript">
    function pic_upload_success(file, data) {
        var json = $.parseJSON(data);

        $(this).bjuiajax('ajaxDone', json);
        if (json[BJUI.keys.statusCode] == BJUI.statusCode.ok) {
            $('#j_custom_pic').val(json.filename).trigger('validate');
            $('#j_custom_span_pic').html('<img id="article-pic" src="<?php echo $this->Url->webroot('')?>/'+ json.filename +'" />');
            $('.delpic').show();
        }
    }


    //删除图片
    $('.delpic').click(function() {
        $('#j_custom_pic').val("");
        $('#j_custom_span_pic').html('<img id="article-pic" src="holder.js/150x150?text=文章图片&theme=sky&size=11" />');
        $('.delpic').hide();
        Holder.run({
            images: document.getElementById('article-pic')
        });
    });

</script>
<div class="bjui-pageContent tablecomm">
    <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Arctypes', 'action' => 'add']);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#basic" role="tab" data-toggle="tab">基本信息</a></li>
        </ul>
        <div class="tab-content">
            <!-- 基本信息 -->
            <div class="tab-pane fade active in" id="basic">
                <table class="table table-condensed">
                    <tbody>
                    <tr>
                        <td width="70%">
                            <label for="name" class="control-label x85">栏目名称：</label>
                            <input type="text" name="name" value="" size="35" class="form-control input-nm" data-rule="required">
                            <span style="color:#ff0000;">*</span>
                        </td>
                        <td rowspan="7" style="vertical-align: middle;text-align: center">
                            <div style="display: inline-block; vertical-align: middle;">
                                <i class="iconfont delpic pic-none">&#xe600;</i>
                                <span id="j_custom_span_pic">
                                    <img id="article-pic" src="holder.js/150x150?text=栏目图片&theme=sky&size=11">
                                </span>
                                <div id="j_custom_pic_up" data-toggle="upload" data-uploader="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Upload', 'action' => 'fileupload']);?>"
                                     data-file-size-limit="1024000000"
                                     data-file-type-exts="*.jpg;*.png;*.gif;*.mpg"
                                     data-multi="true"
                                     data-auto="true"
                                     data-on-upload-success="pic_upload_success"
                                     data-icon="cloud-upload"></div>
                                <input type="hidden" name="image" value="" id="j_custom_pic">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x85">上级栏目：</label>
                            <input type="text" name="parent.name" value="<?php if (!empty($data)) {echo $data->name;}?>" class="form-control input-nm" data-title="查找上级栏目" size="35" data-toggle="lookup" data-url="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Arctypes', 'action' => 'lookup']);?>" data-group="parent" data-width="760" data-height="580">
                            <input type="hidden" name="parent.id" value="<?php if (!empty($data)) {echo $data->id;}?>">
                            <input type="hidden" name="parent.level" value="<?php if (!empty($data)) {echo $data->level;}?>">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="control-label x85">属性：</label>
                            <?php foreach ($enable_columns as $key=>$item):?>
                            <input type="checkbox" value="1" id="enable_columns_<?php echo $key?>" name="columns[<?php echo $item['column']?>]" data-toggle="icheck" data-label="<?php echo $item['label']?>" <?php if ($item['default']) echo 'checked'?>>&nbsp;
                            <?php endforeach;?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="name" class="control-label x85">栏目状态：</label>
                            <select name="isshow" data-toggle="selectpicker">
                                <?php
                                foreach($stateData as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="name" class="control-label x85">栏目类型：</label>
                            <select name="type" class="arctypetype" data-toggle="selectpicker">
                                <?php
                                foreach($typeData as $key => $val) {
                                    ?>
                                    <option value="<?php echo $key;?>"><?php echo $val;?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr id="href">
                        <td>
                            <label for="name" class="control-label x85">模块链接：</label>
                            <input type="text" name="href" placeholder="plugin/controller/action" value="" id="input-href" size="35" class="form-control input-nm">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="name" class="control-label x85">栏目描述：</label>
                            <textarea name="description" cols="50" rows="2" size="35"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label for="name" class="control-label x85">栏目排序：</label>
                            <input type="text" name="sort" class="form-control input-nm" value="0" size="35" data-toggle="spinner" data-min="0" data-max="100" data-step="1" data-rule="integer">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close btn-no">关闭</button></li>
        <li><button type="submit" class="btn-blue">保存</button></li>
    </ul>
</div>