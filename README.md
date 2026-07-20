# Keirsey Temperament Sorter®-II (KTS®-II) Questionnaire

A modernized, responsive web questionnaire based on the Keirsey Temperament Sorter®-II (KTS®-II) personality assessment instrument.

[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)](LICENSE)
[![Donate](https://img.shields.io/badge/$-support-ff69b4.svg?style=flat)](https://paypal.me/cahyadwiana) 

The **Keirsey Temperament Sorter®-II (KTS®-II)** is the most widely used personality instrument in the world. It is a powerful 70-question personality assessment that helps individuals discover their temperament and personality type. The KTS-II is based on Keirsey Temperament Theory™, published in the bestselling books, *Please Understand Me®* and *Please Understand Me II*, by Dr. David Keirsey.

---

## Features
- **Modern User Interface**: Completely redesigned with clean typography, generous grid layouts, glassmorphism headers, and smooth micro-animations.
- **Dynamic Real-Time Themes**: Custom-built CSS properties allowing instantaneous color theme switching (supporting 12 different colors) via minimalist circular pills.
- **Vanilla JS**: Light weight, zero runtime dependencies. (Completely removed jQuery & Zepto.js).
- **No CSS Frameworks**: Handcrafted custom CSS layout removing all external w3.css styling.
- **Secure Credentials**: Integrated native PHP environment loader supporting `.env` configurations.
- **Native Unit Testing**: Custom zero-dependency PHP unit testing harness verifying environment loading and KTS scoring logic.

---

## Installation & Setup

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/cahyadsn/kts-2-questionnarie.git
   cd kts-2-questionnarie
   ```

2. **Setup Credentials**:
   - Copy the template file `.env.example` to `.env`:
     ```bash
     cp .env.example .env
     ```
   - Update database host, username, password, and schema variables in `.env` to match your local setup.

3. **Database Configuration**:
   - Create a new MySQL/MariaDB database named `psycho`.
   - Import the schema and dummy data located in `db/db.kts.dummy.sql`:
     ```bash
     mysql -u root -p psycho < db/db.kts.dummy.sql
     ```

4. **Run Locally**:
   - Start the native PHP development server:
     ```bash
     php -S localhost:8000
     ```
   - Open your browser and navigate to `http://localhost:8000`.

5. **Run Unit Tests**:
   - Execute the test suite using standard PHP:
     ```bash
     php run_tests.php
     ```

---

## Technology Stack
* **PHP**: Server-side logic (Procedural/Native)
* **MySQL/MariaDB**: Database storage
* **CSS3**: Vanilla custom CSS variables for color styling
* **JavaScript**: Modern ES6+ Vanilla Javascript

---

## Changelog

### v1.1 (July 2026)
- **Testing Infrastructure**:
  - Implemented a custom zero-dependency PHP unit testing runner ([`tests/TestRunner.php`](tests/TestRunner.php)) with CLI coloring and structured assertion error reporting.
  - Created unit tests ([`tests/KtsTest.php`](tests/KtsTest.php)) to verify environment configuration loading and isolated Keirsey Temperament Sorter scoring logic ([`inc/kts_calc.php`](inc/kts_calc.php)).

### v1.0 (July 2026)
- **Framework & Libraries Cleanup**:
  - Removed Zepto.js and migrated all codebase functionality to modern **Vanilla JS** (using query selectors, fetch, and event delegation).
  - Deprecated **w3.css** library and w3-themes, implementing a handcrafted custom CSS design system ([`style.css`](assets/css/style.css)).
- **UI & Theme Engine Improvements**:
  - Replaced hover navigation dropdowns with inline minimalist circular theme selectors.
  - Refactored themes to dynamically set a custom HTML tag attribute `data-theme` and handle color styling using CSS variables.
- **Security & Config Modernization**:
  - Introduced native PHP `.env` loader (`inc/env.php`) and added `.env` credentials file to `.gitignore`.
- **Header Info Maintenance**:
  - Standardized program file headers containing creator, updated date, version, and license data across all custom CSS, JS, and PHP files.

### v0.2
- Migrated JavaScript libraries from jQuery to ZeptoJS.

### v0.1
- Initial release.

---

## Donations
If you find this project useful, you can support the developer via:
- **Bank Transfer**:
  - Bank Jago (542) 5003 5796 1022
  - Bank BCA Digital (Blu): (501) 000 576 776 186
  - Bank Sinarmas: (153) 005 462 4719
  - Bank Syariah Indonesia (BSI): 821-342-5550
- **PayPal**: [https://paypal.me/cahyadwiana](https://paypal.me/cahyadwiana)
- **QRIS**: CAHYADSN

![screenshot](https://github.com/cahyadsn/wilayah/blob/master/docs/qr_code.cahyadsn.png?raw=true 'Donasi via QRIS CAHYADSN')

---

## Contact
- **facebook** : [https://m.facebook.com/cahya.dsn](https://m.facebook.com/cahya.dsn)
- **Email**: [cahyadsn@gmail.com](mailto:cahyadsn@gmail.com)
- **Demo Site**: [https://psycho.cahyadsn.com/kts](https://psycho.cahyadsn.com/kts)
