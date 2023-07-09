
# Shelta - Real Estate Management App

![Shelta Logo](shelta_logo.png)

Shelta is a powerful web application developed by KoachTech specifically designed for real estate companies. It provides efficient management of a client database, monthly payments, property allocation, and communication with clients. The application is designed to streamline administrative tasks and enhance the overall client experience.

## Features

1.  Client Management:
    
    -   The application allows the admin to store and manage client information, including personal details, contact information, and payment history.
    -   Clients can be easily added, edited, and deleted from the database.
    -   The admin can search and filter clients based on various criteria to quickly find specific records.
2.  Monthly Payment Tracking:
    
    -   Shelta facilitates tracking of monthly payments made by clients.
    -   The admin can record payments manually or integrate an online payment gateway to automate payment processing.
    -   Payments are associated with specific clients and properties, ensuring accurate tracking and reporting.
3.  Property Allocation:
    
    -   The application enables the admin to allocate properties to clients.
    -   Properties can be categorized by estate and type, allowing for easy management and organization.
    -   Property allocation can be modified or updated as needed.
4.  Payment Reminders:
    
    -   Shelta offers a flexible payment reminder system.
    -   The admin can set intervals for payment reminders, ensuring clients are notified promptly about upcoming payments.
    -   Reminders can be sent via email or SMS, providing convenience and timely communication.
5.  Estate, Property Type, and Payment Plan Management:
    
    -   The application allows the admin to add and manage estates, property types, and payment plans.
    -   Multiple estates can be added, each with its own unique properties and specifications.
    -   Property types and payment plans can be customized to meet the specific needs of the real estate company.
6.  Communication with Clients:
    
    -   Shelta provides a built-in messaging system for effective communication with clients.
    -   The admin can send individual emails or SMS messages to clients or group messages to selected clients.
    -   This feature simplifies communication and enables the admin to keep clients informed about important updates or announcements.

## Demo

To explore a demo of the Shelta web application, please visit [www.shelta.koachtech.com](http://www.shelta.koachtech.com/). Please note that this is a demonstration version and some features may be limited or disabled.

## Pricing and Licensing

Shelta is not available as free software. For pricing and licensing details, please contact KoachTech directly at [info@koachtech.com](mailto:info@koachtech.com).

## Installation and Setup

To install and set up the Shelta application, follow these steps:

1. Ensure that your server meets the [system requirements](link-to-docs) for running Laravel applications.

2. Clone the Shelta repository from the GitHub repository:

   ```bash
   https://github.com/umahatokula/shelta.git
   ```

3. Install the application dependencies using Composer:

   ```bash
   cd shelta
   composer install
   ```

4. Create a new `.env` file by copying the example file:

   ```bash
   cp .env.example .env
   ```

5. Generate a new application key:

   ```bash
   php artisan key:generate
   ```

6. Configure the necessary environment variables in the `.env` file, including the database connection details, email settings, and payment gateway credentials.

7. Run the database migrations and seed the initial data:

   ```bash
   php artisan migrate --seed
   ```

8. Set up a virtual host or use Laravel's built-in development server to serve the application.

9. Access the application in your browser and complete the initial setup by following the on-screen instructions.

For more detailed installation instructions and troubleshooting, refer to the [Installation Guide](link-to-docs).

## Documentation

Comprehensive documentation for Shelta is available at [docs.shelta.koachtech.com](http://docs.shelta.koachtech.com/). The documentation provides detailed information about the application's features, usage instructions, configuration options, and more. Please refer to the documentation for any questions or support needs.

## Support

If you require assistance or have any questions regarding Shelta, please contact the KoachTech support team at [support@koachtech.com](mailto:support@koachtech.com). Our dedicated support team is available to help you with any queries or issues you may encounter.

## License

Shelta is proprietary software developed by KoachTech. The use of this software is subject to the terms and conditions outlined in the End User License Agreement (EULA). Unauthorized use, copying, or distribution of this software is strictly prohibited.

Please refer to the [EULA](link-to-license) for more information about the licensing terms.

## About KoachTech

KoachTech is a software development company specializing in providing innovative solutions for real estate businesses. We strive to develop high-quality software that simplifies complex tasks and enhances productivity. To learn more about KoachTech and our services, please visit [www.koachtech.com](http://www.koachtech.com/).
