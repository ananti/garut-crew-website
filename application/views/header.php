<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title><?=(isset($title))?$title:''?> - Garut Crew</title>
    <?=html::stylesheet(array('public/media/stylesheet/style.css',),array('screen',))?>
    <?if (isset($styles)) foreach($styles as $st) echo html::stylesheet($st);?>
    <?=html::script("public/scripts/jquery/jquery.js");?>
    <?if (isset($scripts)) foreach($scripts as $sc) echo html::script($sc);?>
    <?=(isset($head))?$head:''?>
</head>
<body>
<div id="body_wrapper">
<div  id="top_nav">
    <? if(!$this->is_login) : ?>
    <ul>
        <li><?=html::anchor(url::site('registration', 'http'), "Register")?></li>
        <li><?=html::anchor(url::site('login', 'http'), "Sign In")?></li>
    </ul>
    <? else : ?>
    <span>Welcome, <?//=$this->auth_user->full_name?></span>
    <ul>
        <!-- TODO Link ke member private message -->
	<li>Server's time : <?=date('d/m/y h:i:s')?></li>
        <li><?=html::anchor(url::site('member/edit/'.$this->auth_user->id), "Setting")?></li>
        <li><?=html::anchor(url::site('messages'), "Private Messaging")?></li>
        <li><?=html::anchor(url::site('logout'), "Sign Out")?></li>
    </ul>
    <? endif; ?>
</div>
<div id="banner">
    <div id="logo">

        <div id="title">
            <span id="main"><?=html::anchor(url::site('', 'http'), 'Garut Crew')?></span>
            <span id="sub">Official Website</span>
        </div>
    </div>
</div>
