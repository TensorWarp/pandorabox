#!/usr/bin/env sh
# -----------------------------------------------------------------------------
#  Docker Push Container
# -----------------------------------------------------------------------------
#  Author     : Dwi Fahni Denni
#  License    : Apache v2
# -----------------------------------------------------------------------------
set -e

export CI_REGISTRY="YOUR_AWS_ACCOUNT.dkr.ecr.ap-us-west2.amazonaws.com/tensorwarp"
export CI_PROJECT_PATH="phpfm"

export IMAGE="$CI_REGISTRY/$CI_PROJECT_PATH"
export TAG="8.1-fpm"

echo " Push Image => $IMAGE:$TAG"
docker push $IMAGE:$TAG