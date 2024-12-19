# Auction Website

This project is a database-driven website built for auctioning cars. It is developed as part of the CSY2028 Web Programming assignment using PHP, MySQL, and a Docker environment. The project adheres to the supplied design layout and meets all specified requirements.

---

## REMINDER THAT AFTER YOU DO docker compose up -d it will take a few minutes for the website to initialize so you might encounter an error for sql connection rejected
## for this just go to the place with the link `https://as1.v.je` and press enter so that it refreshes it will operate as intended. 
## User Credentials

### Standard User:
- **Username**: user@user.com
- **Password**: user123

### Admin User:
- **Username**: admin@admin.com
- **Password**: nepal123

### Another User:
- **Username**: sandesh@user.com
- **Password**: sandesh

---

## Features

### Public Features:
- User Registration and Login.
- Post and manage car auctions with categories.
- Display the 10 most recently added auctions on the homepage.
- View cars by category and  auction pages.
- Add and view reviews for users who post auctions.
- Search for auctions using keywords.
- Place and view bids for auctions.

### Admin Features:
- Manage categories (Add, Edit, Delete).
- Password-protected administration area.
- Option to manage administrator accounts (add, edit, delete).

### Additional Enhancements:
- Secure password hashing.
- Support for uploading and displaying images for auctions.
- User-friendly navigation with drop-downs, select boxes, and category links.
- Keep track of bid history for auctions.
- Fully functional search bar with relevance-based sorting.

### Completion Status:
- All basic requirements and additional requirements have been implemented successfully.

---

## Installation

1. **Prerequisites**:
   - Docker
   - PHP 8
   - MySQL database

2. **Setup**:
   - Clone the repository:  
     ```bash
     git clone 
     ```
   - Navigate to the folder containing the `websites` directory and Docker files (i.e. `as1`):
     ```bash
     cd as1
     ```
   - Start the Docker environment:
     ```bash
     docker-compose up
     ```
   - Access the website at `https://as1.v.je`.

3. **Database**:
   - The database structure is included in `database.sql`. Ensure this is imported into the Docker MySQL instance.

---

## Usage

- **Home Page**: Displays the 10 most recent auctions.
- **Auction Management**: Users can create, edit, and delete auctions.
- **Admin Management**: Accessible only to administrators for category management.
- **Search**: Use the search bar to find auctions by keywords.
- **Reviews**: Add reviews on user profiles through auction pages.
- **Bidding**: Place and manage bids on auctions.

---



## Technologies Used

- **Languages**: PHP, HTML, CSS, SQL
- **Frameworks/Libraries**: Bootstrap (if applicable for styling)
- **Database**: MySQL
- **Environment**: Docker

## reference image for astonn martin 
`https://pngimg.com/image/54525`