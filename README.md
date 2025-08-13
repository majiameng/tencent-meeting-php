<h1 align="center">tinymeng/tencent-meeting</h1>

欢迎 Star，欢迎 PR！

# 腾讯会议开放平台sdk php

# 说明文档

[腾讯会议 REST API](https://cloud.tencent.com/document/product/1095/113415)

### 安装

```
composer require tinymeng/tencent-meeting:dev-master -vvv
```


```
tencent-meeting-php/
├── src/
│   ├── Factory.php
│   ├── Client.php
│   ├── Service/
│   │   ├── Meeting.php
│   │   ├── User.php
│   │   └── ...（按API模块拆分）
│   ├── Exception/
│   │   └── ApiException.php
│   └── Utils/
│       └── Http.php
├── tests/
│   └── ...（单元测试）
├── composer.json
└── README.md
```