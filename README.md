CO.kool CMS - PHP Server
===============================

http://cokool.bebu.tech

# Installation
[WebServer]
- Config Nginx/Apache2 Server for these folder:


    /path/to/CO.kool/backend/web
    /path/to/CO.kool/frontend/web
    /path/to/CO.kool/static/web -> 'cdn for files'


[Init project's configs]


    cd /path/to/CO.kool
    php init
    -> change local params in /path/to/CO.kool/common/config/main-local.php
    -> change local params in /path/to/CO.kool/common/config/params-local.php

[DB]
- Create db for cokool, Run these file in your db (Copy & Paste to mysql client tool):

        /path/to/CO.kool/common/modules/adminUser/migrations/init.admin_schema.sql
        /path/to/CO.kool/common/modules/systemSetting/migrations/init.admin_schema.sql
        /path/to/CO.kool/console/migrations/init.sql


- Run these to create working tables:


    cd /path/to/CO.kool
    php yii migrate -> choose yes


More -> please contact ducthang_tran167 (via Skype)