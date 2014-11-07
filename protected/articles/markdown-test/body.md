$ Intro paragraph lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris eget consequat elit. Fusce venenatis tellus blandit iaculis cursus. Ut sed accumsan metus.

Curabitur non velit vel mi ultrices scelerisque. Suspendisse est velit,
porttitor vitae nisi et, accumsan varius nulla. Etiam tempus urna massa, eu
fermentum nisl adipiscing sit amet. Pellentesque sit amet laoreet tellus.
Aenean consectetur elit vitae est convallis lacinia.


# Table

Vivamus vehicula leo vitae leo accumsan, non hendrerit urna
condimentum. Maecenas congue velit urna, in eleifend felis hendrerit posuere.
Aenean tristique justo id mollis blandit.

Block ID        | Block name
----------------|----------------
0               | Air
1               | Stone
7               | *Bedrock*
5               | **Wood**
255             | `java.lang.NullPointerException`

## Table with alignment

Vivamus vehicula leo vitae leo accumsan, non hendrerit urna
condimentum. Maecenas congue velit urna, in eleifend felis hendrerit posuere.
Aenean tristique justo id mollis blandit.

Something        |  Other stuff
---------------: | :---------------
Dog              |  Cat
Apple            |  Pear
Hippo            |  Elephant
Mooo             |  Woof

Vivamus vehicula leo vitae leo accumsan, non hendrerit urna
condimentum. Maecenas congue velit urna, in eleifend felis hendrerit posuere.
Aenean tristique justo id mollis blandit.


# Image

![Cat](kitty.jpg)



# Video

@[I like trains](hHkKJfcBXcw)



# Definition List

Vivamus vehicula leo vitae leo accumsan, non hendrerit urna
condimentum. Maecenas congue velit urna, in eleifend felis hendrerit posuere.
Aenean tristique justo id mollis blandit.

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

Not yet implemented in markdown extra :(

a. foo
b. bar
c. baz


# Block Quote

Vivamus vehicula leo vitae leo accumsan, non hendrerit urna
condimentum. Maecenas congue velit urna, in eleifend felis hendrerit posuere.
Aenean tristique justo id mollis blandit.

> I changed my headlights the other day. I put in strobe lights
instead! Now when I drive at night, it looks like everyone else is
standing still ...

> -- Steven Wright

Vivamus vehicula leo vitae leo accumsan, non hendrerit urna
condimentum. Maecenas congue velit urna, in eleifend felis hendrerit posuere.
Aenean tristique justo id mollis blandit.

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
