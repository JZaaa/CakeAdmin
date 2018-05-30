# CakePHP 3.6 + BJUI 快速开发后台模板

默认账号： admin

密码：123456

## 开始使用

### 安装

````
composer install
````

并向``msyql``中导入 根目录下的``cakeadmin.sql``文件

### 其他配置

复制 ``config/app.default.php`` 至 ``config`` 文件下，并重命名为 ``app.php`` , 修改相关配置后，服务器访问本项目即可。


**Linux文件夹权限**

Linux系统可能会出现文件权限的问题，请给以下文件与子文件添加权限：
````
/logs
/tmp
/files
/webroot/assets/b-jui/BJUI/plugins/kindeditor/attached
````

## 更新日志

**2018-05-30**

- 添加``js/css``资源的gzip静态压缩重定向,并添加部分资源gzip压缩。

  默认引入的``js/css``会优先读取返回同目录下同名``jsgz/cssgz`` gzip文件,不存在则读取返回原文件。

  还原默认设置则用``/webroot/.htaccess_bak``替换 ``/webroot/.htaccess``
  
---------------------

**2018-05-25**

- 新增中文全文检索模块 -- ``Admin/SearchIndexTable.php``

  在[系统配置]中启用全文搜索，现在你可以使用mysql来实现基础的全文检索！


### 其他
**项目中使用的部分组件/类：**[Cake-repository](https://github.com/JZaaa/Cake-repository)

