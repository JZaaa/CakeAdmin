<div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="<?php echo $this->Url->build(['plugin' => 'Admin', 'controller' => 'Articles', 'action' => 'picPageManage', $arctype_id, $divid])?>" method="post">
        <input type="hidden" name="pageSize" value="<?php echo $numPerPage ?>">
        <input type="hidden" name="pageCurrent" value="1">
        <div class="bjui-searchBar">
            <label>标题：</label><input type="text" value="<?php if (isset($title)) echo $title?>" name="title" size="10">&nbsp;
            <button type="submit" class="btn-default" data-icon="search">查询</button>&nbsp;
            <a class="btn btn-orange" href="javascript:;" data-toggle="reloadsearch" data-clear-query="true" data-icon="undo">清空查询</a>
            <div class="pull-right">
                <div class="btn-group" role="group">
                    <a href="<?php echo $this->Url->build(['plugin' => 'Admin', 'controller' => 'Articles', 'action' => 'add', $arctype_id, $divid]);?>" class="btn btn-green" data-toggle="dialog" data-width="1000" data-height="500" data-target="roles" data-mask="true" data-icon="plus">添加</a>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="bjui-pageContent tableContent" id="pic_page_box">
    <?php foreach ($data as $item):?>
    <div class="pic-item-box">
        <div href="javascript:;" class="thumbnail">
            <img src="<?php echo $this->Url->webroot($item['image'])?>">
            <div class="caption">
                <p class="text-center text-ellipsis">
                    <?php if ($item['isshow'] == 2):?>
                    <span class="label label-default">隐藏</span>
                    <?php elseif ($item['istop'] == 1):?>
                    <span class="label label-danger">置顶</span>
                    <?php endif;?>
                    <?php echo $item['title']?>
                </p>
                <div class="text-center">
                    <button class="btn btn-primary" data-url="<?php echo $this->Url->build(['plugin' => 'Admin', 'controller' => 'Articles', 'action' => 'edit', $item['id'], $divid]);?>" data-toggle="dialog" data-width="1000" data-height="500" data-target="roles" data-mask="true">编辑</button>
                    <button data-url="<?php echo $this->Url->build(['plugin' => 'Admin', 'controller' => 'Articles', 'action' => 'delete', $item->id, $divid]);?>" class="btn btn-danger" data-toggle="doajax" data-confirm-msg="确定要删除该行信息吗">删除</button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach;?>

</div>
<div class="bjui-pageFooter">
    <div class="pages">
        <span>每页&nbsp;</span>
        <div class="selectPagesize">
            <select data-toggle="selectpicker" data-toggle-change="changepagesize">
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="50">50</option>
            </select>
        </div>
        <span>&nbsp;条，共 <?php echo str_replace(',', '', $this->Paginator->counter('{{count}}'));?> 条</span>
    </div>
    <div class="pagination-box" data-toggle="pagination"
         data-total="<?php echo str_replace(',', '', $this->Paginator->counter('{{count}}'));?>"
         data-page-size="<?php echo $numPerPage; ?>"
         data-page-current="1">
    </div>
</div>
