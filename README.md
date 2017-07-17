# Spoons Web Manager
Online manager for offline spooning, created for and by [**iD Tech Camps**](https://www.idtech.com/) at **Princeton University**.

![screenshot](screenshot.png)

## Notes

This was quickly hacked together in a short amount of time by multiple tired staffers with very little time on our hands, so I can guarantee there are serious goofs and gaffes, possibly with some security implications. Use at your own risk and feel free to [report back](https://github.com/jakejarvis/spoons/issues)!

#### [Click here to view Snake's Spooning Statutes™, the official Spoons rulebook.](https://docs.google.com/document/d/1Gc0H1ITcNZ0Fg3WQI4Q4HtMpMUBrT_2PReOWc62RIQU/edit?usp=sharing)


## Deploying to Heroku

Easily deployable (for free!) to [Heroku](https://www.heroku.com/) as of Summer 2017. Just sign up for an account, create a new app, add the [JawsDB MySQL add-on](https://elements.heroku.com/addons/jawsdb) (free tier is plenty), run the `db_structure.sql` file to initialize the empty tables, and [set the following environment variables](https://devcenter.heroku.com/articles/config-vars#setting-up-config-vars-for-a-deployed-application) in the Heroku dashboard:

- `SITE_URL`: base URL with no trailing slash; ex: https://idspoons.herokuapp.com
- `SITE_PASSWORD`: the password that allows staff members past the login page
- `TZ`: time zone in [TZ format](https://en.wikipedia.org/wiki/List_of_tz_database_time_zones); ex: America/New_York

Optional (but really [**awesome**](http://synonymsforawesome.com)) SMS reporting capabilities can be added for very little cost — just a few bucks should get you through the whole summer. [Sign up for a Twilio account](https://www.twilio.com/), add some credit, claim a catchy phone number, and point its text webhook callback to `http://{your domain}/sms_hook.php` via HTTP POST. Don't forget to change the phone number that's displayed in the `sms.php` how-to page.

---

with love,

[**Scrabble** ♥](https://jakejarvis.com)