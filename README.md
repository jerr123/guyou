# 菇友·千寻社 (网站项目2.5W)

项目开始

## 配色

- cgreen : rgba(118,204,53, 1); / #76cc35
- cyellow : rgba(255,217,82,1); / #ffd952
- cred : rgba(242,29,29,1); / #f21d1d
- cblue : rgba(51,159,242,1); / #339ff2
- cgrow : rgba(110,77,50,1); / #6e4d32




## 数据表的设计


### 版本说明
| 版本号  |    修改日期    |    修改内容    |  author   |  备注  |
| :--: | :--------: | :--------: | :-------: | :--: |
| v1.0 | 2016-07-30 | 文档创建、建立数据表 | jerr(yzk) |      |


###1.管理员表 admin


| 字段名(-) |     列名(-)      |   类型要求(-)   | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :----: | :------------: | :---------: | :------: | :-----: | :---: |
|  标识id  |    admin_id    |     int     | not null |  主键、自增  |       |
|   账户   |   admin_name   | varchar(20) |   null   |         |       |
|   密码   | admin_password | varchar(32) |   null   |         |       |
|   手机   |  admin_mobile  |  char(11)   |   null   |         |       |
|  添加时间  | admin_addtime  | varchar(20) |   null   |         |       |


### 2.用户表 user


|  字段名(-)  |       列名(-)       |   类型要求(-)    | 是否为空(-)  | 其他约束(-) |          备注(-)           |
| :------: | :---------------: | :----------: | :------: | :-----: | :----------------------: |
|   标识id   |      user_id      |     Int      | not null |  主键、自增  |                          |
|    账户    |    user_mobile    |   char(50)   | not null |         |                          |
|    密码    |   user_password   | varchar(32)  | not null |         |                          |
|   用户昵称   |     user_nick     | varchar(50)  |   null   |         |                          |
|   用户邮箱   |    user_email     | varchar(255) | not null |         |                          |
|   用户性别   |     user_sex      |  tinyint(1)  |   null   |         |           1男2女           |
|   用户头像   |     user_icon     | varchar(100) |   null   |         |                          |
|   用户生日   |    user_birth     |     date     |   null   |         |                          |
|    星座    |     user_star     | varchar(100) |   null   |         |                          |
|   邀请码    |  user_invitecode  |  char(100)   |   null   |         |                          |
|   居住地    |   user_address    | varchar(255) |   null   |         |                          |
|   省份id   |    province_id    |   int(11)    |   null   |         |                          |
|   城市id   |      city_id      |   int(11)    |   null   |         |                          |
|  区或市id   |       qu_id       |   int(11)    |   null   |         |                          |
|  主页访问量   |      user_pv      |    bigint    |   null   |         |                          |
|   是否在线   |   user_isonline   |  tinyint(1)  |   null   |         |        1在线2隐身3不在线        |
|  用户会员等级  |    user_level     |     int      |   null   |         | 1[默认]普通用户2普通会员3黄金会员4钻石会员 |
|  推荐人id   | recommend_user_id |     int      |   null   |         |          推荐人id           |
|   上次登录   |  user_lastlogin   |   datetime   |   null   |         |                          |
|   上次ip   |    user_lastip    | varchar(100) |          |         |                          |
|   注册时间   |   user_addtime    |   datetime   |   null   |         |                          |
|   用户状态   |    user_state     |  tinyint(1)  |   null   |         |      默认为1[激活状态] 2禁用      |
| 是否已经发过红包 |     can_send      |   tinyint    |          |         |        1可以发2已经发过         |

### 3.访问表 user_visitor


| 字段名(-) |      列名(-)      | 类型要求(-) | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :----: | :-------------: | :-----: | :------: | :-----: | :---: |
|  标识id  |   visitor_id    |   Int   | not null |  主键、自增  |       |
|  用户id  |     user_id     |   Int   |   null   |         |       |
|  访问者   | user_visitor_id |   int   |   null   |         |       |
|  访问时间  | visitor_addtime |         |   null   |         |       |


### 4.密码安全问题 user_safe


| 字段名(-) |     列名(-)     |  类型要求(-)  | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :----: | :-----------: | :-------: | :------: | :-----: | :---: |
|  标识id  | user_safe_id  |    int    | not null |  主键、自增  |       |
|  用户id  |    user_id    |    int    | not null |         |       |
|   问题   | safe_question | char(255) | not null |         |       |
|   答案   |  safe_answer  | char(250) | not null |         |       |


