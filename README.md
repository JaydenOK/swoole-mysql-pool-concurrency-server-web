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
守护进程启动
[root@ac_web ]# php service.php start 8080 -d

获取亚马逊账号列表接口: 服务器4核8G服务器, 总请求数10000, 并发200, 1000分别测试, 结果如下:
ab压测工具并发测试(吞吐量,每秒查询率QPS:4750~4966):

[root@localhost ~]# ab -n 10000 -c 200 -k 192.168.92.208:8080/account/lists?platform_code=Amazon
This is ApacheBench, Version 2.3 <$Revision: 1430300 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking 192.168.92.208 (be patient)
Completed 1000 requests
Completed 2000 requests
Completed 3000 requests
Completed 4000 requests
Completed 5000 requests
Completed 6000 requests
Completed 7000 requests
Completed 8000 requests
Completed 9000 requests
Completed 10000 requests
Finished 10000 requests


Server Software:        swoole-http-server
Server Hostname:        192.168.92.208
Server Port:            8080

Document Path:          /account/lists?platform_code=Amazon
Document Length:        17528 bytes

Concurrency Level:      200
Time taken for tests:   2.014 seconds
Complete requests:      10000
Failed requests:        0
Write errors:           0
Keep-Alive requests:    10000
Total transferred:      177050000 bytes
HTML transferred:       175280000 bytes
Requests per second:    4966.44 [#/sec] (mean)
Time per request:       40.270 [ms] (mean)
Time per request:       0.201 [ms] (mean, across all concurrent requests)
Transfer rate:          85869.97 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.9      0       8
Processing:     4   33  36.1     27     695
Waiting:        1   14   5.5     13     237
Total:          9   33  36.1     27     695

Percentage of the requests served within a certain time (ms)
  50%     27
  66%     30
  75%     32
  80%     34
  90%     40
  95%     49
  98%    239
  99%    249
 100%    695 (longest request)


##########################################################################################################
##########################################################################################################

[root@localhost ~]# ab -n 10000 -c 1000 -k 192.168.92.208:8080/account/lists?platform_code=Amazon
This is ApacheBench, Version 2.3 <$Revision: 1430300 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking 192.168.92.208 (be patient)
Completed 1000 requests
Completed 2000 requests
Completed 3000 requests
Completed 4000 requests
Completed 5000 requests
Completed 6000 requests
Completed 7000 requests
Completed 8000 requests
Completed 9000 requests
Completed 10000 requests
Finished 10000 requests


Server Software:        swoole-http-server
Server Hostname:        192.168.92.208
Server Port:            8080

Document Path:          /account/lists?platform_code=Amazon
Document Length:        17528 bytes

Concurrency Level:      1000
Time taken for tests:   2.105 seconds
Complete requests:      10000
Failed requests:        0
Write errors:           0
Keep-Alive requests:    10000
Total transferred:      177050000 bytes
HTML transferred:       175280000 bytes
Requests per second:    4750.02 [#/sec] (mean)
Time per request:       210.525 [ms] (mean)
Time per request:       0.211 [ms] (mean, across all concurrent requests)
Transfer rate:          82128.00 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    6  59.5      0    1032
Processing:    15  154 109.6    125    1548
Waiting:        1   71  75.0     49    1547
Total:         49  160 123.6    126    1548

Percentage of the requests served within a certain time (ms)
  50%    126
  66%    146
  75%    166
  80%    184
  90%    253
  95%    369
  98%    467
  99%    650
 100%   1548 (longest request)

```