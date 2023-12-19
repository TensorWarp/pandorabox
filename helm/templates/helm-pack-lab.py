#!/usr/bin/env python3
import os
import subprocess
from datetime import datetime

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
    return datetime.now().strftime('%Y-%m-%d %H:%M:%S')

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

def remove_old():
    for templ in HELM_TEMPLATE:
        msg_remove(templ)
        os.system(f"rm -f {templ}-*.tgz")
        print("- DONE -")

def packaging():
    for templ in HELM_TEMPLATE:
        msg_package(templ)
        os.system(f"helm package {templ}")
        print("- DONE -")

def msg_remove(template):
    print("")
    print_line2()
    date = get_time()
    print(f"{COL_BLUE}[ {date} ] ##### Remove Old Package : {template} ")
    print(f"{COL_GREEN}[ {date} ]       rm -f {template}-*.tgz {COL_END}")
    date = get_time()
    print_line2()

def msg_package(template):
    print("")
    print_line2()
    date = get_time()
    print(f"{COL_BLUE}[ {date} ] ##### Packaging Helm : {template} ")
    print(f"{COL_GREEN}[ {date} ]       helm package {template} {COL_END}")
    date = get_time()
    print_line2()

def main():
    header()
    remove_old()
    packaging()
    footer()

if __name__ == "__main__":
    main()

