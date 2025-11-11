# 📡 API Integration Setup Guide - Project A (e-Aduan) ↔ Project B (External System)

## 🎯 Overview

This document explains how to set up API integration between **Project A (e-Aduan System)** and **Project B (External System)**. Project A will manage data in Project B through secure API calls.

---

## 📋 What Needs to Be Set Up

### **In Project A (e-Aduan) - Current Project**

#### 1. **Configuration Files**

**`.env` file** - Add these variables:
```env
PROJECT_B_API_URL=http://project-b.test/api
PROJECT_B_API_TOKEN=your-api-token-from-project-b
PROJECT_B_API_TIMEOUT=30
```

**`config/services.php`** - ✅ Already updated with Project B configuration

#### 2. **Service Class** ✅ Created
- `app/Services/ProjectBApiService.php` - Handles all API calls to Project B
  - Methods: `get()`, `post()`, `put()`, `delete()`
  - Automatic error handling and logging
  - Token authentication

#### 3. **Controllers** (Need to create for each module)
- `app/Http/Controllers/Admin/Websites/BizHubController.php` ✅ Created (example)
- `app/Http/Controllers/Admin/Websites/AktivitiController.php` (to create)
- `app/Http/Controllers/Admin/Websites/AhliJawatanKuasaController.php` (to create)
- `app/Http/Controllers/Admin/Websites/FasilitiController.php` (to create)

#### 4. **Views/UI** (Need to create)
- `resources/views/admin/websites/bizhub/` ✅ Folder created
  - `index.blade.php` - List all BizHub items
  - `create.blade.php` - Create new BizHub item
  - `edit.blade.php` - Edit BizHub item
  - `show.blade.php` - View BizHub details

- Same structure for:
  - `aktiviti/`
  - `ahli-jawatan-kuasa/`
  - `fasiliti/`

#### 5. **Routes** (Need to add)
Add to `routes/web.php`:
```php
// Websites Management (Project B Integration)
Route::prefix('admin/websites')->name('admin.websites.')->middleware(['auth', 'role:Super Admin'])->group(function () {
    Route::resource('bizhub', BizHubController::class);
    Route::resource('aktiviti', AktivitiController::class);
    Route::resource('ahli-jawatan-kuasa', AhliJawatanKuasaController::class);
    Route::resource('fasiliti', FasilitiController::class);
});
```

#### 6. **Sidebar Links** (Need to update)
Update `resources/views/components/admin/sidebar.blade.php`:
- Change `href="#"` to actual routes
- Add active state detection

---

### **In Project B (External System) - Separate Project**

#### 1. **API Routes** (in `routes/api.php`)
```php
Route::middleware('auth:sanctum')->group(function () {
    // BizHub endpoints
    Route::get('/bizhub', [BizHubApiController::class, 'index']);
    Route::post('/bizhub', [BizHubApiController::class, 'store']);
    Route::get('/bizhub/{id}', [BizHubApiController::class, 'show']);
    Route::put('/bizhub/{id}', [BizHubApiController::class, 'update']);
    Route::delete('/bizhub/{id}', [BizHubApiController::class, 'destroy']);
    
    // Similar for aktiviti, ahli-jawatan-kuasa, fasiliti
});
```

#### 2. **API Controllers**
- `app/Http/Controllers/Api/BizHubApiController.php`
- Similar controllers for other modules

#### 3. **Sanctum Authentication**
- Generate API token for Project A
- Store token in Project A's `.env`

---

## 🔄 How It Works

### **Flow Example: Creating a BizHub Item**

1. **Admin clicks "Tambah BizHub"** in Project A
   - Route: `GET /admin/websites/bizhub/create`
   - Controller: `BizHubController@create`
   - View: `admin.websites.bizhub.create`

2. **Admin fills form and submits**
   - Route: `POST /admin/websites/bizhub`
   - Controller: `BizHubController@store`
   - Validates data
   - Calls: `ProjectBApiService->post('bizhub', $data)`

3. **API Service makes HTTP request**
   ```php
   Http::withToken($token)
       ->post('http://project-b.test/api/bizhub', $data)
   ```

4. **Project B receives request**
   - Validates token (Sanctum)
   - Validates data
   - Saves to Project B's database
   - Returns JSON response

5. **Project A receives response**
   - If success: Redirect with success message
   - If error: Redirect back with error message

---

## 📁 Folder Structure Created

```
app/
├── Services/
│   └── ProjectBApiService.php          ✅ Created
├── Http/Controllers/Admin/Websites/
│   ├── BizHubController.php            ✅ Created (example)
│   ├── AktivitiController.php          ⏳ To create
│   ├── AhliJawatanKuasaController.php ⏳ To create
│   └── FasilitiController.php         ⏳ To create

resources/views/admin/websites/
├── bizhub/                             ✅ Folder created
│   ├── index.blade.php                 ⏳ To create
│   ├── create.blade.php                ⏳ To create
│   ├── edit.blade.php                  ⏳ To create
│   └── show.blade.php                  ⏳ To create
├── aktiviti/                           ✅ Folder created
├── ahli-jawatan-kuasa/                 ✅ Folder created
└── fasiliti/                           ✅ Folder created
```

---

## 🚀 Next Steps

1. **Create remaining controllers** (Aktiviti, AhliJawatanKuasa, Fasiliti)
2. **Create all view files** (index, create, edit, show for each module)
3. **Add routes** to `routes/web.php`
4. **Update sidebar** with proper routes
5. **Set up Project B** API endpoints (if not done)
6. **Test API connection** with actual Project B URL

---

## ⚙️ Configuration Checklist

- [x] Create `ProjectBApiService.php`
- [x] Update `config/services.php`
- [x] Create folder structure
- [x] Create `BizHubController.php` (example)
- [ ] Create other controllers
- [ ] Create all view files
- [ ] Add routes
- [ ] Update sidebar
- [ ] Add `.env` variables
- [ ] Test API connection

---

## 🔐 Security Notes

1. **API Token**: Store securely in `.env`, never commit to git
2. **HTTPS**: Use HTTPS in production
3. **Rate Limiting**: Implement on Project B
4. **Validation**: Always validate data on both sides
5. **Logging**: All API calls are logged for auditing

---

## 📝 Example API Response Format (Project B should return)

**Success Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Example BizHub",
        "description": "...",
        "created_at": "2025-01-01 12:00:00"
    },
    "message": "BizHub created successfully"
}
```

**Error Response:**
```json
{
    "success": false,
    "message": "Validation failed",
    "errors": {
        "name": ["The name field is required."]
    }
}
```

---

## 🧪 Testing

1. **Test API Service:**
   ```php
   $apiService = new ProjectBApiService();
   $response = $apiService->get('bizhub');
   dd($response);
   ```

2. **Check Logs:**
   - All API calls are logged in `storage/logs/api.log`
   - Check for errors and response times

---

## ❓ FAQ

**Q: What if Project B is not ready yet?**
A: You can create mock responses or use a test API endpoint. The service class handles errors gracefully.

**Q: Can we cache API responses?**
A: Yes, you can add caching in the service class or controllers to reduce API calls.

**Q: What about file uploads?**
A: File uploads need special handling - convert to base64 or use multipart/form-data in API calls.

---

## 📞 Support

If you need help with:
- Project B API setup
- Error handling
- View creation
- Route configuration

Refer to this documentation or ask for specific implementation help.

