$ Long item lists are boring, so why not use columns instead?

Let's see how to print array items in nice, ordered columns.

# You have a list

You typically start with a list of items, here we have some numbers:

```PHP
$list = array(
    1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13
);
```

Now if you just feed it to a `for` loop, you will get something like this:

```
 1.   2.   3.
 4.   5.   6.
 7.   8.   9.
10.  11.  12.
13.
```

While this *is* in columns, it's ordered in rows, which isn't really easy to read - particularly if the items are some alphabetically ordered strings (eg. a list of checkboxes for adding tags to articles).

This is the **desired output**, in most cases (`-` is as invisible "gap" element):

```
 1.   6.  11.
 2.   7.  12.
 3.   8.  13.
 4.   9.   -
 5.  10.   -

```

So, how do we get that?

# "List to columns" function

It's pretty simple, but you must first make sure the list length is divisible by the number of columns.

You add some `null` values to get the right length, and when printing, either print invisible elements there, or just break the line and continue when you reach the next real item.

Here's a simple function that does that very thing:

``` PHP
/**
 * Prepare a list for column layout when being printed
 * in a loop and breaking line after each n-th item.
 */
function listToColumns($list, $cols = 3, $filler = null) {

    $list = array_values($list); // ensure orderly numeric keys

    // make length divisible by cols
    $overhang = (count($list)%$cols);
    if($overhang > 0) {
        $to_add = array_fill(0, $cols - $overhang, $filler);
        $list = array_merge($list, $to_add);
    }

    $per_col = count($list) / $cols;

    $out = array();

    // for all rows
    for($i=0; $i<$per_col; $i++) {

        // for each column
        for($j=0; $j<$cols; $j++) {

            // fetch item from column
            $k = $per_col*$j + $i;
            $out[] = $list[$k];

        }
    }

    return $out;
}
```

If you find any bug in the code, or get an idea for some improvement, don't be shy and share it in the comments below :)
