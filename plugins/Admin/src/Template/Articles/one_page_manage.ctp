<script type="text/javascript">
    function navtab_pic_upload_add_article(file, data) {
        var json = $.parseJSON(data);

        $(this).bjuiajax('ajaxDone', json);
        if (json[BJUI.keys.statusCode] == BJUI.statusCode.ok) {
            $('#navtab-j_input_article_pic').val(json.filename).trigger('validate');
            $('#navtab-j_article_pic').html('<img id="navtab-pic-add-artile" src="<?php echo $this->request->base;?>/'+ json.filename +'" />');
            $('.navtab-delpic').show();
        }
    }

    //删除图片
    $('.navtab-delpic').click(function() {
        $('#navtab-j_input_article_pic').val("");
        $('#navtab-j_article_pic').html('<img id="navtab-pic-add-artile" src="holder.js/200x200?text=文章图片&theme=sky&size=11" />');
        $('.navtab-delpic').hide();
        Holder.run({
            images: document.getElementById('navtab-pic-add-artile')
        });
    });
</script>
<script src="<?php echo $this->request->base;?>/assets/holder/holder.js"></script>
<?php
if (!empty($data['id'])) {
    $url = $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'edit', $data['id'], $divid]);
} else {
    $url = $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Articles', 'action' => 'add', $arctype_id, $divid]);
}
?>
<div class="bjui-pageContent tablecomm">
    <form action="<?php echo $url?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
        <input name="id" type="hidden" value="<?php if(isset($data['id'])) echo $data['id'];?>">
        <input name="arctype_id" type="hidden" value="<?php echo $arctype_id?>">
        <table class="table table-condensed">
            <tbody>
            <tr>
                <td class="colspan-left">
                    <label class="control-label x85">标题：</label>
                    <input type="text" name="title" value="<?php if(isset($data->title)) echo $data->title;?>" size="45" class="form-control input-nm" data-rule="required">
                    <span style="color:#ff0000;">*</span>
                </td>
                <?php if ($rules['image']):?>
                    <td rowspan="5" style="vertical-align: middle; text-align: center">
                        <div style="display: inline-block; vertical-align: middle;">
                            <i class="glyphicon glyphicon-remove navtab-delpic <?php if (!(!empty($data->image) && $this->Pic->url($data->image, '', true))) {echo 'pic-none';}?>"></i>
                            <span id="navtab-j_article_pic">
                            <img id="navtab-pic-add-artile" src="<?php echo $this->Pic->url($data->image, 'holder.js/200x200?text=文章图片&theme=sky&size=11');?>">
                        </span>
                            <div id="navtab-j_article_pic" data-toggle="upload" data-uploader="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Upload', 'action' => 'fileupload']);?>"
                                 data-file-size-limit="1024000000"
                                 data-file-type-exts="*.jpg;*.png;*.gif;*.mpg"
                                 data-multi="true"
                                 data-auto="true"
                                 data-on-upload-success="navtab_pic_upload_add_article"
                                 data-icon="cloud-upload"></div>
                            <input type="hidden" name="image" value="<?php echo $data->image;?>" id="navtab-j_input_article_pic">
                        </div>
                    </td>
                <?php endif;?>
            </tr>
            <?php if ($rules['color']):?>
                <tr>
                    <td>
                        <label for="j_custom_color" class="control-label x85">标题颜色：</label>
                        <input type="text" name="color" id="navtab-j_custom_color" value="<?php if(isset($data->color)) echo $data->color?>" data-toggle="colorpicker" data-bgcolor="true" size="15" readonly style="background-color: <?php if(isset($data->color)) echo $data->color?>">
                        <a href="javascript:;" title="清除颜色" data-toggle="clearcolor" data-target="#j_custom_color">清除颜色</a>
                    </td>
                </tr>
            <?php endif;?>
            <tr>
                <td>
                    <label class="control-label x85">自定义属性：</label>
                    <?php if ($rules['istop']):?>
                        <input type="checkbox" name="istop" id="navtab-j_custom_istop" data-toggle="icheck" <?php if (isset($data->istop) && $data->istop == 1) {echo 'checked';}?> value="1" data-label="置顶">&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php endif;?>
                    <input type="checkbox" name="isshow" id="navtab-j_custom_isshow" data-toggle="icheck" <?php if (isset($data->isshow) && $data->isshow == 2) {echo 'checked';}?> value="2" data-label="隐藏">&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php if ($rules['image'] && $rules['content']):?>
                        <input type="checkbox" name="autoimage" id="navtab-j_custom_autoimage" data-toggle="icheck" <?php if (isset($data->autoimage) && $data->autoimage == 1) {echo 'checked';}?> value="1" data-label="提取内容第一张图片为文章图片">
                    <?php endif;?>
                </td>
            </tr>
            <?php if ($rules['url']):?>
                <tr>
                    <td>
                        <label for="url" class="control-label x85">链接地址：</label>
                        <input type="text" name="url" value="<?php if(isset($data->url)) echo $data->url?>" placeholder="http://" size="45" class="form-control input-nm" data-rule="url">
                    </td>
                </tr>
            <?php endif;?>
            <?php if ($rules['shorttitle']):?>
                <tr>
                    <td>
                        <label class="control-label x85">短标题：</label>
                        <input type="text" name="shorttitle" value="<?php if(isset($data->shorttitle)) echo $data->shorttitle?>" size="25" class="form-control input-nm">
                        <span class="distance"></span>
                    </td>
                </tr>
            <?php endif;?>
            <tr>
                <td>
                    <label class="control-label x85">发布时间：</label>
                    <input type="text" name="pubdate" value="<?php if(isset($data->pubdate)) echo date('Y-m-d H:i:s', strtotime($data->pubdate)); else echo date('Y-m-d H:i:s');?>" data-toggle="datepicker" data-pattern="yyyy-MM-dd HH:mm:ss" size="25" class="form-control input-nm">
                </td>
            </tr>
            <?php if ($rules['keywords']):?>
                <tr>
                    <td>
                        <label class="control-label x85">关键词：</label>
                        <input type="text" name="keywords" size="45" value="<?php if(isset($data->keywords)) echo $data->keywords?>" class="form-control input-nm">
                    </td>
                </tr>
            <?php endif;?>
            <?php if ($rules['description']):?>
                <tr>
                    <td>
                        <label class="control-label x85">摘要：</label>
                        <textarea name="description" cols="45" class="form-control" data-toggle="autoheight"><?php if(isset($data->description)) echo $data->description;?></textarea>
                    </td>
                </tr>
            <?php endif;?>
            <?php if ($rules['content']):?>
                <tr>
                    <td colspan="2">
                        <textarea name="content" data-toggle="kindeditor" style="width: 100%; min-height: 450px;"><?php if(isset($data->content)) echo $data->content;?></textarea>
                    </td>
                </tr>
            <?php endif;?>
            </tbody>
        </table>
    </form>
</div>
<div class="bjui-pageFooter">
    <ul>
        <li><button type="submit" class="btn-blue">保存</button></li>
    </ul>
</div>