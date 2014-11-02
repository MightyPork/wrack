$ This is a function that can be used for highlighting string characters at given positions.

I've given it as an answer to one StackOverflow question, where the goal was to highlight certain letters in a DNA sequence.

The characters at given positions are wrapped into a html tag of choice, but you can provide anything other than a tag, if you want.

*Feel free to use the function for whatever you want, that's why I am posting it here.*

# The function

```php
function highlightChars($text, $indices, $openTag, $closeTag) {
    sort($indices);
    $out = '';
    $last = 0;
    foreach($indices as $i) {
        $fragment = substr($text, $last, $i-$last);
        $letter = substr($text, $i, 1);
        $last = $i+1;

        $out .= $fragment . $openTag . $letter . $closeTag;
    }

    $out .= substr($text, $last);

    return $out;
}
```

## Example use

```php
// zero-based indices
$indices = array(5,13,21,8);

// input
$in = 'CAGGACACTCTTTCTAGTGTTGATTCACCTCGAAGAAGGT';

$openTag = '<b>';
$closeTag = '</b>';

// output
echo highlightChars($in, $indices, $openTag, $closeTag);
```

As an output in this example, we would get:
```html
CAGGA<b>C</b>AC<b>T</b>CTTT<b>C</b>TAGTGTT<b>G</b>ATTCACCTCGAAGAAGGT
```
