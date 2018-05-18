<div class="bjui-pageContent">
    <form action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'AuthRules', 'action' => 'edit', $data['id']]);?>" class="pageForm" data-toggle="validate" data-reloadNavtab="ture" >
        <input type="hidden" name="id" value="<?php echo $data['id']?>">
        <table class="table table-condensed table-hover">
            <tbody>
            <tr>
                <td>
                    <label for="title" class="control-label x85">名称：</label>
                    <input type="text" name="title" value="<?php echo $data['title']?>" size="35" class="form-control input-nm" data-rule="required">
                    <span style="color:#ff0000;">*</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="name" class="control-label x85">唯一标识：</label>
                    <input type="text" name="name" size="35" class="form-control input-nm" placeholder="填写规则(非url)：plugin/controller/action，不区分大小写" value="<?php echo $data['name']?>" data-rule="required">
                    <span style="color:#ff0000;">*</span>
                </td>
            </tr>
            <tr>
                <td>
                    <label class="control-label x85">上级权限：</label>
                    <select data-toggle="selectpicker" data-live-search="true" name="parent_id">
                        <option value="">一级权限</option>
                        <?php foreach ($parents as $key=>$item):?>
                        <option <?php if ($data['parent_id'] == $key) echo 'selected'?> value="<?php echo $key?>"><?php echo $item?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
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