<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php bloginfo();?></title>
    <?php wp_head();?>
</head>
<body <?php body_class(array('first-class', 'second-class', 'third-class'));?> >