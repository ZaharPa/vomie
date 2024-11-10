# Vomie

**Vomie** is an interactive platform for saving and sharing movie information. It allows users to view detailed movie information, rate and comment on films, and engage with the content through personalized profiles. This creates a community space for exchanging opinions and recommendations to aid in movie selection.

## Key Features
- **Movie Browsing**: Access full movie information, including title, photos, genre, cast, status, and links to additional resources.
- **User Interaction**: Users can rate and comment on movies, building a community for discussion and recommendations.
- **User Profiles**: Registration, authentication, and profile views allow for a personalized user experience.
- **Modular Architecture**: Multiple interfaces support flexibility and easy expansion of functionality.

## Tech Stack
- **Frontend**: HTML and CSS for the interface, JavaScript for interactivity.
- **Backend**: PHP for server-side processing and application logic.
- **Database**: MySQL to store and manage data on movies, users, ratings, and comments.
- **AJAX**: Asynchronous requests enhance user experience.

## Requirements
- **PHP**: Server-side scripting for processing requests.
- **MySQL**: Database management for handling movie, user, rating, and comment data.

## Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/ZaharPa/vomie.git
   cd vomie
3. Set up a MySQL database with the provided structure.
4. Configure the database connection in PHP.
5. Install dependencies:
   composer install
6. Start a local server.

## Architecture
1. **Interfaces and Classes**: The following interfaces are implemented, each with a corresponding class responsible for specific data handling tasks:
   - **Movie**: Interface and class for core methods managing basic movie information.
   - **MovieDetail**: Interface and class for handling additional details like photos, genre, and links.
   - **FeedBack**: Interface and class for processing ratings and user comments.
   - **User**: Interface and class for managing user information and actions.

2. **Project Structure**: 
   - The main site is assembled in `index.php`, which includes the header from `include/header.php` and the footer from 
   `include/footer.php`.
   - Main content for each page is dynamically loaded from the `pages` folder.
   - Additional folders include:
     - `images`: Contains all site images.
     - `styles`: Houses CSS files for styling.
     - `scripts`: Contains:
       - `class`: PHP classes for backend functionality.
       - `interface`: Interface definitions.
       - `JavaScript`: JavaScript files for interactive features.
       - PHP files that support AJAX requests.

3. **Database**: To manage and organize the movie-related data, the project uses a relational database model. Below is the schema that outlines the tables and their relationships:
    - **User**: Stores user information, including email, name, role, and profile photo.
    - **Movie**: Contains movie details such as title, description, type, and more.
    - **rate_user_movie**: Records users' ratings and status for each movie.
    - **genre_movie**: Links movies to their respective genres.
    - **photo_movie**: Stores movie photos, such as posters and stills.
    - **cast_movie**: Contains information about the movie's cast, including actor names and their roles.
    - **link_movie**: Stores external links related to the movie, such as trailers or official pages.
    - **comment**: Allows users to comment on movies.
    
    Below is the visual representation of the database schema:
   ![database](https://github.com/user-attachments/assets/deee91fa-5875-45ed-ad67-dbe906ccffdc)
   
## Screenshots
Below are some screenshots showing the functionality and appearance of the platform:
![home](https://github.com/user-attachments/assets/dd218340-a518-40a0-b6c1-d78b3af0dc15)
home page

![profile](https://github.com/user-attachments/assets/33a8c535-58a4-41f3-ad9d-67f0704bc302)
profile page

![movieDetail](https://github.com/user-attachments/assets/9140c633-57c3-47fc-a7d7-9ecc9f15a092)
view movie detail page 
