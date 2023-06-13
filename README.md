# Web Scraping With PHP 
## by Abraham López

[<img src="https://img.shields.io/static/v1?label=&message=PHP&color=brightgreen" />](https://github.com/topics/php) [<img src="https://img.shields.io/static/v1?label=&message=Web%20Scraping&color=important" />](https://github.com/topics/web-scraping) 


## Prerequisites

The system requires having previously installed PHP in a version equal to or greater than 8.0, and composer and a web server such as Apache or Nginx

## Installation

#### Clone the repository
The project should be cloned with the following URL git@github.com:alcinf/php-scraper.git
Cloning can be done with an editor like VSCode, or from the terminal (git init, git clone...)
The folder must be in the folder or subfolder where the server's public files are located (www, htdoc, etc.)

#### Permissions
Full permissions must be given to the folder where the project was cloned.
From the terminal is chmod -R 777 myfolder

#### Open from the web browser
The browser opens looking for the path corresponding to where the project was cloned (localhost/myproject)



## User Manual

On the main screen, the field and button to add a new website are at the top, while the bottom part is a table with the websites that have been scraped. Each website name is also a link to see its references to other websites.

### Add website

The web to be analyzed is entered in the initial text field. We proceed to analyze, pressing the "Scrape" button. The web will be analyzed and the result will be shown below.

### Display grid of scraped webs

The main table shows the websites analyzed and the number of links found. Each name is also the link to show the detail. The table has pagination and search.

### Display grid of links for each website

This second view shows a table with the links found on each website, its URL and its title. Some links do not have a description so it will be shown empty, but with a link. The table has pagination and search.