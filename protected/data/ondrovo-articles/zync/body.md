$ This is a script I made for moving files to and from a remote SSH server.

The script is based on `ssh` and `scp`, accompanied by the `sshpass` tool for non-interactive SSH login.

The typical usage (for developing some stuff) is that you download what is on the remote server, work with the files locally, and send back those you changed.

In some ways it may be similar to `rsync`, and inferior at that, but that's not the point. I didn't want to go into the trouble of learning how to use `rsync`.

The script is called `zync`.

# Download

* Please visit the GitHub repo for download: [MightyPork/zync](https://github.com/MightyPork/zync)

# Installation

You can put the script in `/usr/bin` as an executable file and use it just like any other program (`zync [args]`), or just mark it as executable and keep it in the directory where you want to use it (and use `./zync [args]` to call it).

## Creating a config file

After you run the script for the first time in your desired folder, you will get this:

```terminal
$ zync

Config file does not exist, use the "cfg" argument to create it!

```

So let's do it:
```terminal
$ zync cfg

Creating config file zync.cfg

```

Now there should be a file called `zync.cfg` in your folder. Open it with your favorite editor (gedit, kwrite, vi, nano).

You should get something like this:
```bash
PORT=22
PASS="password"
USER="root"
ADDR="127.0.0.1"

# remote dir should start and end with slash
REMOTE_DIR="/"
LOCAL_DIR="remote"

VERBOSE=1
COPYRIGHT=1
```

### Configuring the connection

This is the most important part. Fill in the `PORT`, `PASS`, `USER` and `ADDR` fields to match those of your SSH connection.

### Configuring the folders

Now there is are those mysterious `REMOTE_DIR` and `LOCAL_DIR`.

`REMOTE_DIR` is the absolute path of the stuff you want to access on your remote server - `/` if you want to play with the root folder, or something like `/home/john/Documents/`.

`LOCAL_DIR` is a name of the folder used to store the local copy of the remote files. This folder will be created in the same folder as the config file. The default name `remote` should be fine, so you can let it be.

# Basic usage

Here is a list of the supported operations.

Please note that all paths are relative to what you defined as `REMOTE_DIR` in the config file.

## Technical commands

### zync help
Get the help message.

*Example:* `zync help`

### zync probe
This will connect to the remote server via plain `ssh`, so it should ask you to accept the certificate and enter a password. You can use this option to make sure the certificate is accepted and the other commands will work fine.

*Example:* `zync probe`

## Filesystem commands

### zync ls PATH
List a remote directory

*Example:* `zync ls var/log/apache2` (assuming REMOTE_DIR is `/`)


### zync mkdir PATH
Create a remote folder (including parent folders)

*Example:* `zync mkdir home/john/my-new-folder`


### zync rmdir PATH
Remove a remote folder (must be empty).

*Example:* `zync rm home/john/junk-folder`


### zync rm PATH
Remove a remote file. Be careful with this one!

*Example:* `zync rm home/john/junk.txt`


## zync commands


### zync get MODE PATH
Download remote files to local copy

MODE is one of:

* *file* - single file
* *dir* - a directory with files - ignoring child directories
* *tree* - a directory recursively

*Example:* `zync get tree home/john`

*Example:* `zync get file home/john/my-folder/image.jpg`


### zync update MODE PATH
The same as `zync get`, but it will erase the target directories in the local copy before downloading remote files.

This is the preferred way to sync remote files to local copy; Then, you can upload modified files back one-by-one, or
simply send it all at once.

`update` works with all three MODEs.

*Example:* `zync update tree home/john`

### zync send MODE PATH
Upload local files to remote server

`send` works with all three MODEs.

*Example:* `zync send file home/john/my-folder/image.jpg`


## Aliases

For convenience, there is a bunch of aliases for the actions.

* `zync pull` = `zync get`
* `zync push` = `zync send`
* `zync list` = `zync ls`
* `zync del` = `zync rm`


# Feedback?

*If you have any questions or suggestions regarding the script, please use the comments section below.*
