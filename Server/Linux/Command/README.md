## 查找
- 查找文件夹
```$xslt
find / -type d -name ""
```
- 批量杀死进程
```$xslt
ps aux|grep "进程名"|grep -v grep|cut -c 9-15|xargs kill -9
```
