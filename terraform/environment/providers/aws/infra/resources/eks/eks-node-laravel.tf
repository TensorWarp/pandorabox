# ==========================================================================
#  Resources: EKS / eks-node-laravel.tf (EKS Node Configuration)
# --------------------------------------------------------------------------
#  Description
# --------------------------------------------------------------------------
#    - EKS Node Group Name
#    - EKS Version
#    - SSH Key
#    - Node VPC Subnet
#    - Node Scaling
#    - Node Tagging
# ==========================================================================

#============================================
# NODE GROUP - LARAVEL
#============================================
locals {
  node_selector_laravel = "laravel"
}

resource "aws_eks_node_group" "laravel" {
  ## NODE GROUP
  for_each = (local.env == "prod" ? toset(["prod"]) : toset(["dev", "uat"]))

  cluster_name    = aws_eks_cluster.aws_eks.name
  node_group_name = "${local.node_selector_laravel}-${each.key}-node"
  node_role_arn   = aws_iam_role.eks_nodes.arn

  ## EKS Private Subnet ###
  subnet_ids = [
    data.terraform_remote_state.core_state.outputs.eks_private_1a[0],
    data.terraform_remote_state.core_state.outputs.eks_private_1b[0],
    data.terraform_remote_state.core_state.outputs.eks_private_1c[0]
  ]

  instance_types = local.env == "prod" ? ["t3.large"] : ["t3.medium"]
  disk_size      = 100
  version        = var.k8s_version[local.env]

  labels = {
    "environment" = "${var.env[local.env]}",
    "node"        = "${local.node_selector_laravel}-${each.key}"
    "department"  = "softeng"
    "productname" = "tensorwarp-${each.key}"
    "service"     = "laravel"
  }

  remote_access {
    ec2_ssh_key = var.ssh_key_pair[local.env]
    # source_security_group_ids = [ "${var.vpn_sgid[local.env]}" ]
  }

  scaling_config {
    desired_size = 1
    max_size     = 5
    min_size     = 1
  }

  lifecycle {
    ignore_changes = [
      scaling_config[0].desired_size,
      scaling_config[0].min_size,
    ]
  }

  tags = merge(
    {
      "ClusterName"                                                             = "${var.eks_cluster_name}-${var.env[local.env]}"
      "k8s.io/cluster-autoscaler/${var.eks_cluster_name}-${var.env[local.env]}" = "owned",
      "k8s.io/cluster-autoscaler/enabled"                                       = "true"
      "Terraform"                                                               = "true"
    },
    {
      Environment     = "${upper(each.key)}"
      Name            = "EKS-${var.k8s_version[local.env]}-${upper(local.node_selector_laravel)}-${upper(each.key)}"
      Type            = "PRODUCTS"
      ProductName     = "EKS-tensorwarp"
      ProductGroup    = "${upper(each.key)}-EKS-tensorwarp"
      Department      = "SOFTENG"
      DepartmentGroup = "${upper(each.key)}-SOFTENG"
      ResourceGroup   = "${upper(each.key)}-EKS-tensorwarp"
      Services        = "${upper(local.node_selector_laravel)}"
    }
  )

  # Ensure that IAM Role permissions are created before and deleted after EKS Node Group handling.
  # Otherwise, EKS will not be able to properly delete EC2 Instances and Elastic Network Interfaces.
  depends_on = [
    aws_iam_role_policy_attachment.eks_iam_worker_node_policy,
    aws_iam_role_policy_attachment.eks_iam_cni_policy,
    aws_iam_role_policy_attachment.eks_iam_container_registry_policy,
  ]
}

# ------------------------------------
#  Target Group
# ------------------------------------
resource "aws_lb_target_group" "laravel" {
  for_each = (local.env == "prod" ? toset(["prod"]) : toset(["dev", "uat"]))

  name     = "tg-${local.node_selector_laravel}-${var.env[local.env]}-${each.key}"
  port     = "${each.key}" == "dev" ? 30580 : 30680
  protocol = "HTTP"
  vpc_id   = data.terraform_remote_state.core_state.outputs.vpc_id

  tags = {
    Environment     = "${var.environment[local.env]}"
    Name            = "ALB-${upper(local.node_selector_laravel)}-${upper(each.key)}"
    Type            = "PRODUCTS"
    ProductName     = "TG-tensorwarp"
    ProductGroup    = "${upper(each.key)}-TG-tensorwarp"
    Department      = "DEVOPS"
    DepartmentGroup = "${upper(each.key)}-DEVOPS"
    ResourceGroup   = "${upper(each.key)}-TG-tensorwarp"
    Services        = "${upper(local.node_selector_laravel)}-${upper(each.key)}"
    Terraform       = true
  }
}

# --------------------------------------------------------------------------
#  Node Group Output
# --------------------------------------------------------------------------
## DEV Output ##
# output "eks_node_name_laravel_dev" {
#   value = aws_eks_node_group.laravel["dev"].id
# }

## UAT Output ##
# output "eks_node_name_laravel_uat" {
#   value = aws_eks_node_group.laravel["uat"].id
# }

## PROD Output ##
output "eks_node_name_laravel_prod" {
  value = aws_eks_node_group.laravel["prod"].id
}

# --------------------------------------------------------------------------
#  Target Group Output
# --------------------------------------------------------------------------
## DEV Output ##
# output "eks_node_tg_laravel_dev" {
#   value = aws_lb_target_group.laravel["dev"].id
# }

# ## UAT Output ##
# output "eks_node_tg_laravel_uat" {
#   value = aws_lb_target_group.laravel["uat"].id
# }

## PROD Output ##
output "eks_node_tg_laravel_prod" {
  value = aws_lb_target_group.laravel["prod"].id
}
