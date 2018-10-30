# 更新日志

**2018-10-30**

- 修复部分文字显示错误
- 更新日志独立化

---------------------

**2018-10-18**

- 添加ApiController类实现Api类接口Json输出，使用方法请参考``src/Controller/ApiController.php``内说明
- ``app.php``添加Cors跨域配置，配置请方法与参数请参考``app.php``内说明
- 添加XSS防护
- 修复栏目查找带回错误
---------------------


**2018-08-02**

- 修复密码未hash化错误
- 取消默认action权限控制组件的开启
- 由于部分环境原因，取消默认gzip开启，若需此功能请修改``/webroot/.htaccess_gzip``替换 ``/webroot/.htaccess``
  
---------------------

**2018-05-30**

- 添加``js/css``资源的gzip静态压缩重定向,并添加部分资源gzip压缩。

  默认引入的``js/css``会优先读取返回同目录下同名``jsgz/cssgz`` gzip文件,不存在则读取返回原文件。

  还原默认设置则用``/webroot/.htaccess_bak``替换 ``/webroot/.htaccess``
  
---------------------

**2018-05-25**

- 新增中文全文检索模块 -- ``Admin/SearchIndexTable.php``

  在[系统配置]中启用全文搜索，现在你可以使用mysql来实现基础的全文检索！