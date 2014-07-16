## 一个调查问卷程序，有后台，有酷炫前台

![image](https://github.com/billyct/ReportCMS/raw/master/screenshots/report.png)

```bash
git clone https://github.com/billyct/ReportCMS.git
cd ReportCMS
```

#### 导入数据库文件
sql文件在report.sql

#### 修改数据库配置文件
./application/config/database.php

#### 运行
php -S localhost:8000 -t public
访问 [localhost:8000](http://localhost:8000)


#### 如果不是localhost:8000
那么需要修改文件
1. ./application/config/config.php ------- $config['base_url']
2. ./public/admin_dir/js/scripts/init.js ------ base
3. ./public/admin_dir/js/modules/admin.js ------- exports.base_url
4. ./public/home_dir/js/functions.js --------
有localhost:8000的地方都改成自己的就可以了~
