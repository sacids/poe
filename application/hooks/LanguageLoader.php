<?php

class LanguageLoader
{
    function initialize()
    {
        $ci =& get_instance();
        $ci->load->helper('language');

        $siteLanguage = $ci->session->userdata('site_lang');

        if ($siteLanguage) {
            $ci->lang->load('auth', $siteLanguage);
            $ci->lang->load('ion_auth', $siteLanguage);
            $ci->lang->load('poe', $siteLanguage);
        } else {
            $ci->lang->load('auth', 'english');
            $ci->lang->load('ion_auth', "english");
            $ci->lang->load('poe', "english");
        }
    }
}