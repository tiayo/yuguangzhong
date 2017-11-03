<?php

//验证码
$this->get('/captcha/{group}', 'CaptchaController@captcha')->name('captcha');