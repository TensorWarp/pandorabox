#!/usr/bin/env python3
import os
import subprocess

AWS_ACCOUNT_ID = os.environ.get("AWS_ACCOUNT_ID")
CI_ECR_PATH = os.environ.get("CI_ECR_PATH")

CI_REGISTRY = f"{AWS_ACCOUNT_ID}.dkr.ecr.ap-us-west-2.amazonaws.com"
IMAGE = f"{CI_REGISTRY}/{CI_ECR_PATH}"

def login_ecr():
    print("=============")
    print("  Login ECR  ")
    print("=============")
    password = subprocess.check_output(["aws", "ecr", "get-login-password", "--region", "ap-us-west-2"]).decode("utf-8").strip()
    subprocess.run(["docker", "login", "--username", "AWS", "--password-stdin", CI_REGISTRY], input=password.encode("utf-8"))
    print('- DONE -')
    print('')

def docker_pull(tags_id):
    print(f"Docker Pull => {IMAGE}:{tags_id}")
    subprocess.run(["docker", "pull", f"{IMAGE}:{tags_id}"])
    print('- DONE -')
    print('')

def main(tags_id):
    login_ecr()
    docker_pull(tags_id)
    print('')
    print('-- ALL DONE --')

if __name__ == "__main__":
    import sys
    if len(sys.argv) != 2:
        print("Usage: python script.py <tags_id>")
        sys.exit(1)
    main(sys.argv[1])


