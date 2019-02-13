<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php if (isset($systemData['systemname'])) {echo $systemData['systemname'];}?></title>
    <link href="<?php echo $this->Url->webroot('/favicon.ico')?>" rel="Shortcut Icon">
    <!-- bootstrap - css -->
    <link href="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/themes/css/bootstrap.min.css')?>" rel="stylesheet">
    <!-- core - css -->
    <link href="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/themes/css/style.css')?>" rel="stylesheet">
    <link href="<?php echo $this->Url->webroot('/css/admin/welcome.css')?>" rel="stylesheet">
    <link href="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/themes/blue/core.css')?>" id="bjui-link-theme" rel="stylesheet">
    <!-- plug - css -->
    <link href="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/kindeditor/themes/default/default.css')?>" rel="stylesheet">
    <link href="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/colorpicker/css/bootstrap-colorpicker.min.css')?>" rel="stylesheet">
    <link href="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/niceValidator/jquery.validator.css')?>" rel="stylesheet">
    <link href="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/bootstrapSelect/bootstrap-select.min.css')?>" rel="stylesheet">
    <link href="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/themes/css/FA/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/uploadify/css/uploadify.css')?>" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lte IE 9]>
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/other/html5shiv.min.js')?>"></script>
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/other/respond.min.js')?>"></script>
    <![endif]-->
    <!-- jquery -->
    <script src="<?php echo $this->Url->webroot('/js/jquery-1.12.4.min.js')?>"></script>
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/js/jquery.cookie.js')?>"></script>
    <!--[if lte IE 9]>
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/other/jquery.iframe-transport.js')?>"></script>
    <![endif]-->
    <!-- BJUI.all 分模块压缩版 -->
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/js/bjui-all.js')?>"></script>
    <!-- plugins -->
    <!-- swfupload for uploadify && kindeditor -->
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/swfupload/swfupload.js')?>"></script>
    <!-- kindeditor -->
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/kindeditor/kindeditor-all.min.js')?>"></script>
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/kindeditor/lang/zh_CN.js')?>"></script>
    <!-- colorpicker -->
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/colorpicker/js/bootstrap-colorpicker.min.js')?>"></script>
    <!-- ztree -->
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/ztree/jquery.ztree.all.min.js')?>"></script>
    <!-- nice validate -->
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/niceValidator/jquery.validator.js?local=zh-CN')?>"></script>
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/niceValidator/jquery.validator.themes.js')?>"></script>
    <!-- bootstrap plugins -->
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/bootstrap.min.js')?>"></script>
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/bootstrapSelect/bootstrap-select.min.js')?>"></script>
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/bootstrapSelect/defaults-zh_CN.min.js')?>"></script>
    <!-- icheck -->
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/icheck/icheck.min.js')?>"></script>
    <!-- other plugins -->
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/other/jquery.autosize.js')?>"></script>
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/uploadify/scripts/jquery.uploadify.min.js')?>"></script>
    <script src="<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/download/jquery.fileDownload.js')?>"></script>
    <!-- init -->
    <script type="text/javascript">
        $(function() {
            BJUI.init({
                JSPATH       : '<?php echo $this->Url->webroot('/assets/b-jui/BJUI/')?>',         //[可选]框架路径
                PLUGINPATH   : '<?php echo $this->Url->webroot('/assets/b-jui/BJUI/plugins/')?>', //[可选]插件路径
                loginInfo    : {url:'<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Users', 'action' => 'relogin']);?>', title:'超时登录', width:500, height:350}, // 会话超时后弹出登录对话框
                statusCode   : {ok:200, error:300, timeout:301}, //[可选]
                ajaxTimeout  : 50000, //[可选]全局Ajax请求超时时间(毫秒)
                pageInfo     : {total:'total', pageCurrent:'pageCurrent', pageSize:'pageSize', orderField:'orderField', orderDirection:'orderDirection'}, //[可选]分页参数
                alertMsg     : {displayPosition:'topcenter', displayMode:'slide', alertTimeout:3000}, //[可选]信息提示的显示位置，显隐方式，及[info/correct]方式时自动关闭延时(毫秒)
                keys         : {statusCode:'statusCode', message:'message'}, //[可选]
                ui           : {
                    windowWidth      : 0,    //框架可视宽度，0=100%宽，> 600为则居中显示
                    showSlidebar     : true, //[可选]左侧导航栏锁定/隐藏
                    clientPaging     : true, //[可选]是否在客户端响应分页及排序参数
                    overwriteHomeTab : false //[可选]当打开一个未定义id的navtab时，是否可以覆盖主navtab(我的主页)
                },
                debug        : true,    // [可选]调试模式 [true|false，默认false]
                theme        : 'material_blue' // 若有Cookie['bjui_theme'],优先选择Cookie['bjui_theme']。皮肤[皮肤:default, orange, purple, blue, red, green, material_blue]
            })

            // main - menu
            $('#bjui-accordionmenu')
                .collapse()
                .on('hidden.bs.collapse', function(e) {
                    $(this).find('> .panel > .panel-heading').each(function() {
                        var $heading = $(this), $a = $heading.find('> h4 > a')

                        if ($a.hasClass('collapsed')) $heading.removeClass('active')
                    })
                })
                .on('shown.bs.collapse', function (e) {
                    $(this).find('> .panel > .panel-heading').each(function() {
                        var $heading = $(this), $a = $heading.find('> h4 > a')

                        if (!$a.hasClass('collapsed')) $heading.addClass('active')
                    })
                })

            $(document).on('click', 'ul.menu-items > li > a', function(e) {
                var $a = $(this), $li = $a.parent(), options = $a.data('options').toObj()
                var onClose = function() {
                    $li.removeClass('active')
                }
                var onSwitch = function() {
                    $('#bjui-accordionmenu').find('ul.menu-items > li').removeClass('switch')
                    $li.addClass('switch')
                }

                $li.addClass('active')
                if (options) {
                    options.url      = $a.attr('href')
                    options.onClose  = onClose
                    options.onSwitch = onSwitch
                    if (!options.title) options.title = $a.text()

                    if (!options.target)
                        $a.navtab(options)
                    else
                        $a.dialog(options)
                }

                e.preventDefault()
            })

            //时钟
            var today = new Date(), time = today.getTime()
            $('#bjui-date').html(today.formatDate('yyyy/MM/dd'));
            $('#bjui-clock').html(today.formatDate('HH:mm:ss'));
            setInterval(function() {
                today = new Date(today.setSeconds(today.getSeconds() + 1));
                $('#bjui-clock').html(today.formatDate('HH:mm:ss'))
            }, 1000)
        })

        //菜单-事件
        function MainMenuClick(event, treeId, treeNode) {
            event.preventDefault()

            if (treeNode.isParent) {
                var zTree = $.fn.zTree.getZTreeObj(treeId)

                zTree.expandNode(treeNode, !treeNode.open, false, true, true)
                return
            }

            if (treeNode.target && treeNode.target == 'dialog')
                $(event.target).dialog({id:treeNode.tabid, url:treeNode.url, title:treeNode.name})
            else
                $(event.target).navtab({id:treeNode.tabid, url:treeNode.url, title:treeNode.name, fresh:treeNode.fresh, external:treeNode.external})
        }
    </script>
