<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Course Roadmap Generator

A Laravel web application that generates personalized course roadmaps using Google’s Generative Language API (Gemini). Users can register, log in, and submit course details (course name, duration, level, and purpose) via a form. The application sends a prompt to the Gemini API, receives a generated roadmap, and saves it in the database for later review.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation and Setup](#installation-and-setup)
- [Environment Configuration](#environment-configuration)
- [Commands to Run the Project](#commands-to-run-the-project)
- [Usage](#usage)
- [API Integration](#api-integration)
- [Project Structure](#project-structure)
- [Troubleshooting](#troubleshooting)
- [License](#license)

## Features

- **User Authentication:**  
  - Registration, Login, Logout, and Password Reset powered by Laravel Breeze (Blade with Alpine.js).
  
- **Course Roadmap Generation:**  
  - Form to input course details: name, duration, level (Beginner, Intermediate, Advanced), and purpose.
  - Sends a prompt to Google’s Generative Language API (Gemini) to generate a detailed course roadmap.
  - Saves the generated roadmap in the database.

- **Dashboard:**  
  - View a list of all generated roadmaps.
  - Click on a roadmap to view its detailed content.

- **Responsive UI:**  
  - Styled with Tailwind CSS and assets built using Vite.

## Prerequisites

- PHP >= 8.0
- Composer
- Node.js and npm
- MySQL (or another compatible database)
- A valid API key for Google’s Generative Language API (Gemini)

## Installation and Setup

Follow these steps to set up the project on your local machine:

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/NaimParvez/course-roadmap-generator-laravel.git
   cd course-roadmap-generator-laravel
   ```

2. **Install PHP Dependencies:**

   ```bash
   composer install
   ```

3. **Install Node Dependencies:**

   ```bash
   npm install
   ```

4. **Set Up Laravel Breeze for Authentication:**

   (If not already installed, run the following commands)
   ```bash
   composer require laravel/breeze --dev
   php artisan breeze:install blade
   npm install && npm run dev
   ```

5. **Run Database Migrations:**

   ```bash
   php artisan migrate
   ```

## Environment Configuration

1. **Copy the Example Environment File:**

   ```bash
   cp .env.example .env
   ```

2. **Edit the `.env` File:**  
   Update your environment variables accordingly. Example settings:

   ```env
   APP_NAME=CourseRoadmap
   APP_ENV=local
   APP_KEY=            # Generate one via: php artisan key:generate
   APP_DEBUG=true
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=laravel
   DB_USERNAME=root
   DB_PASSWORD=

   GEMINI_API_KEY=YOUR_GOOGLE_API_KEY

   SESSION_DRIVER=database
   SESSION_LIFETIME=120

   MAIL_MAILER=smtp
   MAIL_HOST=your_smtp_host
   MAIL_PORT=your_smtp_port
   MAIL_USERNAME=your_email
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="hello@example.com"
   MAIL_FROM_NAME="${APP_NAME}"
   ```

   **Note:** Replace `YOUR_GOOGLE_API_KEY` with your actual API key for Google’s Generative Language API.

## Commands to Run the Project

After installation and environment setup, run the following commands:

1. **Generate the Application Key:**

   ```bash
   php artisan key:generate
   ```

2. **Start the Vite Development Server (for assets):**

   ```bash
   npm run dev
   ```

3. **Run the Laravel Development Server:**

   ```bash
   php artisan serve
   ```

4. **(Optional) For Production Build of Assets:**

   ```bash
   npm run build
   ```

5. **Clear Caches (if needed):**

   ```bash
   php artisan view:clear
   php artisan config:clear
   php artisan route:clear
   ```

## Usage

1. **User Authentication:**  
   - Visit [http://127.0.0.1:8000](http://127.0.0.1:8000) and register a new account or log in.
   - Use the password reset feature if necessary.

2. **Generate a Course Roadmap:**  
   - Navigate to `/roadmap/create` to access the form.
   - Fill in the required fields:
     - **Course Name**
     - **Duration (in weeks)**
     - **Level** (Beginner, Intermediate, Advanced)
     - **Purpose of Learning**
   - Click **Generate Roadmap**. The application sends your details to the Gemini API, retrieves the generated roadmap, and saves it to the database.

3. **View Roadmaps:**  
   - Go to `/roadmap` to view all generated roadmaps.
   - Click on a specific roadmap to see its detailed content on the `/roadmap/{id}` page.

## API Integration

The project integrates with Google’s Generative Language API (Gemini) using the following details:

- **Endpoint URL:**  
  ```
  https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateContent?key=YOUR_GOOGLE_API_KEY
  ```

- **Request Payload Format:**

  ```json
  {
      "contents": [
          {
              "parts": [
                  { "text": "Create a [level] roadmap for learning [course_name] in [duration] weeks. Purpose: [purpose]" }
              ]
          }
      ]
  }
  ```

- **Response Structure:**  
  The API is expected to return a JSON object similar to:

  ```json
  {
      "candidates": [
          {
              "content": {
                  "parts": [
                      { "text": "Generated roadmap text..." }
                  ]
              },
              "finishReason": "STOP"
          }
      ],
      "usageMetadata": { ... },
      "modelVersion": "gemini-pro"
  }
  ```

  The application extracts the generated text from:

  ```php
  $json['candidates'][0]['content']['parts'][0]['text']
  ```

## Project Structure

```
course-roadmap-generator/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── RoadmapController.php       # Handles roadmap generation and API integration
│   │   │   └── Auth/                      # Laravel Breeze authentication controllers
│   ├── Models/
│   │   └── Roadmap.php                    # Eloquent model for roadmaps
├── database/
│   ├── migrations/                        # Contains migration files (including the roadmap table)
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php              # Main layout (includes navbar, flash messages, etc.)
│   │   ├── roadmap/
│   │   │   ├── index.blade.php            # Lists all generated roadmaps
│   │   │   ├── create.blade.php           # Form for generating a new roadmap
│   │   │   └── show.blade.php             # Displays a single roadmap
│   │   └── auth/                          # Authentication views (provided by Breeze)
├── routes/
│   ├── web.php                            # Web routes (roadmap and auth routes)
├── .env                                   # Environment configuration file
├── package.json                           # Node dependencies
├── composer.json                          # PHP dependencies
├── tailwind.config.js                     # Tailwind CSS configuration
├── vite.config.js                         # Vite configuration for asset compilation
└── README.md                              # This file
```

## Troubleshooting

- **No Styling or Missing Assets:**  
  - Ensure Vite is running (`npm run dev`).
  - Verify your layout file (`resources/views/layouts/app.blade.php`) includes `@vite('resources/css/app.css')` in the `<head>`.
  - Clear caches with `php artisan view:clear`, `php artisan config:clear`, and refresh your browser.

- **API Response Issues:**  
  - Test the Gemini API endpoint with Postman using the same payload.
  - Check Laravel logs (`storage/logs/laravel.log`) for any errors or unexpected responses.
  - Verify that your API key is valid.

- **Authentication Problems:**  
  - Ensure Laravel Breeze is set up correctly.
  - Double-check your `.env` file and run `php artisan migrate`.

## License

This project is open source and available under the [MIT License](LICENSE).




