FROM ubuntu:22.04

# ENV GOPROXY=https://goproxy.cn,https://goproxy.io,direct \
#     GO111MODULE=on \
#     CGO_ENABLED=1

#设置时区参数
ENV TZ=Asia/Shanghai

# 不知道是干嘛的先注释了
# RUN sed -i 's!http://dl-cdn.alpinelinux.org/!https://mirrors.ustc.edu.cn/!g' /etc/apk/repositories
# RUN apk --no-cache add tzdata zeromq \
#     && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
#     && echo '$TZ' > /etc/timezone

WORKDIR /app
# 后端信息
COPY ./wyblog_linux_amd64 ./wyblog
# 前端静态文件
COPY web/front/dist ./web/front/dist
COPY web/admin/dist ./web/admin/dist

EXPOSE 3000

CMD ["./wyblog"]