</head>
<body>
<!--[if lte IE 9]>
<div id="errorie"><div>您还在使用老掉牙的IE，正常使用系统前请升级您的浏览器到 IE9以上版本 <a target="_blank" href="http://windows.microsoft.com/zh-cn/internet-explorer/ie-8-worldwide-languages">点击升级</a>&nbsp;&nbsp;强烈建议您更改换浏览器：<a href="http://down.tech.sina.com.cn/content/40975.html" target="_blank">谷歌 Chrome</a></div></div>
<![endif]-->
<div id="bjui-window">
    <header id="bjui-header">
        <div class="bjui-navbar-header">
            <button type="button" class="bjui-navbar-toggle btn-default" data-toggle="collapse" data-target="#bjui-navbar-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="bjui-navbar-logo" href="<?php echo $this->request->here()?>">
                <?php
                if (isset($systemData['systemlogo']) && is_file($systemData['systemlogo'])) {
                    ?>
                    <img src="<?php echo $this->request->base . DS . $systemData['systemlogo'];?>">
                    <?php
                }
                if (isset($systemData['systemnamehide']) && $systemData['systemnamehide'] != 1) {
                    echo $systemData['systemname'];
                }
                ?>
            </a>
        </div>
        <nav id="bjui-navbar-collapse">
            <ul class="bjui-navbar-right">
                <li class="datetime"><div><span id="bjui-date"></span> <span id="bjui-clock"></span></div></li>
                <li><a href="#"><?php if (isset($userData)) {echo empty($userData['nickname']) ? $userData['username'] : $userData['nickname'];}?></a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">我的账户 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Users', 'action' => 'resetpasswd']);?>" data-toggle="dialog" data-mask="true" data-width="520" data-height="360">
                                &nbsp;<span class="glyphicon glyphicon-lock"></span> 修改密码&nbsp;
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Users', 'action' => 'myinfo']);?>" data-toggle="dialog" data-width="650" data-height="400" data-id="dialog-mask" data-mask="true">
                                &nbsp;<span class="glyphicon glyphicon-user"></span> 我的资料
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Users', 'action' => 'logout']);?>" class="red">&nbsp;<span class="glyphicon glyphicon-off"></span> 注销登陆</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#" class="dropdown-toggle theme blue" data-toggle="dropdown" title="切换皮肤"><i class="fa fa-tree"></i></a>
                    <ul class="dropdown-menu" role="menu" id="bjui-themes">
                        <li><a href="javascript:;" class="theme_default" data-toggle="theme" data-theme="default">&nbsp;<i class="fa fa-tree"></i> 黑白分明&nbsp;&nbsp;</a></li>
                        <li><a href="javascript:;" class="theme_orange" data-toggle="theme" data-theme="orange">&nbsp;<i class="fa fa-tree"></i> 橘子红了</a></li>
                        <li><a href="javascript:;" class="theme_purple" data-toggle="theme" data-theme="purple">&nbsp;<i class="fa fa-tree"></i> 紫罗兰</a></li>
                        <li class="active"><a href="javascript:;" class="theme_blue" data-toggle="theme" data-theme="blue">&nbsp;<i class="fa fa-tree"></i> 天空蓝</a></li>
                        <li><a href="javascript:;" class="theme_green" data-toggle="theme" data-theme="green">&nbsp;<i class="fa fa-tree"></i> 绿草如茵</a></li>
                        <li><a href="javascript:;" class="theme_material_blue" data-toggle="theme" data-theme="material_blue">&nbsp;<i class="fa fa-tree"></i> Material-Blue</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="bjui-hnav">
            <button type="button" class="btn-default bjui-hnav-more-left" title="导航菜单左移"><i class="fa fa-angle-double-left"></i></button>
            <div id="bjui-hnav-navbar-box">
                <ul id="bjui-hnav-navbar">
                    <?php
                    $i = 1;
                    if (!empty($menuData)) {
                        foreach ($menuData as $item) {
                            ?>
                            <li <?php if($i == 1) {echo "class=active";}?> ><a href="javascript:;" data-toggle="slidebar"><i class="fa <?php echo h($item->icon);?>"></i> <?php echo h($item->name);?></a>
                                <div class="items hide" data-noinit="true">
                                    <?php
                                    if (!empty($item->child)) {
                                        foreach ($item->child as $child) {
                                            ?>
                                            <ul class="menu-items" data-faicon="<?php echo h($child['parent']->icon);?>" data-tit="<?php echo h($child['parent']->name);?>">
                                                <?php
                                                if (!empty($child['child'])) {
                                                    foreach ($child['child'] as $tmp) {
                                                        ?>
                                                        <li><a href="<?php echo h($this->request->base.'/'.$tmp->target);?>" data-reload="true" data-autorefresh="true" data-options="{id:'<?php echo $tmp->reload;?>', faicon:'<?php echo h($tmp->icon);?>', fresh:true}"><?php echo h($tmp->name);?></a></li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </ul>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </li>
                            <?php
                            $i++;
                        }
                    }
                    ?>
                </ul>
            </div>
            <button type="button" class="btn-default bjui-hnav-more-right" title="导航菜单右移"><i class="fa fa-angle-double-right"></i></button>
        </div>
    </header>
    <div id="bjui-container">
        <div id="bjui-leftside">
            <div id="bjui-sidebar-s">
                <div class="collapse"></div>
            </div>
            <div id="bjui-sidebar">
                <div class="toggleCollapse"><h2><i class="fa fa-bars"></i> 导航栏 <i class="fa fa-bars"></i></h2><a href="javascript:;" class="lock"><i class="fa fa-lock"></i></a></div>
                <div class="panel-group panel-main" data-toggle="accordion" id="bjui-accordionmenu" data-heightbox="#bjui-sidebar" data-offsety="26">
                </div>
            </div>
        </div>
        <div id="bjui-navtab" class="tabsPage">
            <div class="tabsPageHeader">
                <div class="tabsPageHeaderContent">
                    <ul class="navtab-tab nav nav-tabs">
                        <li data-url="<?php echo $this->Url->build(['plugin' => $this->request->params['plugin'], 'controller' => 'Welcome', 'action' => 'main']);?>"><a href="javascript:;"><span><i class="fa fa-home"></i> #maintab#</span></a></li>
                    </ul>
                </div>
                <div class="tabsLeft"><i class="fa fa-angle-double-left"></i></div>
                <div class="tabsRight"><i class="fa fa-angle-double-right"></i></div>
                <div class="tabsMore"><i class="fa fa-angle-double-down"></i></div>
            </div>
            <ul class="tabsMoreList">
                <li><a href="javascript:;">#maintab#</a></li>
            </ul>
            <div class="navtab-panel tabsPageContent">
                <div class="navtabPage unitBox">
                    <div class="bjui-pageContent" style="background:#FFF;">
                        Loading...
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer id="bjui-footer">
        <?php
        if (isset($systemData['systemfoot'])) {
            echo h($systemData['systemfoot']);
        }
        ?>
    </footer>
</div>
</body>
</html>