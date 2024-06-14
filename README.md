# GRTECH

please follow the step.

## Setup Instructions

1. **Clone the repository**
    ```bash
    git clone <this repo>
    cd <this folder name>
    ```

2. **Install PHP Dependencies**
    ```bash
    composer install
    ```

3. **Setup Environment Variables**
    ```bash
    cp .env.example .env
    fullfill the DB and EMAIL record
    ```

4. **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

5. **Install JavaScript Dependencies**
    ```bash
    npm install
    ```

6. **Compile Assets for Development**
    ```bash
    npm run dev
    ```
    then open new terminal

7. **Database Setup**

   **Migrate the Database**
    ```bash
    php artisan migrate
    ```

   **Seed the Database (Optional)**
    ```bash
    php artisan db:seed
    ```
8. **Storage Link**

   **Create Symbolic Link for Storage**
    ```bash
    php artisan storage:link
    ```
9. **Start the Development Server**
    ```bash
    php artisan serve
    ```

Access the application at `http://localhost:8000`.