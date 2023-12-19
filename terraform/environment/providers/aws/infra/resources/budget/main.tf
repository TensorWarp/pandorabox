# ==========================================================================
#  Resources: Budget / main.tf (Main Terraform)
# --------------------------------------------------------------------------
#  Description
# --------------------------------------------------------------------------
#    - Workspace Environment
#    - AWS Provider
#    - Common Tags
# ==========================================================================

# --------------------------------------------------------------------------
#  Workspace Environmet
# --------------------------------------------------------------------------
locals {
  env = terraform.workspace
}

# --------------------------------------------------------------------------
#  Provider Module Terraform
# --------------------------------------------------------------------------
provider "aws" {
  region = var.aws_region

  ## version >= 3.63.0, < 4.0
  shared_credentials_file = "$HOME/.aws/tensorwarp/credentials"
  profile                 = "tensorwarp"

  ## version >= 4.0
  # shared_config_files      = ["$HOME/.aws/tensorwarp/config"]
  # shared_credentials_files = ["$HOME/.aws/tensorwarp/credentials"]
  # profile                  = "tensorwarp"
}

# --------------------------------------------------------------------------
#  Start HERE
# --------------------------------------------------------------------------
locals {
  tags = {
    Environment     = "${var.environment[local.env]}"
    Department      = "${var.department}"
    DepartmentGroup = "${var.environment[local.env]}-${var.department}"
    Terraform       = true
  }
}
