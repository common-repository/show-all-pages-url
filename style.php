<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<style>

    .yydev-show-all-url {
        display: block;
        padding: 0px 10px 0px 10px;
        position: relative;
    }

    .yydev-show-all-url .yy-page-url {
        direction: ltr;
    }

    .yydev-show-all-url .yoast-seo-td {
        padding: 5px 0px 5px 0px;
        color: #ccc;
        vector-effect: middle;
    }

    .yydev-show-all-url .yoast-seo-td .yy-view-data {
        position: relative;
        top: -10px;
        margin: 0px -5px 0px 5px;
    }

    .yydev-show-all-url-rtl .yoast-seo-td .yy-view-data {
        margin: 0px 10px 0px -10px;
    }

    .yydev-show-all-url .yoast-seo-td p {
        direction: ltr;
    }

    .yydev-show-all-url .yy-marks-warp {
        display: inline-block;
    }

    .yydev-show-all-url .yy-not-exists {
        font-weight: bold;
        color: #ccc;
    }

    .yydev-show-all-url .yy-exists {
        color: #0073aa;
    }

    .yydev-show-all-url .yoast-seo-td p {
        padding: 2px 0px 2px 0px;
        margin: 0px;
    }

    .yydev-show-all-url .yoast-seo-td p.yoast-noindex {
        color: #858585;
        padding: 0px 3px 0px 3px;
        font-size: 12px;
    }

    .yydev-show-all-url .yy-float-menu-output {
        position: fixed;
        right: 0px !important;
        bottom: 60px !important;
        z-index: 999999999;
    }

    .yydev-show-all-url-rtl .yy-float-menu-output {
        left: 0px !important;
        right: auto !important;
    }

    .yydev-show-all-url .yy-float-menu-output a {
        display: block;
        clear: both;
        padding: 10px 10px 10px 10px;
        border: 1px solid #d9d9d9;
        direction: ltr;
        text-align: center;
    }

    .yydev-show-all-url h2 {
        font-size: 20px;
        color: #0085da;
    }

    .yydev-show-all-url .yy-darker-h2 {
        display: block;
        color: #fff;
        background: #0078c4;
        line-height: 30px;
        padding: 15px 20px 13px 20px;
        margin: 8px 0px 35px 0px;
    }

    .yydev-show-all-url h2 b {
        color: #f6ff00;
    }

    .yydev-show-all-url .yy-darker-h2 h2 {
        color: #fff;
        padding: 5px 0px 5px 0px;
        margin: 0px;
        font-size: 25px;
    }

    .yydev-show-all-url .yy-darker-h2 small {
        font-size: 14px;
        margin: 0px 5px 0px 5px;
        padding: 0px;
        line-height: 22px;
    }
    
    .yydev-show-all-url .yy-table-section {
        max-width: 90%;
        margin-bottom: 40px;
        padding: 0px 0px 10px 0px;
    }

    .yydev-show-all-url table {
        border-collapse: collapse;
    }

    .yydev-show-all-url table tr td { 
        border: 1px solid #d8d8d8;
        text-align: center;
        position: relative;
        padding: 5px;
    }

    .yydev-show-all-url table tr td a {
        display: block;
        padding: 13px 10px 13px 10px;
    }

    .yydev-show-all-url .yy-view-data {
        position: relative;
        top: 3px;
        margin: 0px -2px 0px 1px;
        padding: 0px 0px 0px 5px;
        z-index: 9999;
        cursor: pointer;
    }
    .yydev-show-all-url-rtl .yy-view-data {
        margin: 0px 4px 0px -5px;
    }


    .yydev-show-all-url .yy-data-warp {
        display: inline-block;
        position: relative;
    }

    .yydev-show-all-url .yy-data-warp b {
        color: #414141;
    }


    .yydev-show-all-url .yy-data-window {
        position: absolute;
        width: 300px;
        top: -70px;
        right: 20px;
        background: #fff;
        border: 1px solid #fff;
        padding: 30px;
        margin: 0px 4px 0px 0px;
        z-index: 99999999;
        border: 1px solid #b2b2b2;
        box-shadow: 0px 0px 20px rgba(37, 37, 37, 0.3);
        display: none;
        color: #444;
    }

    .yydev-show-all-url .page-notes .yy-data-window {
        width: 200px;
    }

    .yydev-show-all-url .yy-data-close {
        background: #ff0000;
        color: #fff;
        display: inline-block;
        padding: 4px 6px 4px 6px;
        text-decoration: none;
        font-weight: bold;
        font-size: 16px;
        position: absolute;
        top: -10px;
        right: -13px;
        border: 2px solid #fff;
        cursor: pointer;
        box-shadow: 0px 0px 20px rgba(37, 37, 37, 0.2);
    }


    .yydev-show-all-url table tr td.edit-page {
        background: #ededed;
        border: 1px solid #d3d3d3;
    }

    .yydev-show-all-url table tr th {
        background: #5f5f5f;
        color: #fff;
        padding: 10px 15px 10px 15px;
        border: 1px solid #dedede;
    }

    .yydev-show-all-url table tr th {
      position: sticky;
      z-index: 99;
      top: 32px;
    }

    .yydev-show-all-url span#footer-thankyou-code {
        margin: 0px 0px -30px 0px !important;
        padding: 0px;
        display: block;
        font-size: 14px;
        line-height: 1.55;
        font-style: italic;
        font-family: Arial,sans-serif !important;
        color: #555d66;
    }

    /*================================
    =============== Mobile
    ==================================*/

    @media only screen and (max-width: 960px) {

        .yydev-show-all-url .yy-table-section {
            width: 850px;
            overflow: auto;
        }

    }

</style>