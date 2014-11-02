$ This is a list of useful pieces of bash script I collected over the last few years.

I won't take credit for all of it. Some pieces are the fruit of tedious searching, particularly on StackOverflow, but others are truly my work.

If you have your own useful scripts, please post them in the comments, and I will include them in the page.

## How to install

The scripts are best utilized if you save them as an executable file in `/usr/bin` or similar place. You can then use them as commands in terminal, which is really handy.

Make sure your executable file starts with `#!/bin/bash`.


# Remove file with corrupt name

Sometimes there's a file with some weird characters in it's name, and you can't use `rm` to get rid of it. This script lists the directory and lets you pick `inode` of the file you want to delete.

```bash
#!/bin/bash
# The "rmcor" script by MightyPork

if [ "$1" == "-a" ]; then
    ls . -q -1 -i --almost-all
else
    ls . -q -1 -i
fi;

echo -n "Enter ID to destroy (nothing = cancel):"; read filenumber;
if [ "$filenumber" == "" ]; then
    echo "Aborted.";
    exit 1;
fi;
find . -inum $filenumber -exec rm -i {} +;
echo "File deleted.";
exit 0;
```

# Create thumbnails

If you have a directory with images and want to make their downscaled versions, this is a script for you. It is made to work with `*.jpg` files, and saves the results in a `./thumbs` folder.

To get it working, you need the `convert` program from the `imagemagick` package.

```bash
#!/bin/bash
# The "jpgthumbs" script by MightyPork

if [ -z "$1" ]; then
    echo "Arguments: WxH"
    echo "You can use also Wx and xH.";
    exit;
fi;
mkdir ./thumbs &> /dev/null
ls *.jpg | tr '\\n' '\\00' | xargs -0 -i{} rm "./thumbs/{}" -f
ls *.jpg | tr '\\n' '\\00' | xargs -0 -i{} convert -resize "$1" "{}" "thumbs/{}"
```


# Kill by name

This script can be used if you know the name of a process, but not it's PID. Note that usually you can use the `killall` command instead.

```bash
#!/bin/bash
if [ "$1" == "" ]; then
    echo "No process name given, aborting.";
    exit 1;
fi;

echo "Matches:";
ps -C "$1";

for i in `ps -C "$1" -o pid=`; do
    echo -n "Terminate \\"$i\\" (Y/n)?"; read a;
    if [[ "$a" == "Y" || "$a" == "y" ]]; then
        kill $i;
        echo "\\"$i\\" terminated.";
    else
        echo "\\"$i\\" skipped.";
    fi;
done;

exit 0;
```


# Zync - the SSH file transfer script

This is a rather complicated script, so I made a separate [article about it][zync].

It is used to transfer files to and from a remote SSH server. It's particularly useful if you want to edit files in graphical editor, and there is only the SSH interface to your server.


*More stuff will be added later*

[zync]: article/zync "Zync"
