$ This page lists various tweaks and fixes I had to apply to my system, so if you have the same symptoms, they might help you as well!

# Desktop manager won't start

This is a nasty one. After messing with my freshly installed Linux Mint, the MDM somehow stopped starting on boot, leaving me with the text login prompt.

I spent many hours (maybe even days!) searching a solution - in vain.

Here is what I did in the end:

1. Open `/etc/rc.local` for editing as root (`sudo gedit /etc/rc.local`)
2. Before `exit 0`, add `service mdm restart` (or kdm, gdm - what you're using)
3. Save and pray that it works ;)

My `rc.local` now looks like this:

```bash
#!/bin/sh -e
#
# rc.local
#
# This script is executed at the end of each multiuser runlevel.
# Make sure that the script will "exit 0" on success or any other
# value on error.
#
# In order to enable or disable this script just change the execution
# bits.
#
# By default this script does nothing.

service mdm restart

exit 0

```


# Vsync won't work, tearing windows

This is an annoying issue, and can have various causes.

Here's some tips I have collected on the net:

* Install latest drivers
* Enable vsync in the gfx card options (`nvidia-settings` or catalyst)
* For NVIDIA, set PowerMizer to "Performance"
* Add this into `/etc/environment`:

  ```bash
  CLUTTER_PAINT=disable-clipped-redraws:disable-culling
  CLUTTER_VBLANK=True
  ```

However, *none of those worked for me*.

In the end, I discovered that **the root of all evil** is `mate-window-manager` (a clone of Metacity, dubbed "Marco").

I tried to install compiz, but it didn't really work, so I eventually went for KWin.

## How to replace Marco with KWin

(this may work on other systems, too)

First, install `kde-window-manager`, `systemsettings` and all the various dependencies.

To replace Marco with KWin on-the-fly, run `kwin --replace`.

For some reason, I was not able to set KWin as the default window manager, so I ended with adding `kwin --replace` as one of the autostart applications. Ugly, but works fine.


# Some applications look ugly in Linux Mint / Mate

To be exact, this happened to Krusader and Synaptic.

I'm not sure what is the particular reason, something with incompatibilities between versions of GTK and Qt. Anyway, the fix is rather simple:

To get rid of this, install the `clearlooks-phenix-theme` package and select it in the "Appearance" settings module (`mate-appearance-properties`).
