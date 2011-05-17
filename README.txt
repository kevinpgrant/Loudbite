README
======

Synopsis
--------
'Loudbite.com' is a sample application to track users favourite music artistes'.
 It is described in the Apress book 'Beginning Zend Framework', written by
 Armando Padilla (ch2 pg38).

This project contains all of the downloadable source code from the book, merged
 into git on a chapter by chapter basis so you can use git to review and compare
 the changes incrementally, as an aid to learning the code. 

Introduction
------------
Welcome to Zend! This is an EXAMPLE application for learning purposes, and you
 should NOT consider it to be production ready.

This project (https://github.com/kevinpgrant/Loudbite) is a derivative work,
 where for the past 6 weeks or so I have taken the source codes provided and
 got it working more-or-less as per the description in the book.

You will have some work to do, but the idea is that you should be able to
 extract this app onto your server, point it at your db, add your .htaccess 
 and api keys, and be experimenting with Zend in minutes, rather than weeks!

Description
-----------
Unfortunately, the code examples were incomplete, and the errata included from 
 beginningzendframework.com only covers upto chapters 3 & 4. The book spends
 a lot of its time introducing then successively revising the same function -
 in contrast to the style of introducing a class and going over it line by line
 to explain each step. This can be bewildering and cause more confusion as the
 reader tries to figure out what they should actually have in place.

So much time got spent on variations of code that don't get used, that there
 was skant little detail on how to add the views / routing etc to actually get
 it to work properly at the end of each chapter.

Opportunities to introduce good coding style / habits - especially as the book
 is aimed towards newbies, were also missed: e.g. (re)use of class properties
 in methods for values like API keys, email server settings, etc.

There are numerous examples (mostly hardcoded) in the book, and it concluded
 with a whirlwind introduction to Lucene and caching with Zend, memcached etc.
 This was another lost opportunity - had these been introduced sooner, the
 author may have been able to incorporate them into the app and demonstrate
 their usefulness to newbies, instead of giving yet-another dry example.

The result is a book which began well, had a clear & flowing narrarative style
 which explains the app in detail and defined clear milestones to reach, yet
 failed to deliver an actual working example Zend app at the end.

Conclusion
----------
 /* Don't use it in production! */

This project is only a patch-up, not a complete rewrite, so expect rough edges!
 I have restrained myself to only making changes that were necessary to get the
 examples working, even though I wanted to start making those 'improvements' =)

Im sure that experienced Zend / OOP php developers will have many suggestions
 on ways to improve this basic app - that is the point, really ;-)

If you wish to offer suggestions for improvement, like role based permissions,
 security fixes, encrypted passwords, better session handler, or to show how
 Lucene / memcached could actually be incorporated properly - great! As those
 changes are really beyond the scope of the book (and therefore also this task)
 please do so by cloning this project and make your changes public!

Otherwise, if you spot something wrong with the basic app itself please let me
 know so I can correct it asap, or add it to the 'known issues' section...

Known Issues
------------

 * The artist profile page shows a list of links to the (hardcoded) examples
   from the source code / book. The examples from the latter  part of the book
   may be reached via the homepage. These could be hidden for 'production' env

 * email signup component is untested, as I relied on URLs to activate users.
   (a note on the homepage tells you how you can activate a user)
   This is insecure and open to abuse - again, could hide this on prod.

 * the update user details component doesn't actually write to anything the db

 * there is no way to 'remove' an artiste from your list without manipulating
   the db directly (you can add though)

 * I'm probably breaking numerous Zend coding standards. Oh dear.
   If anyone wants to offer help with adding Unit Tests / using automatic code
   tools to improve the quality of the code please get in touch!
   (particularly if you have experience of PHPUnit, Hudson and|or Selenium)

Suggested Improvements
----------------------

 * The artist profile page shows a list of links to the (hardcoded) examples
   from the source code / book. The examples from the latter  part of the book
   may be reached via the homepage. These could be hidden for 'production' env

 * the list of artistes is per-user, rather than per site - so you could
   end up with umpteen copies of 'u2', or dozens of different spellings of the
   same artiste. This is wasteful, the user could have chosen an artiste from
   a list, or click to add one, if their favourite was not listed. This would
   have been a great place to add a jQuery / AJAX autocompleter, and blend it
   with Lucene (search) and (mem)cached results! Unfortunately, out of scope.


Note to ALL publishers:
-----------------------
It should NOT be left as an exercise for the reader to get examples working,
 although it is okay at the end of a chapter to make suggestions or hint at
 possible enhancements beyond the scope of the example, for the unaided reader.

disclaimers
-----------
I hereby make no warranty, express or implied, about merchantability or
 fitness for any particular purpose. It is shared for its educational value and
 purposes only. Use it at your own risk / discretion. Your mileage may vary.
 
 All trademarks and copyrights acknowledged to their rightful owner(s).

 This work is an educational (non-profit) derivative of a combination of sources

Book Details
------------
    * Title: Beginning Zend Framework
    * Author: Armando Padilla
    * Paperback: 424 pages
    * Publisher: Apress; 1 edition (September 2, 2009)
    * Language: English
    * ISBN-10: 1430218258
    * ISBN-13: 978-1430218258

links
-----

http://www.apress.com/9781430218258/
[publisher's site - see the 'source code/download' tab on this page too]

http://www.beginningzendframework.com/
[book's own site, with errata]

http://www.hashbangcode.com/blog/beginning-zend-framework-armando-padilla-563.html
[book review]
