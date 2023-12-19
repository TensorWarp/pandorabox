#!/usr/bin/env python3
import subprocess

def git_clone_ssh(url, destination):
    git_ssh_command = 'ssh -i ~/.ssh/id_rsa -o IdentitiesOnly=yes -F /dev/null'
    command = ['git', 'clone', '--depth', '1', url, destination]
    subprocess.run(command, env={'GIT_SSH_COMMAND': git_ssh_command})