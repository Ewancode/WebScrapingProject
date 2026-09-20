# Streetwear Savings — price-comparison website

A-Level Computer Science coursework (NEA), 2025–26. Awarded grade A.

A multi-page retail website for a clothing price-comparison concept, with user
registration and login backed by a MySQL database.

## What this repository contains

| Path | Contents |
|---|---|
| `site/` | The website: 9 HTML pages, `style.css`, and the two PHP scripts |
| `images/` | Logos and photography used by the pages (compressed for this repo) |

## Tech stack

- **Front end:** HTML5, CSS3 (hand-written, no framework)
- **Back end:** PHP
- **Database:** MySQL

## Pages

`index` · `apparel` · `trainers` · `Collectibles` · `TradingCards` · `electronics`
· `AboutUs` · `SignUp` · `Login`

## Registration and login

`connect.php` handles account creation. Two things it does deliberately:

- **Prepared statements** (`mysqli_prepare` / `mysqli_stmt_bind_param`) so user
  input is never concatenated into the SQL string.
- **SHA-512 hashing** of the password before insertion, so no plaintext
  credential is ever written to the database.

## Scope — what was built and what wasn't

The project was specified as a price-comparison site: a scraper would collect
product and price data from several clothing retailers, normalise it into one
schema, match the same product across differently-worded listings, and the site
would surface the cheapest option.

**Built and delivered:** the full front end, the database schema, and the account
registration and login flow.

**Designed but not implemented:** the scraping layer and the product-matching
logic. These were specified in the written NEA but not completed in code before
the deadline. The scraping work I did complete is in a separate repository
(`nike-product-scraper`).

## Known limitations

These are real and I know about them — listed rather than hidden:

- `login.php` builds its query by string interpolation rather than using a
  prepared statement, and compares the submitted password directly. It is
  vulnerable to SQL injection and does not hash on comparison. `connect.php`
  (registration) does both correctly; the login path was never brought up to
  the same standard.
- `login.php` also references an undefined `$email` variable.
- There is no scraper integration, so prices on the category pages are static.

## Running it locally

Needs PHP and MySQL (XAMPP or similar). Credentials are read from the
environment — `DB_HOST`, `DB_USER`, `DB_PASSWORD`, `DB_NAME` — and are not
stored in this repository.
