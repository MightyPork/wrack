$ When developing something, you often need a simple HTML template. Here's one you can use.

# Pure basics

```html
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <title>TITLE</title>
</head>
<body>
    <!-- document body -->
</body>
</html>
```

# The universal template

This template contains all of the most-used stuff. It's a good starting point for a website.

```html
<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>TITLE</title>

    <link href="favicon.ico" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="YOUR_CSS_FILE">

    <script src="YOUR_JS_FILE"></script>

    <!-- jQuery -->
    <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <style type="text/css">
        /* some CSS */
    </style>

    <script type="text/javascript">
        /* some javascript */
    </script>
</head>
<body>
    <!-- document body -->
</body>
</html>
```
