# WebBlock-Generator

Domain blocklist generator for Squid proxy and network filtering environments.

![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)

---

## 📌 About

WebBlock-Generator is a lightweight PHP + Bootstrap web application that generates categorized domain blocklists ready to be used in:

- Squid proxy servers
- Network firewalls
- DNS filtering systems
- Content filtering environments

The application allows selecting domains by category and exports a clean `bloqueados.txt` file formatted for network blocking systems.

---

## 🚀 Features

- Categorized domain selection
- Select / Deselect by category
- External JSON configuration file
- Automatic domain normalization
- Duplicate removal
- Alphabetical sorting
- Instant `.txt` download
- Responsive Bootstrap interface
- Lightweight and easy to deploy

---

## 🛠️ Technologies Used

- PHP
- Bootstrap 5
- Vanilla JavaScript
- JSON (external data source)

---

## 📂 Project Structure


WebBlock-Generator/
│
├── index.php
├── components/
│ ├── header.php
│ └── footer.php
├── data/
│ └── sites.json
├── assets/
│ └── bootstrap-5.x/
└── LICENSE


---

## ⚙️ Installation

### Local (XAMPP / WAMP)

1. Clone or download the repository
2. Place the project folder inside your `htdocs`
3. Start Apache
4. Access:


http://localhost/WebBlock-Generator


---

### Linux Server

1. Copy the project to your web directory (e.g., `/var/www/html/`)
2. Ensure PHP is installed
3. Access via browser

---

## 📄 How It Works

1. Domains are stored in `data/sites.json`
2. The application loads and parses the JSON file
3. Users select domains by category
4. On submit, a `bloqueados.txt` file is generated
5. The file can be used in Squid or firewall configurations

---

## 🧩 Example Squid Configuration


acl blocked_sites dstdomain "/etc/squid/blocklist.txt"
http_access deny blocked_sites


Place the generated file in:


/etc/squid/blocklist.txt


Then reload Squid:


sudo systemctl reload squid


---

## 📜 License

This project is licensed under the MIT License.

You are free to use, modify, and distribute this software, provided that the original copyright and license notice are included.

---

## 👨‍💻 Author

Mateus Nobre Silva Almeida

---

## ⭐ Contributing

Pull requests are welcome.  
For major changes, please open an issue first to discuss what you would like to change.