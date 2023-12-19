#!/usr/bin/env python3
import os
import subprocess
import argparse
from enum import Enum

AWS_ACCOUNT_ID = os.environ.get("AWS_ACCOUNT_ID")
CI_ECR_PATH = os.environ.get("CI_ECR_PATH")

CI_REGISTRY = f"{AWS_ACCOUNT_ID}.dkr.ecr.ap-us-west-2.amazonaws.com"
IMAGE = f"{CI_REGISTRY}/{CI_ECR_PATH}"

DOCKER_BUILD_ARGS = ["docker", "build", "-f"]
EXIT_CODE_ERROR = 1

class TagChoices(Enum):
    BASE = "base"
    TAGS_ID = "tags_id"
    CUSTOM_TAGS = "custom_tags"

def execute_docker_command(file_path, *tag_parts):
    image_tag = f"{IMAGE}:{'-'.join(tag_parts)}"
    print(f"Build Image => {image_tag}")
    print('---')
    subprocess.run(DOCKER_BUILD_ARGS + [file_path, "-t", image_tag, "."], check=True)

def validate_custom_tags(custom_tags):
    invalid_char = next((char for char in custom_tags if not char.isalnum()), None)
    if invalid_char is not None:
        error_position = custom_tags.find(invalid_char) + 1
        error_message = f"Error: Custom tags must be alphanumeric. Invalid character '{invalid_char}' at position {error_position}."
        raise argparse.ArgumentError(None, error_message)

def build_docker_images(file_path, base_image, tags_id, custom_tags):
    execute_docker_command(file_path, base_image, tags_id, custom_tags)

def main():
    parser = argparse.ArgumentParser(description="Build Docker images with specified tags.")
    parser.add_argument("file_path", help="Path to the Dockerfile")
    parser.add_argument("base_image", help="Base image tag")
    parser.add_argument("tags_id", choices=[tag.value for tag in TagChoices], help="Tags ID (choose from 'base', 'tags_id', 'custom_tags')")
    parser.add_argument("custom_tags", nargs="?", default="", help="Custom tags")

    try:
        args = parser.parse_args()

        if args.tags_id == TagChoices.CUSTOM_TAGS.value:
            validate_custom_tags(args.custom_tags)

        build_docker_images(args.file_path, args.base_image, args.tags_id, args.custom_tags)

        print("\n-- ALL DONE --")
    except argparse.ArgumentError as e:
        print(f"Error: {e}")
        exit(EXIT_CODE_ERROR)
    except KeyboardInterrupt:
        print("\nScript interrupted by user.")
        exit(EXIT_CODE_ERROR)

if __name__ == "__main__":
    main()
