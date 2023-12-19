#!/usr/bin/env python3
import os
import subprocess
from datetime import datetime

TITLE = "TERRAFORM OFFICIAL SUBMODULES"
VER = "2.3"

PATH_FOLDER = os.getcwd()
SUBMODULE_TERRAFORM = os.path.join(PATH_FOLDER, "module_officials.lst")
PATH_MODULES = os.path.join(PATH_FOLDER, "terraform/modules/providers/aws/officials")

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

def submodule_terrafom():
    print_line2()
    date = get_time()
    print(f"{COL_BLUE}[ {date} ] ##### Download Official Submodule(s): {COL_END}")

    os.chdir(PATH_MODULES)
    with open(SUBMODULE_TERRAFORM, 'r') as file:
        for line in file:
            line = line.strip()
            date = get_time()
            print_line2()
            print(f"{COL_GREEN}[ {date} ]       git clone --depth 1 {line} {COL_END}")
            print_line2()
            subprocess.run(["git", "clone", "--depth", "1", line])
            print("")

    print("- DOWNLOAD DONE -")

def main():
    header()
    submodule_terrafom()
    footer()

if __name__ == "__main__":
    main()
