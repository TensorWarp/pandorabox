# ==========================================================================
#  Resources: EKS / backend.tf (Storing tfstate)
# --------------------------------------------------------------------------
#  Description
# --------------------------------------------------------------------------
#    - S3 Bucket Path
#    - DynamoDB Table
# ==========================================================================

# --------------------------------------------------------------------------
#  Store Path for Terraform State
# --------------------------------------------------------------------------
terraform {
  backend "s3" {
    region         = "ap-us-west2"
    bucket         = "tensorwarp-terraform-remote-state"
    dynamodb_table = "tensorwarp-terraform-state-lock"
    key            = "resources/eks/terraform.tfstate"
    encrypt        = true
  }
}
