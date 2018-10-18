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

## 定制开发模块推荐

``arctype`` 表中存在存在 ``keywords`` 字段,利用此字段标识将要开发对应模块，并创建其子模块，例如：

````php
    /**
     * 获取栏目关键字，修改原关键字请确保ArticlesTable 内文章具体分类不受影响
     * @param null $key
     * @return array|mixed
     */
    public function getKey($key = null)
    {
        $data = [
            'index' => '首页',
            'about' => '关于我们'
        ];

        $data = array_merge(
            $data,
            $this->getIndexKeywords(),
            $this->getAboutKeywords()
        );

        return !empty($key) ? $data[$key] : $data;
    }
    
     /**
       * 获取首页keywords
       * @return array
       */
     public function getIndexKeywords() {
        return [
            'index-banner' => '首页banner',
            'index-article-0' => '首页文章1',
            'news-0' => '新闻'
            ];
     }
     
     // ....

```` 

定义类似keywords获取函数后，再创建对应栏目与菜单,菜单内容可复制``Template/list_page_main.ctp`` 进行修改，并根据程序中自定义keywords获取内容树。如不存在特殊功能的，后台文章内容部分工作就已经完成了。

## 更新日志

**2018-10-18**

- 添加ApiController类实现Api类接口Json输出，使用方法请参考``src/Controller/ApiController.php``内说明
- ``app.php``添加Cors跨域配置，配置请方法与参数请参考``app.php``内说明
- 添加XSS防护
- 修复栏目查找带回错误

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


### 其他
**项目中使用的部分组件/类：**[Cake-repository](https://github.com/JZaaa/Cake-repository)