### 5.日志类别 blog_type


| 字段名(-) |     列名(-)      |   类型要求(-)    | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :----: | :------------: | :----------: | :------: | :-----: | :---: |
|  类别id  |  blog_type_id  |     Int      | not null |  主键、自增  |       |
|  用户id  |    user_id     |     Int      |   null   |         | 用户表id |
|  类别名   | blog_type_name | varchar(255) |   null   |         |       |


### 6.日志表 blog

| 字段名(-) |        列名(-)        |   类型要求(-)    | 是否为空(-)  | 其他约束(-) |     备注(-)      |
| :----: | :-----------------: | :----------: | :------: | :-----: | :------------: |
|  日志id  |       blog_id       |     int      | not null |  主键、自增  |                |
|  用户id  |       user_id       |     Int      |   null   |         |     用户表id      |
|  类别id  |    blog_type_id     | varchar(255) |   null   |         |     日志类别id     |
|  日志标题  |     blog_title      | varchar(255) |   null   |         |                |
|  日志内容  |    blog_content     |     text     |   null   |         |                |
|  阅读次数  |     blog_clicks     |    bigint    |   null   |         |      默认为0      |
|  评论次数  | blog_comment_clicks |     int      |          |         |                |
|  保密程度  |      blog_rank      |  tinyint(1)  |   null   |         | 1[默认]所有人2好友3自己 |
|  是否锁定  |     blog_islock     |  tinyint(1)  |   null   |         |     1默认正常      |
|   时间   |    blog_addtime     |   datetime   |          |         |                |
|   状态   |     blog_state      |  tinyint(1)  |          |         |   默认1正常 2回收站   |


### 7.相册表 album


| 字段名(-) |     列名(-)     |   类型要求(-)    | 是否为空(-)  | 其他约束(-) |    备注(-)    |
| :----: | :-----------: | :----------: | :------: | :-----: | :---------: |
|  相册id  |   album_id    |     Int      | not null |  主键、自增  |             |
|  用户id  |    user_id    |     Int      |   null   |         |    用户表id    |
|  相册名称  |  album_name   | varchar(100) |   null   |         |             |
|  相册描述  |  album_desc   | varchar(255) |   null   |         |             |
|  是否锁定  | album_islock  |  tinyint(1)  |   null   |         |    1默认正常    |
|  可见性   | album_isshow  |  tinyint(1)  |   null   |         | 1所有2好友3自己可见 |
|   封面   |  album_head   | varchar(100) |   null   |         |             |
| 相册照片数  |  photo_count  |     int      | not null |         |    默认[0]    |
|  创建时间  | album_addtime |   datetime   |   null   |         |             |
|  更新时间  | album_modtime |   datetime   |   null   |         |             |


### 8.照片表 photo

|   字段名(-)    |     列名(-)     |   类型要求(-)    | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :---------: | :-----------: | :----------: | :------: | :-----: | :---: |
|    照片id     |   photo_id    |     Int      | not null |  主键、自增  |       |
|    相册id     |   album_id    |     Int      | not null |         |       |
|     照片名     |  photo_name   | varchar(100) |   null   |         |       |
|     缩略图     |  photo_thumb  | varchar(100) |   null   |         |       |
| 照片full_path |  photo_path   | varchar(100) |   null   |         |       |
|    照片描述     |  photo_desc   | varchar(255) |   null   |         |       |
|    是否为封面    | photo_ishead  |  tinyint(1)  |   null   |         | 1是2否  |
|    是否锁定     | photo_islock  |  tinyint(1)  |   null   |         | 1默认正常 |
|    添加时间     | photo_addtime |   datetime   |   null   |         |       |


### 9.动态 trends


| 字段名(-) |     列名(-)      |   类型要求(-)    | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :----: | :------------: | :----------: | :------: | :-----: | :---: |
|  动态id  |   trends_id    |     Int      | not null |  主键、自增  |       |
|  用户id  |    user_id     |     Int      | not null |   外键    |       |
|  用户名   |   user_name    | varchar(50)  |          |         |       |
|  动态内容  | trends_content | varchar(200) |   null   |         |       |
|  添加时间  | trends_addtime | varchar(100) |   null   |         |       |


### 10.好友默认分组表 friend_def_group


