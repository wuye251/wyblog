BINARY_NAME=wyblog

	
export GOPROXY=https://goproxy.cn,direct

build:
	mv $(BINARY_NAME) $(BINARY_NAME)_bak
	go build -o $(BINARY_NAME)
	@echo "wyblog build successfully!"

run:
	pkill -9 $(BINARY_NAME)
	nohup ./$(BINARY_NAME) 2>&1 &