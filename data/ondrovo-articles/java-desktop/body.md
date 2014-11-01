$ If you've ever tried to open a link in Java, or edit a file, you know that `java.awt.Desktop` is almost useless. Here's a working replacement for it.

This class comes from one of my projects, and it has been simplified and reduced to what I think is pretty much standalone.

Feel free to include it in your projects when the original API fails - which it will: if not on Windows, on Linux it's almost guaranteed.

## How is this different, better?

I've made some research and found commands that work on different systems, and ways how to run them from within Java. The way this class works is that it first tried the best ones, then it tries the general ones, and as a last resort, falls back to the Desktop API.

It is tested to work on Linux (KDE, Gnome and about any other X-server based systems), Mac and Windows. It should also work on Solaris, but that doesn't really matter, because Solaris is nearly extinct.


# The source code

``` java
package net.mightypork.utils;


import java.awt.Desktop;
import java.io.File;
import java.io.IOException;
import java.net.URI;
import java.util.ArrayList;
import java.util.List;


public class DesktopApi {

    public static boolean browse(URI uri) {

        if (openSystemSpecific(uri.toString())) return true;

        if (browseDESKTOP(uri)) return true;

        return false;
    }


    public static boolean open(File file) {

        if (openSystemSpecific(file.getPath())) return true;

        if (openDESKTOP(file)) return true;

        return false;
    }


    public static boolean edit(File file) {

        if (openSystemSpecific(file.getPath())) return true;

        if (editDESKTOP(file)) return true;

        return false;
    }


    private static boolean openSystemSpecific(String what) {

        EnumOS os = getOs();

        if (os.isLinux()) {
            if (runCommand("kde-open", "%s", what)) return true;
            if (runCommand("gnome-open", "%s", what)) return true;
            if (runCommand("xdg-open", "%s", what)) return true;
        }

        if (os.isMac()) {
            if (runCommand("open", "%s", what)) return true;
        }

        if (os.isWindows()) {
            if (runCommand("explorer", "%s", what)) return true;
        }

        return false;
    }


    private static boolean browseDESKTOP(URI uri) {

        logOut("Trying to use Desktop.getDesktop().browse() with " + uri.toString());
        try {
            if (!Desktop.isDesktopSupported()) {
                logErr("Platform is not supported.");
                return false;
            }

            if (!Desktop.getDesktop().isSupported(Desktop.Action.BROWSE)) {
                logErr("BORWSE is not supported.");
                return false;
            }

            Desktop.getDesktop().browse(uri);

            return true;
        } catch (Throwable t) {
            logErr("Error using desktop browse.", t);
            return false;
        }
    }


    private static boolean openDESKTOP(File file) {

        logOut("Trying to use Desktop.getDesktop().open() with " + file.toString());
        try {
            if (!Desktop.isDesktopSupported()) {
                logErr("Platform is not supported.");
                return false;
            }

            if (!Desktop.getDesktop().isSupported(Desktop.Action.OPEN)) {
                logErr("OPEN is not supported.");
                return false;
            }

            Desktop.getDesktop().open(file);

            return true;
        } catch (Throwable t) {
            logErr("Error using desktop open.", t);
            return false;
        }
    }


    private static boolean editDESKTOP(File file) {

        logOut("Trying to use Desktop.getDesktop().edit() with " + file);
        try {
            if (!Desktop.isDesktopSupported()) {
                logErr("Platform is not supported.");
                return false;
            }

            if (!Desktop.getDesktop().isSupported(Desktop.Action.EDIT)) {
                logErr("EDIT is not supported.");
                return false;
            }

            Desktop.getDesktop().edit(file);

            return true;
        } catch (Throwable t) {
            logErr("Error using desktop edit.", t);
            return false;
        }
    }


    private static boolean runCommand(String command, String args, String file) {

        logOut("Trying to exec:\\n   cmd = " + command + "\\n   args = " + args + "\\n   %s = " + file);

        String[] parts = prepareCommand(command, args, file);

        try {
            Process p = Runtime.getRuntime().exec(parts);
            if (p == null) return false;

            try {
                int retval = p.exitValue();
                if (retval == 0) {
                    logErr("Process ended immediately.");
                    return false;
                } else {
                    logErr("Process crashed.");
                    return false;
                }
            } catch (IllegalThreadStateException itse) {
                logErr("Process is running.");
                return true;
            }
        } catch (IOException e) {
            logErr("Error running command.", e);
            return false;
        }
    }


    private static String[] prepareCommand(String command, String args, String file) {

        List<String> parts = new ArrayList<String>();
        parts.add(command);

        if (args != null) {
            for (String s : args.split(" ")) {
                s = String.format(s, file); // put in the filename thing

                parts.add(s.trim());
            }
        }

        return parts.toArray(new String[parts.size()]);
    }

    private static void logErr(String msg) {
        System.err.println(msg);
    }

    private static void logOut(String msg) {
        System.out.println(msg);
    }

    public static enum EnumOS {
        linux, macos, solaris, unknown, windows;

        public boolean isLinux() {

            return this == linux || this == solaris;
        }


        public boolean isMac() {

            return this == macos;
        }


        public boolean isWindows() {

            return this == windows;
        }
    }


    public static EnumOS getOs() {

        String s = System.getProperty("os.name").toLowerCase();

        if (s.contains("win")) {
            return EnumOS.windows;
        }

        if (s.contains("mac")) {
            return EnumOS.macos;
        }

        if (s.contains("solaris")) {
            return EnumOS.solaris;
        }

        if (s.contains("sunos")) {
            return EnumOS.solaris;
        }

        if (s.contains("linux")) {
            return EnumOS.linux;
        }

        if (s.contains("unix")) {
            return EnumOS.linux;
        } else {
            return EnumOS.unknown;
        }
    }
}
```

You may want to modify the `logErr()` and `logOut()` methods to use your Logger - if you have any. Now they would simply print to the console.
