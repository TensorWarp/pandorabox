#!/usr/bin/env python3
import os
import subprocess

TITLE = "HELM PACKAGE SCRIPT"  # script name
VER = "2.2"  # script version

HELM_VERSION = "1.4.0-rc"
HELM_TEMPLATE = ["api", "backend", "configmap", "frontend", "secretref", "stateful", "svcrole"]
HELM_REPO_PATH = "s3://tensorwarp-helm-chart/lab"
HELM_REPO_NAME = "tensorwarp-lab"

COL_RED = "\033[22;31m"
COL_GREEN = "\033[22;32m"
COL_BLUE = "\033[22;34m"
COL_END = "\033[0m"

def get_time():
    return os.popen('date "+%Y-%m-%d %H:%M:%S"').read().strip()

def print_line0():
    print(f"{COL_GREEN}====================================================================================={COL_END}")

def print_line1():
    print(f"{COL_GREEN}-------------------------------------------------------------------------------------{COL_END}")

def print_line2():
    print("-------------------------------------------------------------------------------------")

def header():
    print_line0()
    date = get_time()
    print(f"{COL_RED}# BEGIN PROCESS..... (Please Wait)  {COL_END}")
    print(f"{COL_RED}# Start at: {date}  {COL_END}")

def footer():
    print("")
    print_line0()
    date = get_time()
    print(f"{COL_RED}# Finish at: {date}  {COL_END}")
    print(f"{COL_RED}# END PROCESS.....  {COL_END}\n")

def push_package():
    for templ in HELM_TEMPLATE:
        msg_push(templ)
        subprocess.run(["helm", "s3", "push", f"{templ}*.tgz", HELM_REPO_NAME, "--force"])
        print("- DONE -")

def msg_push(template):
    print("")
    print_line2()
    date = get_time()
    print(f"{COL_BLUE}[ {date} ] ##### Push Package Helm : {template} ")
    print(f"{COL_GREEN}[ {date} ]       helm s3 push {template}*.tgz {HELM_REPO_NAME} --force {COL_END}")
    print_line2()

def helm_update():
    print("")
    print_line2()
    date = get_time()
    print(f"{COL_BLUE}[ {date} ] ##### Update Helm Repository : ")
    print(f"{COL_GREEN}[ {date} ]       helm repo update")
    subprocess.run(["helm", "repo", "update"])
    print("- DONE -")

def main():
    header()
    push_package()
    helm_update()
    footer()

if __name__ == "__main__":
    main()

