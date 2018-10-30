<script type="text/javascript">
    function pic_upload_add_article(file, data) {
        var json = $.parseJSON(data);

        $(this).bjuiajax('ajaxDone', json);
        if (json[BJUI.keys.statusCode] == BJUI.statusCode.ok) {
            $('#j_input_article_pic').val(json.filename).trigger('validate');
            $('#j_article_pic').html('<img id="pic-add-artile" src="$this->Url->webroot('')/'+ json.filename +'" />');
            $('.delpic').show();
        }
    }

    //删除图片
    $('.delpic').click(function() {
        $('#j_input_article_pic').val("");
        $('#j_article_pic').html('<img id="pic-add-artile" src="holder.js/200x200?text=文章图片&theme=sky&size=11" />');
        $('.delpic').hide();
        Holder.run({
            images: document.getElementById('pic-add-artile')
        });
    });
</script>
<div class="bjui-pageContent tablecomm">
    <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'edit', $data->id, $divid]);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
        <input name="id" type="hidden" value="<?php echo $data->id;?>">
        <table class="table table-condensed">
            <tbody>
            <tr>
                <td class="colspan-left">
                    <label class="control-label x85">标题：</label>
                    <input type="text" name="title" value="<?php echo h($data->title);?>" size="45" class="form-control input-nm" data-rule="required">
                    <span style="color:#ff0000;">*</span>
                </td>
                <?php if ($rules['image']):?>
                <td rowspan="5" style="vertical-align: middle; text-align: center">
                    <div style="display: inline-block; vertical-align: middle;">
                        <i class="glyphicon glyphicon-remove delpic <?php if (!(!empty($data->image) && $this->Pic->url($data->image, '', true))) {echo 'pic-none';}?>"></i>
                        <span id="j_article_pic">
                            <img id="pic-add-artile" src="<?php echo $this->Pic->url($data->image, 'holder.js/200x200?text=文章图片&theme=sky&size=11');?>">
                        </span>
                        <div id="j_article_pic" data-toggle="upload" data-uploader="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Upload', 'action' => 'fileupload']);?>"
                             data-file-size-limit="1024000000"
                             data-file-type-exts="*.jpg;*.png;*.gif;*.mpg"
                             data-multi="true"
                             data-auto="true"
                             data-on-upload-success="pic_upload_add_article"
                             data-icon="cloud-upload"></div>
                        <input type="hidden" name="image" value="<?php echo h($data->image);?>" id="j_input_article_pic">
                    </div>
                </td>
                <?php endif;?>
            </tr>
            <?php if ($rules['color']):?>
                <tr>
                    <td>
                        <label for="j_custom_color" class="control-label x85">标题颜色：</label>
                        <input type="text" name="color" id="j_custom_color" value="<?php echo $data->color?>" data-toggle="colorpicker" data-bgcolor="true" size="15" readonly style="background-color: <?php echo $data->color?>">
                        <a href="javascript:;" title="清除颜色" data-toggle="clearcolor" data-target="#j_custom_color">清除颜色</a>
                    </td>
                </tr>
            <?php endif;?>
            <tr>
                <td>
                    <label class="control-label x85">自定义属性：</label>
                    <?php if ($rules['istop']):?>
                    <input type="checkbox" name="istop" id="j_custom_istop" data-toggle="icheck" <?php if ($data->istop == 1) {echo 'checked';}?> value="1" data-label="置顶">&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php endif;?>
                    <input type="checkbox" name="isshow" id="j_custom_isshow" data-toggle="icheck" <?php if ($data->isshow == 2) {echo 'checked';}?> value="2" data-label="隐藏">&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php if ($rules['image'] && $rules['content']):?>
                    <input type="checkbox" name="autoimage" id="j_custom_autoimage" data-toggle="icheck" <?php if ($data->autoimage == 1) {echo 'checked';}?> value="1" data-label="提取内容第一张图片为文章图片">
                    <?php endif;?>
                </td>
            </tr>
            <?php if ($rules['url']):?>
                <tr>
                    <td>
                        <label for="url" class="control-label x85">链接地址：</label>
                        <input type="text" name="url" value="<?php echo h($data->url)?>" placeholder="http://" size="45" class="form-control input-nm" data-rule="url">
                    </td>
                </tr>
            <?php endif;?>
            <?php if ($rules['shorttitle']):?>
                <tr>
                    <td>
                        <label class="control-label x85">短标题：</label>
                        <input type="text" name="shorttitle" value="<?php echo h($data->shorttitle)?>" size="25" class="form-control input-nm">
                        <span class="distance"></span>
                    </td>
                </tr>
            <?php endif;?>
            <tr>
                <td>
                    <label class="control-label x85">发布时间：</label>
                    <input type="text" name="pubdate" value="<?php echo date('Y-m-d H:i:s', strtotime($data->pubdate));?>" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss" size="25" class="form-control input-nm">
                </td>
            </tr>
            <?php if ($rules['keywords']):?>
                <tr>
                    <td>
                        <label class="control-label x85">关键词：</label>
                        <input type="text" name="keywords" size="45" value="<?php echo h($data->keywords)?>" class="form-control input-nm">
                    </td>
                </tr>
            <?php endif;?>
            <?php if ($rules['description']):?>
            <tr>
                <td>
                    <label class="control-label x85">摘要：</label>
                    <textarea name="description" cols="45" class="form-control" data-toggle="autoheight"><?php echo h($data->description);?></textarea>
                </td>
            </tr>
            <?php endif;?>
            <?php if ($rules['content']):?>
            <tr>
                <td colspan="2">
                    <textarea name="content" data-toggle="kindeditor" style="width: 100%; min-height: 450px;"><?php echo h($data->content);?></textarea>
                </td>
            </tr>
            <?php endif;?>
            </tbody>
        </table>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="button" class="btn-close btn-no">关闭</button></li>
        <li><button type="submit" class="btn-blue">保存</button></li>
    </ul>
</div>