# 菇友网说明文档

## 一.后端Action

### 1.点赞

**action:Ajax/like**



| 参数描述  |       字段名       |  类型  |   备注    |
| :---: | :-------------: | :--: | :-----: |
| 内容id  |     app_id      | int  | 如、说说的id |
| 被赞的用户 | to_like_user_id | int  |         |
**返回数据**
```javascript
{
	"status":1	//状态码
	"errmsg":"网络错误"	//错误信息
}
```

### 2.取消点赞

**action:Ajax/unLike**

| 参数描述 |  字段名   |  类型  |   备注    |
| :--: | :----: | :--: | :-----: |
| 内容id | app_id | int  | 如、说说的id |

### 3.评论

**action:Ajax/commentAdd**

|  参数描述  |        字段名         |  类型  |   备注    |
| :----: | :----------------: | :--: | :-----: |
|  内容id  |       app_id       | int  | 如、说说的id |
|  被评论人  | to_comment_user_id |      |         |
|  评论内容  |  comment_content   |      |         |
| 评论的父id | parent_comment_id  | int  | 存在时就是回复 |

### 4.评论删除

**action:Ajax/commentDel**

| 参数描述 |  字段名   |  类型  |   备注    |
| :--: | :----: | :--: | :-----: |
| 内容id | app_id | int  | 如、说说的id |

### 5.转发
**action:Ajax/commentAdd**

|  参数描述  |        字段名         |  类型  |   备注    |
| :----: | :----------------: | :--: | :-----: |
|  内容id  |       app_id       | int  | 如、说说的id |
|  被评论人  | to_comment_user_id |      |         |
|  评论内容  |  comment_content   |      |         |
| 评论的父id | parent_comment_id  | int  | 存在时就是回复 |