# Docker-Compose

### 现存问题
我们运行了两个容器：Web 项目 + Redis        
如果项目依赖更多的第三方软件，我们需要管理的容器就更加多，每个都要单独配置运行，指定网络。   
这节，我们使用 docker-compose 把项目的多个服务集合到一起，一键运行。  


###     安装 Docker Compose    
如果你是安装的桌面版 Docker，不需要额外安装，已经包含了。        
如果是没图形界面的服务器版 Docker，你需要单独安装 [安装文档](https://docs.docker.com/compose/install/#install-compose-on-linux-systems)       
运行docker-compose检查是否安装成功 


### 编写脚本
要把项目依赖的多个服务集合到一起，我们需要编写一个docker-compose.yml文件，描述依赖哪些服务
[参考文档](https://docs.docker.com/compose/)

```yaml
version: "3"
services:
  app:
    build:
      context: ./
      dockerfile: ./Dockerfile
    ports:
      - 8080:8080
    volumes:
      - ./:/www/webapp
    environment:
      - TZ=Asia/Shanghai
  redis:
    image: redis:5.0.13
    volumes:
      - redis:/data
    environment:
      - TZ=Asia/Shanghai

volumes:
  redis:
```