## 💪 Survey Application (Symfony + React) – Clean Architecture

A fullstack customer satisfaction survey application built with **Symfony** and **React**, using **Docker**.
This project follows **Clean Architecture** principles to separate concerns and ensure maintainability.

---

## 📁 Project Structure

```
.
├── api/                         # Symfony backend (PHP)
│   ├── src/
│   │   ├── Application/         # Application layer
│   │   │   ├── UseCase/         # Business use cases
│   │   │   ├── Dto/             # Data Transfer Objects
│   │   │   └── Mapper/          # Mapping logic (DTO <-> Domain)
│   │   │
│   │   ├── Domain/              # Domain layer (business rules)
│   │   │   ├── Entity/          # Domain entities
│   │   │   └── Port/            # ports defintions
│   │   │
│   │   ├── Infrastructure/      # Infrastructure layer
│   │   │   ├── Controller/      # HTTP controllers (e.g., API)
│   │   │   ├── EventSubscriber/ # Framework-related listeners
│   │   │   └── Repository/      # Doctrine repositories (implements domain ports)
│   │   │
│   │   └── Kernel.php           # Symfony Kernel
│   └── config/, migrations/, etc.
│
├── frontend/                    # React frontend
│   └── ...
│
├── docker/
│   ├── php/                     # PHP Dockerfile
│   └── nginx/                   # Nginx configuration
│
├── docker-compose.yml
├── Makefile
└── README.md
```

---

## 🛡 Clean Architecture Overview

### ✅ Layers

* **Application**:
  Orchestrates business logic using use cases, DTOs and mappers.
  No framework dependencies.

* **Domain**:
  Contains the core business entities and logic.
  Should be completely framework-agnostic and testable.

* **Infrastructure**:
  Handles framework concerns (Symfony controllers, events, Doctrine, etc.).
  Implements interfaces from the domain/application layers.

---

## 🚧 Room for Improvement

One potential improvement is to **separate Doctrine entities from pure domain entities**, to:

* Fully decouple the domain from the ORM (Doctrine)
* Avoid leaking persistence logic into the business logic
* Improve unit testing (no DB required for domain tests)

This could be done by:

* Creating `Domain\Entity\Survey` (pure PHP object)
* Creating `Infrastructure\Doctrine\Entity\Survey` (Doctrine-mapped entity)
* Using mappers/adapters to convert between both when needed

---

## ⚙️ Installation

```bash
git clone git@gitlab.com:fr_kata_sf/c4-SF-0306-BT04.git
cd c4-SF-0306-BT04
make build      # Build all containers
make up         # Start containers
make install    # Install backend and frontend dependencies
```

Once setup is complete, access:

* 💅 API Docs: [http://localhost:8086/api/doc](http://localhost:8086/api/doc)

---

## 🔧 Useful Commands

| Command                 | Description              |
| ----------------------- | ------------------------ |
| `make up`               | Start all containers     |
| `make down`             | Stop all containers      |
| `make php`              | Access PHP container     |
| `make composer-install` | Install PHP dependencies |

---

## 🛠 Tech Stack

* **Backend**: Symfony 6+, MySQL 8, PHP 8.3 (FPM Alpine)
* **Frontend**: React, Vite, TailwindCSS
* **Web Server**: Nginx (Alpine)
* **Containerization**: Docker + Docker Compose
