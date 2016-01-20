<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>

<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="<?php echo ($PUBLIC_PATH); ?>/ueditor1/ueditor.parse.js"></script>
    </head>
    <body>
        <div id="content">
            <p>dsfsdF</p>
            <p>sdsdf</p>
            <h1>asfgafdhgd</h1>
            <?php echo ($DOCMENT); ?>
        </div>
        <script type="text/javascript">
            uParse("#content",{rootPath:"/blog/Admin/public/ueditor1/"});
        </script>
    </body>
</html>