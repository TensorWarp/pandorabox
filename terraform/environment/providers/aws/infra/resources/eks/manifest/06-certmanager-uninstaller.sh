#!/bin/sh

export AWS_REGION="ap-us-west2"
export ACCOUNT_ID="YOUR_AWS_ACCOUNT"
export EKS_CLUSTER="tensorwarp-prod"
export EKS_VPC_ID="vpc-0987612345"
export SSL_CERT_ARN="arn:aws:acm:ap-us-west2:${ACCOUNT_ID}:certificate/HASH_NUMBER"

kubectl config use-context arn:aws:eks:ap-us-west2:${ACCOUNT_ID}:cluster/${EKS_CLUSTER}

kubectl get Issuers,ClusterIssuers,Certificates,CertificateRequests,Orders,Challenges --all-namespaces

helm --namespace cert-manager delete cert-manager
kubectl delete namespace cert-manager
kubectl delete -f https://github.com/cert-manager/cert-manager/releases/download/v1.11.0/cert-manager.crds.yaml