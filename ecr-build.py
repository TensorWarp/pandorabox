#!/usr/bin/env python3
import os
import subprocess

AWS_ACCOUNT_ID = os.environ.get("AWS_ACCOUNT_ID")
CI_ECR_PATH = os.environ.get("CI_ECR_PATH")

CI_REGISTRY = f"{AWS_ACCOUNT_ID}.dkr.ecr.ap-us-west-2.amazonaws.com"
IMAGE = f"{CI_REGISTRY}/{CI_ECR_PATH}"

def docker_build(file_path, base_image, tags_id, custom_tags):
    print(f"Build Image => {IMAGE}:{base_image}")
    subprocess.run(["docker", "build", "-t", f"{IMAGE}:{base_image}", "-f", file_path, "."])
    print('---')

    print(f"Build Image => {IMAGE}:{tags_id}")
    subprocess.run(["docker", "build", "-t", f"{IMAGE}:{tags_id}", "-f", file_path, "."])
    print('---')

    print(f"Build Image => {IMAGE}:{base_image}-{tags_id}")
    subprocess.run(["docker", "build", "-t", f"{IMAGE}:{base_image}-{tags_id}", "-f", file_path, "."])
    print('---')

    if custom_tags:
        print(f"Build Image => {IMAGE}:{tags_id}-{custom_tags}")
        subprocess.run(["docker", "build", "-t", f"{IMAGE}:{tags_id}-{custom_tags}", "-f", file_path, "."])
        print('---')

        print(f"Build Image => {IMAGE}:{base_image}-{tags_id}-{custom_tags}")
        subprocess.run(["docker", "build", "-t", f"{IMAGE}:{base_image}-{tags_id}-{custom_tags}", "-f", file_path, "."])
        print('---')

def main(file_path, base_image, tags_id, custom_tags):
    docker_build(file_path, base_image, tags_id, custom_tags)
    print('')
    print('-- ALL DONE --')

if __name__ == "__main__":
    import sys
    if len(sys.argv) != 5:
        print("Usage: python script.py <file_path> <base_image> <tags_id> <custom_tags>")
        sys.exit(1)
    main(sys.argv[1], sys.argv[2], sys.argv[3], sys.argv[4])


