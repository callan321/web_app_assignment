

## Setup 
.env files removed from gitignore  and will be included in git.
### install dependencies 
```
git clone https://github.com/callan321/web_app_assignment.git
cd web_app_assignment
```
```
composer install
```
```
npm install
```
### Generate key and db
```
php artisan key:generate
```
``` 
php artisan app:database
```
### Run Dev Server 
```
php artisan serve
```
```
npm run dev 
```


### app:database 

The `app:database` command deletes the current SQLite database, creates a new one, and seeds it with data from `database.sql`.

- **Command**: [Laravel Command Documentation](https://laravel.com/docs/10.x/artisan#writing-commands)
- **File Facade**: [Laravel File Facade](https://laravel.com/docs/10.x/filesystem#the-file-facade)
- **DB Facade**: [Laravel DB Facade](https://laravel.com/docs/10.x/database#running-queries)


## Requirements 

- [x] All pages must have a navigation menu, either across the top of the page or down the left or right column.
- [x] The home page must display a list of all items in the database. Clicking on the item will bring up the review page for that item.
- [x] The review page will display all the details for that item (i.e. name, manufacturer, and any other detail for that item). Furthermore, it will display all reviews for that item. Each review contains the reviewer’s name, the rating, date of the review, and the review (text).
- [x] Users can create a new item. New item must have a name and a manufacturer.
- [x] Users can create a new review for an item. To add a review, user enters the username, rating, and the review text (which can be up to a few paragraphs of text). User (with the same name) cannot post multiple reviews for the same item. An item can have multiple reviews.
- [X] When adding a review, the user should not have to enter the date; the date should be taken from the system.
- [x] Input validation 1: A name (user, item, and manufacturer) must have more than 2 characters and cannot have the following symbols: `-`, `_`, `+`, `"`. Appropriate error message should be displayed on validation error.
- [x] Input validation 2: Any odd number in a username (e.g. 1Smith, Bob21, or Ace1337Nova) will be removed from the name before the name is stored. Example: 1Smith becomes Smith, Bob21 becomes Bob, Ace1337Nova becomes AceNova.
- [x] A message should be displayed to inform the user that the name they entered has been changed and display the altered name.
- [ ] Users can edit existing reviews.
- [ ] An item can be deleted. When a user deletes an item, the reviews for that item should also be deleted.
- [ ] When listing all items on the home page, the number of reviews and the average rating for that item should also be displayed.
- [ ] The home page has a feature where users can select to sort the list of items in the following ways:
- [ ] By the number of reviews
- [ ] By the average rating
- [ ] Users can select to sort by either ascending or descending order.
- [ ] There is a page that lists all manufacturers and displays the average rating for that manufacturer. The average rating for a manufacturer is the average of the average ratings of all items from that manufacturer.
- [ ] Clicking on a manufacturer will list all items and the average rating of each item from that manufacturer.
- [ ] Clicking on the item will bring up the review page for that item.
- [ ] After the user submits a review, the system remembers that user’s name for the duration of the session. Subsequent reviews made will not require the user to enter their name but will instead use the same username as the first post/comment.
- [ ] There is a feature that identifies or helps users identify fake reviews. You have to research methods for identifying or supporting the identification of fake reviews and implement the method(s). You will be judged on the usefulness, usability, creativity/innovation, and technical competence of your design and implementation.

## Check
- [ ] Form sanitation 
