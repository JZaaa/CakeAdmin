<script type="text/javascript">
    function listpagemain_layout(event, treeId, treeNode) {
        if (treeNode.isParent) {
            var zTree = $.fn.zTree.getZTreeObj(treeId)

            zTree.expandNode(treeNode)
            return
        }
        $(event.target).bjuiajax('doLoad', {url:treeNode.href, target:treeNode.divid})

        event.preventDefault()
    }
</script>
<div class="bjui-pageContent">
    <div style="float:left; width:200px;">
        <ul id="listpagemain-tree" class="ztree" data-toggle="ztree" data-expand-all="true" data-on-click="listpagemain_layout">
            <?php foreach ($data as $item):?>
            <li data-id="<?php echo $item['id']?>" data-href="<?php if (!empty($item['href'])) echo $this->Url->build($item['href']); else echo $this->Url->build(['plugin' => 'Admin', 'controller' => 'Articles', 'action' => 'manage', $item['id'], $item['type'], 'listpagemainbox'])?>" data-divid="#listpagemainbox" data-pid="<?php echo $item['parent_id']?>"><?php echo h($item['name'])?></li>
            <?php endforeach;?>
        </ul>
    </div>
    <div style="margin-left:210px; height:99.9%; overflow:hidden;">
        <div style="height:100%; overflow:hidden;">
            <fieldset style="height:100%;">
                <div id="listpagemainbox" style="height:100%; overflow:hidden;">

                </div>
            </fieldset>
        </div>
    </div>
</div>