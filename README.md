# 🛡️ Cyber Void - Cybersecurity Learning Platform

![Cyber Void Banner](https://img.shields.io/badge/Cyber-Void-blue)
![Docker](https://img.shields.io/badge/Docker-Enabled-green)
![PHP](https://img.shields.io/badge/PHP-8.2-purple)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.0-blueviolet)

**Cyber Void** is a file-driven, Docker-based cybersecurity learning platform designed for students and self-learners. It provides an interactive environment for learning cybersecurity concepts through structured classes and hands-on CTF-style challenges.

## ✨ Features

### 🎯 Core Features
- **File-Driven Content System** - No database required, content managed via JSON/Markdown files
- **Docker Containerization** - Easy deployment on any system with Docker
- **Responsive Bootstrap 5 UI** - Clean, professional interface
- **Two Learning Paths**:
  - **Classes** - Structured cybersecurity curriculum (10+ classes)
  - **Challenges** - CTF-style problems with varying difficulty (Easy/Medium/Hard)
- **Live Discord Integration** - Connect with community for live sessions

### 📚 Learning Content
- **Classes**: Introduction to Cybersecurity, Network Security, Cryptography, Web Security, Linux Security, Reverse Engineering, Mobile Security, Social Engineering, Incident Response, Penetration Testing
- **Challenges**: Multiple CTF challenges with flags, hints, and points system
- **Tips & Tricks**: Daily cybersecurity tips and best practices

### 🔧 Technical Features
- **Simple File Structure** - Easy to add/edit content
- **No Admin Panel** - Content managed via Git/file system
- **Debug Mode** - Built-in troubleshooting for students
- **Client-side Flag Validation** - Instant feedback on challenge submissions
- **Markdown Support** - Rich content formatting
- **Difficulty Badges** - Visual indicators for challenge difficulty

## 🚀 Quick Start

### Prerequisites
- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- Git (for cloning repository)

### Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/cyber-void.git
   cd cyber-void
   docker-compose up --build