<h1>RedirectionProject</h1>
<p>RedirectionProject is a web application developed in PHP following the MVC architecture. It enables users to create custom redirect URLs, facilitating the tracking of links from external sources such as Google Drive documents, SharePoint, or other similar platforms. This functionality is comparable to Pardot's Custom Redirect feature, which allows the creation of personalized links to monitor user interactions.
<p></p>
<h2>Key Features</h2>

<p><b>Redirect Creation: Allows users to generate custom URLs that redirect to specific destinations.</p>
<p><b>Redirect Management:</b> Provides an interface to view, modify, or delete existing redirects.</p>
<h2>Technologies Used</h2>

<p><b>Languages:</b> PHP, JavaScript, HTML, CSS</p>
<p><b>Architecture:</b> MVC</p>
<p><b>Database:</b> MySQL</p>

## Database Setup

This application uses a MySQL database.

1.  **Ensure you have a MySQL server running.**
2.  **Create a database named `tackdirect`**. You can use a tool like phpMyAdmin or the MySQL command line:
    ```sql
    CREATE DATABASE tackdirect CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    ```
3.  **Import the schema.** The table structure is defined in `database/schema.sql`. You can import it using:
    *   **Command Line:**
        ```bash
        mysql -u your_username -p tackdirect < database/schema.sql
        ```
        (Replace `your_username` with your MySQL username. You will be prompted for your password.)
    *   **phpMyAdmin:** Select the `tackdirect` database, go to the "Import" tab, and upload the `database/schema.sql` file.

4.  **Verify database credentials.** The application connects to the database using credentials in `src/lib/database.php`. By default, it's set to:
    *   Host: `localhost`
    *   Database name: `tackdirect`
    *   User: `root`
    *   Password: `root`
    If your MySQL setup uses different credentials, please update them in `src/lib/database.php`:
    ```php
    // src/lib/database.php
    function linkDbConnect()
    {
        try {
            $database = new PDO ('mysql:host=localhost;dbname=tackdirect;charset=utf8','root','root'); // Update 'root','root' if needed
        }  catch (Exception $e)  {
                die('Erreur : '.$e->getMessage());
        }
        return $database;
    }
    ```
