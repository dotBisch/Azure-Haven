## 🚀 Getting Started

<p>Follow these steps to set up and run the application locally:</p>

```bash
# 1. 🔁 Clone the Repository
git clone https://github.com/your-username/your-repo.git
cd your-repo

# 2. 📦 Install PHP Dependencies
# Make sure Composer is installed: https://getcomposer.org/
composer install

# 3. 🧰 Install Node.js Dependencies
# Ensure Node.js and npm are installed: https://nodejs.org/
npm install

# 4. ⚙️ Configure Environment Variables
cp .env.example .env
# Then open the .env file and update database credentials and other configs.

# 5. 🔐 Generate Application Key
php artisan key:generate

# 6. 🏗️ Run Database Migrations
# Make sure your database exists and is properly configured in .env
php artisan migrate

# 7. 🌱 (Optional) Seed the Database
php artisan db:seed

# 8. 🛠️ Build Front-End Assets
npm run build      # for production
# or
npm run dev        # for development with hot reloading

# 9. 🖥️ Start the Development Server
php artisan serve
# Visit http://localhost:8000 in your browser

📝 Additional Notes
PHP 8.1 or higher is required.
Set up a MySQL (or supported) database and update your .env file accordingly.
For email features, configure mail settings in .env.
For production, configure your web server (Apache/Nginx) and set correct permissions for the storage/ and bootstrap/cache/ directories.

Contributors:
- Barrientos, Nicole
- De Villa, Franz Ivan
- Momo Yasmin
- Padlan, Jezrielle
