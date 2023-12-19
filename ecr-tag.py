#!/usr/bin/env python3
import os
import subprocess

AWS_ACCOUNT_ID = os.environ.get("AWS_ACCOUNT_ID")
CI_ECR_PATH = os.environ.get("CI_ECR_PATH")

CI_REGISTRY = f"{AWS_ACCOUNT_ID}.dkr.ecr.ap-us-west2.amazonaws.com"
IMAGE = f"{CI_REGISTRY}/{CI_ECR_PATH}"

def set_tag(base_image, tags_id, custom_tags):
    commit_hash = subprocess.check_output(["git", "log", "-1", "--format=format:%H"]).decode("utf-8").strip()

    if not custom_tags:
        tags = [tags_id, f"{base_image}-{tags_id}", f"{tags_id}-{commit_hash}", f"{base_image}-{commit_hash}"]
    else:
        tags = [tags_id, f"{base_image}-{tags_id}", f"{tags_id}-{commit_hash}", f"{base_image}-{commit_hash}", f"{tags_id}-{custom_tags}"]

    return tags

def docker_tag(tags, base_image):
    for tag in tags:
        print(f"Docker Tags => {IMAGE}:{tag}")
        print(f">> docker tag {IMAGE}:{base_image} {IMAGE}:{tag}")
        subprocess.run(["docker", "tag", f"{IMAGE}:{base_image}", f"{IMAGE}:{tag}"])
        print("- DONE -")
        print("")

def main(base_image, tags_id, custom_tags):
    tags = set_tag(base_image, tags_id, custom_tags)
    docker_tag(tags, base_image)
    print("")
    print("-- ALL DONE --")

if __name__ == "__main__":
    import sys
    if len(sys.argv) != 4:
        print("Usage: python script.py <base_image> <tags_id> <custom_tags>")
        sys.exit(1)
    main(sys.argv[1], sys.argv[2], sys.argv[3])


