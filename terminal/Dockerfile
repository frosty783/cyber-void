FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    curl \
    bash \
    nodejs \
    npm \
    python3 \
    make \
    g++ \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy PHP frontend
COPY public/ /var/www/html/

# Copy Node backend
COPY server.js package.json /app/
COPY start.sh /start.sh

# Install Node dependencies
WORKDIR /app
RUN npm install

# Expose ports
EXPOSE 80 3001

# Start Apache + Node
CMD ["/bin/bash", "/start.sh"]
