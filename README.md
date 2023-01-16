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
总请求数1000, 分别测试, 结果如下:

[root@ac_web ]# php service.php start Amazon 9901  -d  (守护进程启动)
 
[root@ac_web easy_mysql_pool]# curl "127.0.0.1:9901/?task_type=Amazon&concurrency=10&total=1000"
{"taskCount":1000,"concurrency":10,"useTime":"103s"}


```