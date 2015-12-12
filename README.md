# MVC Lite

[![Build Status](https://travis-ci.org/corycollier/mvc-lite.svg?branch=master)](https://travis-ci.org/corycollier/mvc-lite)
[![Latest Stable Version](https://poser.pugx.org/corycollier/mvc-lite/v/stable)](https://packagist.org/packages/corycollier/mvc-lite)
[![Total Downloads](https://poser.pugx.org/corycollier/mvc-lite/downloads)](https://packagist.org/packages/corycollier/mvc-lite)
[![Latest Unstable Version](https://poser.pugx.org/corycollier/mvc-lite/v/unstable)](https://packagist.org/packages/corycollier/mvc-lite)
[![License](https://poser.pugx.org/corycollier/mvc-lite/license)](https://packagist.org/packages/corycollier/mvc-lite)


## Introduction
mvc-lite is a lightweight MVC Framework aimed at accomplishing common MVC
goals in a much lighter package. The bulk of this work is inspired by the
Zend Framework (http://framework.zend.com)

## Usage
This library should be used to create a simple MVC application. If you need
sophisticated application handling, consider a more robust framework, like
Zend Framework, Laravel, or Symfony.

## Quick Start
The `mvc` script can be used to help start an application quickly. It's usage is:
```
./bin/mvc setup --target=/local/path/to/app
```

Once created, adding an entire resources (i.e. Users) can be done like this:
```
./bin/mvc resource:create --target=/local/path/to/app --name=users
```

## Full Documentation
Full documentation can be found on our [GitHub Pages site](http://corycollier.github.io/mvc-lite)