| 字段名(-) |         列名(-)         |   类型要求(-)   | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :----: | :-------------------: | :---------: | :------: | :-----: | :---: |
|  标识id  |  friend_def_group_id  |     Int     | not null |  主键、自增  |       |
|        | friend_def_group_name | varchar(50) |   null   |         |       |


### 11.好友分组表(个人分组)friend_group


| 字段名(-) |       列名(-)       |   类型要求(-)    | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :----: | :---------------: | :----------: | :------: | :-----: | :---: |
|  标识id  |     group_id      |     Int      | not null |  主键、自增  |       |
|  分组名   | friend_group_name | varchar(150) |          |         |       |
|  用户id  |      user_id      |     int      |    外键    |         | 用户表id |
|  用户数量  |    user_count     |     int      |          |         |  默认0  |


### 12.好友表 friend


| 字段名(-) |      列名(-)      | 类型要求(-) | 是否为空(-)  | 其他约束(-) |  备注(-)  |
| :----: | :-------------: | :-----: | :------: | :-----: | :-----: |
|  标识id  |    friend_id    |   Int   | not null |  主键、自增  |         |
|  自己id  |   fri_user_id   |   int   |   null   |         |         |
|  分组id  | friend_group_id | int(11) | not null |         | 好友分组表id |
|  好友id  | friend_user_id  |   int   |    外键    |         |  用户表id  |
| 好友添加时间 | friend_addtime  |         |          |         |         |


### 13.好友申请表 friend_apply


| 字段名(-) |       列名(-)       | 类型要求(-) | 是否为空(-)  | 其他约束(-) |      备注(-)       |
| :----: | :---------------: | :-----: | :------: | :-----: | :--------------: |
|  标识id  |   fri_apply_id    |   Int   | not null |  主键、自增  |                  |
| 申请人id  |   from_user_id    |   int   |   null   |         |                  |
| 被申请人id |    to_user_id     |   int   |   null   |         |                  |
|  申请时间  | fri_apply_addtime |         |          |         |                  |
|   状态   |  fri_apply_state  |  tyint  |          |         | 默认1-未处理 2-同意3-拒绝 |


### 14.打招呼表 hi

| 字段名(-) |      列名(-)      |   类型要求(-)    | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :----: | :-------------: | :----------: | :------: | :-----: | :---: |
|  标识id  |      hi_id      |     Int      | not null |  主键、自增  |       |
| 发送人id  | hi_from_user_id |     int      |   null   |         |       |
| 接收人id  |  hi_to_user_id  |     int      |   null   |         |       |
|  发送内容  |   hi_content    | varchar(255) |   null   |         |       |
|  发送时间  |   hi__addtime   |              |          |         |       |



### 15评论表 comment


| 字段名(-) |       列名(-)        |   类型要求(-)    | 是否为空(-)  | 其他约束(-) |   备注(-)   |
| :----: | :----------------: | :----------: | :------: | :-----: | :-------: |
|  标识id  |     comment_id     |     Int      | not null |  主键、自增  |           |
| 被评论者id | to_comment_user_id |     int      |   null   |         |           |
| 评论者id  |  comment_user_id   |     int      |   null   |         |           |
|  评论者名  | comment_user_name  | varchar(50)  |          |         |           |
| 评论者头像  | comment_user_icon  | varchar(100) |          |         |           |
|  应用类别  |      app_type      |     int      |   null   |         | 1日志2相册3动态 |
|  应用id  |       app_id       |     int      |   null   |         |           |
|  评论内容  |  comment_content   | varchar(255) |          |         |           |
|  评论时间  |  comment_addtime   |   datetime   |          |         |           |
| 父评论Id  | parent_comment_id  |   int(10)    |   null   |         |   默认为0    |


### 16.发红包 red_packet


| 字段名(-) |          列名(-)          | 类型要求(-) | 是否为空(-)  | 其他约束(-) |   备注(-)    |
| :----: | :---------------------: | :-----: | :------: | :-----: | :--------: |
|  标识id  |      red_packet_id      |   Int   | not null |  主键、自增  |            |
|  红包类型  |     red_packet_type     | tinyint |          |         | 1积分红包2钻石红包 |
| 发红包人id | red_packet_from_user_id |   int   |   null   |         |            |
|   数量   |     red_packet_num      |         |          |         |            |
|   时间   |   red_packet_addtime    |         |          |         |            |


### 17. 钱包 wallet 


