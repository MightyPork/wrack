$ Intro paragraph lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget consequat elit. Fusce venenatis tellus blandit iaculis cursus. Ut sed accumsan metus. Vivamus vulputate quam nec volutpat lacinia. Pellentesque eget massa nisi. Ut in pellentesque lorem, vel lobortis urna.


# Table

Block ID        | Block name
----------------|----------------
0               | Air
1               | Stone
7               | *Bedrock*
5               | **Wood**
255             | `java.lang.NullPointerException`


## Table with alignment

Something        |  Other stuff
---------------: | :---------------
Dog              |  Cat
Apple            |  Pear
Hippo            |  Elephant
Mooo             |  Woof



# Image

![Cat](kitty.jpg)



# Video

@[I like trains](hHkKJfcBXcw)



# Definition List

WWW
: World Wide Web

CMOS
: Complementary Metal–Oxide–Semiconductor



# Lists

## Unordered

* Item
* Other item
* Elephant


## Numbered

1. Hello
2. Hi
3. Good bye


## Lettered

a. foo
b. bar
c. baz


# Block Quote

> I changed my headlights the other day. I put in strobe lights
instead! Now when I drive at night, it looks like everyone else is
standing still ...

> -- Steven Wright


# Emphasis

Lorem ipsum *dolor sit amet*, consectetur adipiscing elit. Mauris eget consequat elit. Fusce venenatis tellus blandit **iaculis cursus**. Ut sed accumsan metus. Vivamus vulputate quam nec volutpat lacinia. _Pellentesque eget_ massa nisi. Ut in pellentesque lorem, vel lobortis urna.


# Code

## Inline code

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget consequat elit. Fusce venenatis tellus `java.lang.NullPointerException`. Ut sed accumsan metus. Vivamus vulputate quam nec volutpat lacinia. Pellentesque `echo` eget massa nisi. Ut in pellentesque lorem, vel lobortis urna..

## Block of code

### Fenced

~~~ java
import java.io.File;
import java.lang.reflect.Field;

import net.minecraft.client.Minecraft;

public class Start
{
    public static void main(String[] args)
    {
        try
        {
            Field f = Minecraft.class.getDeclaredField("minecraftDir");
            Field.setAccessible(new Field[] { f }, true);
            f.set(null, new File("."));
        }
        catch (Exception e)
        {
            e.printStackTrace();
            return;
        }

        Minecraft.main(args);
    }
}
~~~

### Indented

    import java.io.File;
    import java.lang.reflect.Field;

    import net.minecraft.client.Minecraft;

    public class Start
    {
        public static void main(String[] args)
        {
            try
            {
                Field f = Minecraft.class.getDeclaredField("minecraftDir");
                Field.setAccessible(new Field[] { f }, true);
                f.set(null, new File("."));
            }
            catch (Exception e)
            {
                e.printStackTrace();
                return;
            }

            Minecraft.main(args);
        }
    }
