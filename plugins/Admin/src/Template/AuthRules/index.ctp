<div class="bjui-pageHeader">
    <form id="pagerForm" data-toggle="ajaxsearch" action="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Roles', 'action' => 'index']);?>" method="post">
    </form>
    <div class="datagrid-toolbar">
        <div class="btn-group" role="group">
            <a href="javascript:;" data-url="<?php echo $this->Url->build(['plugin' => 'Admin', 'controller' => 'AuthRules', 'action' => 'add']);?>" class="btn btn-green" data-toggle="dialog" data-width="600" data-height="350" data-target="roles" data-mask="true" data-icon="plus" id="auth-dialog">添加权限管理</a>
        </div>
        <span class="label label-danger">标签右键可弹出操作菜单</span>
    </div>
</div>

<div class="bjui-pageContent tableContent">
    <table class="table table-bordered table-hover table-striped table-top" id="table">
        <thead>
        <tr>
            <td width="500" align="center">一级权限</td>
            <td align="center">子权限</td>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($data as $item):?>
        <tr>
            <td align="center"><span class="contextmenu" data-parent="0" data-id="<?php echo $item['id']?>"><?php echo h($item['title']), '(' , h($item['name']) , ')'?></span></td>
            <td>
                <?php foreach ($item['children'] as $val):?>
                <span class="label label-success contextmenu" data-parent="<?php echo $val['parent_id']?>" data-id="<?php echo $val['id']?>"><?php echo h($val['title']), '(' , h($val['name']) , ')'?></span>
                <?php endforeach; ?>
            </td>
        </tr>
        <?php endforeach;?>
        </tbody>
    </table>
</div>
<script>
    var dialogOpt = $.CurrentNavtab.find('#auth-dialog').data();
    var childItem = {
        items: [
            {
                icon: 'plus',
                title: '新增菜单',
                func: function(parent, menu) {
                    var opt = $.extend({}, dialogOpt, {
                        title: '新增菜单'
                    })
                    $(this).dialog(opt)
                }
            },
            {
                title : 'diver'
            },
            {
                icon: 'edit',
                title: '编辑菜单',
                func: function(parent, menu) {
                    var opt = $.extend({}, dialogOpt, {
                        title: '编辑菜单',
                        url: '<?php echo $this->Url->build(['plugin' => 'Admin', 'controller' => 'AuthRules', 'action' => 'edit'])?>/' + parent.data('id')
                    })
                    $(this).dialog(opt)
                }
            },
            {
                icon: 'trash',
                title: '删除菜单',
                func: function(parent, menu) {
                    $(this).bjuiajax('doAjax', {
                        url: '<?php echo $this->Url->build(['plugin' => 'Admin', 'controller' => 'AuthRules', 'action' => 'delete'])?>/' + parent.data('id'),
                        confirmMsg: '确定要删除该行信息吗?'
                    })
                }
            }
        ]
    }



    var parentItem = {
        items:[
            {
                icon: 'plus',
                title: '新增菜单',
                func: function(parent, menu) {
                    var opt = $.extend({}, dialogOpt, {
                        title: '新增菜单'
                    })
                    $(this).dialog(opt)
                }
            },
            {
                title : 'diver'
            },
            {
                icon: 'sitemap',
                title: '新增子菜单',
                func: function(parent, menu) {
                    var opt = $.extend({}, dialogOpt, {
                        title: '新增子菜单',
                        data: {
                            parent_id: parent.data('id')
                        }
                    })
                    $(this).dialog(opt)
                }
            },
            {
                icon: 'edit',
                title: '编辑菜单',
                func: function(parent, menu) {
                    var opt = $.extend({}, dialogOpt, {
                        title: '编辑菜单',
                        url: '<?php echo $this->Url->build(['plugin' => 'Admin', 'controller' => 'AuthRules', 'action' => 'edit'])?>/' + parent.data('id')
                    })
                    $(this).dialog(opt)
                }
            },
            {
                icon: 'trash',
                title: '删除菜单',
                func: function(parent, menu) {
                    $(this).bjuiajax('doAjax', {
                        url: '<?php echo $this->Url->build(['plugin' => 'Admin', 'controller' => 'AuthRules', 'action' => 'delete'])?>/' + parent.data('id'),
                        confirmMsg: '确定要删除该行信息吗?'
                    })
                }
            }
        ]
    }
    $.CurrentNavtab.find('#table .contextmenu').each(function () {
        if ($(this).data('parent') === 0) {
            $(this).contextmenu('show', parentItem)
        } else {
            $(this).contextmenu('show', childItem)
        }
    })
</script>
