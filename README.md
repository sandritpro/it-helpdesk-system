# IT HelpDesk System

Internal IT Help Desk / Request Tracking System built with PHP.

This system allows IT departments to register, manage and analyze user requests inside an organization.

---

# Features

- Add and manage IT requests
- Add and manage users
- Store cabinet/office information
- Track request reasons and descriptions
- View all requests in one table
- Statistics and analytics dashboard
- Identify users with the most requests
- Analyze the most common IT problems
- JSON-based storage (no database required)

---

# Technologies

- PHP
- HTML5
- CSS3
- JavaScript
- JSON Storage

---

# Project Structure

```txt
assets/         -> CSS and JavaScript
config/         -> Configuration files
data/           -> JSON storage files
index.php       -> Main page
users.php       -> Users management
requests.php    -> Requests management
stats.php       -> Statistics page
```

---

# How to Run

## 1. Clone repository

```bash
git clone https://github.com/sandritpro/it-helpdesk-system.git
```

## 2. Open project folder

```bash
cd it-helpdesk-system
```

## 3. Start local PHP server

```bash
php -S localhost:8000
```

## 4. Open browser

```txt
http://localhost:8000
```

---

# Data Storage

This project does NOT use MySQL or SQLite.

All data is stored inside JSON files located in:

```txt
/data
```

---

# Screenshots

You can add screenshots here later.

---

# Future Improvements

- Authentication system
- Admin/User roles
- MySQL support
- Docker support
- Export to Excel/PDF
- REST API
- Bootstrap UI redesign
- Dark mode
- Email notifications

---

# Author

Sandr

GitHub:
https://github.com/sandritpro
