#!/usr/bin/env python3
import os
import shutil
import subprocess
from datetime import datetime

TITLE = "TERRAFORM SUBMODULES"
VER = "2.3"

PATH_CODEBUILD = os.getenv("CODEBUILD_SRC_DIR")
SUBMODULE_TERRAFORM_COMMUNITY = os.path.join(PATH_CODEBUILD, "module_community.lst")
SUBMODULE_TERRAFORM_OFFICIALS = os.path.join(PATH_CODEBUILD, "module_officials.lst")
PATH_MODULES = os.path.join(PATH_CODEBUILD, "terraform/modules/providers/aws")
PATH_MODULES_COMMUNITY = os.path.join(PATH_MODULES, "community")
PATH_MODULES_OFFICIALS = os.path.join(PATH_MODULES, "officials")

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
    print(f"{COL_RED}# Start at: {date}  {COL_END}\n")

def footer():
    print_line0()
    date = get_time()
    print(f"{COL_RED}# Finish at: {date}  {COL_END}")
    print(f"{COL_RED}# END PROCESS.....  {COL_END}\n")

def skip_exists(file_path):
    if os.path.isfile(file_path):
        print(f">> Skip for existing file {file_path} ...")
    else:
        subprocess.run(["git", "clone", "--depth", "1", file_path])

def submodule_cleanup():
    print_line2()
    date = get_time()
    print(f"{COL_BLUE}[ {date} ] ##### Rebuild Submodule(s): {COL_END}")

    os.chdir(PATH_CODEBUILD)
    shutil.rmtree("modules", ignore_errors=True)

    os.makedirs(PATH_MODULES_COMMUNITY, exist_ok=True)
    os.makedirs(PATH_MODULES_OFFICIALS, exist_ok=True)
    print('- REBUILD DONE -')

def submodule_terrafom_community():
    print_line2()
    date = get_time()
    print(f"{COL_BLUE}[ {date} ] ##### Download Community Submodule(s): {COL_END}")
    submodule_download(PATH_MODULES_COMMUNITY, SUBMODULE_TERRAFORM_COMMUNITY)

def submodule_terrafom_officials():
    print_line2()
    date = get_time()
    print(f"{COL_BLUE}[ {date} ] ##### Download Officials Submodule(s): {COL_END}")
    submodule_download(PATH_MODULES_OFFICIALS, SUBMODULE_TERRAFORM_OFFICIALS)

def submodule_download(path, submodule_file):
    os.chdir(path)
    with open(submodule_file, 'r') as file:
        for line in file:
            line = line.strip()
            date = get_time()
            print_line2()
            print(f"{COL_GREEN}[ {date} ]       git clone --depth 1 {line} {COL_END}")
            print_line2()
            subprocess.run(["git", "clone", "--depth", "1", line])
            print("")

    print('- DOWNLOAD DONE -')

def main():
    header()
    submodule_cleanup()
    submodule_terrafom_community()
    submodule_terrafom_officials()
    footer()

if __name__ == "__main__":
    main()

