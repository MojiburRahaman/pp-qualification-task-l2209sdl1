**In routes/admin.php  all of admin panel route created .**

    // for admin login
    Route::get('login',[AdminAuthController::class,'AdminLogin'])->name('AdminLogin');
    Route::post('login', [AdminAuthController::class,'AdminLoginPost'])->name('AdminLogin.Post');
    
    // for admin register
    Route::get('register', [AdminAuthController::class, 'AdminRegister'])->name('AdminRegister');
    Route::post('register', [AdminAuthController::class, 'AdminRegisterPost'])->name('AdminRegister.Post');

**In routes/web.php all of frontend route created .**

    // home view route
    Route::get('/', function () {
    return  view('welcome');
    })->name('home');
    
    // frontend login and register route
    Route::get('/register', function () {
    return  redirect()->route('login');
    })->name('RegisterView')->middleware('guest:web');
    Route::get('/login', [AuthController::class, 'LoginView'])->name('login')->middleware('guest:web');
    Route::post('/login', [AuthController::class, 'LoginPost'])->name('LoginPost');
    Route::post('/register', [AuthController::class, 'RegisterPost'])->name('RegisterPost')->middleware('guest:web');
    
    // for code verify route
    Route::get('/code', [AuthController::class, 'AuthCodeVerify'])->name('AuthCodeVerify')->middleware('auth:web');
    Route::post('/code', [AuthController::class, 'AuthCodeVerifyPost'])->name('AuthCodeVerifyPost')->middleware('auth:web');

    // for cash in to personal account from agent account
    Route::get('/cash-in', [AgentTransactionController::class, 'CashInView'])->name('CashInView');
    Route::post('/cash-in', [AgentTransactionController::class, 'CashInPost'])->name('CashInPost');
    
    // for add money to personal account
    Route::get('/add-money', [PersonalAccountTransactinController::class, 'AddMoney'])->name('AddMoney');
    Route::post('/add-money', [PersonalAccountTransactinController::class, 'AddMoneyPost'])->name('AddMoneyPost');
    
    // for send money to personal account
    Route::get('/send-money', [PersonalAccountTransactinController::class, 'SendMoneyView'])->name('SendMoneyView');
    Route::post('/send-money', [PersonalAccountTransactinController::class, 'SendMoneyPost'])->name('SendMoneyPost');
    
    // for cashout to agent account
    Route::get('/cashout', [PersonalAccountTransactinController::class, 'CashOutView'])->name('CashOutView');
    Route::post('/cashout', [PersonalAccountTransactinController::class, 'CashOutViewpost'])->name('CashOutViewpost');

    // for user admin panel view
    Route::get('/dashboard', [FrontendController::class, 'DashboardView'])->name('DashboardView');
    
    // for view user transaction
    Route::get('/transaction', [FrontendController::class, 'TransactionView'])->name('TransactionView');
    
    // for view user profile
    Route::get('/profile', [UserProfileController::class, 'ProfileView'])->name('ProfileView');
    
    // for  user logout
    Route::post('/logout', [AuthController::class, 'Logout'])->name('Logout');