| 字段名(-) |   列名(-)   | 类型要求(-) | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :----: | :-------: | :-----: | :------: | :-----: | :---: |
|  标识id  | wallet_id |   Int   | not null |  主键、自增  |       |
|  用户id  |  user_id  |   int   |   null   |         |       |
|   b币   |  b_coin   |   int   |   null   |         |  默认0  |
|   钻石   |  diamond  |   int   |   null   |         |  默认0  |
|   积分   |   point   |   int   |   null   |         |  默认0  |


### 18.银行卡绑定 bank


| 字段名(-) |     列名(-)      |   类型要求(-)    | 是否为空(-)  | 其他约束(-) | 备注(-) |
| :----: | :------------: | :----------: | :------: | :-----: | :---: |
|  标识id  |    bank_id     |     Int      | not null |  主键、自增  |       |
|  用户Id  |    user_id     |   int(10)    | not null |         |       |
|  绑定银行  |   bank_name    | vachar(100)  |   null   |         |       |
| 银行卡卡号  |    bank_no     | varchar(255) |   null   |         |       |
|  账户名   | bank_user_name |  varchar(50  |   null   |         |       |
|  绑定时间  |  bank_addtime  |              |          |         |       |

### 19.账单记录 bill


| 字段名(-) |         列名(-)          |   类型要求(-)    | 是否为空(-)  | 其他约束(-) |         备注(-)         |
| :----: | :--------------------: | :----------: | :------: | :-----: | :-------------------: |
|  标识id  |        bill_id         |     Int      | not null |  主键、自增  |                       |
|  账单类型  |       bill_type        |  tinyint(1)  |   null   |         | 1充值2发红包3收益4转账5提现6开通会员 |
|   币种   |     bill_currency      |  tinyint(1)  |   null   |         |       1b币2钻石3积分       |
|  转出账户  | transfer_frome_user_id |     int      |   null   |         |          0系统          |
|  转入账户  |  transfer_to_user_id   |     int      |   null   |         |          0系统          |
|  转账数量  |      bill_amount       |   varchar    |   null   |         |        -10、+10        |
|   备注   |      bill_remark       | varchar(255) |   null   |         |                       |
|   时间   |      bill_addtime      |              |          |         |                       |

### 20.个人提醒fri_tx

| 字段名(-) |     列名(-)      |   类型要求(-)    | 是否为空(-)  | 其他约束(-) |       备注(-)        |
| :----: | :------------: | :----------: | :------: | :-----: | :----------------: |
|  标识id  |   fri_tx_id    |     Int      | not null |  主键、自增  |                    |
|  用户id  |  fri_user_id   |     int      |   null   |         |      非当前登录的用户      |
| 品论者id  | review_user_id |     int      | not null |         |                    |
| 评论者头像  |   review_pic   | varchar(100) |   null   |         |                    |
|  评论者名  |  review_nick   | varchar(20)  |   null   |         |                    |
|  提醒内容  | fri_tx_content | varchar(225) |   null   |         |                    |
|   状态   |  fri_tx_state  |  tinyint(1)  | not null |         |    默认1[未读] 2已读     |
|   类型   |  fri_tx_type   |  tinyint(1)  |          |         | 消息类型1-加好友2-评论,3-系统 |


### 21.配置表 config


| 字段名(-) |      列名(-)       |   类型要求(-)    | 是否为空(-)  | 其他约束(-) |        备注(-)        |
| :----: | :--------------: | :----------: | :------: | :-----: | :-----------------: |
|  标识id  |    config_id     |     Int      | not null |  主键、自增  |                     |
| 上一级id  |    parent_id     |     int      |   null   |         |     上一级Id默认没有为0     |
| 字段key  |    field_code    | varchar(20)  |   null   |         | 字段关键字 例.income_rate |
|  字段名   |    field_name    | varchar(50)  |   null   |         |       例.收益比例        |
|   类型   |    field_type    | varchar(10)  |   null   |         |    例.text、radio     |
|  文字提醒  | value_range_text | varchar(225) |   null   |         |                     |
|  字段值   |   field_value    |  varchar()   |   null   |         |       例.10.1%       |



### 22.说说 评论@关系表at

|  字段名(-)  |  列名(-)  |  类型要求(-)   | 是否为空(-)  | 其他约束(-) |  备注(-)  |
| :------: | :-----: | :--------: | :------: | :-----: | :-----: |
|   @id    |  at_id  |  int(11)   | not null |   主键    |         |
|    类型    | at_type | tinyint(1) | not null |         | 1说说,2评论 |
|   用户id   | user_id |  int(11)   | not null |         |         |
| 说说或者评论id |   id    |  int(10)   | not null |         |         |

### 23.广告表 adv
|    字段名    |        列名         |       类型要求       |   是否为空   | 其他约束 |            备注            |
| :-------: | :---------------: | :--------------: | :------: | :--: | :----------------------: |
|    id     |      adv_id       |     int(11)      | not null |  主键  |                          |
|   广告位名字   |     advp_name     |   varchar(50)    |   null   |      |                          |
|   广告位描述   |     advp_des      |   varchar(255)   |   null   |      |                          |
| 广告位width  |    advp_width     |      float       |   null   |      |                          |
| 广告位height |    advp_height    |      float       |   null   |      |                          |
|   广告位状态   |     adv_state     |    tinyint(1)    | not null |      | 1可用广告位[默认]2广告(正常)3广告(停用) |
|   广告图片    |      adv_img      |   varchar(255)   |   null   |      |                          |
|   广告主名称   |  advertiser_name  |   varchar(50)    |   null   |      |                          |
|   广告主手机   | advertiser_mobile | varchar(11) null |          |      |                          |
| 广告投放开始时间  |     adv_start     |     datetime     |   null   |      |                          |
| 广告投放结束时间  |      adv_end      |     datetime     |   null   |      |                          |

### 24.点赞 like
|  字段名(-)  |      列名(-)      |  类型要求(-)   | 是否为空(-)  | 其他约束(-) |   备注(-)   |
| :------: | :-------------: | :--------: | :------: | :-----: | :-------: |
|   标识Id   |     like_id     |  int(11)   | not null |   主键    |           |
|   点赞的人   |  like_user_id   |  int(11)   | not null |         |           |
| 被赞的应用类型  |    app_type     | tinyint(1) | not null |         | 1日志2相册3动态 |
| 被赞的内容的id |     app_id      |  int(11)   | not null |         |           |
|  被赞人的id  | to_like_user_id |  int(11)   | not null |         |           |
|  点赞的时间   |  like_addtime   |  datetime  |          |         |           |

### 25.会员等级表 vip_level
|       字段名        |       列名       |    类型要求     | 是否为空 | 其他约束 |  备注  |
| :--------------: | :------------: | :---------: | :--: | :--: | :--: |
|      会员等级Id      |  vip_level_id  | intnot null |      |      |      |
|       等级名称       | vip_level_name |  varchar50  |      |      |      |
|     升级所需要的钻石     | vip_level_need |     int     |      |      |      |
| 该等级可以发的钻石红包的钻石数量 | red_packet_num |     int     |      |      |      |

### 26.提现表 to_cash
|    字段名    |       列名        |    类型要求    |   是否为空   | 其他约束 |       备注       |
| :-------: | :-------------: | :--------: | :------: | :--: | :------------: |
|   标识id    |   to_cash_id    |  int(11)   | not null |  主键  |                |
| 绑定信息银行卡id |     bank_id     |  int(10)   |          |      |                |
|   用户Id    |     user_id     |  int(10)   |          |      |                |
|  提现b币数量   |   b_icon_num    |   float    |          |      |                |
|   提现状态    |  to_cash_state  | tinyint(1) |          |      | 1[默认]待处理,2提现成功 |
|   提现时间    | to_cash_addtime |  datetime  |          |      |                |

### 27.充值单  topup
|  字段名  |      列名       |     类型要求     |   是否为空   | 其他约束 |    备注     |
| :---: | :-----------: | :----------: | :------: | :--: | :-------: |
| 标识id  |   topup_id    |   int(11)    | not null |  主键  |           |
| 用户Id  |    user_id    |   int(11)    |          |      |           |
| 充值金额  |     money     |  float(11)   |          |      |           |
| 联系手机  |    mobile     | varchar(11)  |          |      |           |
| 汇款人姓名 |  remit_name   | varchar(30)  |          |      |           |
| 支付宝账号 |    alipay     | varchar(255) |          |      |           |
| 充值状态  |  topup_state  |  tinyint(1)  |          |      |           |
| 充值方式  |  topup_type   |  tinyint(1)  |          |      | 1-支付宝2-银行 |
|  时间   | topup_addtime |   datetime   | not null |      |    时间     |
| 备注/复验 |    remark     |    int(6)    | not null |      |           |