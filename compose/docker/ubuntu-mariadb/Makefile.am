IMAGE = YOUR_AWS_ACCOUNT.dkr.ecr.ap-us-west2.amazonaws.com/tensorwarp/mariadb
TAG = 10.5.12

clean-local:
	docker rmi $(CLEAN_OPTIONS) $(IMAGE):$(TAG) || true

build:
	docker build $(BUILD_OPTIONS) -t $(IMAGE):$(TAG) .

pull:
	docker pull $(PULL_OPTIONS) $(IMAGE):$(TAG)

push: build
	docker push $(PUSH_OPTIONS) $(IMAGE):$(TAG)