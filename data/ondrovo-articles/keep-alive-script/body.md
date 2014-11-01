$ This script can be used to automatically restart a process when it ends (eg. crashes)

I wanted to use the `docky` dock application, but it kept crashing with segmentation fault. Nothing unusual, but in case of dock it's quite unfortunate.

To fix the problem, I wrote this script which takes care of restarting docky (and anything else you use it for).

It's equipped with a lock file, so that you can't by accident run it twice to observe the same process.

## Usage

Usage is simple:

```bash
./keep_alive.sh COMMAND_TO_EXECUTE
```

So, for example:

```bash
./keep_alive.sh docky
```

# The Script

```bash
#!/bin/bash

# precess name to keep alive
PROCNAME=$1

# prepare lock name
LOCKFILE=/tmp/.${PROCNAME}_lock

# check lock
if [ -e ${LOCKFILE} ] && kill -0 `cat ${LOCKFILE}`; then
    echo "Already running."
    exit
fi

# set trap to undo lock when killed
trap "rm -f ${LOCKFILE}; exit" INT TERM EXIT

# create lock file
echo $$ > ${LOCKFILE}

# main loop
while true
do
    # respawn process if it's not running
    ps cax | grep "${PROCNAME}" | grep -v "$0" > /dev/null
    if [ $? -eq 1 ]; then
        echo "Respawning ${PROCNAME}"
        ${PROCNAME} &
    fi

    # wait
    sleep 0.5
done;


# undo lock
rm -f ${LOCKFILE}
```

*Have fun, and comment if you find a problem with the script!*
