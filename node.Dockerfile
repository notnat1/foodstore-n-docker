FROM node:20-alpine
WORKDIR /var/www/html

# Copy package files
COPY package*.json ./

# Install all dependencies including devDependencies
RUN npm install

# Copy source code
COPY . .

# Set PATH to include node_modules/.bin
ENV PATH /var/www/html/node_modules/.bin:$PATH

# Build assets using Vite
RUN npm run build

# Default command: start the application
CMD ["npm", "start"]
