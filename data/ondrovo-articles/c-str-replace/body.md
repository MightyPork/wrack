$ Recently I needed `str_replace()`, and although there's quite a few hits on Google, neither of them worked well for me.

So, here's my take at it, tested with `valgrind` to have no leaks.

One thing to keep in mind is that since the function allocates the output string, the caller must thereafter not forget to `free()` it.

Copiles nicely with `gcc -std=gnu99`, and seems to be OK when tested with *valgrind*.

# str_replace.c

```c
#include <stdio.h>
#include <stdlib.h>
#include <string.h>


char* str_replace(const char *src, const char *from, const char *to) {

    if(src == NULL || from == NULL || to == NULL) return NULL;

    // helper pointers
    const char * sp; // src pointer
    const char * mp; // match pointer
    char * dp; // dest pointer (for writing)


    // lengths
    size_t from_len = strlen(from);
    size_t to_len = strlen(to);
    size_t src_len = strlen(src);

    // count matches
    size_t count = 0;
    sp = src;
    while(1) {
        mp = strstr(sp, from); // find next match
        if(mp == NULL) break; // end of matches
        count++;
        sp = mp + from_len; // advance past match
    }

    // compute dest size
    size_t len = src_len;
    long int sub = (from_len - to_len)*count;

    // sanity check
    if(from_len >= to_len) {
        if(sub > len || sub < 0) return NULL;
    } else {
        if((len-sub) < 0 || sub > 0) return NULL;
    }

    // allocate output buffer
    size_t actual_size = (len - sub) + 1;
    char *dest = malloc( actual_size );

    // fill output buffer
    if(dest != NULL) {

        sp = src; // src pointer
        dp = dest; // dest pointer

        while(1) {
            mp = strstr(sp, from); // find next match
            if(mp == NULL) break; // end of matches

            // copy chunk before match
            memcpy(dp, sp, mp - sp);
            dp += mp - sp;

            // copy replacement
            memcpy(dp, to, to_len);
            dp += to_len;

            // advance past match
            sp = mp + from_len;
        }

        // copy tail
        size_t k = src_len - (sp - src) + 1;
        memcpy(dp, sp, k);

    }

    return dest;
}
```

# Usage

Usage is trivial:

```c
char *input, *res;
input = "cat dog cat dog";

res = str_replace(input, "cat", "HIPPO");

printf("%s", res); // "HIPPO dog HIPPO dog"

free(res); // clean up
```

When doing multiple replacements, one must take care of the `free()`:

```c
char *input, *res, *old;

input = "cat dog cat dog";

// input can't be free'd
res = str_replace(input, "cat", "HIPPO");

// but "res" here would be a leak
old = res;
res = str_replace(res, "dog", "ZEBRA");
free(old); // free old string


printf("%s", res); // "HIPPO ZEBRA HIPPO ZEBRA"

free(res); // clean up
```

