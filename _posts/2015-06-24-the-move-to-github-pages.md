---
title: "The Move to Github Pages"
source_url: 
date: 2015-06-24 12:36:52 +0700
tags:
 - etc
---

I both like and dislike Blogger for its simplicity.
For one, I can just write and let Blogger publish, serve, and even promote it.
Statistics (mostly view count), ads integration, and powerful search feature are available out of the box as we are talking about one of Google's products.
But that's it. We can customize it to our liking if we want, 
but it will be a bit difficult or at least there isn't (to me) any easy way to do that.
Creating your own theme for example (just like what I did with this blog), 
requires you to write your theme in one long XML file.
Now, I'm not a very good coder myself, but I like structured code better.
And finally, here I am, moving my blog to Github Pages and using Jekyll to organize it.

*So, how was it?*

For one it was not that difficult. It was mostly about copy-pasting my previous css, js, and template for Blogger and reorganize them. 
Also I need to know how Jekyll handles the posts and pages.
The file naming convention is not really convenient as I need to write each post as `year-month-day-an-awesome-title-here.ext`, 
but I wrote a little script to help me with that, so no problem.

Overall, here are the things I like:

1. Markdown is available out of the box  
   *IF* you use Jekyll. No biggies here, I also wrote my posts in Blogger using markdown. I may share my markdown tools for Blogger later.

2. Github  
   Well, [the page is served through Github's blazing fast CDN][1].

3. Jekyll  
   Well, nothing to say here.

And here are the things that I don't:

1. Github Pages' software bundle is out of date  
   For example, Github Pages uses Jekyll 2.4.0, meaning that you also get some old bugs that have already been fixed in the newer version, e.g. you cannot do this:
```
defaults:
  -
    scope:
      path: ""
      type: "posts"
    values:
      permalink: /:year/:month/:day/:title.html
  -
    scope:
      path: "category"
      type: "posts"
    values:
      permalink: /category/:title.html
```
   You will literally get `/:year/:month/:day/:title.html` and `/category/:title.html`. 
   Instead, you need to specify the custom permalink in your post's [Front Matter][2].

2. Search  
   As it's all about static HTML files, you can't really create a decent search feature here.


Overall, it was a new experience, and we'll see how long this blog will last ^^

[1]: https://github.com/blog/1715-faster-more-awesome-github-pages
[2]: http://jekyllrb.com/docs/frontmatter/