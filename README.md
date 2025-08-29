# Paws'N Claws — System Archive

A developer-focused repository archive for **Paws'N Claws** — a web-based pet adoption / community hub. This README is intentionally focused on the system/code: what the app does, the tech used, how to run it, and how to contribute. (Academic analysis and full paper appendices are omitted.)

---

## What it is

Paws'N Claws is a browser-based platform that centralizes pet adoption listings, community posts, event coordination, and basic peer-to-peer pet services. This archive contains the system source code and developer documentation for the app.

---

## Tech stack

Primary technologies used in the system:

* **Backend:** Laravel (PHP)
* **Frontend:** Vue 3 + Vue Router (Single Page Application style)
* **Build tooling:** Vite (with laravel-vite-plugin)
* **Styling / UI utilities:** TailwindCSS, DaisyUI, Flowbite
* **HTTP client / API:** Axios
* **Extras:** AlpineJS for lightweight interactions; libraries for image handling and rich-text editing

---

## Key features

Developer-facing list of implemented or intended features:

* Centralized **pet adoption database** with detailed animal profiles and search/filters.
* **Adoption application** flow (forms with required fields and verification steps).
* **Posting & community** functionality: announcements, posts, comments.
* **Peer-to-peer marketplace / services**: listings for pet-related services and items.
* **Admin console**: user management, report handling, privacy & TOS pages.
* Notification/reminder capability (part of the app's system components).

---

### Prerequisites

* PHP (compatible with the Laravel version in the project)
* Composer
* Node.js (v16+ recommended) and npm / yarn / pnpm
* MySQL / MariaDB (or other DB configured in `.env`)
* Git

---

## Contributors & credits

Primary project contributors (from the original project record):

* Alexandre Justin Repia - Backend Programmer | [https://github.com/AlexandreJustinRepia](https://github.com/AlexandreJustinRepia)
* Ashley M. Sarmiento- Technical Writer
* Denver Wayne E. Dela Masa - Frontend Programmer | [https://github.com/denverdelamasa](https://github.com/denverdelamasa)
* John Michael Son D. Calayag - Technical Writer
* Julie Ann R. Borja - Technical Writer

Add technical writers or additional contributors below as needed.

---

## License

Paws'N Claws — Proprietary License

Copyright (c) 2025 PawsNClaws Team

Permission is granted to view and evaluate the contents of this repository for personal and educational purposes only. Any form of redistribution, public deployment, commercial use, modification, or derivative works is strictly prohibited without prior written permission from the copyright holders.
