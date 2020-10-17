<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('database', 'email','Template', 'session', 'form_validation','encrypt','dynamic_menu','breadcrumbs','useronline');
$autoload['drivers'] = array();
$autoload['helper'] = array('url', 'file', 'security','func','vayes_helper');
$autoload['config'] = array();
$autoload['language'] = array();
$autoload['model'] = array('PublicModel');
