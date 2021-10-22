# Cachebuster plugin for Craft CMS 3.x

Handles cache busting server side

## Requirements

This plugin requires Craft CMS 3.0.0-beta.23 or later.

## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require /cachebuster

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Cachebuster.

## Cachebuster Overview

Made as an attempt to avoid having to set cache buster variables in multiple index.twig files.

Works by generating a timestamp in resources/timestamp.json that is being fetched by the plugin by calling the getTimestamp() method on the CachebusterVariable.

## Using Cachebuster

```twig      
{% set cacheBust = craft.cachebuster.getTimestamp() %}
{% do view.registerCssFile('@web/resources/css/site.min.css?v=' ~ cacheBust) %}
{% do view.registerJsFile('@web/resources/js/site.min.js?v=' ~ cacheBust) %}
```

##

Brought to you by [TIBE Molde](https://tibemolde.no)
