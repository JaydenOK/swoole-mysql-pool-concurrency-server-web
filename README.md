## swoole-mysqlpool-concurrency--server-web


#### 功能逻辑
```text
协程并发站点服务，启动Http-Server接收用户请求，启用mysql连接池，每个请求通过协程处理返回，提高站点并发数
```

#### 版本
- PHP 7.1
- Swoole 4.5.11


#### 测试结果

```shell script
获取亚马逊账号列表接口: 总请求数1000, 分别测试, 结果如下:

[root@ac_web ]# php service.php start 8080 -d  (守护进程启动)
 
[root@ac_web easy_mysql_pool]# curl "192.168.92.208:8080/account/lists?platform_code=Amazon"


ab 并发测试:

[root@localhost ~]# ab -n 1000 -c 100 -k 192.168.92.208:8080/account/lists?platform_code=Amazon


```