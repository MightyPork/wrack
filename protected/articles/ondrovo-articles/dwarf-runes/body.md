<link rel="stylesheet" href="body-runes.css">

$ This script is a proof-of-concept of using a spritesheet to replace text with small elements with background image.

Here's an example output, so you can make a better idea of it:

<p style="text-align: left;"><span class='dr d s16'><span class='f' title='F'>F</span><span class='ea' title='ea'>ea</span><span class='r' title='r'>r</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='a' title='a'>a</span><span class='n' title='n'>n</span><span class='y' title='y'>y</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='b' title='b'>b</span><span class='r' title='r'>r</span><span class='ea' title='ea'>ea</span><span class='c' title='c'>c</span><span class='h' title='h'>h</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='o' title='o'>o</span><span class='f' title='f'>f</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='th' title='th'>th</span><span class='i' title='i'>i</span><span class='s' title='s'>s</span><br>
<span class='s' title='s'>s</span><span class='ea' title='ea'>ea</span><span class='l' title='l'>l</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='t' title='t'>t</span><span class='o' title='o'>o</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='th' title='th'>th</span><span class='e' title='e'>e</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='e' title='e'>e</span><span class='m' title='m'>m</span><span class='p' title='p'>p</span><span class='i' title='i'>i</span><span class='r' title='r'>r</span><span class='e' title='e'>e</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='b' title='b'>b</span><span class='e' title='e'>e</span><span class='y' title='y'>y</span><span class='o' title='o'>o</span><span class='n' title='n'>n</span><span class='d' title='d'>d</span><span class='comma' title=','>,</span><br>
<span class='f' title='f'>f</span><span class='o' title='o'>o</span><span class='r' title='r'>r</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='b' title='b'>b</span><span class='e' title='e'>e</span><span class='y' title='y'>y</span><span class='o' title='o'>o</span><span class='n' title='n'>n</span><span class='d' title='d'>d</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='a' title='a'>a</span><span class='r' title='r'>r</span><span class='e' title='e'>e</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='th' title='th'>th</span><span class='o' title='o'>o</span><span class='s' title='s'>s</span><span class='e' title='e'>e</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='w' title='w'>w</span><span class='h' title='h'>h</span><span class='o' title='o'>o</span><br>
<span class='c' title='c'>c</span><span class='a' title='a'>a</span><span class='n' title='n'>n</span><span class='n' title='n'>n</span><span class='o' title='o'>o</span><span class='t' title='t'>t</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='s' title='s'>s</span><span class='ee' title='ee'>ee</span><span class='space' title='&nbsp;'>&nbsp;</span><span class='e' title='e'>e</span><span class='v' title='v'>v</span><span class='i' title='i'>i</span><span class='l' title='l'>l</span><span class='dot' title='.'>.</span></span></p>

(This text comes from the book "Naked Empire" by Terry Godkind, btw.)

To get into the Tolkien theme, check out [this example page][graystone]. If you don't know where exactly *that* text appeared, you should better re-read the Hobbit book.

# Download

The script and the image sheets are available for **[free download][dl]**, you can even paint your
own runes or customize the script to do what you want.



# How it works & how to use it

## Options

There's a lot of config options and comments within the class file `DwarfRunes.php`, so make sure you read it all.

## How to use the script

You have two options: either generate the stylesheet and runes on the fly, or as in the case of this article, pre-generate them, and put it into a static html page.

The usage of the generation script is fairly easy.

Once you include it, make an instance tell it to do what you want:

``` php
$dr = new DwarfRunes();

// make CSS styles
$css = $dr->generateCss(true, true, array(16), "dark");

// make the runes
$runes = $dr->encode("Hello World", 16, "dark");

// and now echo it in the right place
```

*For full info about arguments and usage, read the source file.*

## How it works - the magic

![Sprite sheet][sheet]

If you check the source of this page, you will see a ugly block of minified CSS, and a block of not much prettier &lt;span&gt;s. It's not pretty, but then, normal people don't read source codes, usually..

However, despite making ugly code, it has the advantage over some other rune generators that the text can be selected and copied with mouse, and since all letters are in single sprite sheet (look on right, that's a chunk of it), it loads almost instantly.

The *translator class* itself is fairly simple. What kinda complicates matters is that the original runes from Hobbit have separate symbols for "ng", "st", "th" and others, so it has to properly parse those.

If you want to see all this, **go read the source file**, there's a ton if interesting and crazy code.

*Have you used this tool for anything? Like it? Share your opinions in the comments below!*

[graystone]: dwarf-runes
[dl]: dwarf-runes.zip
[sheet]: runes-sheet-example.png "Example of the sprite sheet" {.img-float}
