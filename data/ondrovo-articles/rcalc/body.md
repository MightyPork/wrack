$ "RCalc" is a command-line calculator, which gives results as fractions rather than imprecise decimal values.

However, it's more than just a calculator for your terminal - the important thing is that you can use the parser and evaluator **as a library** for your projects - and it's really good at what it does. That is, parsing a string to a syntax tree and evaluating it.

The only bigger limitation (and an intended one) is that it can't work with irrational numbers (`sqrt(2)`, `pi`, `e` etc). Everything that can be written as a fraction is fine, of course.


# On GitHub!

The project is available on GitHub, so if you want to help, or just want to check out the sources, here's a link:

* [MightyPork/rcalc][github]


# Downloads

* See the [releases on GitHub][github-releases]


# What it can do

The parser can calculate result of a mathematical formula entered as `String`. Those can consist of brackets, integral numbers and operators `+`, `-`, `*`, `/`, `%`, `!`.

It can't calculate square root, so if you need that, it can be a bit of a problem.

The numbers are represented by `BigInteger`, so it's no big deal to calculate a factorial of very big numbers, or calculate with some really mad-sized numbers.

## How to use it

I think you can make the best idea by looking at a little terminal output:

```no-highlight
$ java -jar rcalc.jar

Rational Calculator - interactive mode
--------------------------------------
(c) Ondrej Hruska 2013

Type 'help' for more info.

Enter expression, 'exit' to quit.

> 38/12
= 19/6

> a = 29^2
= 841

> b = 30!
= 265252859812191058636308480000000

> (a*b)/37
= 223077655102052680313135431680000000/37

> 99/13
= 99/13

> decimal
[FRACTIONAL MODE OFF]

> %
| 99/13
= 7.615384615384615
```

## How it works inside

After entering the `String`, it is preprocessed and converted to a sequence of tokens. A syntax tree is subsequently built of those, and its root node provides a method `evaluate()`, which triggers the whole calculation.

In short, the package `net.mightypork.rcalc` contains the library stuff, and `net.mightypork.calculator` keeps the calculator UI and some other application stuff. The "Library" download above contains only the `rcalc` package.

After adding it to your Build Path, the most basic use is like this:

```java
RCalc rc = new RCalc();
Fraction result = rc.evaluate("13+47^-1-3+99%5");
```

To get support for variables, use `RCalcSession` instead.

The `Fraction` class has methods to get the numerator, denominator, and even the value as `double`.

# Licensing

The project is available under the MIT license.

[github]: http://github.com/MightyPork/rcalc
[github-releases]: https://github.com/MightyPork/rcalc/releases/
