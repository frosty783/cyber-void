FROM nginx:alpine

# Copy nginx configuration
COPY nginx/nginx.conf /etc/nginx/nginx.conf

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY app/ /var/www/html/

# Expose port
EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]