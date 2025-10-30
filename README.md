# TicketFlow - Twig Implementation

A robust ticket management web application built with **PHP + Twig templating engine**. This is part of a multi-framework implementation that includes React, Vue.js, and Twig versions, all sharing the same design language and functionality.

##  Live Demo

- **Twig Version**: [Deploy URL here]
- **React Version**: [Your React deploy URL]
- **Vue Version**: [Your Vue deploy URL]

##  Table of Contents

- [Frameworks & Libraries](#frameworks--libraries)
- [Features](#features)
- [Project Structure](#project-structure)
- [Setup Instructions](#setup-instructions)
- [Test Credentials](#test-credentials)
- [UI Components](#ui-components)
- [State Management](#state-management)
- [Accessibility](#accessibility)
- [Known Issues](#known-issues)
- [Deployment](#deployment)
- [Switching Between Versions](#switching-between-versions)

---

##  Frameworks & Libraries

### Backend
- **PHP 8.4.1** - Server-side scripting language
- **Twig 3.21.1** - Template engine for PHP
- **Composer** - PHP dependency manager

### Frontend
- **Vanilla JavaScript (ES6+)** - Client-side interactions
- **Custom CSS** - Styling (no frameworks)
- **localStorage** - Client-side data persistence

### Development Tools
- **MAMP** - Local development server (Apache + PHP + MySQL)
- **VS Code** - Code editor
- **Git** - Version control

---

##  Features

### Core Functionality
- ✅ **Landing Page** - Hero section with wavy SVG background and decorative circles
- ✅ **Authentication** - Login and Signup with form validation
- ✅ **Dashboard** - Summary statistics (total, open, in-progress, closed tickets)
- ✅ **Ticket Management** - Full CRUD operations (Create, Read, Update, Delete)
- ✅ **Responsive Design** - Mobile-first approach with hamburger menu
- ✅ **Protected Routes** - Authentication-based access control
- ✅ **Toast Notifications** - User feedback for actions
- ✅ **Inline Validation** - Real-time form error messages

### Design Features
- Max-width: 1440px (centered layout)
- Wavy SVG hero background
- Decorative circular elements
- Card-style components with shadows
- Status-based color coding (green for open, amber for in-progress, gray for closed)
- Smooth transitions and hover effects

---

##  Project Structure

```
ticketflow-twig/
├── config.php                 # Twig configuration & session setup
├── index.php                  # Landing page
├── login.php                  # Login page
├── signup.php                 # Signup page
├── dashboard.php              # Dashboard page
├── tickets.php                # Ticket management page
├── logout.php                 # Logout handler
├── includes/
│   └── auth.php              # Authentication helper functions
├── templates/
│   ├── layout.twig           # Base layout template
│   ├── landing.twig          # Landing page template
│   ├── login.twig            # Login form template
│   ├── signup.twig           # Signup form template
│   ├── dashboard.twig        # Dashboard template
│   ├── tickets.twig          # Ticket management template
│   └── partials/
│       ├── header.twig       # Hero/navigation component
│       └── footer.twig       # Footer component
├── assets/
│   ├── css/
│   │   └── style.css         # All styling (single file)
│   └── js/
│       ├── auth.js           # Authentication logic
│       ├── dashboard.js      # Dashboard functionality
│       └── tickets.js        # Ticket CRUD operations
├── vendor/                    # Composer dependencies (auto-generated)
├── composer.json             # PHP dependencies
├── composer.lock             # Locked dependency versions
└── README.md                 # This file
```

---

##  Setup Instructions

### Prerequisites
- macOS (or any OS with PHP 8.x)
- MAMP (or similar local server)
- Composer
- Git

### Step 1: Install MAMP
1. Download MAMP from [https://www.mamp.info](https://www.mamp.info)
2. Install MAMP (free version)
3. Start MAMP servers (Apache + MySQL)

### Step 2: Clone the Repository
```bash
cd /Applications/MAMP/htdocs
git clone [your-repo-url] ticketflow-twig
cd ticketflow-twig
```

### Step 3: Install PHP Dependencies
```bash
# Install Composer globally (if not installed)
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install project dependencies
composer install
```

### Step 4: Configure Base URL
Edit `config.php` and update the base URL if needed:
```php
$baseUrl = '/ticketflow-twig'; // Adjust based on your folder name
```

### Step 5: Access the Application
Open your browser and navigate to:
```
http://localhost:8888/ticketflow-twig/index.php
```

### Step 6: Create Test User (Optional)
On first run, the app will create a default test user automatically. Alternatively, you can sign up through the UI.

---

##  Test Credentials

### Default Test User
```
Email: admin@test.com
Password: password
```

### Creating New Users
1. Navigate to the Signup page
2. Enter any email and password (minimum 6 characters)
3. User data is stored in `localStorage` (client-side)

---

##  UI Components

### Layout Structure
All pages extend `layout.twig` which provides:
- Base HTML structure
- CSS/JS imports
- Toast notification container
- Footer component

### Component Breakdown

#### 1. **Header/Hero Component** (`partials/header.twig`)
- Responsive navigation bar
- Desktop menu (visible ≥640px)
- Mobile hamburger menu (<640px)
- Hero section with decorative circles
- CTA buttons
- Stats cards
- Ticket preview card
- Wavy SVG bottom border

#### 2. **Footer Component** (`partials/footer.twig`)
- Copyright information
- Links (Privacy, Terms)
- Centered layout with max-width

#### 3. **Auth Pages** (`login.twig`, `signup.twig`)
- Centered form layout
- Real-time validation
- Inline error messages
- Toast notifications
- Decorative background circle

#### 4. **Dashboard** (`dashboard.twig`)
- Navigation bar with logout button
- Statistics cards (Total, Open, In Progress, Closed)
- Gradient background
- Wave SVG decoration
- Decorative blur circles
- Frosted glass navbar effect

#### 5. **Tickets Page** (`tickets.twig`)
- Create/Edit form
- Tickets grid display
- Card-based ticket layout
- Status badges
- Edit/Delete actions
- Decorative elements

---

##  State Management

### Client-Side Storage (localStorage)
Since this is a frontend-focused implementation matching React/Vue, all data is stored in the browser:

#### Authentication State
```javascript
// Key: ticketapp_session
// Value: token string (e.g., "session_1234567890")
localStorage.setItem('ticketapp_session', token);
```

#### User Data
```javascript
// Key: mock_user
// Value: JSON object { email, password }
localStorage.setItem('mock_user', JSON.stringify({ email, password }));
```

#### Tickets Data
```javascript
// Key: tickets
// Value: Array of ticket objects
localStorage.setItem('tickets', JSON.stringify([
  { title, description, status, priority }
]));
```

### Session Flow
1. **Login/Signup** → Creates `ticketapp_session` token
2. **Protected Pages** → JavaScript checks for token, redirects if missing
3. **Logout** → Removes token and returns to landing page

### Data Validation
- **Title**: Required field
- **Status**: Must be one of: `open`, `in_progress`, `closed`
- **Description**: Optional, max 1000 characters
- **Priority**: Optional (low, medium, high)

---

## ♿ Accessibility

### Features Implemented
- ✅ **Semantic HTML** - Proper use of `<header>`, `<nav>`, `<main>`, `<footer>`
- ✅ **ARIA Labels** - `aria-label` on hamburger menu button
- ✅ **ARIA Hidden** - Decorative elements marked with `aria-hidden="true"`
- ✅ **Keyboard Navigation** - All interactive elements are keyboard accessible
- ✅ **Focus States** - Visible focus rings on buttons and links
- ✅ **Color Contrast** - WCAG AA compliant color ratios
- ✅ **Responsive Design** - Works on all screen sizes
- ✅ **Screen Reader Support** - Meaningful alt text and labels

### Status Color Coding
- **Open**: Green (#059669) - High contrast
- **In Progress**: Amber (#92400e) - High contrast
- **Closed**: Gray (#374151) - High contrast

---

##  Known Issues

### Current Limitations
1. **Data Persistence**: Data is stored in `localStorage`, which means:
   - Data is lost when browser cache is cleared
   - Data is not shared across devices
   - No real backend database

2. **Authentication**: 
   - Mock authentication (no real server-side validation)
   - Passwords are not hashed (stored in plain text in localStorage)
   - No password reset functionality

3. **Browser Compatibility**:
   - Requires modern browser with ES6+ support
   - localStorage must be enabled

4. **Mobile Safari**:
   - Hamburger menu animation may be slightly different due to browser rendering

### Future Improvements
- [ ] Add real backend API
- [ ] Implement actual password hashing
- [ ] Add search/filter functionality for tickets
- [ ] Implement pagination for large ticket lists
- [ ] Add ticket assignment to users
- [ ] Add file attachment support
- [ ] Add email notifications
- [ ] Add dark mode toggle

---

##  Deployment

### Deploy to GitHub

#### Step 1: Initialize Git Repository
```bash
cd /Applications/MAMP/htdocs/ticketflow-twig

# Initialize git
git init

# Create .gitignore
echo "vendor/
.DS_Store
*.log" > .gitignore

# Add all files
git add .

# Commit
git commit -m "Initial commit - Twig ticket management app"
```

#### Step 2: Create GitHub Repository
1. Go to [github.com](https://github.com)
2. Click "New Repository"
3. Name it `ticketflow-twig`
4. Do NOT initialize with README (we already have one)
5. Click "Create repository"

#### Step 3: Push to GitHub
```bash
# Add remote
git remote add origin https://github.com/YOUR_USERNAME/ticketflow-twig.git

# Push to main branch
git branch -M main
git push -u origin main
```

### Deploy to Render

**Important Note**: Render is designed for Node.js, Python, Docker, and static sites. For a PHP/Twig application, you have two options:

#### Option A: Deploy as Static Site (Recommended for this project)

Since this project uses client-side storage, you can deploy it as a static site:

1. **Convert to Static HTML**:
   - Generate static HTML files from Twig templates
   - Remove PHP dependencies
   - Use only JavaScript for functionality

2. **Deploy on Render**:
```bash
# In your project root
# Create a build script to generate static files
```

**Render Static Site Steps**:
1. Go to [render.com](https://render.com)
2. Click "New" → "Static Site"
3. Connect your GitHub repository
4. Configure:
   - **Build Command**: `composer install` (or leave empty if static)
   - **Publish Directory**: `.` or `public`
5. Click "Create Static Site"

#### Option B: Deploy on PHP Hosting (Better for PHP/Twig)

For a proper PHP/Twig deployment, use:

**Recommended PHP Hosts**:
1. **Heroku** (with PHP buildpack)
2. **Railway.app** (supports PHP)
3. **InfinityFree** (free PHP hosting)
4. **000WebHost** (free PHP hosting)

**Heroku Deployment**:
```bash
# Install Heroku CLI
brew tap heroku/brew && brew install heroku

# Login
heroku login

# Create app
heroku create ticketflow-twig

# Create Procfile
echo "web: vendor/bin/heroku-php-apache2" > Procfile

# Deploy
git push heroku main

# Open app
heroku open
```

#### Option C: Use Render with Docker

Create a `Dockerfile`:
```dockerfile
FROM php:8.4-apache

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project
COPY . /var/www/html/

# Install dependencies
RUN composer install --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
```

Create `render.yaml`:
```yaml
services:
  - type: web
    name: ticketflow-twig
    env: docker
    dockerfilePath: ./Dockerfile
    envVars:
      - key: PHP_VERSION
        value: "8.4"
```

Deploy:
1. Push to GitHub
2. On Render, select "Blueprint" → Connect repository
3. Render will auto-detect `render.yaml`

---

##  Switching Between Versions

### Access Different Implementations

#### React Version
```bash
cd /path/to/react-version
npm install
npm run dev
# Opens at http://localhost:5173
```

#### Vue Version
```bash
cd /path/to/vue-version
npm install
npm run dev
# Opens at http://localhost:5174
```

#### Twig Version
```bash
cd /Applications/MAMP/htdocs/ticketflow-twig
# Start MAMP servers
# Opens at http://localhost:8888/ticketflow-twig
```

### Shared Assets
All three versions share:
- Same design system (colors, spacing, typography)
- Identical wavy SVG
- Same decorative circle positions
- Matching component layouts
- Consistent max-width (1440px)

### Key Differences

| Feature | React | Vue | Twig |
|---------|-------|-----|------|
| Routing | React Router | Vue Router | PHP files |
| State | useState/Context | Composition API | localStorage + JS |
| Templating | JSX | Vue SFC | Twig templates |
| Build Tool | Vite | Vite | None (native PHP) |
| Server | Node dev server | Node dev server | Apache (MAMP) |

---

##  Additional Notes

### Development Tips
- Clear browser cache when CSS/JS doesn't update
- Check browser console for JavaScript errors
- Use Chrome DevTools mobile mode for responsive testing
- MAMP must be running for the app to work



### Composer Troubleshooting
```bash
# Clear Composer cache
composer clear-cache

# Update dependencies
composer update

# Validate composer.json
composer validate
```

---

## Credits

**Developer**: Bimbo  
**Course**: Frontend Stage 2 Task  
**Framework**: PHP + Twig  
**Design**: Custom (matching React/Vue versions)

---

##  License

This project is for educational purposes.

---

## Contributing

This is a course project and  open for contributions.

---



