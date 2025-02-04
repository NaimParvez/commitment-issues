<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Course Roadmap Generator

A Laravel web application that generates personalized course roadmaps using Google’s Generative Language API (Gemini). Users can register, log in, and submit course details (course name, duration, level, and purpose) via a form. The application sends a prompt to the Gemini API, receives a generated roadmap, and saves it for future reference.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Environment Configuration](#environment-configuration)
- [Running the Application](#running-the-application)
- [Usage](#usage)
- [API Integration](#api-integration)
- [Troubleshooting](#troubleshooting)
- [Project Structure](#project-structure)
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
  - Modern design styled with Tailwind CSS and integrated via Vite.

## Prerequisites

- PHP >= 8.0
- Composer
- Node.js and npm
- A MySQL (or compatible) database
- A valid API key for Google’s Generative Language API (Gemini)

## Installation

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/NaimParvez/course-roadmap-generator-laravel.git
   cd course-roadmap-generator-laravel

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

---

This README covers all aspects of the project—from features and installation to API integration and troubleshooting. Adjust any sections as needed to fit any further customizations or project updates.

Let me know if you need any additional details or modifications!


The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
