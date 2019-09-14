# Endouble-interview

This project is the result of the Back-end assessment given by Endouble.

- [Assessment](#assessment)
- [Installation](#installation)
- [API](#api)
- [Testing](#testing)
- [Discussion](#discussion)


## Assessment

**Task:** You must build a RESTful API that, based on a predetermined sets of fixed requests, will return the correct responses.

**Details of the task:** 

* The API backend will have to connect to one or more remote sources, retrieve its data through an appropriate connector module and transform it accordingly before outputting it.

* You can build the API in whichever way you prefer, as long as the results are correct and consistent and the connector modules are decoupled from the main API.

* **Please note:** The requests provided are the first results that will be checked, but the API should work with variable request parameters (it's enough to vary "year" and "limit"). If the below test cases don't match without proper justification the review will be negative.

* Please build a solution that can easily accommodate multiple additional remote sources (each remote source would be selected by a different value of the "sourceId" input field, as described by their "ID" below).

* You must also provide detailed set-up/installation instructions.

* Automated tests are optional but highly recommended.

* Do not abuse the API's! Those are publicly accessible resources, you don't want to overload them by firing thousands of requests each time. Hint: this applies especially for XKCD comics API.

**Hint:** SpaceX API is easier to use. XKCD is less easy to navigate, and you'll have to build a workaround for that. This is intended and part of the test.

**SpaceX launches API:**

API root: [https://api.spacexdata.com/v2/launches](https://api.spacexdata.com/v2/launches)

ID: "space"

**XKCD comics API:**
 
API homepage with instructions: [https://xkcd.com/json.html](https://xkcd.com/json.html)

ID: "comics"


## Installation

### Project

First of all you will need to clone this project onto your local.

```bash
git clone https://github.com/FabrizioKruislandEndouble/endouble-interview
```

### Homestead

Make sure you have installed [VirtualBox](https://www.virtualbox.org/wiki/Downloads) and [Vagrant](https://www.vagrantup.com/downloads.html)

Then add the laravel/homestead box to give yourself a head start with running this project.

```bash
vagrant box add laravel/homestead
```

Install Homestead by cloning the repository onto your host machine. 

```bash
git clone https://github.com/laravel/homestead.git ~/Homestead
```
Move to the newly created Homestead and make sure you checkout the latest release.

```bash
cd ~/Homestead
```
```bash
git checkout release
```

Once you have cloned the Homestead repository, run the bash init.sh command from the Homestead directory to create the Homestead.yaml configuration file. The Homestead.yaml file will be placed in the Homestead directory:

```bash
# Mac / Linux...
bash init.sh

# Windows...
init.bat
```

Now you have the Homestead.yaml file you will need to map your folder and site to the newly cloned project 'endouble-interview'.

```bash
folders:
    - map: ~/LaravelEnvironment/endouble-interview
      to: /home/vagrant/endouble-interview

sites:
    - map: endouble-interview.test
      to: /home/vagrant/endouble-interview/public
```

Ok, now this is done you can bring up the vagrant environment. 

```bash
cd ~/Homestead
```

```bash
vagrant up
```

Now when your vagrant box is up and running you can ssh into the box and run a composer install in the endouble-interview project directory.


```bash
vagrant ssh
```

```bash
cd endouble-interview
```

```bash
composer install
```

Great! You are good to go. Now everything is running and installed you can interact with the API.


## API

### Endpoints

Seen the scope of this assessment I chose to create two API endpoint with multiple query parameters which you could use to filter 

```python
/api/spacex
/api/comics
```

### Params
The values for the parameters are dynamic, so you can easily filter for the result you expect.

**year:** 2019

**limit:** 2

## Testing

For testing purposes there are tests for the Spacex and XKCD API. You can easily run the test by running the following command in your projcet root.

```bash
phpunit
```

## Discussion

### Language
Seen the fact that the main coding language for this Back-end position most likely will be PHP I chose to write this REST API in PHP. Considering the amount of requests we have to do so we can find posts in a specific year from the XKCD API, Python would maybe have been a better choice (Considering the amount of requests per second).

### Framework
When it comes to PHP frameworks, Laravel is almost always my first choice. This is mainly due to my experience with Laravel and the speed of development. Seen the scope of this project, no database and no front-end, I chose Lumen instead of Laravel. Yes I could have chosen to use Symphony, but this also felt like an overly large approach. Would I have wrote this project in Python my chose would have go to Django.

### Installation/Set-up
Homestead? Why not use php artisan serve.. Well this is on of the nice things that is not included in Lumen by default. Assuming you all have a PHP vagrant box I think this installation wouldn't be a problem for you. If you want to run the project via Homestead you can do so by following the [Installation](#installation) manual.

### Architecture
TO DO:: write down choises of architecture

