# Dockerfile 参数详解 

指令的一般格式为 INSTRUCTION arguments ，指令包括 FROM、MAINTAINER、RUN  等。


###  FROM
> FROM <image>  或者 FROM <image>:<tag> 
第一条指令必须为FROM 指令。并且，如果在同一个Dockerfile中创建多个镜像时，可以使用多个FROM 指令（每个镜像一次）

### MAINTAINER
> MAINTAINER <name>，指定维护者信息。 

> 注：该指令已过时，建议使用如下形式： 
>LABEL maintainer="M" 


### RUN
> RUN <command> 或 RUN ["executable", "param1", "param2"]。

前者将在 shell 终端中运行命令，即 /bin/sh -c；    
后者则使用 exec 执行 。指定使用其它终端可以通过第二种方式实现，例如 RUN ["/bin/bash", "-c", "echo hello"]。    
每条 RUN 指令将在当前镜像基础上执行指定命令，并提交为新的镜像。当命令较长时可以使用 \ 来换行。

### CMD 
>CMD ["executable","param1","param2"] 使用 exec 执行，推荐方式；  
>CMD command param1 param2 在 /bin/sh 中执行，提供给需要交互的应用；    
>CMD ["param1","param2"] 提供给 ENTRYPOINT 的默认参数；  

指定启动容器时执行的命令，每个 Dockerfile 只能有一条CMD 命令。 
如果指定了多条命令，只有最后一条会被执行。       
如果用户启动容器时候指定了运行的命令，则会覆盖掉 CMD 指定的命令。 

### EXPOSE
> EXPOSE <port> [<port>...]

告诉 Docker 服务端容器暴露的端口号，供互联系统使用。在启动容器时需要通过 -P ，Docker 主机会自动分配一个端口转发到指定的端口。

### ENV
> ENV <key> <value>

指定一个环境变量，会被后续 RUN 指令使用，并在容器运行时保持。

### ADD
> ADD <src> <dest>

该命令将复制指定的 到容器中的 。 其中 可以是Dockerfile所在目录的一个相对路径；也可以是一个 URL；还可以是一个 tar 文件（自动解压为目录）

### COPY

> COPY <src> <dest>。
复制本地主机的 （为 Dockerfile 所在目录的相对路径）到容器中的 。 当使用本地目录为源目录时，推荐使用 COPY。

### ENTRYPOINT
> ENTRYPOINT ["executable", "param1", "param2"]
> ENTRYPOINT command param1 param2（shell中执行）。

 配置容器启动后执行的命令，并且不可被 docker run 提供的参数覆盖
 每个 Dockerfile 中只能有一个 ENTRYPOINT ，当指定多个时，只有最后一个起效
 
### VOLUME
> VOLUME ["/data"]

 创建一个可以从本地主机或其他容器挂载的挂载点，一般用来存放数据库和需要保持的数据等。

### USER
> USER daemon。

指定运行容器时的用户名或 UID，后续的 RUN 也会使用指定用户。
当服务不需要管理员权限时，可以通过该命令指定运行用户。并且可以在之前创建所需要的用户，例如：RUN groupadd -r postgres && useradd -r -g postgres postgres 。要临时获取管理员权限可以使用 gosu，而不推荐 sudo

### WORKDIR
> WORKDIR /path/to/workdir。

为后续的 RUN、CMD、ENTRYPOINT 指令配置工作目录。
可以使用多个WORKDIR 指令，后续命令如果参数是相对路径，则会基于之前命令指定的路径

### ONBUILD
> ONBUILD [INSTRUCTION]。

配置当所创建的镜像作为其它新创建镜像的基础镜像时，所执行的操作指令。
例如，Dockerfile 使用如下的内容创建了镜像 image-A。
> ...  
> ONBUILD ADD . /app/src   
> ONBUILD RUN /usr/local/bin/python-build --dir /app/src  
> ... 


如果基于 image-A 创建新的镜像时，新的Dockerfile中使用 FROM image-A指定基础镜像时，会自动执行 ONBUILD 指令内容，等价于在后面添加了两条指令。

>FROM image-A  
> \#Automatically run the following  
>ADD . /app/src  
>RUN /usr/local/bin/python-build --dir /app/src  