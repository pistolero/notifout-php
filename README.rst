PHP API for Notifout.com
===========================

What is Notifout.com
--------------------
Notifout.com is an online service which helps your application have nice-looking and reliable email notifications.

See `notifout.com <http://notifout.com/>`_ for details.


Requirements
------------

- cURL extension
- Notifout project token

Usage
-----


::

    require "notifout.php";

    $notifout = new Notifout('ohsh6Iez3Nah0ahmohz2ge');
    $notifout->send('signup', 'Dummy User <user@example.com>', array("first_name" => "Dummy"));
