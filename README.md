<p align="center"> <img style="max-width: 100%; margin: 2rem auto; display: block;" src=cover_github.jpg></p>

# Events | October CMS

MoonWalkerz present "Events"! A simple event plugin for October CMS. this plugin allows you to create and publish events on your website. What more do you want?

## 🔥 Features 🔥

- Fully manageable from backend.
- Add and manage multiple categories.
- Add and manage multiple locations.
- Add and manage multiple tags.
- Add and manage mutiple contacts.
- You can set the start and end of the event.

## 💊 Dependencies 💊

this plugin needs the following dependencies:
- Rainlab.Translate
- Inetis.ListSwitch

## 🚀 Install 🚀

You can install this plugin with this command:

```
composer require moonwalkerz/events-plugin
```
Next:

```
php artisan october:migrate
```

## ⚙️ Documentation ⚙️

Using this plugin is really simple! Once installed just insert the component on the page and and enter the settings and filters you want.

below some examples:

### Example of an event page with url like /event/yyy/mm/dd/slug
```
url = "/evento/:y/:m/:d/:slug"
layout = "default"
title = "Evento"

[eventPage]
slug = "{{ :slug }}"
y = "{{ :y }}"
m = "{{ :m }}"
d = "{{ :d }}"
==
<div class="w-full bg-orange py-16 -my-16">
<div class="container mx-auto ">
{% component 'eventPage' %}
</div>
</div>
```
### Example of a page with a list of events
The list of events has two possible types of pagination, the classic one with page numbering or the incremental one that adds new events by pressing loadmore
url = "/events/:page?"
layout = "default"
title = "Events"
```
[eventList]
pageNumber = "{{ :page }}"
eventsPerPage = 9
skip = 0
paginate = 0
timeline = 1
sortOrder = "date_from asc"
eventPage = "event"
categories = "{{ :categories }}"
==
<div class="container mx-auto">
{% component 'eventList' %}
</div>
```

### Example of a page with a list of events filtered by tag
```
url = "/tag/:tags/:page?"
layout = "default"
title = "Events by Tag"

[eventList]
pageNumber = "{{ :page }}"
eventsPerPage = 9
skip = 0
paginate = 0
timeline = 1
sortOrder = "date_from asc"
eventPage = "event"
categories = "{{ :categories }}"
tags = "{{ :tags }}"
==
<section class=" relative pb-32">
    <div class=" container mx-auto">
        <div class="text-center pt-32 pb-24"> 
            <h2 class="text-white uppercase font-light text-4xl pb-3">Events  tagged by {{ tags }} </h2>
        </div>
    {% component 'eventList' %}
    </div>
</section>
```
## 🙏 Big Thanks to 🙏
- Leaflet | http://leafletjs.com
- Rainlab | https://github.com/rainlab

 

## 🤑 Support Us 🤑

These codes make your life easier and you avoid wasting time?\
Give us some RedBull!

BUSD(BEP20)\
0x367B9207ACBC30022F9A7262320E36661D7Ffeb5

## ✉️ Contact Us ✉️ 

Do you have any suggestions?\
Do you need to customise this plugin?

Mail: webmaster@moonwalkerz.dev\
Telegram: @MoonWalkerzDev
