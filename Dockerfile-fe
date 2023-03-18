FROM golang:1.17

ENV GOPROXY=https://goproxy.cn,https://goproxy.io,direct

WORKDIR $GOPATH/src/wyblog

COPY . $GOPATH/src/wyblog

RUN go mod tidy \
    && go build .

# EXPOSE 80

ENTRYPOINT ["nohup", "./wyblog", "&"]