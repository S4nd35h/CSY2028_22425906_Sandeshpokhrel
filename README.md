# Auction Website

This project is a database-driven website built for auctioning cars. It is developed as part of the CSY2028 Web Programming assignment using PHP, MySQL, and a Docker environment. The project adheres to the supplied design layout and meets all specified requirements.

---

## It may take a few minutes for the website to initialize, during which time you might encounter a "SQL connection rejected" error. If this happens, go to the following link:`https://as1.v.je`and press Enter to refresh the page. The website should operate as intended after that.

## User Credentials

### Standard User:
- **Username**: user@user.com
- **Password**: user123

### Admin User:
- **Username**: admin@admin.com
- **Password**: Nepal123

### Another User:
- **Username**: sandesh@user.com
- **Password**: sandesh

---

### Features
### Public Features:
- User Registration and Login: Users can register, log in and access the website.
- Auction Management: Users can post, edit, and manage their car auctions.
- Auction Display: The homepage shows the 10 most recent car auctions.
- Category-Based Viewing: Users can view auctions categorized by types of cars (e.g., sedan, SUV, etc.).
- Auction Details: Each auction has a detailed page with a description, image, current bid, and bidding options.
- Search Auctions: A functional search bar allows users to search auctions by keywords (title or description).
- Place Bids: Users can place bids on auctions and see the current bid status.
- Reviews: Users can view and add reviews for auctioneers on the bidding pages.

### Admin Features:
- Category Management: Admin users can manage categories by adding, editing, and deleting them.
- Admin Management: Admins can manage other admin accounts (add, edit, delete).
- Admin Login: Access to a password-protected admin area to manage categories and user accounts.

### Additional Enhancements:
- Password Hashing: All passwords are securely hashed using PHP’s password_hash for secure authentication.
- Image Upload: Users can upload and display images for their auctions.
- Navigation: User-friendly navigation with dynamic category links for easy browsing.
- Search Optimization: The search bar sorts results based on relevance, showing auction results that best match the search term.

### Completion Status:
--All basic and additional features as outlined in the assignment have been successfully implemented and tested.
---

## Installation

1. **Prerequisites**:
   - Docker
   - PHP 8
   - MySQL database

2. **Setup**:
   - Clone the repository:  
     ```bash
     git clone <repo link>
     ```
   - Navigate to the folder containing the `websites` directory and Docker files (i.e. `as1`):
     ```bash
     cd as1
     ```
   - Start the Docker environment:
     ```bash
     docker-compose up -d
     ```
   - Access the website at `https://as1.v.je`.
   - As mentioned above, the website will take a bit to load so you may encounter an error saying connection refused. Just close the tab and try again a few times.

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
