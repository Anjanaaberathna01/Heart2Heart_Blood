# Hospital Registration and Login Flow

## Admin Adding Hospital

### Step 1: Admin Logs In

- Email: `admin123@gmail.com`
- Password: `admin123`
- Redirects to: `/admin/dashboard`

### Step 2: Admin Navigates to Add Hospital

- Route: `GET /admin/hospitals/add`
- View: `blood_admin.add-hospital`

### Step 3: Admin Fills Hospital Form

Required fields:

- Hospital ID (unique)
- Hospital Registration Number (unique)
- Mobile Number 1 (10 digits)
- Mobile Number 2 (optional, 10 digits)
- Address (text)
- District (text)
- **Hospital Username** (unique) - NEW
- **Hospital Email** (unique) - NEW

### Step 4: Hospital Registration

- Route: `POST /admin/hospitals/store`
- Controller: `AdminController@storeHospital`
- System automatically:
    - Hashes the default password: **12345678**
    - Creates hospital record in `hospitals` table
    - Redirects to login page with success message

### Step 5: Hospital Admin First Login

- Hospital goes to login page: `GET /login`
- Enters:
    - Email: (the email provided by admin)
    - Password: 12345678
- System checks:
    1. Checks `users` table (admin/donor users)
    2. If not found, checks `hospitals` table
- If hospital email found and password matches:
    - Redirects to: `/hospital/dashboard`

## Login Flow (Same Page for All)

Login page: `GET /login` or `POST /login`

### Three Types of Logins:

**1. Admin (System Administrator)**

- Table: `users`
- Role: `admin`
- Email: admin123@gmail.com
- Password: admin123
- Redirects to: `/admin/dashboard`

**2. User (Donor)**

- Table: `users`
- Role: `user`
- Example: john@example.com, jane@example.com
- Password: password123
- Redirects to: `/dashboard`

**3. Hospital Admin**

- Table: `hospitals`
- Email: (set by system admin)
- Password: 12345678 (default, changeable after first login)
- Redirects to: `/hospital/dashboard`

## Key Points

✅ Default password for hospitals: **12345678**
✅ Hospital must be registered by system admin first
✅ Same login page for all user types
✅ System intelligently routes based on credentials

## Database Structure

### users table (role: admin/user)

- id, name, email, password, phone, role

### hospitals table (hospital admins)

- id, hospital_id, hospital_reg_number, user_name, email, password, mobile_number1, mobile_number2, address, district
