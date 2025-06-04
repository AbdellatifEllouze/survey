# Survey Application (Symfony + React)

A fullstack customer satisfaction survey application built with **Symfony** (PHP) and **React** (JS), containerized with **Docker**.

---

## 📁 Project Structure

```
.
├── api/                 # Symfony backend (PHP)
├── frontend/            # React frontend
├── docker/
│   ├── php/             # Dockerfile for PHP
│   └── nginx/           # Nginx config
├── docker-compose.yml
├── Makefile             # Dev automation
└── README.md
```

---

## 🛠️ Requirements

* Docker & Docker Compose
* Make (optional but recommended)

---

## ⚙️ Installation

```bash
git git git@gitlab.com:fr_kata_sf/c4-SF-0306-BT04.git
cd c4-SF-0306-BT04
make build      # Build all containers
make up         # Start containers
make install    # Install backend, frontend
```

You can now access:

* 🛁 API: [http://localhost:8086](http://localhost:8086)
---

## 🔧 Useful Commands

| Command                 | Description                         |
| ----------------------- | ----------------------------------- |
| `make up`               | Start all containers                |
| `make down`             | Stop containers                     |
| `make php`              | Enter PHP container                 |
| `make composer-install` | Install PHP dependencies            |

---

## 🛠 Tech Stack

* **Backend**: Symfony 6+, MySQL 8, PHP 8.3 (FPM Alpine)
* **Web Server**: Nginx (Alpine)
* **Containerization**: Docker Compose

---
