[[css:begin]]

span.dr{display:inline;color:transparent}span.dr.s16 span{display:inline-block;width:16px;height:16px;line-height:16px;text-align:center;vertical-align:middle;background:url('/dwarf-runes/images/dwarf-runes-16.png') 0px 16px no-repeat;margin:0;padding:0}span.dr.s16.d .a{background-position:-16px -0px}span.dr.s16.d .b{background-position:-16px -16px}span.dr.s16.d .c{background-position:-16px -32px}span.dr.s16.d .d{background-position:-16px -48px}span.dr.s16.d .e{background-position:-16px -64px}span.dr.s16.d .f{background-position:-16px -80px}span.dr.s16.d .g{background-position:-16px -96px}span.dr.s16.d .h{background-position:-16px -112px}span.dr.s16.d .i{background-position:-16px -128px}span.dr.s16.d .j{background-position:-16px -144px}span.dr.s16.d .k{background-position:-16px -160px}span.dr.s16.d .l{background-position:-16px -176px}span.dr.s16.d .m{background-position:-16px -192px}span.dr.s16.d .n{background-position:-16px -208px}span.dr.s16.d .o{background-position:-16px -224px}span.dr.s16.d .p{background-position:-16px -240px}span.dr.s16.d .q{background-position:-16px -256px}span.dr.s16.d .r{background-position:-16px -272px}span.dr.s16.d .s{background-position:-16px -288px}span.dr.s16.d .t{background-position:-16px -304px}span.dr.s16.d .u{background-position:-16px -320px}span.dr.s16.d .v{background-position:-16px -336px}span.dr.s16.d .w{background-position:-16px -352px}span.dr.s16.d .x{background-position:-16px -368px}span.dr.s16.d .y{background-position:-16px -384px}span.dr.s16.d .z{background-position:-16px -400px}span.dr.s16.d .th{background-position:-16px -416px}span.dr.s16.d .ea{background-position:-16px -432px}span.dr.s16.d .st{background-position:-16px -448px}span.dr.s16.d .ng{background-position:-16px -464px}span.dr.s16.d .ee{background-position:-16px -480px}span.dr.s16.d .n0{background-position:-16px -496px}span.dr.s16.d .n1{background-position:-16px -512px}span.dr.s16.d .n2{background-position:-16px -528px}span.dr.s16.d .n3{background-position:-16px -544px}span.dr.s16.d .n4{background-position:-16px -560px}span.dr.s16.d .n5{background-position:-16px -576px}span.dr.s16.d .n6{background-position:-16px -592px}span.dr.s16.d .n7{background-position:-16px -608px}span.dr.s16.d .n8{background-position:-16px -624px}span.dr.s16.d .n9{background-position:-16px -640px}span.dr.s16.d .dash{background-position:-16px -656px}span.dr.s16.d .underscore{background-position:-16px -672px}span.dr.s16.d .atsign{background-position:-16px -688px}span.dr.s16.d .comma{background-position:-16px -704px}span.dr.s16.d .dot{background-position:-16px -720px}span.dr.s16.d .bang{background-position:-16px -736px}span.dr.s16.d .question{background-position:-16px -752px}span.dr.s16.d .semicolon{background-position:-16px -768px}span.dr.s16.d .bracketl{background-position:-16px -784px}span.dr.s16.d .bracketr{background-position:-16px -800px}span.dr.s16.d .parenl{background-position:-16px -816px}span.dr.s16.d .parenr{background-position:-16px -832px}span.dr.s16.d .bracel{background-position:-16px -848px}span.dr.s16.d .bracer{background-position:-16px -864px}span.dr.s16.d .less{background-position:-16px -880px}span.dr.s16.d .greater{background-position:-16px -896px}span.dr.s16.d .dollar{background-position:-16px -912px}span.dr.s16.d .slash{background-position:-16px -928px}span.dr.s16.d .backslash{background-position:-16px -944px}span.dr.s16.d .plus{background-position:-16px -960px}span.dr.s16.d .colon{background-position:-16px -976px}span.dr.s16.d .hash{background-position:-16px -992px}span.dr.s16.d .equals{background-position:-16px -1008px}span.dr.s16.d .percent{background-position:-16px -1024px}span.dr.s16.d .quote{background-position:-16px -1040px}span.dr.s16.d .apos{background-position:-16px -1056px}span.dr.s16.d .pipe{background-position:-16px -1072px}span.dr.s16.d .asterisk{background-position:-16px -1088px}span.dr.s16.d .power{background-position:-16px -1104px}span.dr.s16.d .tilde{background-position:-16px -1120px}span.dr.s16.d .and{background-position:-16px -
1136px}span.dr.s16.d .space{background-position:-16px -1152px}

[[css:end]]

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
