<?php

use App\Http\Controllers\Auth\{LoginController,ForgotPasswordController,AuditorController,AgencyController,CitizenLoginController};
use App\Http\Controllers\Admin\{DashboardController,RescueReportController,ReliefReportController,HydrantController,EmployeesController,VehicleController,StandbyController,AwarenessController,IncidentController,VehicleTypesController};
use App\Http\Controllers\Admin\Location\{DistrictController,TehsilController,PanchayatController,BlockController};
use App\Http\Controllers\Admin\Category\{CategoryController,ProjectController,SubcategoryController,TypeController};
use App\Http\Controllers\Admin\Department\{DeputyController,ReviewOfficerController,CFOController,FSOController,StationsController} ;
use App\Http\Controllers\Admin\CMS\{OrganisationalController,SpecialRiskAreaController,RecentUpdatesController,ContactController,RecentFireIncidentsController};
use App\Http\Controllers\Admin\CMS\About\{AboutController,HistoryController,FireserviceController,FlagDayController,OurobjectiveController,DGMassageController,FAQController,TutorialController};
use App\Http\Controllers\Admin\CMS\Services\{RenderedPaidController,RenderedUnpaidController,AwarnessMockDrillController,PumpingWorkDrillController,RTIController,RTIServicesController,FireOperationController};
use App\Http\Controllers\Admin\CMS\Activities\{GalaryController,FireServiceWeekController};
use App\Http\Controllers\Admin\CMS\Achivements\{MedalWinnersController};
use App\Http\Controllers\Admin\CMS\Achivements\{AchievementController};
use App\Http\Controllers\Admin\Activities\{InspectionController};
use App\Http\Controllers\Admin\Master\{RemarkController};
use App\Http\Controllers\Admin\Leaves\LeaveController;
use App\Http\Controllers\Admin\FireReportController;
use App\Http\Controllers\Admin\TemporaryNocController;
use App\Http\Controllers\Citizen\{CitizenController,DeclarionController,ActivitiesController,TransportationNocController,FireCrackersNocController,OtherServicesNocController,KeroseneNocController,HelipadNocController,GamesNocController,FilmShootingNocController,EntertainmentActivityNocController,NocController,IssuedController,PandalNocController,PublicFunctionNocController};
use App\Http\Controllers\CommonController;
use App\Http\Controllers\Admin\SOP\SOPController;
use App\Http\Controllers\Admin\GO\GOController;
use App\Http\Controllers\Admin\Equipment\EquipmentController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtpController;
use App\Http\Controllers\Admin\CMS\LeadershipSectionController;
use App\Http\Controllers\Admin\PricingRuleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\CMS\Services\StandbyController as CmsStandbyController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\ReportFeeMasterController;
use App\Http\Controllers\FSO\ServiceBillController;
use App\Http\Controllers\CaptchaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return 'All caches have been cleared!';
});

Route::get('/dump-autoload', function() {
    try {
        shell_exec('composer dump-autoload');
        return 'Composer dump-autoload executed successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/composer-update', function() {
    try {
        shell_exec('composer update');
        return 'Composer update executed successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

Route::get('/dompdf-font-cache', function() {
    try {
        shell_exec('php vendor/dompdf/dompdf/util/dompdf_font_family_cache.php');
        return 'DomPDF font cache updated successfully!';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});

// Block storage access
if (str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/storage/logs')) {
    abort(403);
}

// Or using route (for Laravel to handle)
Route::any('storage/{any}', function ($any) {
    if (str_contains($any, 'logs')) {
        abort(403);
    }
    // Redirect to actual storage
    return redirect()->away('/' . $any);
})->where('any', '.*');

Route::post('/send-otp', [OtpController::class, 'sendOtp'])->name('send.otp');
Route::post('/resend-otp', [LoginController::class, 'resendOtp'])->name('resend.otp');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'])->name('auth.login');

Route::prefix('captcha')->group(function () {
    Route::get('/generate', [CaptchaController::class, 'generate'])->name('captcha.generate');
    Route::get('/refresh', [CaptchaController::class, 'refresh'])->name('captcha.refresh');
    Route::post('/validate', [CaptchaController::class, 'validate'])->name('captcha.validate');
    Route::get('/status', [CaptchaController::class, 'status'])->name('captcha.status');
});

Route::get('citizen-register', [CitizenLoginController::class, 'showCitizenLoginForm'])->name('citizen.register');
Route::post('citizenRegister', [CitizenLoginController::class, 'register'])->name('citizenRegister');

Route::get('auditor-register', [AuditorController::class, 'showAuditorRegisterForm'])->name('auditor.register');
Route::post('auditorRegister', [AuditorController::class, 'register'])->name('auditorRegister');

Route::get('agency-register', [AgencyController::class, 'showAgencyRegisterForm'])->name('agency.register');
Route::post('agencyRegister', [AgencyController::class, 'register'])->name('agencyRegister');

// Forgot Password Routes (Public)
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('auth.forgotpassword');
Route::get('resetpasswordotp', [ForgotPasswordController::class, 'otpResetPasswordForm'])->name('resetpasswordotp');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('submitForgetPasswordForm');
Route::post('verify_otp', [ForgotPasswordController::class, 'verifyForgotOtp'])->name('auth.verify.otp');
Route::get('reset-password', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('change-password', [ForgotPasswordController::class, 'changePassword'])->name('change.password');

// Public Main Site Routes
Route::get('/', [App\Http\Controllers\MainController::class,'actionIndex'])->name('actionIndex');
Route::get('/apuni-sarkar/{data?}', [App\Http\Controllers\MainController::class, 'actionSarkar'])->name('actionSarkar');
Route::get('/single-window', [App\Http\Controllers\MainController::class, 'actionWindow'])->name('actionWindow');
Route::get('/achivements', [App\Http\Controllers\MainController::class, 'actionAchivements'])->name('actionAchivements');
Route::get('/achivements_in-previous-year', [App\Http\Controllers\MainController::class, 'actionAchivementsPrevious'])->name('actionAchivementsPrevious');
Route::get('/acts-rules', [App\Http\Controllers\MainController::class, 'actionActs'])->name('actionActs');
Route::get('/call-details', [App\Http\Controllers\MainController::class, 'actionCallDetails'])->name('actionCallDetails');
Route::get('/checknoc', [App\Http\Controllers\MainController::class, 'actionCheckNoc'])->name('actionCheckNoc');
Route::get('/governer-message', [App\Http\Controllers\MainController::class, 'actionGovMsg'])->name('actionGovMsg');
Route::get('/awareness-programme', [App\Http\Controllers\MainController::class, 'actionAwarenessProgramme'])->name('actionAwarenessProgramme');
Route::get('/cm-message', [App\Http\Controllers\MainController::class, 'actionCmMsg'])->name('actionCmMsg');
Route::get('/consultation', [App\Http\Controllers\MainController::class, 'actionConsultation'])->name('actionConsultation');
Route::get('/contact', [App\Http\Controllers\MainController::class, 'actionContact'])->name('actionContact');
Route::get('/copyright-policy', [App\Http\Controllers\MainController::class, 'actionCopyright'])->name('actionCopyright');
Route::get('/dg-message', [App\Http\Controllers\MainController::class, 'actionDgMsg'])->name('actionDgMsg');
Route::get('/disaster-search',[App\Http\Controllers\MainController::class, 'actionDisasterSearch'])->name('actionDisasterSearch');
Route::get('/faq', [App\Http\Controllers\MainController::class, 'actionFaq'])->name('actionFaq');
Route::get('/faq2', [App\Http\Controllers\MainController::class, 'actionFaq2'])->name('actionFaq2');
Route::get('/tutorials', [App\Http\Controllers\MainController::class, 'actionTutorials'])->name('actionTutorials');
Route::get('/feedback', [App\Http\Controllers\MainController::class,'actionFeedback'])->name('actionFeedback');
Route::get('/fire-saftey-vvip', [App\Http\Controllers\MainController::class, 'actionFireSafteyVVIP'])->name('actionFireSafteyVVIP');
Route::get('/success', [App\Http\Controllers\MainController::class, 'actionSuccess'])->name('actionSuccess');
Route::get('/message', [App\Http\Controllers\MainController::class, 'actionMessage'])->name('actionMessage');
Route::get('/fire-saftey-certificate',[App\Http\Controllers\MainController::class, 'actionFireSafteyCertificate'])->name('actionFireSafteyCertificate');
Route::get('/fire-saftey-to-all-places', [App\Http\Controllers\MainController::class,'actionFireSafteyToAllPlaces'])->name('actionFireSafteyToAllPlaces');
Route::get('/fire-service-day', [App\Http\Controllers\MainController::class,'actionFireServiceDay'])->name('actionFireServiceDay');
Route::get('/fire-service-week', [App\Http\Controllers\MainController::class,'actionFireServiceWeek'])->name('actionFireServiceWeek');
Route::get('/fire-units', [App\Http\Controllers\MainController::class,'actionFireUnits'])->name('actionFireUnits');
Route::get('/firefighting', [App\Http\Controllers\MainController::class,'actionFireFighting'])->name('actionFireFighting');
Route::get('/emergency-contact', [App\Http\Controllers\MainController::class,'actionEmergencyContact'])->name('actionEmergencyContact');
Route::get('/flagday', [App\Http\Controllers\MainController::class,'actionFlagday'])->name('actionFlagday');
Route::get('/G1', [App\Http\Controllers\MainController::class,'actionG1'])->name('actionG1');
Route::get('/grivances', [App\Http\Controllers\MainController::class,'actionGrivances'])->name('actionGrivances');
Route::get('/growth-in-staff-strength', [App\Http\Controllers\MainController::class,'actionGrowthInStaffStrength'])->name('actionGrowthInStaffStrength');
Route::get('/history', [App\Http\Controllers\MainController::class,'actionHistory'])->name('actionHistory');
Route::get('/hyperlinking-policy', [App\Http\Controllers\MainController::class,'actionHyperlinkingPolicy'])->name('actionHyperlinkingPolicy');
Route::get('/medal-winner', [App\Http\Controllers\MainController::class,'actionMedalWinner'])->name('actionMedalWinner');
Route::get('/awards', [App\Http\Controllers\MainController::class,'actionAwards'])->name('actionAwards');
Route::get('/mission-vision', [App\Http\Controllers\MainController::class,'actionMissionVision'])->name('actionMissionVision');
Route::get('/noc1', [App\Http\Controllers\MainController::class,'actionNoc1'])->name('actionNoc1');
Route::get('/objective', [App\Http\Controllers\MainController::class,'actionObjective'])->name('actionObjective');
Route::get('/objective2', [App\Http\Controllers\MainController::class,'actionObjective2'])->name('actionObjective2');
Route::get('/organisation-structure', [App\Http\Controllers\MainController::class,'actionOrganisationStructure'])->name('actionOrganisationStructure');
Route::get('/priority-list-of-fire-station', [App\Http\Controllers\MainController::class,'actionPriorityListOfFireStation'])->name('actionPriorityListOfFireStation');
Route::get('/recent-updates',[App\Http\Controllers\MainController::class,'actionRecentUpdates'])->name('actionRecentUpdates');
Route::get('/special-risk-area',[App\Http\Controllers\MainController::class,'actionSpecialRiskArea'])->name('actionSpecialRiskArea');
Route::get('/privacy-policy',[App\Http\Controllers\MainController::class,'actionPrivacyPolicy'])->name('actionPrivacyPolicy');
Route::get('/pumping-work',[App\Http\Controllers\MainController::class,'actionPumpingWork'])->name('actionPumpingWork');
Route::get('/rti',[App\Http\Controllers\MainController::class,'actionRTI'])->name('actionRTI');
Route::get('/rts',[App\Http\Controllers\MainController::class,'actionRTS'])->name('actionRTS');
Route::get('/rtsAction',[App\Http\Controllers\MainController::class,'rtsAction'])->name('rtsAction');
Route::get('/safety-corner',[App\Http\Controllers\MainController::class,'actionSafetyCorner'])->name('actionSafetyCorner');
Route::get('/screen-reader-access',[App\Http\Controllers\MainController::class,'actionScreenReaderAccess'])->name('actionScreenReaderAccess');
Route::get('/servicerenderedpaid',[App\Http\Controllers\MainController::class,'actionServicerenderedpaid'])->name('actionServicerenderedpaid');
Route::get('/servicerenderunpaid',[App\Http\Controllers\MainController::class,'actionServicerenderunpaid'])->name('actionServicerenderunpaid');
Route::get('/sitemap',[App\Http\Controllers\MainController::class,'actionSitemap'])->name('actionSitemap');
Route::get('/staff-strength',[App\Http\Controllers\MainController::class,'actionStaffStrength'])->name('actionStaffStrength');
Route::get('/standby',[App\Http\Controllers\MainController::class,'actionStandby'])->name('actionStandby');
Route::post('/actionStandbyPost',[App\Http\Controllers\MainController::class,'actionStandbyPost'])->name('actionStandbyPost');
Route::post('/actionStandbyOtpPost',[App\Http\Controllers\MainController::class,'actionStandbyOtpPost'])->name('actionStandbyOtpPostVerify');
Route::get('standby/payment/{id}', [App\Http\Controllers\MainController::class, 'paymentPage'])->name('standby.payment');
Route::post('/create-order', [App\Http\Controllers\MainController::class, 'createOrder'])->name('create.order');
Route::post('/verify-payment', [App\Http\Controllers\MainController::class, 'verifyPayment'])->name('verify.payment');
Route::get('payment-success', function () {
    return view('payment_success');
})->name('payment.success');
Route::get('/public-awareness',[App\Http\Controllers\MainController::class,'actionPublicAwareness'])->name('actionPublicAwareness');
Route::post('/publicAwarenessPost',[App\Http\Controllers\MainController::class,'publicAwarenessPost'])->name('publicAwarenessPost')->middleware('throttle:3,1');
Route::post('/publicAwarenessOtpPost',[App\Http\Controllers\MainController::class,'publicAwarenessOtpPost'])->name('publicAwarenessOtpPost');
Route::get('/incidentReport',[App\Http\Controllers\MainController::class,'actionIncidentReport'])->name('actionIncidentReport');
Route::post('/incidentReportPost',[App\Http\Controllers\MainController::class,'incidentReportPost'])->name('incidentReportPost');
Route::get('/terms-condition',[App\Http\Controllers\MainController::class,'actionTermsCondition'])->name('actionTermsCondition');
Route::get('/traning-course',[App\Http\Controllers\MainController::class,'actionTraningCourse'])->name('actionTraningCourse');
Route::get('/vehicle',[App\Http\Controllers\MainController::class,'actionVehicle'])->name('actionVehicle');
Route::get('/pre-establishment-noc',[App\Http\Controllers\MainController::class,'actionPreEstNoc'])->name('actionPreEstNoc');
Route::get('/serviceorderdata',[App\Http\Controllers\MainController::class,'serviceorderdata'])->name('serviceorderdata');
Route::get('/publicarticledata',[App\Http\Controllers\MainController::class,'publicarticledata'])->name('publicarticledata');
Route::get('/recruitmentdata',[App\Http\Controllers\MainController::class,'recruitmentdata'])->name('recruitmentdata');
Route::get('/historydata',[App\Http\Controllers\MainController::class,'historydata'])->name('historydata');
Route::get('/routemapdata',[App\Http\Controllers\MainController::class,'routemapdata'])->name('routemapdata');
Route::get('/istitutionalstructuredata',[App\Http\Controllers\MainController::class,'istitutionalstructuredata'])->name('istitutionalstructuredata');
Route::get('/resultdata',[App\Http\Controllers\MainController::class,'resultdata'])->name('resultdata');
Route::get('/trainingscheduledata',[App\Http\Controllers\MainController::class,'trainingscheduledata'])->name('trainingscheduledata');
Route::get('/coursedata',[App\Http\Controllers\MainController::class,'coursedata'])->name('coursedata');
Route::get('/nocdocrequiredata',[App\Http\Controllers\MainController::class,'nocdocrequiredata'])->name('nocdocrequiredata');
Route::get('/checklistdata',[App\Http\Controllers\MainController::class,'checklistdata'])->name('checklistdata');
Route::get('/bannersliderdata',[App\Http\Controllers\MainController::class,'bannersliderdata'])->name('bannersliderdata');
Route::get('/welfareamenitydata',[App\Http\Controllers\MainController::class,'welfareamenitydata'])->name('welfareamenitydata');
Route::get('/applicationtrackstatus',[App\Http\Controllers\MainController::class,'applicationtrackstatus'])->name('applicationtrackstatus');
Route::post('/applicationtrackstatusPost',[App\Http\Controllers\MainController::class,'applicationtrackstatusPost'])->name('application.track');
Route::post('/application-track-fetch-mobile', [App\Http\Controllers\MainController::class, 'trackFetchMobile'])->name('application.track.fetch.mobile');
Route::post('/application-track-verify-otp', [App\Http\Controllers\MainController::class, 'verifyTrackOtp'])->name('application.track.verify.otp');
Route::get('/applicationverificationtrackstatus',[App\Http\Controllers\MainController::class,'applicationverificationtrackstatus'])->name('applicationverificationtrackstatus');
Route::post('actionFireStationByDistrict',[App\Http\Controllers\MainController::class,'actionFireStationByDistrict'])->name('actionFireStationByDistrict');
Route::get('view_awareness_details/{id}', [App\Http\Controllers\MainController::class,'view_awareness_details'])->name('view_awareness_details');
Route::get('awarenessPdfDownload',[App\Http\Controllers\MainController::class,'awarenessPdfDownload'])->name('awarenessPdfDownload');
Route::post('/verification/send-otp', [App\Http\Controllers\MainController::class, 'verificationSendOtp'])->name('verification.send.otp');
Route::post('/verification/verify-otp', [App\Http\Controllers\MainController::class, 'verificationVerifyOtp'])->name('verification.verify.otp');

// Payment Routes (Public access for payment gateway callbacks)
Route::get('/payment/{service_type}/{application_no}', [PaymentController::class, 'index'])->name('payment.index');
Route::post('/payment/create-order', [PaymentController::class, 'createOrder'])->name('payment.createOrder');
Route::post('/payment/verify', [PaymentController::class, 'verifyPayment'])->name('payment.verify');
Route::get('/payment-success/{application_no}', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment-invoice/{application_no}', [PaymentController::class, 'downloadInvoice'])->name('payment.invoice');
Route::get('/invoice/{application_no}', [PaymentController::class, 'invoice'])->name('invoice.view');

// ==================== AUTHENTICATED ROUTES (Require Login) ====================

Route::middleware(['auth.check'])->group(function () {
    
    // OTP Verification Routes
    Route::get('loginotp', [LoginController::class, 'loginotpForm'])->name('loginotp');
    Route::post('submit_otp', [LoginController::class, 'verifyOtp'])
        ->name('auth.submit.otp')
        ->middleware('throttle:5,10');  // Rate limiting for OTP
    
    // Logout Routes
    Route::get('logout', [LoginController::class, 'logout'])->name('auth.logout');
    Route::post('citizenLogout', [LoginController::class, 'citizenLogout'])->name('citizenLogout');
    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/');
    })->name('logout');
    Route::middleware(['staff'])->group(function () {
        // Profile Routes
        Route::get('/account', [App\Http\Controllers\Admin\AdminController::class,'admin_profile'])->name('admin.home');
        Route::get('admin_profile', [App\Http\Controllers\Admin\AdminController::class,'admin_profile'])->name('admin.profile');
        
        // ==================== ADMIN ONLY ROUTES (type = 0) ====================
        Route::get('home-dashboard-two', [DashboardController::class, 'dashboard'])->name('admin.dashboardtwo');
        Route::get('home-dashboard', [DashboardController::class, 'dashboardTwo'])->name('admin.dashboard');
        // Equipment Management
        Route::get('admin/equipment/equipmentlist', [EquipmentController::class,'equipmentlist'])->name('admin.equipmentlist');
        Route::get('admin/equipment/addequipment', [EquipmentController::class,'addequipment'])->name('admin.add-equipment');
        Route::post('admin/equipment/getstationbydistrict', [EquipmentController::class,'getstationbydistrict'])->name('admin.getstationbydistrict');
        Route::post('admin/equipment/getnamebycategory', [EquipmentController::class,'getnamebycategory'])->name('admin.getnamebycategory');
        Route::post('admin/equipment/saveequipment', [EquipmentController::class,'saveequipment'])->name('admin.saveequipment');
        Route::get('admin/equipment/editequipment/{id}', [EquipmentController::class, 'editequipment'])->name('admin.editequipment');
        Route::post('admin/equipment/updateequipment', [EquipmentController::class,'updateequipment'])->name('admin.updateequipment');
        Route::post('admin/equipment/deleteequipment', [EquipmentController::class, 'deleteequipment'])->name('admin.deleteequipment');
        // Remark Routes
        Route::get('admin/remark', [RemarkController::class, 'index'])->name('admin.remark');
        Route::get('admin/remark/add', [RemarkController::class, 'addRemark'])->name('admin.addRemark');
        Route::post('admin/addRemarkPost', [RemarkController::class, 'addRemarkPost'])->name('admin.addRemarkPost');
        Route::get('admin/remark/view/{id}', [RemarkController::class, 'viewRemark'])->name('admin.viewRemark');
        Route::get('admin/remark/edit/{id}', [RemarkController::class, 'editRemark'])->name('admin.editRemark');
        Route::post('admin/updateRemarkPost', [RemarkController::class, 'updateRemarkPost'])->name('admin.updateRemarkPost');
        Route::get('admin/remark/delete/{id}', [RemarkController::class, 'deleteRemark'])->name('admin.deleteRemark');
        
        // Temporary NOC Routes
        Route::get('admin/temporary-noc', [TemporaryNocController::class,'indexTemporaryNoc'])->name('admin.indexTemporaryNoc');
        Route::get('admin/temporary-noc/{any}', [TemporaryNocController::class,'listTemporaryNoc'])->name('admin.temporary.noc.list');
        Route::get('admin/temporary-noc/view/{type}/{id}', [TemporaryNocController::class,'viewTemporaryNocDetail'])->name('admin.viewTemporaryNocDetail');
        Route::get('admin/noc/list', [NocController::class,'indexAdminNoc'])->name('admin.Noc.list');
        Route::get('admin/noc', [NocController::class,'indexNoc'])->name('admin.Noc');
        Route::get('/apply-temporary-noc/{type}', [NocController::class,'applyTempNOC'])->name('apply.temp.noc');
        Route::post('/filter_noc_data', [NocController::class,'filter_noc_data'])->name('admin.filter_noc_data');
        Route::get('admin/noc/view/{id}', [NocController::class,'adminviewNocDetail'])->name('admin.adminviewNocDetail');
        Route::post('/temporary-noc-fso-approval', [TemporaryNocController::class, 'temporaryNocApplicationForApprovalPost'])->name('temporary.fso.approval');
        Route::post('/temporaryAddPhysicalInsPost', [TemporaryNocController::class, 'temporaryAddPhysicalInsPost'])->name('fso.temporaryAddPhysicalInsPost');
        Route::post('temporary/assignNocToFSO', [TemporaryNocController::class, 'temporaryNocAssignedNocToFSO'])->name('temporary.assignedNocToFSO');
        Route::post('/temporary-noc-cfo-approved', [TemporaryNocController::class, 'temporaryNocApplicationApprovePost'])->name('temporary.cfo.approve');
        Route::post('/temporary-noc-cfo-reject', [TemporaryNocController::class, 'temporaryNocApplicationRejectPost'])->name('temporary.cfo.reject');
        Route::post('/temporary-noc-cfo-revert', [TemporaryNocController::class, 'temporaryNocRevertNocPost'])->name('temporary.cfo.revert');
        Route::get('admin/temporary-noc/download/{type}/{id}', [TemporaryNocController::class, 'downloadTemporaryNoc'])->name('admin.downloadTemporaryNoc');
        Route::post('/temporary-noc-remark', [TemporaryNocController::class, 'temporaryNocRemark'])->name('temporary.cfo.remark');
        
        // Fire Report Management
        Route::get('admin/fire_report', [FireReportController::class, 'index'])->name('admin.fire_report');
        Route::get('admin/fireReport/add', [FireReportController::class, 'addFireReport'])->name('admin.addFireReport');
        Route::post('admin/saveFireReport', [FireReportController::class, 'saveFireReport'])->name('admin.saveFireReport');
        Route::get('admin/fireReport/edit/{id}', [FireReportController::class, 'editFireReport'])->name('admin.editFireReport');
        Route::post('admin/updateFireReport', [FireReportController::class, 'updateFireReport'])->name('admin.updateFireReport');
        Route::get('admin/fireReport/view/{id}', [FireReportController::class, 'viewFireReport'])->name('admin.viewFireReport');
        Route::delete('admin/fireReport/delete/{id}', [FireReportController::class, 'deleteFireReport'])->name('admin.deleteFireReport');
        Route::get('admin/fireReport/sentFireApproval/{id}', [FireReportController::class, 'sentFireApproval'])->name('admin.sentFireApproval');
        Route::get('admin/fireReport/fireApproved/{id}', [FireReportController::class, 'fireApproved'])->name('admin.fireApproved');
        Route::post('admin/fireReport/addFireRemark', [FireReportController::class, 'addFireRemark'])->name('admin.addFireRemark');
        Route::get('admin/fireReport/deleteFireFile/{id}', [FireReportController::class, 'deleteFireFile'])->name('admin.deleteFireFile');
        Route::get('admin/fireReport/download/{id}', [FireReportController::class, 'downloadFireReport'])->name('admin.downloadFireReport');
        
        // Rescue Report Management
        Route::get('admin/rescue_report', [RescueReportController::class, 'index'])->name('admin.rescueReport');
        Route::get('admin/rescueReport/add', [RescueReportController::class, 'addRescueReport'])->name('admin.addRescueReport');
        Route::post('admin/saveRescueReport', [RescueReportController::class, 'saveRescueReport'])->name('admin.saveRescueReport');
        Route::get('admin/rescueReport/edit/{id}', [RescueReportController::class, 'editRescueReport'])->name('admin.editRescueReport');
        Route::post('admin/updateRescueReport', [RescueReportController::class, 'updateRescueReport'])->name('admin.updateRescueReport');
        Route::get('admin/rescueReport/view/{id}', [RescueReportController::class, 'viewRescueReport'])->name('admin.viewRescueReport');
        Route::delete('admin/rescueReport/delete/{id}', [RescueReportController::class, 'deleteRescueReport'])->name('admin.deleteRescueReport');
        Route::get('admin/rescueReport/sentRescueApproval/{id}', [RescueReportController::class, 'sentRescueApproval'])->name('admin.sentRescueApproval');
        Route::get('admin/rescueReport/rescueApproved/{id}', [RescueReportController::class, 'rescueApproved'])->name('admin.rescueApproved');
        Route::post('admin/rescueReport/addRescueRemark', [RescueReportController::class, 'addRescueRemark'])->name('admin.addRescueRemark');
        Route::get('admin/rescueReport/deleteRescueFile/{id}', [RescueReportController::class, 'deleteRescueFile'])->name('admin.deleteRescueFile');
        Route::get('admin/rescueReport/download/{id}', [RescueReportController::class, 'downloadRescueReport'])->name('admin.downloadRescueReport');
        
        // Relief Report Management
        Route::get('admin/reliefReport', [ReliefReportController::class, 'index'])->name('admin.reliefReport');
        Route::get('admin/reliefReport/add', [ReliefReportController::class, 'addReliefReport'])->name('admin.addReliefReport');
        Route::post('admin/saveReliefReport', [ReliefReportController::class, 'saveReliefReport'])->name('admin.saveReliefReport');
        Route::get('admin/reliefReport/edit/{id}', [ReliefReportController::class, 'editReliefReport'])->name('admin.editReliefReport');
        Route::post('admin/updateReliefReport', [ReliefReportController::class, 'updateReliefReport'])->name('admin.updateReliefReport');
        Route::get('admin/reliefReport/view/{id}', [ReliefReportController::class, 'viewReliefReport'])->name('admin.viewReliefReport');
        Route::delete('admin/reliefReport/delete/{id}', [ReliefReportController::class, 'deleteReliefReport'])->name('admin.deleteReliefReport');
        Route::get('admin/reliefReport/sentReliefApproval/{id}', [ReliefReportController::class, 'sentReliefApproval'])->name('admin.sentReliefApproval');
        Route::get('admin/reliefReport/reliefApproved/{id}', [ReliefReportController::class, 'reliefApproved'])->name('admin.reliefApproved');
        Route::post('admin/reliefReport/addReliefRemark', [ReliefReportController::class, 'addReliefRemark'])->name('admin.addReliefRemark');
        Route::get('admin/reliefReport/deleteReliefFile/{id}', [ReliefReportController::class, 'deleteReliefFile'])->name('admin.deleteReliefFile');
        Route::get('admin/reliefReport/download/{id}', [ReliefReportController::class, 'downloadReliefReport'])->name('admin.reliefReport.download');
        
        // Hydrant Management
        Route::get('admin/hydrant', [HydrantController::class, 'index'])->name('admin.hydrant');
        Route::delete('admin/hydrant/delete/{id}', [HydrantController::class, 'destroy'])->name('admin.deletehydrant');
        Route::get('admin/hydrant/edit/{id}', [HydrantController::class, 'edit'])->name('admin.edithydrant');
        Route::get('admin/hydrant/addhydrant', [HydrantController::class, 'addhydrant'])->name('admin.addhydrant');
        Route::post('admin/hydrant/getfirestation', [HydrantController::class, 'getfirestation'])->name('admin.getfirestation');
        Route::post('admin/hydrant/savehydrant', [HydrantController::class, 'savehydrant'])->name('admin.savehydrant');
        Route::get('admin/hydrant/view/{id}', [HydrantController::class, 'view'])->name('admin.viewhydrant');
        Route::post('admin/hydrant/updatehydrant', [HydrantController::class, 'updatehydrant'])->name('admin.updatehydrant');
        
        // Vehicle Management
        Route::get('admin/vehicle', [VehicleController::class, 'index'])->name('admin.vehicle');
        Route::delete('admin/vehicle/delete/{id}', [VehicleController::class, 'destroy'])->name('admin.deletevehicle');
        Route::get('admin/vehicle/edit/{id}', [VehicleController::class, 'edit'])->name('admin.editvehicle');
        Route::get('admin/vehicle/addnewvehicle', [VehicleController::class, 'add'])->name('admin.addnewvehicle');
        Route::post('admin/vehicle/savevehicle', [VehicleController::class, 'savevehicle'])->name('admin.savevehicle');
        Route::get('admin/vehicle/editdata/{id}', [VehicleController::class, 'editdata'])->name('admin.editdata');
        Route::post('admin/vehicle/updatevehicle', [VehicleController::class, 'updatevehicle'])->name('admin.updatevehicle');
        Route::post('admin/vehicle/StatementPost', [VehicleController::class, 'vehicleStatementPost'])->name('admin.vehicleStatementPost');
        Route::get('admin/vehicle/editvehiclestatement/{id}', [VehicleController::class, 'editvehiclestatement'])->name('admin.editvehiclestatement');
        Route::get('admin/vehicle/vehiclestatementreport/{id}', [VehicleController::class, 'vehiclestatementreport'])->name('admin.vehiclestatementreport');
        
        // Employee Management
        Route::get('admin/employees', [EmployeesController::class, 'index'])->name('admin.employees');
        Route::get('admin/employees/add', [EmployeesController::class, 'create'])->name('admin.addemployees');
        Route::post('admin/employees/saveemployees', [EmployeesController::class, 'store'])->name('admin.saveemployees');
        Route::delete('admin/employees/delete/{id}', [EmployeesController::class, 'destroy'])->name('admin.deleteemployees');
        Route::get('admin/employees/edit/{id}', [EmployeesController::class, 'edit'])->name('admin.editemployees');
        Route::put('/employee/update/{id}', [EmployeesController::class, 'update'])->name('admin.updateemployee');
        
        // Standby, Awareness, Incident Admin Routes
        Route::get('admin/standby', [StandbyController::class, 'index'])->name('admin.standby');
        Route::get('admin/standby/add', [StandbyController::class, 'addStandby'])->name('admin.addStandby');
        Route::post('admin/addStandbyPost', [StandbyController::class, 'saveStandby'])->name('admin.saveStandby');
        Route::get('admin/standby/view/{id}', [StandbyController::class, 'viewStandby'])->name('admin.viewStandby');
        Route::post('admin/assignedToStandby', [StandbyController::class, 'assignedToStandby'])->name('admin.assignedToStandby');
        Route::post('admin/assigneeResponseStandby', [StandbyController::class, 'assigneeResponseAwareness'])->name('admin.assigneeResponseStandby');
        Route::get('admin/rejectStandbyApplication/{id}', [StandbyController::class, 'rejectStandbyApplication'])->name('admin.rejectStandbyApplication');
        Route::get('admin/standByEventProgram/{id}', [StandbyController::class, 'standByEventProgram'])->name('admin.standByEventProgram');
        Route::post('admin/standByEventProgramData', [StandbyController::class, 'standByEventProgramData'])->name('admin.standByEventProgramData');
        Route::post('admin/standByEventProgramAcceptRejectByCfo', [StandbyController::class, 'standByEventProgramAcceptRejectByCfo'])->name('admin.standByEventProgramAcceptRejectByCfo');
        Route::post('admin/standByOtpPost', [StandbyController::class, 'standByOtpPost'])->name('admin.standByOtpPost');
        Route::get('/standbyDownload/{id}', [StandbyController::class, 'standbyDownload'])->name('standby.download');
        
        Route::get('admin/awareness', [AwarenessController::class, 'index'])->name('admin.awareness');
        Route::get('admin/awareness/add', [AwarenessController::class, 'addAwareness'])->name('admin.addAwareness');
        Route::post('admin/addAwarenessPost', [AwarenessController::class, 'saveAwareness'])->name('admin.saveAwareness');
        Route::get('admin/awareness/view/{id}', [AwarenessController::class, 'viewAwareness'])->name('admin.viewAwareness');
        Route::post('admin/assignedToAwareness', [AwarenessController::class, 'assignedToAwareness'])->name('admin.assignedToAwareness');
        Route::post('admin/assigneeResponseAwareness', [AwarenessController::class, 'assigneeResponseAwareness'])->name('admin.assigneeResponseAwareness');
        Route::post('admin/rejectAwarenessApplication', [AwarenessController::class, 'rejectAwarenessApplication'])->name('admin.rejectAwarenessApplication');
        Route::get('admin/awarenessEventProgram/{id}', [AwarenessController::class, 'awarenessEventProgram'])->name('admin.awarenessEventProgram');
        Route::post('admin/awarenessEventProgramData', [AwarenessController::class, 'awarenessEventProgramData'])->name('admin.awarenessEventProgramData');
        Route::post('admin/eventProgramAcceptRejectByCfo', [AwarenessController::class, 'eventProgramAcceptRejectByCfo'])->name('admin.eventProgramAcceptRejectByCfo');
        Route::post('admin/awarenessOtpPost', [AwarenessController::class, 'awarenessOtpPost'])->name('admin.awarenessOtpPost');
        Route::get('/awarenessDownload/{id}', [AwarenessController::class, 'awarenessDownload'])->name('awareness.download');
        
        Route::get('admin/incident', [IncidentController::class, 'index'])->name('admin.incident');
        Route::get('admin/incident/add', [IncidentController::class, 'addIncident'])->name('admin.addIncident');
        Route::post('admin/addIncidentPost', [IncidentController::class, 'saveIncident'])->name('admin.saveIncident');
        Route::get('admin/incident/view/{id}', [IncidentController::class, 'viewIncident'])->name('admin.viewIncident');
        Route::post('admin/assignedToIncident', [IncidentController::class, 'assignedToIncident'])->name('admin.assignedToIncident');
        Route::post('admin/assigneeResponseIncident', [IncidentController::class, 'assigneeResponseIncident'])->name('admin.assigneeResponseIncident');
        Route::post('admin/sentReportUrl', [IncidentController::class, 'sentReportUrl'])->name('admin.sentReportUrl');
        Route::get('admin/rejectIncidentApplication/{id}', [IncidentController::class, 'rejectIncidentApplication'])->name('admin.rejectIncidentApplication');
        
        Route::post('dashboard-filterdata', [DashboardController::class, 'filterDashboardData'])->name('admin.dashboardfilterData');
        Route::get('admin/actions', [DashboardController::class,'actions'])->name('admin.actions');
        
        // Admin Activities
        Route::get('admin/activities', [CommonController::class, 'indexActivities'])->name('admin.activities');
        
        // Inspection Routes
        Route::get('admin/inspection-by-officer', [InspectionController::class, 'inspectionByOfficer'])->name('admin.inspectionByOfficer');
        Route::get('admin/inspection-by-fficer/add', [InspectionController::class, 'addInspectionByOfficer'])->name('admin.addInspectionByOfficer');
        Route::post('admin/addInspectionByOfficerPost', [InspectionController::class, 'addInspectionByOfficerPost'])->name('admin.addInspectionByOfficerPost');
        Route::get('admin/inspection-by-officer/view/{id}', [InspectionController::class, 'viewInspectionByOfficer'])->name('admin.viewInspectionByOfficer');
        Route::get('admin/inspection-by-officer/delete/{id}', [InspectionController::class, 'deleteInspectionByOfficer'])->name('admin.deleteInspectionByOfficer');
        
        // Reward Punishment Routes
        Route::get('admin/reward-punishment', [InspectionController::class, 'rewardPanishment'])->name('admin.rewardPanishment');
        Route::get('admin/reward-punishment/add', [InspectionController::class, 'addRewardPanishment'])->name('admin.addRewardPanishment');
        Route::post('admin/addRewardPunishmentPost', [InspectionController::class, 'addRewardPanishmentPost'])->name('admin.saveRewardPanishment');
        Route::get('admin/reward-pinishment/view/{id}', [InspectionController::class, 'viewRewardPanishment'])->name('admin.viewRewardPanishment');
        Route::get('admin/reward-punishment/delete/{id}', [InspectionController::class, 'deleteRewardPanishment'])->name('admin.deleteRewardPanishment');
        
        // Fire Inspection Routes
        Route::get('admin/fire-inspection', [InspectionController::class, 'fireInspection'])->name('admin.fireInspection');
        Route::get('admin/fire-inspection/add', [InspectionController::class, 'addFireInspection'])->name('admin.addFireInspection');
        Route::post('admin/addFireInspectionPost', [InspectionController::class, 'addFireInspectionPost'])->name('admin.addFireInspectionPost');
        Route::get('admin/fire-inspection/view/{id}', [InspectionController::class, 'viewFireInspection'])->name('admin.viewFireInspection');
        Route::get('admin/fire-inspection/delete/{id}', [InspectionController::class, 'deleteFireInspection'])->name('admin.deleteFireInspection');
        
        // Station Management
        Route::get('admin/stations', [StationsController::class, 'index'])->name('admin.stations');
        Route::get('admin/stations/add', [StationsController::class, 'add'])->name('admin.addstations');
        Route::post('admin/stations/store', [StationsController::class, 'store'])->name('admin.storestations');
        Route::get('admin/station/edit/{id}', [StationsController::class, 'editStation'])->name('admin.editStation');
        Route::put('admin/updateStationPost/{id}', [StationsController::class, 'updateStation'])->name('admin.updateStation');
        Route::get('admin/stations/view', [StationsController::class, 'view'])->name('admin.view');
        Route::delete('admin/stations/delete/{id}', [StationsController::class, 'destroy'])->name('admin.deletestations');
        Route::get('admin/stations/filter', [StationsController::class, 'filter'])->name('admin.stationsfilter');
        
        // SOP and GO Circular Routes
        Route::get('/admin/sop', [SOPController::class, 'indexSOP'])->name('admin.sop');
        Route::get('/admin/add-sop', [SOPController::class, 'addSOP'])->name('admin.add-sop');
        Route::post('/admin/sop-post', [SOPController::class, 'indexSOPPost'])->name('admin.sop.post');
        Route::get('/admin/sop-delete/{id}', [SOPController::class, 'deleteSOP'])->name('admin.sop.delete');
        Route::get('/admin/sop-edit/{id}', [SOPController::class, 'editSOP'])->name('admin.sop.edit');
        Route::post('/admin/sop-post-update', [SOPController::class, 'updateSOP'])->name('admin.sop.update');
        
        Route::get('/admin/go-circular', [GOController::class, 'indexGoCircularPlan'])->name('admin.go.circular');
        Route::get('/admin/add-go-circular', [GOController::class, 'addGoCircular'])->name('admin.add-go-circular');
        Route::post('/admin/go-circular-post', [GoController::class, 'indexGoCircularPlanPost'])->name('admin.go.circular.post');
        Route::get('/admin/edit-go-circular/{id}', [GOController::class, 'editGoCircular'])->name('admin.edit-go-circular');
        Route::post('/admin/go-circular-post-update', [GoController::class, 'indexGoCircularPlanPostUpdate'])->name('admin.go.circular.post.update');
        Route::get('/admin/go-circular-delete/{id}', [GOController::class, 'deleteGoCircularPlan'])->name('admin.go.circular.delete');
        
        // Admin Periodic Reports
        Route::get('/admin/periodic-employee', [CommonController::class, 'indexPeriodicEmployee'])->name('admin.periodic-employee');
        Route::get('/admin/periodic-inspection-officers', [CommonController::class, 'indexPeriodicInspectionOfficers'])->name('admin.periodic-report-inspection-officers');
        Route::get('/admin/periodic-rewards', [CommonController::class, 'indexPeriodicRewards'])->name('admin.periodic-report-rewards');
        Route::get('/admin/periodic-punishment', [CommonController::class, 'indexPeriodicPunishment'])->name('admin.periodic-report-punishment');
        Route::get('/admin/periodic-communication', [CommonController::class, 'indexPeriodicCommunication'])->name('admin.periodic-report-communication');
        Route::get('/admin/periodic-fire-stations', [CommonController::class, 'indexPeriodicFireStations'])->name('admin.periodic-report-fire-stations');
        Route::get('/admin/periodic-fire-incidents', [CommonController::class, 'indexPeriodicFireIncidents'])->name('admin.periodic-report-fire-incidents');
        Route::get('/admin/periodic-rescue-incidents', [CommonController::class, 'indexPeriodicRescueIncidents'])->name('admin.periodic-report-rescue-incidents');
        Route::get('/admin/periodic-relief-incidents', [CommonController::class, 'indexPeriodicReliefIncidents'])->name('admin.periodic-report-relief-incidents');
        Route::get('/admin/periodic-service-duties', [CommonController::class, 'indexPeriodicServiceDuties'])->name('admin.periodic-report-service-duties');
        Route::get('/admin/periodic-hydrants', [CommonController::class, 'indexPeriodicHydrants'])->name('admin.periodic-report-hydrants');
        Route::get('/admin/periodic-noc', [CommonController::class, 'indexPeriodicFireNoc'])->name('admin.periodic-report-noc');
        Route::get('/admin/periodic-fire-inspections', [CommonController::class, 'indexPeriodicFireInspections'])->name('admin.periodic-report-fire-inspections');
        Route::get('/admin/periodic-fire-vehicles', [CommonController::class, 'indexPeriodicFireVehicles'])->name('admin.periodic-report-fire-vehicles');
        Route::get('/admin/periodic-awareness-programs', [CommonController::class, 'indexPeriodicAwarenessPrograms'])->name('admin.periodic-report-awareness-programs');
        
        // Admin Agency License
        Route::get('/admin/agency-license', [CommonController::class, 'indexAgencyLicense'])->name('admin.agency.licence');
        Route::get('/admin/agency/licence/view/{id}', [CommonController::class, 'indexAgencyLicenceView'])->name('admin.agency.licence.view');
        Route::post('/revertedAgencyLicence', [CommonController::class, 'revertedAgencyLicence'])->name('revertedAgencyLicence');
        Route::get('/agency-licence-download/{id}', [App\Http\Controllers\Admin\Agency\AgencyController::class, 'agencyLicenceDownload'])->name('agencyLicenceDownload');
        
        // Admin Risk Auditor
        Route::get('/admin/auditor/risk-auditor', [CommonController::class, 'indexRiskAuditor'])->name('admin.auditor.riskAuditor');
        Route::get('/admin/auditor/risk-auditor/view/{id}', [CommonController::class, 'indexRiskAuditorView'])->name('admin.auditor.risk.view');
        Route::post('/revertedRiskAuditor', [CommonController::class, 'revertedRiskAuditor'])->name('revertedRiskAuditor');
        Route::get('/risk-auditor-download/{id}', [App\Http\Controllers\Admin\Auditor\AuditorController::class, 'riskAuditorDownload'])->name('riskAuditorDownload');
        
        // Leave Management
        Route::get('admin/leaves', [LeaveController::class, 'manageLeaves'])->name('admin.leaves');
        Route::post('dashboard/noc-data', [DashboardController::class, 'getNocDashboardData'])->name('admin.getNocDashboardData');
        Route::get('/get-fire-stations/{districtId}', [FSOController::class, 'getFireStations']);
        Route::post('/dashboard/vehicle-data', [DashboardController::class, 'getVehicleData'])->name('dashboard.vehicle.data');
        Route::get('/dashboard/fire-report-data', [DashboardController::class, 'getFireReportData'])->name('dashboard.fireReportData');
        Route::get('/dashboard/equipment-data', [DashboardController::class, 'getEquipmentData'])->name('dashboard.equipmentData');
        Route::post('/admin/rescue-dashboard-data', [DashboardController::class, 'getRescueDashboardData'])->name('admin.getRescueDashboardData');
        Route::post('/admin/relief-dashboard-data', [DashboardController::class, 'getReliefDashboardData'])->name('admin.getReliefDashboardData');
        Route::post('/admin/hydrant-dashboard-data', [DashboardController::class, 'getHydrantDashboardData'])->name('admin.getHydrantDashboardData');
        Route::post('/admin/employee-dashboard-data', [DashboardController::class, 'getEmployeeDashboardData'])->name('admin.getEmployeeDashboardData');

    });
    
    Route::middleware(['admin'])->group(function () {        
        Route::get('awarnessChart', [DashboardController::class, 'postawarnessChart'])->name('admin.postawarnessChart');
        Route::get('nocChart', [DashboardController::class, 'countNocPending'])->name('admin.nocChart');
        Route::get('postSanctionChart', [DashboardController::class, 'postSanctionChart'])->name('admin.postSanctionChart');
        
        // CMS - About Section
        Route::get('admin/about/mission-vision', [AboutController::class, 'MissionVision'])->name('admin.about.missionvision');
        Route::get('admin/about/mission-vision/add', [AboutController::class, 'AddMissionVision'])->name('admin.about.missionvision.add');
        Route::post('admin/about/mission-vision/save', [AboutController::class, 'SaveMissionVision'])->name('admin.about.missionvision.save');
        Route::get('/admin/mission-vision/delete/{id}', [AboutController::class, 'destroyMissionVision'])->name('admin.about.mission_vision.destroy');
        Route::get('admin/about/mission-vision/edit/{id}', [AboutController::class, 'EditMissionVision'])->name('admin.about.missionvision.edit');
        Route::post('admin/about/mission-vision/update/{id}', [AboutController::class, 'UpdateMissionVision'])->name('admin.about.missionvision.update');
        
        Route::get('admin/about/history', [HistoryController::class, 'index'])->name('admin.about.history');
        Route::get('admin/about/history/add', [HistoryController::class, 'addHistory'])->name('admin.about.history.add');
        Route::post('admin/about/history/save', [HistoryController::class, 'Savehistory'])->name('admin.about.history.save');
        Route::get('/admin/history/delete/{id}', [HistoryController::class, 'destroyhistory'])->name('admin.about.history.destroy');
        Route::get('/admin/history/edit/{id}', [HistoryController::class, 'edithistory'])->name('admin.about.history.edit');
        Route::post('admin/about/history/update', [HistoryController::class, 'Updatehistory'])->name('admin.about.history.update');
        
        Route::get('admin/about/Fire_Service_Day', [FireserviceController::class, 'index'])->name('admin.about.Fire_Service_Day');
        Route::get('admin/about/Fire_Service_Day/add', [FireserviceController::class, 'addFire_Service_Day'])->name('admin.about.Fire_Service_Day.add');
        Route::post('admin/about/Fire_Service_Day/save', [FireserviceController::class, 'SaveFire_Service_Day'])->name('admin.about.Fire_Service_Day.save');
        Route::get('/admin/Fire_Service_Day/delete/{id}', [FireserviceController::class, 'destroyFire_Service_Day'])->name('admin.about.Fire_Service_Day.destroy');
        Route::get('admin/about/Fire_Service_Day/edit/{id}', [FireserviceController::class, 'editFire_Service_Day'])->name('admin.about.Fire_Service_Day.edit');
        Route::post('admin/about/Fire_Service_Day/update/{id}', [FireserviceController::class, 'updateFire_Service_Day'])->name('admin.about.Fire_Service_Day.update');
        
        Route::get('admin/about/flag_day', [FlagDayController::class, 'index'])->name('admin.about.flag_day');
        Route::get('admin/about/flag_day/add', [FlagDayController::class, 'addflag_day'])->name('admin.about.flag_day.add');
        Route::post('admin/about/flag_day/save', [FlagDayController::class, 'Saveflag_day'])->name('admin.about.flag_day.save');
        Route::get('/admin/flag_day/delete/{id}', [FlagDayController::class, 'destroyflag_day'])->name('admin.about.flag_day.destroy');
        Route::get('admin/about/flag_day/edit/{id}', [FlagDayController::class, 'editflag_day'])->name('admin.about.flag_day.edit');
        Route::post('admin/about/flag_day/update/{id}', [FlagDayController::class, 'updateflag_day'])->name('admin.about.flag_day.update');
        
        Route::get('admin/about/tutorial', [TutorialController::class, 'tutorialIndex'])->name('admin.about.tutorial');
        Route::get('admin/about/tutorial/add', [TutorialController::class, 'addTutorial'])->name('admin.about.tutorial.add');
        Route::post('admin/about/tutorial/save', [TutorialController::class, 'saveTutorial'])->name('admin.about.tutorial.save');
        Route::get('admin/about/tutorial/edit/{id}', [TutorialController::class, 'editTutorial'])->name('admin.about.tutorial.edit');
        Route::post('admin/about/tutorial/update/{id}', [TutorialController::class, 'updateTutorial'])->name('admin.about.tutorial.update');
        Route::get('admin/about/tutorial/delete/{id}', [TutorialController::class, 'destroyTutorial'])->name('admin.about.tutorial.delete');
        
        Route::get('admin/about/our_objective', [OurobjectiveController::class, 'index'])->name('admin.about.our_objective');
        Route::get('admin/about/our_objective/add', [OurobjectiveController::class, 'add'])->name('admin.about.our_objective.add');
        Route::post('admin/about/our_objective/save', [OurobjectiveController::class, 'Save'])->name('admin.about.our_objective.save');
        Route::get('/admin/our_objective/delete/{id}', [OurobjectiveController::class, 'destroy'])->name('admin.about.our_objective.destroy');
        Route::get('/admin/our-objective/edit/{id}', [OurobjectiveController::class, 'edit'])->name('admin.about.our_objective.edit');
        Route::post('/admin/our-objective/update/{id}', [OurobjectiveController::class, 'update'])->name('admin.about.our_objective.update');
        
        Route::get('admin/about/dg_message', [DGMassageController::class, 'index'])->name('admin.about.dg_message');
        Route::get('admin/about/dg_message/add', [DGMassageController::class, 'add'])->name('admin.about.dg_message.add');
        Route::post('admin/about/dg_message/save', [DGMassageController::class, 'Save'])->name('admin.about.dg_message.save');
        Route::get('/admin/dg_message/delete/{id}', [DGMassageController::class, 'destroy'])->name('admin.about.dg_message.destroy');
        
        Route::get('admin/about/faq', [FAQController::class, 'index'])->name('admin.about.faq');
        Route::get('admin/about/faq/add', [FAQController::class, 'add'])->name('admin.about.faq.add');
        Route::post('admin/about/faq/save', [FAQController::class, 'Save'])->name('admin.about.faq.save');
        Route::get('admin/about//faq/edit/{id}', [FAQController::class, 'edit'])->name('admin.about.faq.edit');
        Route::put('admin/about//faq/update/{id}', [FAQController::class, 'update'])->name('admin.about.faq.update');
        Route::get('/admin/faq/delete/{id}', [FAQController::class, 'destroy'])->name('admin.about.faq.destroy');
        
        
        
        // Location Management
        Route::get('admin/district', [DistrictController::class, 'index'])->name('admin.district');
        Route::delete('admin/district/delete/{id}', [DistrictController::class, 'destroy'])->name('admin.deletedistrict');
        Route::get('admin/district/edit/{id}', [DistrictController::class, 'edit'])->name('admin.editdistrict');
        Route::put('admin/district/update/{id}', [DistrictController::class, 'update'])->name('admin.updatedistrict');
        Route::get('admin/district/add', [DistrictController::class, 'add'])->name('admin.adddistrict');
        Route::post('admin/district/store', [DistrictController::class, 'store'])->name('admin.storedistrict');
        Route::get('admin/district/filter', [DistrictController::class, 'filter'])->name('admin.districtfilter');
        
        Route::get('admin/tehsil', [TehsilController::class, 'index'])->name('admin.tehsil');
        Route::delete('admin/tehsil/delete/{id}', [TehsilController::class, 'destroy'])->name('admin.deletetehsil');
        Route::get('admin/tehsil/edit/{id}', [TehsilController::class, 'edit'])->name('admin.edittehsil');
        Route::put('admin/tehsil/update/{id}', [TehsilController::class, 'update'])->name('admin.updatetehsil');
        Route::get('admin/tehsil/add', [TehsilController::class, 'add'])->name('admin.addtehsil');
        Route::post('admin/tehsil/store', [TehsilController::class, 'store'])->name('admin.storetehsil');
        Route::get('admin/tehsil/filter', [TehsilController::class, 'filter'])->name('admin.Tehsilfilter');
        
        Route::get('admin/block', [BlockController::class, 'index'])->name('admin.block');
        Route::delete('admin/block/delete/{id}', [BlockController::class, 'destroy'])->name('admin.deleteblock');
        Route::get('admin/block/edit/{id}', [BlockController::class, 'edit'])->name('admin.editblockl');
        Route::put('admin/block/update/{id}', [BlockController::class, 'update'])->name('admin.updateblockl');
        Route::get('admin/block/add', [BlockController::class, 'add'])->name('admin.addblock');
        Route::post('admin/block/store', [BlockController::class, 'store'])->name('admin.storeblock');
        Route::get('admin/block/filter', [BlockController::class, 'filter'])->name('admin.blockfilter');
        
        Route::get('admin/panchayat', [PanchayatController::class, 'index'])->name('admin.panchayat');
        Route::delete('admin/panchayat/delete/{id}', [PanchayatController::class, 'destroy'])->name('admin.deletepanchayat');
        Route::get('admin/panchayat/edit/{id}', [PanchayatController::class, 'edit'])->name('admin.editpanchayat');
        Route::put('admin/panchayat/update/{id}', [PanchayatController::class, 'update'])->name('admin.updatepanchayat');
        Route::get('admin/panchayat/add', [PanchayatController::class, 'add'])->name('admin.addpanchayat');
        Route::post('admin/panchayat/store', [PanchayatController::class, 'store'])->name('admin.storepanchayat');
        Route::get('admin/panchayat/filter', [PanchayatController::class, 'filter'])->name('admin.panchayatfilter');
        
        // Department Management
        Route::get('admin/deptydirector', [DeputyController::class, 'index'])->name('admin.deptydirector');
        Route::delete('admin/deptydirector/delete/{id}', [DeputyController::class, 'destroy'])->name('admin.deletedeptydirector');
        Route::get('admin/deptydirector/edit/{id}', [DeputyController::class, 'edit'])->name('admin.editdeptydirector');
        Route::put('admin/deptydirector/update/{id}', [DeputyController::class, 'update'])->name('admin.updatedeptydirector');
        Route::get('admin/deptydirector/add', [DeputyController::class, 'add'])->name('admin.deptydirectoradd');
        Route::post('admin/deptydirector/store', [DeputyController::class, 'store'])->name('admin.storedeptydirector');
        Route::get('admin/deptydirector/filter', [DeputyController::class, 'filter'])->name('admin.deputyfilter');
        
        Route::get('admin/review', [ReviewOfficerController::class, 'index'])->name('admin.review');
        Route::delete('admin/review/delete/{id}', [ReviewOfficerController::class, 'destroy'])->name('admin.deletereview');
        Route::get('admin/review/edit/{id}', [ReviewOfficerController::class, 'edit'])->name('admin.editreview');
        Route::put('admin/review/update/{id}', [ReviewOfficerController::class, 'update'])->name('admin.updatereview');
        Route::get('admin/review/add', [ReviewOfficerController::class, 'add'])->name('admin.reviewadd');
        Route::post('admin/review/store', [ReviewOfficerController::class, 'store'])->name('admin.storereview');
        Route::get('admin/review/filter', [ReviewOfficerController::class, 'filter'])->name('admin.reviewfilter');
        
        Route::get('admin/cfo', [CFOController::class, 'index'])->name('admin.cfo');
        Route::get('admin/cfo/add', [CFOController::class, 'add'])->name('admin.addcfo');
        Route::post('admin/cfo/add', [CFOController::class, 'store'])->name('admin.cfostore');
        Route::get('admin/cfo/edit/{id}', [CFOController::class, 'edit'])->name('admin.editcfo');
        Route::put('admin/cfo/update/{id}', [CFOController::class, 'update'])->name('admin.updatecfo');
        Route::delete('admin/cfo/delete/{id}', [CFOController::class, 'destroy'])->name('admin.deletecfo');
        Route::get('admin/cfo/upload-signatures/{id}', [CFOController::class, 'uploadSignature'])->name('admin.uploadSignatures');
        Route::post('admin/cfo/uploadSignaturePost', [CFOController::class, 'uploadSignaturePost'])->name('admin.uploadSignaturePost');
        Route::get('admin/cfo/filter', [CFOController::class, 'filter'])->name('admin.cfofilter');
        
        Route::get('admin/fso', [FSOController::class, 'index'])->name('admin.fso');
        Route::get('admin/fso/add', [FSOController::class, 'add'])->name('admin.addfso');
        Route::post('admin/fso/add', [FSOController::class, 'store'])->name('admin.fsostore');
        Route::get('admin/fso/edit/{id}', [FSOController::class, 'edit'])->name('admin.editfso');
        Route::put('admin/fso/update/{id}', [FSOController::class, 'update'])->name('admin.updatefso');
        Route::delete('admin/fso/delete/{id}', [FSOController::class, 'destroy'])->name('admin.deletefso');
        Route::get('admin/fso/upload-signature/{id}', [FSOController::class, 'uploadSignature'])->name('admin.uploadSignature');
        Route::post('admin/fso/uploadSignaturePost', [FSOController::class, 'uploadSignaturePost'])->name('admin.uploadSignaturePost');
        Route::get('admin/fso/filter', [FSOController::class, 'filter'])->name('admin.fsofilter');
        
        
        // Category Management
        Route::get('admin/category', [CategoryController::class, 'index'])->name('admin.category');
        Route::get('admin/category/addcategory', [CategoryController::class,'addCategoryForm'])->name('admin.addcategory');
        Route::post('admin/category/savecategory', [CategoryController::class, 'savecategory'])->name('admin.savecategory');
        Route::post('admin/category/updatecategory', [CategoryController::class, 'updatecategory'])->name('admin.updatecategory');
        Route::get('admin/category/delete/{id}', [CategoryController::class, 'destroy'])->name('admin.deletecategory');
        Route::get('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin.editcategory');
        Route::get('admin/category/filter', [CategoryController::class, 'filter'])->name('admin.categoryfilter');
        
        Route::get('admin/subcategory', [SubcategoryController::class, 'index'])->name('admin.subcategory');
        Route::get('admin/subcategory/addsubcategory', [SubcategoryController::class,'addSubcategoryForm'])->name('admin.addsubcategory');
        Route::post('admin/subcategory/savesubcategory', [SubcategoryController::class, 'savesubcategory'])->name('admin.savesubcategory');
        Route::post('admin/subcategory/updatesubcategory', [SubcategoryController::class, 'updatesubcategory'])->name('admin.updatesubcategory');
        Route::get('admin/subcategory/delete/{id}', [SubcategoryController::class, 'destroy'])->name('admin.deletesubcategory');
        Route::get('admin/subcategory/edit/{id}', [SubcategoryController::class, 'edit'])->name('admin.editsubcategory');
        Route::get('admin/subcategory/filter', [SubcategoryController::class, 'filter'])->name('admin.subcategoryfilter');
        
        Route::get('admin/projects', [ProjectController::class, 'index'])->name('admin.projects');
        Route::get('admin/projects/addproject', [ProjectController::class,'addProjectForm'])->name('admin.addproject');
        Route::post('admin/projects/saveproject', [ProjectController::class, 'saveproject'])->name('admin.saveproject');
        Route::post('admin/projects/updateproject', [ProjectController::class, 'updateproject'])->name('admin.updateproject');
        Route::get('admin/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('admin.deleteproject');
        Route::get('admin/projects/edit/{id}', [ProjectController::class, 'edit'])->name('admin.editproject');
        Route::get('admin/projects/filter', [ProjectController::class, 'filter'])->name('admin.projectfilter');
        
        Route::get('admin/type', [TypeController::class, 'index'])->name('admin.type');
        Route::get('admin/type/delete/{id}', [TypeController::class, 'destroy'])->name('admin.deletetype');
        Route::get('admin/type/edit/{id}', [TypeController::class, 'edit'])->name('admin.edittype');
        Route::get('admin/type/addtype', [TypeController::class,'addTypeForm'])->name('admin.addtype');
        Route::post('admin/type/savetype', [TypeController::class, 'savetype'])->name('admin.savetype');
        Route::post('admin/type/getsubcategory', [TypeController::class, 'getsubcategory'])->name('admin.getsubcategory');
        Route::post('admin/type/updatetype', [TypeController::class, 'updatetype'])->name('admin.updatetype');
        
        // CMS Routes
        Route::get('admin/organisational', [OrganisationalController::class, 'index'])->name('admin.organisational');
        Route::get('admin/organisational/add-organisational', [OrganisationalController::class, 'addOrganisationalForm'])->name('admin.addOrganisationalForm');
        Route::post('admin/organisational/saveOrganisational', [OrganisationalController::class, 'saveOrganisational'])->name('admin.saveOrganisational');
        Route::get('admin/organisational/edit/{id}', [OrganisationalController::class, 'editOrganisationalForm'])->name('admin.editOrganisationalForm');
        Route::post('admin/organisational/updateOrganisational', [OrganisationalController::class, 'updateOrganisational'])->name('admin.updateOrganisational');
        Route::get('admin/organisational/delete-organisational/{id}', [OrganisationalController::class, 'deleteOrganisational'])->name('admin.deleteOrganisational');
        
        Route::get('admin/specialriskarea', [SpecialRiskAreaController::class, 'index'])->name('admin.specialriskarea');
        Route::get('admin/specialriskarea/addSpecialRiskArea', [SpecialRiskAreaController::class, 'addSpecialRiskAreaForm'])->name('admin.addSpecialRiskAreaForm');
        Route::post('admin/specialriskarea/saveSpecialRiskArea', [SpecialRiskAreaController::class, 'saveSpecialRiskArea'])->name('admin.saveSpecialRiskArea');
        Route::get('admin/specialriskarea/edit/{id}', [SpecialRiskAreaController::class, 'editSpecialRiskAreaForm'])->name('admin.editSpecialRiskAreaForm');
        Route::post('admin/specialriskarea/updateSpecialRiskArea', [SpecialRiskAreaController::class, 'updateSpecialRiskArea'])->name('admin.updateSpecialRiskArea');
        Route::get('admin/specialriskarea/deleteSpecialRiskArea/{id}', [SpecialRiskAreaController::class, 'deleteSpecialRiskArea'])->name('admin.deleteSpecialRiskArea');
        
        Route::get('admin/recentupdates', [RecentUpdatesController::class, 'index'])->name('admin.recentupdates');
        Route::get('admin/recentupdates/add-recentupdates', [RecentUpdatesController::class, 'addRecentUpdatesForm'])->name('admin.addRecentUpdatesForm');
        Route::post('admin/recentupdates/saveRecentUpdates', [RecentUpdatesController::class, 'saveRecentUpdates'])->name('admin.saveRecentUpdates');
        Route::get('admin/recentupdates/edit/{id}', [RecentUpdatesController::class, 'editRecentUpdatesForm'])->name('admin.editRecentUpdatesForm');
        Route::post('admin/recentupdates/updateRecentUpdates', [RecentUpdatesController::class, 'updateRecentUpdates'])->name('admin.updateRecentUpdates');
        Route::get('admin/recentupdates/delete-recentupdates/{id}', [RecentUpdatesController::class, 'deleteRecentUpdates'])->name('admin.deleteRecentUpdates');
        
        Route::get('admin/recentfireincidents', [RecentFireIncidentsController::class, 'index'])->name('admin.recentfireincidents');
        Route::get('admin/recentfireincidents/add-recentfireincidents', [RecentFireIncidentsController::class, 'addRecentFireIncidentsForm'])->name('admin.addRecentFireIncidentsForm');
        Route::post('admin/recentfireincidents/saveRecentFireIncidents', [RecentFireIncidentsController::class, 'saveRecentFireIncidents'])->name('admin.saveRecentFireIncidents');
        Route::get('admin/recentfireincidents/edit/{id}', [RecentFireIncidentsController::class, 'editRecentFireIncidentsForm'])->name('admin.editRecentFireIncidentsForm');
        Route::post('admin/recentfireincidents/updateRecentFireIncidents', [RecentFireIncidentsController::class, 'updateRecentFireIncidents'])->name('admin.updateRecentFireIncidents');
        Route::get('admin/recentfireincidents/delete-recentfireincidents/{id}', [RecentFireIncidentsController::class, 'deleteRecentFireIncidents'])->name('admin.deleteRecentFireIncidents');
        
        Route::get('admin/contactinfo', [ContactController::class, 'contactinfo'])->name('admin.contactinfo');
        Route::post('admin/addcontactinfo', [ContactController::class, 'store'])->name('admin.addcontactinfo');
        Route::post('admin/updatecontactinfo', [ContactController::class, 'update'])->name('admin.updatecontactinfo');
        Route::put('/admin/updatecontactinfo/{id}', [ContactController::class, 'update'])->name('admin.updatecontactinfo');
        
        // CMS Services Routes
        Route::get('admin/services/fire-operation', [FireOperationController::class, 'adminIndex'])->name('admin.services.fire-operation');
        Route::get('admin/services/fire-operation/add', [FireOperationController::class, 'add'])->name('admin.services.fire-operation.add');
        Route::post('admin/services/fire-operation/save', [FireOperationController::class, 'save'])->name('admin.services.fire-operation.save');
        Route::get('admin/services/fire-operation/edit/{id}', [FireOperationController::class, 'edit'])->name('admin.services.fire-operation.edit');
        Route::post('admin/services/fire-operation/update/{id}', [FireOperationController::class, 'update'])->name('admin.services.fire-operation.update');
        Route::get('admin/services/fire-operation/delete/{id}', [FireOperationController::class, 'destroy'])->name('admin.services.fire-operation.delete');
        
        Route::get('admin/services/standby', [CmsStandbyController::class, 'index'])->name('admin.services.standby');
        Route::get('admin/services/standby/add', [CmsStandbyController::class, 'add'])->name('admin.services.standby.add');
        Route::post('admin/services/standby/save', [CmsStandbyController::class, 'save'])->name('admin.services.standby.save');
        Route::get('admin/services/standby/edit/{id}', [CmsStandbyController::class, 'edit'])->name('admin.services.standby.edit');
        Route::post('admin/services/standby/update/{id}', [CmsStandbyController::class, 'update'])->name('admin.services.standby.update');
        Route::get('admin/services/standby/delete/{id}', [CmsStandbyController::class, 'destroy'])->name('admin.services.standby.destroy');
        
        Route::get('admin/services/rendered_paid', [RenderedPaidController::class, 'index'])->name('admin.services.rendered_paid');
        Route::get('admin/services/rendered_paid/add', [RenderedPaidController::class, 'add'])->name('admin.services.rendered_paid.add');
        Route::post('admin/services/rendered_paid/save', [RenderedPaidController::class, 'Save'])->name('admin.services.rendered_paid.save');
        Route::get('/admin/rendered_paid/delete/{id}', [RenderedPaidController::class, 'destroy'])->name('admin.services.rendered_paid.destroy');
        
        Route::get('admin/services/rendered_unpaid', [RenderedUnpaidController::class, 'index'])->name('admin.services.rendered_unpaid');
        Route::get('admin/services/rendered_unpaid/add', [RenderedUnpaidController::class, 'add'])->name('admin.services.rendered_unpaid.add');
        Route::post('admin/services/rendered_unpaid/save', [RenderedUnpaidController::class, 'Save'])->name('admin.services.rendered_unpaid.save');
        Route::get('/admin/rendered_unpaid/delete/{id}', [RenderedUnpaidController::class, 'destroy'])->name('admin.services.rendered_unpaid.destroy');
        
        Route::get('admin/services/awarness_mock_drill', [AwarnessMockDrillController::class, 'index'])->name('admin.services.awarness_mock_drill');
        Route::get('admin/services/awarness_mock_drill/add', [AwarnessMockDrillController::class, 'add'])->name('admin.services.awarness_mock_drill.add');
        Route::post('admin/services/awarness_mock_drill/save', [AwarnessMockDrillController::class, 'Save'])->name('admin.services.awarness_mock_drill.save');
        Route::get('/admin/awarness_mock_drill/delete/{id}', [AwarnessMockDrillController::class, 'destroy'])->name('admin.services.awarness_mock_drill.destroy');
        Route::get('admin/services/awarness_mock_drill/edit/{id}', [AwarnessMockDrillController::class, 'edit'])->name('admin.services.awarness_mock_drill.edit');
        Route::post('admin/services/awarness_mock_drill/update/{id}', [AwarnessMockDrillController::class, 'update'])->name('admin.services.awarness_mock_drill.update');
        
        Route::get('admin/services/pumping_work', [PumpingWorkDrillController::class, 'index'])->name('admin.services.pumping_work');
        Route::get('admin/services/pumping_work/add', [PumpingWorkDrillController::class, 'add'])->name('admin.services.pumping_work.add');
        Route::post('admin/services/pumping_work/save', [PumpingWorkDrillController::class, 'Save'])->name('admin.services.pumping_work.save');
        Route::get('admin/services/pumping_work/edit/{id}', [PumpingWorkDrillController::class, 'edit'])->name('admin.services.pumping_work.edit');
        Route::post('admin/services/pumping_work/update/{id}', [PumpingWorkDrillController::class, 'update'])->name('admin.services.pumping_work.update');
        Route::get('/admin/pumping_work/delete/{id}', [PumpingWorkDrillController::class, 'destroy'])->name('admin.services.pumping_work.destroy');
        
        // CMS Activities Routes
        Route::get('admin/activities/galary', [GalaryController::class, 'index'])->name('admin.activities.galary');
        Route::get('admin/activities/galary/add', [GalaryController::class, 'add'])->name('admin.activities.galary.add');
        Route::post('admin/activities/galary/save', [GalaryController::class, 'Save'])->name('admin.activities.galary.save');
        Route::get('admin/activities/galary/edit/{id}', [GalaryController::class, 'edit'])->name('admin.activities.galary.edit');
        Route::post('admin/activities/galary/update/{id}', [GalaryController::class, 'update'])->name('admin.activities.galary.update');
        Route::get('/admin/galary/delete/{id}', [GalaryController::class, 'destroy'])->name('admin.activities.galary.destroy');
        
        Route::get('admin/Activities/fire_service_week', [FireServiceWeekController::class, 'index'])->name('admin.Activities.fire_service_week');
        Route::get('admin/Activities/fire_service_week/add', [FireServiceWeekController::class, 'create'])->name('admin.Activities.fire_service_week.add');
        Route::post('admin/Activities/fire_service_week/save', [FireServiceWeekController::class, 'store'])->name('admin.Activities.fire_service_week.save');
        Route::get('admin/Activities/fire_service_week/edit/{id}', [FireServiceWeekController::class, 'edit'])->name('admin.Activities.fire_service_week.edit');
        Route::post('admin/Activities/fire_service_week/update/{id}', [FireServiceWeekController::class, 'update'])->name('admin.Activities.fire_service_week.update');
        Route::get('/admin/fire_service_week/delete/{id}', [FireServiceWeekController::class, 'destroy'])->name('admin.Activities.fire_service_week.destroy');
        Route::get('admin/Activities/fire_service_week_category', [FireServiceWeekController::class, 'category'])->name('admin.Activities.fire_service_week.category');
        Route::post('admin/Activities/fire_service_week_category/save', [FireServiceWeekController::class, 'savrCategory'])->name('admin.Activities.fire_service_week_category.save');
        Route::post('admin/Activities/fire_service_week_category/saveCategory', [FireServiceWeekController::class, 'saveCategory'])->name('admin.Activities.fire_service_week_category.saveCategory');
        Route::get('/admin/fire_service_week_category/delete/{id}', [FireServiceWeekController::class, 'destroyCategory'])->name('admin.Activities.fire_service_week_category.destroy');
        
        // Achievements Routes
        Route::get('admin/achivements/medal_category', [MedalWinnersController::class, 'medalCategory'])->name('admin.achivements.medal_category');
        Route::get('admin/achivements/medal_category/add', [MedalWinnersController::class, 'addMedalCategory'])->name('admin.achivements.medal_category.add');
        Route::post('admin/achivements/medal_category/save', [MedalWinnersController::class, 'saveMedalCategory'])->name('admin.achivements.medal_category.save');
        Route::get('admin/achivements/medal_category/edit/{id}', [MedalWinnersController::class, 'editMedalCategory'])->name('admin.achivements.medal_category.edit');
        Route::post('admin/achivements/medal_category/update/{id}', [MedalWinnersController::class, 'updateMedalCategory'])->name('admin.achivements.medal_category.update');
        Route::get('/admin/medal_category/delete/{id}', [MedalWinnersController::class, 'destroyMedalCategory'])->name('admin.achivements.medal_category.destroy');
        Route::get('admin/achivements/medal_winners', [MedalWinnersController::class, 'index'])->name('admin.achivements.medal_winners');
        Route::get('admin/achivements/medal_winners/add', [MedalWinnersController::class, 'add'])->name('admin.achivements.medal_winners.add');
        Route::post('admin/achivements/medal_winners/save', [MedalWinnersController::class, 'Save'])->name('admin.achivements.medal_winners.save');
        Route::get('admin/achivements/medal_winners/edit/{id}', [MedalWinnersController::class, 'edit'])->name('admin.achivements.medal_winners.edit');
        Route::post('admin/achivements/medal_winners/update/{id}', [MedalWinnersController::class, 'update'])->name('admin.achivements.medal_winners.update');
        Route::get('/admin/medal_winners/delete/{id}', [MedalWinnersController::class, 'destroy'])->name('admin.achivements.medal_winners.destroy');
        
        Route::get('/admin/achievement', [AchievementController::class,'index'])->name('admin.achievement');
        Route::get('/admin/achievement/add', [AchievementController::class,'create'])->name('admin.achievement.add');
        Route::post('/admin/achievement/store', [AchievementController::class,'store'])->name('admin.achievement.store');
        Route::get('/admin/achievement/edit/{id}', [AchievementController::class,'edit'])->name('admin.achievement.edit');
        Route::post('/admin/achievement/update', [AchievementController::class,'update'])->name('admin.achievement.update');
        Route::get('/admin/achievement/delete/{id}', [AchievementController::class,'delete'])->name('admin.achievement.delete');
        
        // Vehicle Types
        Route::get('admin/vehicletypes', [VehicleTypesController::class, 'index'])->name('admin.vehicletypes');
        Route::get('admin/vehicletypes/addVehicleTypes', [VehicleTypesController::class, 'addVehicleTypesForm'])->name('admin.addVehicleTypesForm');
        Route::post('admin/vehicletypes/saveVehicleTypes', [VehicleTypesController::class, 'saveVehicleTypes'])->name('admin.saveVehicleTypes');
        Route::get('admin/vehicletypes/edit/{id}', [VehicleTypesController::class, 'editVehicleTypesForm'])->name('admin.editVehicleTypes');
        Route::post('admin/vehicletypes/updateVehicleTypes', [VehicleTypesController::class, 'updateVehicleTypes'])->name('admin.updateVehicleTypes');
        Route::get('admin/vehicletypes/deleteVehicleTypes/{id}', [VehicleTypesController::class, 'deleteVehicleTypes'])->name('admin.deleteVehicleTypes');
        
        
        // Staff Strength
        Route::get('/admin/staffstrentgh', [CommonController::class, 'staffstrength'])->name('admin.staffstrength');
        Route::get('/admin/add-staffstrength', [CommonController::class, 'addstaffstrength'])->name('admin.add-staffstrength');
        Route::post('/admin/savestaffstrength', [CommonController::class, 'savestaffstrength'])->name('admin.savestaffstrength');
        Route::get('admin/savestaffstrength/edit/{id}', [CommonController::class, 'editstaffstrength'])->name('admin.savestaffstrength.edit');
        Route::post('admin/savestaffstrength/update', [CommonController::class,'updatestaffstrength'])->name('admin.savestaffstrength.update');
        
        // Pricing Rules (CRITICAL - was exposed!)
        Route::get('admin/pricing-rules', [PricingRuleController::class, 'index'])->name('pricing-rules.index');
        Route::get('admin/pricing-rules/create', [PricingRuleController::class, 'create'])->name('pricing-rules.create');
        Route::post('admin/pricing-rules', [PricingRuleController::class, 'store'])->name('pricing-rules.store');
        Route::get('admin/pricing-rules/{id}/edit', [PricingRuleController::class, 'edit'])->name('pricing-rules.edit');
        Route::post('admin/pricing-rules/{id}/update', [PricingRuleController::class, 'update'])->name('pricing-rules.update');
        Route::get('admin/pricing-rules/{id}/toggle', [PricingRuleController::class,'toggle'])->name('pricing-rules.toggle');
        Route::post('admin/pricing-rules/{id}/delete', [PricingRuleController::class, 'destroy'])->name('pricing-rules.delete');
        
        // Services
        Route::get('admin/services', [ServiceController::class,'index'])->name('services.index');
        Route::get('admin/services/create', [ServiceController::class,'create'])->name('services.create');
        Route::post('admin/services/store', [ServiceController::class,'store'])->name('services.store');
        Route::get('admin/services/{id}/edit', [ServiceController::class,'edit'])->name('services.edit');
        Route::post('admin/services/{id}/update', [ServiceController::class,'update'])->name('services.update');
        Route::post('admin/services/{id}/delete', [ServiceController::class,'destroy'])->name('services.delete');
        Route::get('admin/services/{id}/toggle', [ServiceController::class,'toggle'])->name('services.toggle');
        
        // Personnel Expense
        Route::resource('admin/personnel-expense', App\Http\Controllers\Admin\PersonnelExpenseController::class);
        
        // Report Fee Master
        Route::get('admin/report-fee-master', [ReportFeeMasterController::class, 'index'])->name('report-fee-master.index');
        Route::get('admin/report-fee-master/edit/{id}', [ReportFeeMasterController::class, 'edit'])->name('report-fee-master.edit');
        Route::post('admin/report-fee-master/update/{id}', [ReportFeeMasterController::class, 'update'])->name('report-fee-master.update');
        
        // RTI Routes
        Route::get('admin/Service/RTI', [RTIController::class, 'index'])->name('admin.Service.RTI');
        Route::get('admin/Service/RTI/add', [RTIController::class, 'add'])->name('admin.Service.RTI.add');
        Route::post('admin/service/RTI/save', [RTIController::class, 'save'])->name('admin.Service.RTI.save');
        Route::get('admin/service/RTI/delete/{id}', [RTIController::class, 'destroy'])->name('admin.Service.RTI.delete');
        
        Route::get('admin/service/RTI/service/', [RTIServicesController::class, 'index'])->name('admin.Service.rtiservices');
        Route::get('admin/service/RTI/service/add', [RTIServicesController::class, 'add'])->name('admin.Service.rtiservices.add');
        Route::post('admin/service/RTI/service/save', [RTIServicesController::class, 'save'])->name('admin.Service.rtiservices.save');
        Route::get('admin/service/RTI/service/delete/{id}', [RTIServicesController::class, 'destroy'])->name('admin.Service.rtiservices.delete');
        
        // Service Order
        Route::get('admin/getserviceorder', [CommonController::class, 'getserviceorder'])->name('admin.getserviceorder');
        Route::get('admin/serviceorderadd', [CommonController::class, 'serviceorderadd'])->name('admin.serviceorder.add');
        Route::post('admin/serviceordersave', [CommonController::class, 'serviceordersave'])->name('admin.serviceorder.save');
        Route::get('admin/serviceorderdelete/{id}', [CommonController::class, 'serviceorderdelete'])->name('admin.serviceorder.delete');
        Route::get('admin/serviceorderedit/{id}', [CommonController::class, 'serviceorderedit'])->name('admin.serviceorder.edit');
        Route::post('admin/serviceorderupdate', [CommonController::class, 'serviceorderupdate'])->name('admin.serviceorder.update');
        
        // Public Article
        Route::get('admin/getpublicarticle', [CommonController::class, 'getpublicarticle'])->name('admin.getpublicarticle');
        Route::get('admin/publicarticleadd', [CommonController::class, 'publicarticleadd'])->name('admin.publicarticle.add');
        Route::post('admin/publicarticlesave', [CommonController::class, 'publicarticlesave'])->name('admin.publicarticle.save');
        Route::get('admin/publicarticledelete/{id}', [CommonController::class, 'publicarticledelete'])->name('admin.publicarticle.delete');
        Route::get('admin/publicarticleedit/{id}', [CommonController::class, 'publicarticleedit'])->name('admin.publicarticle.edit');
        Route::post('admin/publicarticleupdate', [CommonController::class, 'publicarticleupdate'])->name('admin.publicarticle.update');
        
        // Recruitment
        Route::get('admin/getrecruitment', [CommonController::class, 'getrecruitment'])->name('admin.getrecruitment');
        Route::get('admin/recruitmentadd', [CommonController::class, 'recruitmentadd'])->name('admin.recruitment.add');
        Route::post('admin/recruitmentsave', [CommonController::class, 'recruitmentsave'])->name('admin.recruitment.save');
        Route::get('admin/recruitmentdelete/{id}', [CommonController::class, 'recruitmentdelete'])->name('admin.recruitment.delete');
        Route::get('admin/recruitmentedit/{id}', [CommonController::class, 'recruitmentedit'])->name('admin.recruitment.edit');
        Route::post('admin/recruitmentupdate', [CommonController::class, 'recruitmentupdate'])->name('admin.recruitment.update');
        
        // History
        Route::get('admin/gethistory', [CommonController::class, 'gethistory'])->name('admin.gethistory');
        Route::get('admin/historyadd', [CommonController::class, 'historyadd'])->name('admin.history.add');
        Route::post('admin/historysave', [CommonController::class, 'historysave'])->name('admin.history.save');
        Route::get('admin/historydelete/{id}', [CommonController::class, 'historydelete'])->name('admin.history.delete');
        Route::get('admin/historyedit/{id}', [CommonController::class, 'historyedit'])->name('admin.history.edit');
        Route::post('admin/historyupdate', [CommonController::class, 'historyupdate'])->name('admin.history.update');
        
        // Route Map
        Route::get('admin/getroutemap', [CommonController::class, 'getroutemap'])->name('admin.getroutemap');
        Route::get('admin/routemapadd', [CommonController::class, 'routemapadd'])->name('admin.routemap.add');
        Route::post('admin/routemapsave', [CommonController::class, 'routemapsave'])->name('admin.routemap.save');
        Route::get('admin/routemapdelete/{id}', [CommonController::class, 'routemapdelete'])->name('admin.routemap.delete');
        Route::get('admin/routemapedit/{id}', [CommonController::class, 'routemapedit'])->name('admin.routemap.edit');
        Route::post('admin/routemapupdate', [CommonController::class, 'routemapupdate'])->name('admin.routemap.update');
        
        // Institutional Structure
        Route::get('admin/getistitutionalstructure', [CommonController::class, 'getistitutionalstructure'])->name('admin.getistitutionalstructure');
        Route::get('admin/istitutionalstructureadd', [CommonController::class, 'istitutionalstructureadd'])->name('admin.istitutionalstructure.add');
        Route::post('admin/istitutionalstructuresave', [CommonController::class, 'istitutionalstructuresave'])->name('admin.istitutionalstructure.save');
        Route::get('admin/istitutionalstructuredelete/{id}', [CommonController::class, 'istitutionalstructuredelete'])->name('admin.istitutionalstructure.delete');
        Route::get('admin/istitutionalstructureedit/{id}', [CommonController::class, 'istitutionalstructureedit'])->name('admin.istitutionalstructure.edit');
        Route::post('admin/istitutionalstructureupdate', [CommonController::class, 'istitutionalstructureupdate'])->name('admin.istitutionalstructure.update');
        
        // Result
        Route::get('admin/getresult', [CommonController::class, 'getresult'])->name('admin.getresult');
        Route::get('admin/resultadd', [CommonController::class, 'resultadd'])->name('admin.result.add');
        Route::post('admin/resultsave', [CommonController::class, 'resultsave'])->name('admin.result.save');
        Route::get('admin/resultdelete/{id}', [CommonController::class, 'resultdelete'])->name('admin.result.delete');
        Route::get('admin/resultedit/{id}', [CommonController::class, 'resultedit'])->name('admin.result.edit');
        Route::post('admin/resultupdate', [CommonController::class, 'resultupdate'])->name('admin.result.update');
        
        // Training Schedule
        Route::get('admin/gettrainingschedule', [CommonController::class, 'gettrainingschedule'])->name('admin.gettrainingschedule');
        Route::get('admin/trainingscheduleadd', [CommonController::class, 'trainingscheduleadd'])->name('admin.trainingschedule.add');
        Route::post('admin/trainingschedulesave', [CommonController::class, 'trainingschedulesave'])->name('admin.trainingschedule.save');
        Route::get('admin/trainingscheduledelete/{id}', [CommonController::class, 'trainingscheduledelete'])->name('admin.trainingschedule.delete');
        Route::get('admin/trainingscheduleedit/{id}', [CommonController::class, 'trainingscheduleedit'])->name('admin.trainingschedule.edit');
        Route::post('admin/trainingscheduleupdate', [CommonController::class, 'trainingscheduleupdate'])->name('admin.trainingschedule.update');
        
        // Course
        Route::get('admin/getcourse', [CommonController::class, 'getcourse'])->name('admin.getcourse');
        Route::get('admin/courseadd', [CommonController::class, 'courseadd'])->name('admin.course.add');
        Route::post('admin/coursesave', [CommonController::class, 'coursesave'])->name('admin.course.save');
        Route::get('admin/coursedelete/{id}', [CommonController::class, 'coursedelete'])->name('admin.course.delete');
        Route::get('admin/courseedit/{id}', [CommonController::class, 'courseedit'])->name('admin.course.edit');
        Route::post('admin/courseupdate', [CommonController::class, 'courseupdate'])->name('admin.course.update');
        
        // NOC Required Documents
        Route::get('admin/getnocdocrequire', [CommonController::class, 'getnocdocrequire'])->name('admin.getnocdocrequire');
        Route::get('admin/nocdocrequireadd', [CommonController::class, 'nocdocrequireadd'])->name('admin.nocdocrequire.add');
        Route::post('admin/nocdocrequiresave', [CommonController::class, 'nocdocrequiresave'])->name('admin.nocdocrequire.save');
        Route::get('admin/nocdocrequiredelete/{id}', [CommonController::class, 'nocdocrequiredelete'])->name('admin.nocdocrequire.delete');
        Route::get('admin/nocdocrequireedit/{id}', [CommonController::class, 'nocdocrequireedit'])->name('admin.nocdocrequire.edit');
        Route::post('admin/nocdocrequireupdate', [CommonController::class, 'nocdocrequireupdate'])->name('admin.nocdocrequire.update');
        
        // NOC Checklist
        Route::get('admin/getchecklist', [CommonController::class, 'getchecklist'])->name('admin.getchecklist');
        Route::get('admin/checklistadd', [CommonController::class, 'checklistadd'])->name('admin.checklist.add');
        Route::post('admin/checklistsave', [CommonController::class, 'checklistsave'])->name('admin.checklist.save');
        Route::get('admin/checklistdelete/{id}', [CommonController::class, 'checklistdelete'])->name('admin.checklist.delete');
        Route::get('admin/checklistedit/{id}', [CommonController::class, 'checklistedit'])->name('admin.checklist.edit');
        Route::post('admin/checklistupdate', [CommonController::class, 'checklistupdate'])->name('admin.checklist.update');
        
        // Home Banner Slider
        Route::get('admin/getbannerslider', [CommonController::class, 'getbannerslider'])->name('admin.getbannerslider');
        Route::get('admin/bannerslideradd', [CommonController::class, 'bannerslideradd'])->name('admin.bannerslider.add');
        Route::post('admin/bannerslidersave', [CommonController::class, 'bannerslidersave'])->name('admin.bannerslider.save');
        Route::get('admin/bannersliderdelete/{id}', [CommonController::class, 'bannersliderdelete'])->name('admin.bannerslider.delete');
        Route::get('admin/bannerslideredit/{id}', [CommonController::class, 'bannerslideredit'])->name('admin.bannerslider.edit');
        Route::post('admin/bannersliderupdate', [CommonController::class, 'bannersliderupdate'])->name('admin.bannerslider.update');
        
        // Welfare and Amenity Fund
        Route::get('admin/getwelfareamenity', [CommonController::class, 'getwelfareamenity'])->name('admin.getwelfareamenity');
        Route::get('admin/welfareamenityadd', [CommonController::class, 'welfareamenityadd'])->name('admin.welfareamenity.add');
        Route::post('admin/welfareamenitysave', [CommonController::class, 'welfareamenitysave'])->name('admin.welfareamenity.save');
        Route::get('admin/welfareamenitydelete/{id}', [CommonController::class, 'welfareamenitydelete'])->name('admin.welfareamenity.delete');
        Route::get('admin/welfareamenityedit/{id}', [CommonController::class, 'welfareamenityedit'])->name('admin.welfareamenity.edit');
        Route::post('admin/welfareamenityupdate', [CommonController::class, 'welfareamenityupdate'])->name('admin.welfareamenity.update');
        
        // NOC Assignment Routes
        Route::post('admin/assignNocToFSO', [NocController::class, 'assignedNocToFSO'])->name('admin.assignedNocToFSO');
        Route::post('admin/assignedNocToCFO', [NocController::class, 'assignedNocToCFO'])->name('admin.assignedNocToCFO');
        
        // Leadership Section
        Route::get('admin/leadership-section/add', [LeadershipSectionController::class,'addLeadershipSectionForm'])->name('admin.addLeadershipSection');
        Route::post('admin/leadership-section/save', [LeadershipSectionController::class,'saveLeadershipSection'])->name('admin.saveLeadershipSection');
        Route::get('admin/leadership-section', [LeadershipSectionController::class,'leadershipSectionList'])->name('admin.leadershipSectionList');
        Route::get('admin/edit-leadership-section/{id}', [LeadershipSectionController::class,'editLeadershipSectionForm'])->name('admin.editLeadershipSectionForm');
        Route::post('admin/update-leadership-section', [LeadershipSectionController::class,'updateLeadershipSection'])->name('admin.updateLeadershipSection');
        Route::get('admin/delete-leadership-section/{id}', [LeadershipSectionController::class,'deleteLeadershipSection'])->name('admin.deleteLeadershipSection');
        
        Route::get('/admin/test', [CommonController::class, 'test'])->name('admin.test');
        
    }); // End of Admin Middleware
    
    // ==================== CFO ROUTES (type = 0 or 2) ====================
    Route::middleware(['cfo'])->group(function () {
        
        Route::post('/cfo-reject', [App\Http\Controllers\Department\DepartmentController::class, 'applicationRejectPost'])->name('cfo.reject');
        Route::post('/cfo-pre-approval', [App\Http\Controllers\Department\DepartmentController::class, 'applicationPreApprovalPost'])->name('cfo.pre.approval');
        Route::post('/cfo-approved', [App\Http\Controllers\Department\DepartmentController::class, 'applicationApprovePost'])->name('cfo.approve');
        Route::post('/cfo-revert', [App\Http\Controllers\Department\DepartmentController::class, 'revertNocPost'])->name('cfo.revert');
        Route::post('/cfo-remark', [App\Http\Controllers\Department\DepartmentController::class, 'remarkByCFOPost'])->name('cfo.remark');
        
        // Deputy Director to CFO assignments
        Route::post('/dd-pre-approved', [App\Http\Controllers\Department\DepartmentController::class, 'applicationPreApprovedPost'])->name('dd.pre.approved');
        Route::post('/dd-assigned-to-cfo', [App\Http\Controllers\Department\DepartmentController::class, 'applicationAssignedToCFO'])->name('dd.assignedTo.cfo');
        
    }); // End of CFO Middleware
    
    // ==================== FSO ROUTES (type = 0, 2, or 3) ====================
    Route::middleware(['fso'])->prefix('fso')->group(function () {
        
        Route::get('/service-bills', [ServiceBillController::class, 'index'])->name('service-bills.index');
        Route::get('/service-bills/create/{service_type}/{request_id}', [ServiceBillController::class, 'create'])->name('service-bills.create');
        Route::post('/service-bills/store', [ServiceBillController::class, 'store'])->name('service-bills.store');
        Route::get('/service-bills/show/{id}', [ServiceBillController::class, 'show'])->name('service-bills.show');
        Route::get('/service-bills/print/{id}', [ServiceBillController::class, 'print'])->name('service-bills.print');
        Route::get('/service-bills/export/csv', [ServiceBillController::class, 'export'])->name('service-bills.export');
        Route::get('service-bills/report/create/{service_type}/{request_id}', [ServiceBillController::class, 'createReportBill'])->name('service-bills.report.create');
        Route::post('service-bills/report/store', [ServiceBillController::class, 'storeReportBill'])->name('service-bills.report.store');
        
    });
    
    // FSO Routes (outside prefix)
    Route::middleware(['fso'])->group(function () {
        Route::post('/fso-approval', [App\Http\Controllers\Department\DepartmentController::class, 'applicationForApprovalPost'])->name('fso.approval');
        Route::post('/fso-operational-approval', [App\Http\Controllers\Department\DepartmentController::class, 'operationalApplicationForApprovalPost'])->name('fso.operational.approval');
        Route::post('/fso-remark', [App\Http\Controllers\Department\DepartmentController::class, 'remarkByFSOPost'])->name('fso.remark');
        Route::post('/fso-addPhysicalInsPost', [App\Http\Controllers\Department\DepartmentController::class, 'addPhysicalInsPost'])->name('fso.addPhysicalInsPost');
        Route::post('/fso-addFireProvissionPost', [App\Http\Controllers\Department\DepartmentController::class, 'addFireProvissionPost'])->name('fso.addFireProvissionPost');
        Route::post('/fso-addBuildingStatusPost', [App\Http\Controllers\Department\DepartmentController::class, 'addBuildingStatusPost'])->name('fso.addBuildingStatusPost');
        Route::post('/fso-addSpecialProvissionPost', [App\Http\Controllers\Department\DepartmentController::class, 'addSpecialProvissionPost'])->name('fso.addSpecialProvissionPost');
    });
    
    // ==================== CITIZEN ROUTES (type = 0 or 4) ====================
    Route::middleware(['citizen'])->group(function () {
        
        // Citizen Dashboard & Profile
        Route::get('citizen_profile', [CitizenController::class,'citizen_profile'])->name('citizen.profile');
        Route::get('/my-account', [CitizenController::class, 'index'])->name('citizen.account');
        Route::get('/my-noc', [CitizenController::class, 'noc'])->name('citizen.noc.home');
        Route::get('/temporary_noc', [CitizenController::class, 'temporary_noc'])->name('citizen.temporary_noc');
        
        // NOC Application Steps
        Route::get('/noc-step-initial', [CitizenController::class, 'addNocStepFirst'])->name('noc.step.first');
        Route::get('/apply-noc', [CitizenController::class, 'applyNoc'])->name('noc.apply');
        Route::post('/noc-step-initial-post', [NocController::class, 'addNocStepFirstPost'])->name('noc.step.first.post');
        Route::get('/noc-step-two', [CitizenController::class, 'addNocStepSecond'])->name('noc.step.second');
        Route::post('/noc-step-two-post', [NocController::class, 'addNocStepSecondPost'])->name('noc.step.second.post');
        Route::get('/noc-step-three', [CitizenController::class, 'addNocStepThird'])->name('noc.step.third');
        Route::post('/noc-step-three-post', [NocController::class, 'addNocStepThirdPost'])->name('noc.step.third.post');
        Route::get('/noc-step-four', [CitizenController::class, 'addNocStepForth'])->name('noc.step.forth');
        Route::post('/noc-step-forth-post', [NocController::class, 'addNocStepForthPost'])->name('noc.step.forth.post');
        Route::get('/noc-step-upload-attachment', [CitizenController::class, 'addNocStepFive'])->name('noc.step.five');
        Route::post('/noc-step-upload-attachment-post', [NocController::class, 'addNocStepFivePost'])->name('noc.step.five.post');
        Route::post('/noc-step-upload-challan', [CitizenController::class, 'addNocStepSix'])->name('noc.step.six');
        Route::post('/noc-step-upload-challan-post', [NocController::class, 'addNocStepSixPost'])->name('noc.step.six.post');
        Route::post('/noc-submit-application', [CitizenController::class, 'addNocStepSeven'])->name('noc.step.submit');
        Route::post('/noc-submit', [NocController::class, 'addNocStepSevenPost'])->name('noc.step.seven.post');
        
        // NOC Update Routes
        Route::post('/noc-step-initial-update-post', [App\Http\Controllers\Citizen\NocUpdateController::class, 'updateNocStepFirstPost'])->name('noc.step.first.update.post');
        Route::post('/noc-step-two-update-post', [App\Http\Controllers\Citizen\NocUpdateController::class, 'updateNocStepSecondPost'])->name('noc.step.second.update.post');
        Route::post('/noc-step-three-update-post', [App\Http\Controllers\Citizen\NocUpdateController::class, 'updateNocStepThirdPost'])->name('noc.step.third.update.post');
        Route::post('/noc-step-forth-update-post', [App\Http\Controllers\Citizen\NocUpdateController::class, 'updateNocStepForthPost'])->name('noc.step.forth.update.post');
        Route::post('/noc-step-final-update-post', [App\Http\Controllers\Citizen\NocUpdateController::class, 'updateNocStepFinalPost'])->name('noc.step.final.update.post');
        
        Route::get('/generateQrCode', [NocController::class, 'generateQrCode'])->name('noc.generateQrCode');
        Route::get('/applications', [CitizenController::class, 'indexNoc'])->name('noc');
        Route::get('/edit-application/{id}', [NocController::class, 'editNoc'])->name('noc.editNoc');
        Route::get('citizen/noc/view/{id}', [NocController::class, 'viewNocDetail'])->name('citizen.viewNocDetail');
        Route::get('citizen/noc/apply-noc', [NocController::class, 'applyNoc'])->name('citizen.applyNoc');
        Route::get('citizen/noc/apply-pre-operational/{id}', [NocController::class, 'applyOperationalNocDetail'])->name('citizen.applyOperationalNocDetail');
        Route::get('citizen/noc/apply-renewal/{id}', [NocController::class, 'applyRenewalNocDetail'])->name('citizen.applyRenewalNocDetail');
        
        // Temporary NOC for Citizens
        Route::get('/temporary-noc', [CitizenController::class, 'indexTemporaryNoc'])->name('indexTemporaryNoc');
        Route::get('/temporary-noc/{any}', [CitizenController::class, 'listTemporaryNoc'])->name('citizen.temporary.noc.list');
        Route::get('temporary-noc/view/{type}/{id}', [CitizenController::class, 'viewTemporaryNocDetail'])->name('citizen.viewTemporaryNocDetail');
        
        // Issued NOC
        Route::get('citizen/noc/issued-noc/', [IssuedController::class, 'index'])->name('citizen.issuedNoc');
        Route::get('citizen/noc/add-issued-noc/', [IssuedController::class, 'addIssuedNoc'])->name('citizen.addIssuedNoc');
        Route::post('citizen/noc/addIssuedNocPost/', [IssuedController::class, 'addIssuedNocPost'])->name('citizen.addIssuedNocPost');
        
        // Building Map
        Route::get('/building-map', [CitizenController::class, 'building_map'])->name('citizen.building.map');
        Route::post('/uploadDocument', [CitizenController::class, 'uploadDocument'])->name('citizen.uploadDocument');
        Route::get('/building-map/delete/{any}', [CitizenController::class, 'deleteBuildingMap'])->name('citizen.building.map.delete');
        
        // Fire Escape Plan
        Route::get('/fire-escape-plan', [CitizenController::class, 'fire_escape_plan'])->name('citizen.fire.escape.plan');
        Route::post('/save-fire-escape-plan', [CitizenController::class, 'saveFireEscapePlan'])->name('citizen.saveFireEscapePlan');
        Route::get('fire-escape-plan-delete/{id}', [CitizenController::class, 'deleteFireEscapePlan'])->name('fire.escape.plan.delete');
        
        // Chemical Use
        Route::get('/chemical-use', [CitizenController::class, 'chemical_use'])->name('citizen.chemical.use');
        Route::post('/save-chemical-use', [CitizenController::class, 'SaveChemicalUse'])->name('citizen.SaveChemicalUse');
        Route::get('chemical-use-delete/{id}', [CitizenController::class, 'chemicalUseDelete'])->name('citizen.chemical.use.delete');
        
        // SOP Upload
        Route::get('/list-sop', [CitizenController::class, 'listSop'])->name('citizen.upload.sop');
        Route::get('/upload-sop', [CitizenController::class, 'upload_sop'])->name('citizen.sop');
        Route::get('/upload-sop-delete/{id}', [CitizenController::class, 'uploadSopDelete'])->name('citizen.upload.sop.delete');
        
        // Safety Officer
        Route::get('/safety-officer', [CitizenController::class, 'safety_officer'])->name('citizen.safety.officer');
        Route::post('/safety-officer-post', [CitizenController::class, 'saveSafetyOfficer'])->name('citizen.safety.officer.post');
        Route::get('/safety-officer-delete/{id}', [CitizenController::class, 'safetyOfficerDelete'])->name('citizen.safety.officer.delete');
        
        // Do's and Don'ts
        Route::get('/do-dont', [CitizenController::class, 'do_dont'])->name('citizen.do.dont');
        
        // Declaration Routes
        Route::get('/declaration', [DeclarionController::class, 'indexDeclaration'])->name('citizen.declaration');
        Route::get('/declaration-list', [DeclarionController::class, 'declarationList'])->name('citizen.declarationList');
        Route::post('/addBuildingStatusPost', [DeclarionController::class, 'addBuildingStatusPost'])->name('citizen.addBuildingStatusPost');
        Route::post('/addFireProvissionPost', [DeclarionController::class, 'addFireProvissionPost'])->name('citizen.addFireProvissionPost');
        Route::post('/addSpecialProvissionPost', [DeclarionController::class, 'addSpecialProvissionPost'])->name('citizen.addSpecialProvissionPost');
        Route::post('/addFinalSubmitPost', [DeclarionController::class, 'addFinalSubmitPost'])->name('citizen.addFinalSubmitPost');
        
        // Citizen Activities (Standby, Awareness, Incident)
        Route::get('/citizen/standby', [ActivitiesController::class, 'standby'])->name('citizen.standby');
        Route::get('/citizen/standby/add', [ActivitiesController::class, 'addStandby'])->name('citizen.addStandby');
        Route::post('/citizen/standby/save', [ActivitiesController::class, 'saveStandby'])->name('citizen.saveStandby');
        Route::get('/citizen/standby/view/{id}', [ActivitiesController::class, 'viewStandby'])->name('citizen.viewStandby');
        Route::post('/citizen/standByOtpPost', [ActivitiesController::class, 'standByOtpPost'])->name('citizen.standByOtpPost');
        
        Route::get('/citizen/awareness', [ActivitiesController::class, 'awareness'])->name('citizen.awareness');
        Route::get('/citizen/awareness/add', [ActivitiesController::class, 'addAwareness'])->name('citizen.addAwareness');
        Route::post('/citizen/awareness/save', [ActivitiesController::class, 'saveAwareness'])->name('citizen.saveAwareness');
        Route::get('/citizen/awareness/view/{id}', [ActivitiesController::class, 'viewAwareness'])->name('citizen.viewAwareness');
        Route::post('/citizen/awarenessOtpPost', [ActivitiesController::class, 'awarenessOtpPost'])->name('citizen.awarenessOtpPost');
        Route::post('/citizen/resendOtp', [ActivitiesController::class, 'resendOtp'])->name('citizen.resendOtp');
        
        Route::get('/citizen/incident', [ActivitiesController::class, 'incident'])->name('citizen.incident');
        Route::get('/citizen/incident/add', [ActivitiesController::class, 'addIncident'])->name('citizen.addIncident');
        Route::post('/citizen/incident/save', [ActivitiesController::class, 'saveIncident'])->name('citizen.saveIncident');
        Route::get('/citizen/incident/view/{id}', [ActivitiesController::class, 'viewIncident'])->name('citizen.viewIncident');
        
        // NOC Type Specific Routes
        Route::get('/citizen-noc-pandal/{data?}', [PandalNocController::class, 'index'])->name('citizen.pandal');
        Route::post('noc-pandal-basic-post', [PandalNocController::class, 'addPandalBasicDetails'])->name('noc.pandal.basic.post');
        Route::post('noc-pandal-applicant-post', [PandalNocController::class, 'addPandalApplicantDetails'])->name('noc.pandal.applicant.post');
        Route::post('noc-pandal-organizing-post', [PandalNocController::class, 'addPandalOrganizingDetails'])->name('noc.pandal.organizing.post');
        Route::post('noc-pandal-organizer-post', [PandalNocController::class, 'addPandalOrganizerDetails'])->name('noc.pandal.organizer.post');
        Route::post('noc-pandal-erector-post', [PandalNocController::class, 'addPandalErectorDetails'])->name('noc.pandal.erector.post');
        Route::post('noc-pandal-coordinator-post', [PandalNocController::class, 'addPandalCoordinatorDetails'])->name('noc.pandal.coordinator.post');
        Route::post('noc-pandal-project-post', [PandalNocController::class, 'addPandalProjectDetails'])->name('noc.pandal.project.post');
        Route::post('noc-pandal-attachments-post', [PandalNocController::class, 'addPandalAttachmentsDetails'])->name('noc.pandal.attachments.post');
        
        Route::get('/citizen-noc-public-function/{data?}', [PublicFunctionNocController::class, 'index'])->name('citizen.public.function');
        Route::post('noc-public-function-basic-post', [PublicFunctionNocController::class, 'addPublicFunctionBasicDetails'])->name('noc.public.function.basic.post');
        Route::post('noc-public-function-applicant-post', [PublicFunctionNocController::class, 'addPublicFunctionApplicantDetails'])->name('noc.public.function.applicant.post');
        Route::post('noc-public-function-organizing-post', [PublicFunctionNocController::class, 'addPublicFunctionOrganizingDetails'])->name('noc.public.function.organizing.post');
        Route::post('noc-public-function-organizer-post', [PublicFunctionNocController::class, 'addPublicFunctionOrganizerDetails'])->name('noc.public.function.organizer.post');
        Route::post('noc-public-function-erector-post', [PublicFunctionNocController::class, 'addPublicFunctionErectorDetails'])->name('noc.public.function.erector.post');
        Route::post('noc-public-function-coordinator-post', [PublicFunctionNocController::class, 'addPublicFunctionCoordinatorDetails'])->name('noc.public.function.coordinator.post');
        Route::post('noc-public-function-project-post', [PublicFunctionNocController::class, 'addPublicFunctionProjectDetails'])->name('noc.public.function.project.post');
        Route::post('noc-public-function-attachments-post', [PublicFunctionNocController::class, 'addPublicFunctionAttachmentsDetails'])->name('noc.public.function.attachments.post');
        
        Route::get('/citizen-noc-entertainment-activity/{data?}', [EntertainmentActivityNocController::class, 'index'])->name('citizen.entertainment.activity');
        Route::post('noc-entertainment-basic-post', [EntertainmentActivityNocController::class, 'addEntertainmentBasicDetails'])->name('noc.entertainment.basic.post');
        Route::post('noc-entertainment-applicant-post', [EntertainmentActivityNocController::class, 'addEntertainmentApplicantDetails'])->name('noc.entertainment.applicant.post');
        Route::post('noc-entertainment-organizing-post', [EntertainmentActivityNocController::class, 'addEntertainmentOrganizingDetails'])->name('noc.entertainment.organizing.post');
        Route::post('noc-entertainment-organizer-post', [EntertainmentActivityNocController::class, 'addEntertainmentOrganizerDetails'])->name('noc.entertainment.organizer.post');
        Route::post('noc-entertainment-erector-post', [EntertainmentActivityNocController::class, 'addEntertainmentErectorDetails'])->name('noc.entertainment.erector.post');
        Route::post('noc-entertainment-coordinator-post', [EntertainmentActivityNocController::class, 'addEntertainmentCoordinatorDetails'])->name('noc.entertainment.coordinator.post');
        Route::post('noc-entertainment-project-post', [EntertainmentActivityNocController::class, 'addEntertainmentProjectDetails'])->name('noc.entertainment.project.post');
        Route::post('noc-entertainment-attachments-post', [EntertainmentActivityNocController::class, 'addEntertainmentAttachmentsDetails'])->name('noc.entertainment.attachments.post');
        
        Route::get('/citizen-noc-film-shooting/{data?}', [FilmShootingNocController::class, 'index'])->name('citizen.film.shooting');
        Route::post('noc-film-shooting-basic-post', [FilmShootingNocController::class, 'addFilmShootingBasicDetails'])->name('noc.film.shooting.basic.post');
        Route::post('noc-film-shooting-applicant-post', [FilmShootingNocController::class, 'addFilmShootingApplicantDetails'])->name('noc.film.shooting.applicant.post');
        Route::post('noc-film-shooting-organizing-post', [FilmShootingNocController::class, 'addFilmShootingOrganizingDetails'])->name('noc.film.shooting.organizing.post');
        Route::post('noc-film-shooting-organizer-post', [FilmShootingNocController::class, 'addFilmShootingOrganizerDetails'])->name('noc.film.shooting.organizer.post');
        Route::post('noc-film-shooting-erector-post', [FilmShootingNocController::class, 'addFilmShootingErectorDetails'])->name('noc.film.shooting.erector.post');
        Route::post('noc-film-shooting-coordinator-post', [FilmShootingNocController::class, 'addFilmShootingCoordinatorDetails'])->name('noc.film.shooting.coordinator.post');
        Route::post('noc-film-shooting-project-post', [FilmShootingNocController::class, 'addFilmShootingProjectDetails'])->name('noc.film.shooting.project.post');
        Route::post('noc-film-shooting-attachments-post', [FilmShootingNocController::class, 'addFilmShootingAttachmentsDetails'])->name('noc.film.shooting.attachments.post');
        
        Route::get('/citizen-noc-games/{data?}', [GamesNocController::class, 'index'])->name('citizen.games');
        Route::post('noc-games-basic-post', [GamesNocController::class, 'addGamesBasicDetails'])->name('noc.games.basic.post');
        Route::post('noc-games-applicant-post', [GamesNocController::class, 'addGamesApplicantDetails'])->name('noc.games.applicant.post');
        Route::post('noc-games-organizing-post', [GamesNocController::class, 'addGamesOrganizingDetails'])->name('noc.games.organizing.post');
        Route::post('noc-games-organizer-post', [GamesNocController::class, 'addGamesOrganizerDetails'])->name('noc.games.organizer.post');
        Route::post('noc-games-erector-post', [GamesNocController::class, 'addGamesErectorDetails'])->name('noc.games.erector.post');
        Route::post('noc-games-coordinator-post', [GamesNocController::class, 'addGamesCoordinatorDetails'])->name('noc.games.coordinator.post');
        Route::post('noc-games-project-post', [GamesNocController::class, 'addGamesProjectDetails'])->name('noc.games.project.post');
        Route::post('noc-games-attachments-post', [GamesNocController::class, 'addGamesAttachmentsDetails'])->name('noc.games.attachments.post');
        
        Route::get('/citizen-noc-helipad/{data?}', [HelipadNocController::class, 'index'])->name('citizen.helipad');
        Route::post('noc-helipad-basic-post', [HelipadNocController::class, 'addHelipadBasicDetails'])->name('noc.helipad.basic.post');
        Route::post('noc-helipad-applicant-post', [HelipadNocController::class, 'addHelipadApplicantDetails'])->name('noc.helipad.applicant.post');
        Route::post('noc-helipad-organizing-post', [HelipadNocController::class, 'addHelipadOrganizingDetails'])->name('noc.helipad.organizing.post');
        Route::post('noc-helipad-organizer-post', [HelipadNocController::class, 'addHelipadOrganizerDetails'])->name('noc.helipad.organizer.post');
        Route::post('noc-helipad-erector-post', [HelipadNocController::class, 'addHelipadErectorDetails'])->name('noc.helipad.erector.post');
        Route::post('noc-helipad-coordinator-post', [HelipadNocController::class, 'addHelipadCoordinatorDetails'])->name('noc.helipad.coordinator.post');
        Route::post('noc-helipad-project-post', [HelipadNocController::class, 'addHelipadProjectDetails'])->name('noc.helipad.project.post');
        Route::post('noc-helipad-attachments-post', [HelipadNocController::class, 'addHelipadAttachmentsDetails'])->name('noc.helipad.attachments.post');
        
        Route::get('/citizen-noc-kerosene/{data?}', [KeroseneNocController::class, 'index'])->name('citizen.kerosene');
        Route::post('noc-kerosene-basic-post', [KeroseneNocController::class, 'addKeroseneBasicDetails'])->name('noc.kerosene.basic.post');
        Route::post('noc-kerosene-applicant-post', [KeroseneNocController::class, 'addKeroseneApplicantDetails'])->name('noc.kerosene.applicant.post');
        Route::post('noc-kerosene-organizing-post', [KeroseneNocController::class, 'addKeroseneOrganizingDetails'])->name('noc.kerosene.organizing.post');
        Route::post('noc-kerosene-organizer-post', [KeroseneNocController::class, 'addKeroseneOrganizerDetails'])->name('noc.kerosene.organizer.post');
        Route::post('noc-kerosene-erector-post', [KeroseneNocController::class, 'addKeroseneErectorDetails'])->name('noc.kerosene.erector.post');
        Route::post('noc-kerosene-coordinator-post', [KeroseneNocController::class, 'addKeroseneCoordinatorDetails'])->name('noc.kerosene.coordinator.post');
        Route::post('noc-kerosene-project-post', [KeroseneNocController::class, 'addKeroseneProjectDetails'])->name('noc.kerosene.project.post');
        Route::post('noc-kerosene-attachments-post', [KeroseneNocController::class, 'addKeroseneAttachmentsDetails'])->name('noc.kerosene.attachments.post');
        
        Route::get('/citizen-noc-other-services/{data?}', [OtherServicesNocController::class, 'index'])->name('citizen.other.services');
        Route::post('noc-other-services-basic-post', [OtherServicesNocController::class, 'addOtherServicesBasicDetails'])->name('noc.other.services.basic.post');
        Route::post('noc-other-services-applicant-post', [OtherServicesNocController::class, 'addOtherServicesApplicantDetails'])->name('noc.other.services.applicant.post');
        Route::post('noc-other-services-organizing-post', [OtherServicesNocController::class, 'addOtherServicesOrganizingDetails'])->name('noc.other.services.organizing.post');
        Route::post('noc-other-services-organizer-post', [OtherServicesNocController::class, 'addOtherServicesOrganizerDetails'])->name('noc.other.services.organizer.post');
        Route::post('noc-other-services-erector-post', [OtherServicesNocController::class, 'addOtherServicesErectorDetails'])->name('noc.other.services.erector.post');
        Route::post('noc-other-services-coordinator-post', [OtherServicesNocController::class, 'addOtherServicesCoordinatorDetails'])->name('noc.other.services.coordinator.post');
        Route::post('noc-other-services-project-post', [OtherServicesNocController::class, 'addOtherServicesProjectDetails'])->name('noc.other.services.project.post');
        Route::post('noc-other-services-attachments-post', [OtherServicesNocController::class, 'addOtherServicesAttachmentsDetails'])->name('noc.other.services.attachments.post');
        
        Route::get('/citizen-noc-fire-crackers/{data?}', [FireCrackersNocController::class, 'index'])->name('citizen.fire.crackers');
        Route::post('noc-fire-crackers-basic-post', [FireCrackersNocController::class, 'addFireCrackersBasicDetails'])->name('noc.fire.crackers.basic.post');
        Route::post('noc-fire-crackers-applicant-post', [FireCrackersNocController::class, 'addFireCrackersApplicantDetails'])->name('noc.fire.crackers.applicant.post');
        Route::post('noc-fire-crackers-organizing-post', [FireCrackersNocController::class, 'addFireCrackersOrganizingDetails'])->name('noc.fire.crackers.organizing.post');
        Route::post('noc-fire-crackers-organizer-post', [FireCrackersNocController::class, 'addFireCrackersOrganizerDetails'])->name('noc.fire.crackers.organizer.post');
        Route::post('noc-fire-crackers-erector-post', [FireCrackersNocController::class, 'addFireCrackersErectorDetails'])->name('noc.fire.crackers.erector.post');
        Route::post('noc-fire-crackers-coordinator-post', [FireCrackersNocController::class, 'addFireCrackersCoordinatorDetails'])->name('noc.fire.crackers.coordinator.post');
        Route::post('noc-fire-crackers-project-post', [FireCrackersNocController::class, 'addFireCrackersProjectDetails'])->name('noc.fire.crackers.project.post');
        Route::post('noc-fire-crackers-attachments-post', [FireCrackersNocController::class, 'addFireCrackersAttachmentsDetails'])->name('noc.fire.crackers.attachments.post');
        
        Route::get('/citizen-noc-transportation-material/{data?}', [TransportationNocController::class, 'index'])->name('citizen.transportation');
        Route::post('noc-transportation-basic-post', [TransportationNocController::class, 'addTransportationBasicDetails'])->name('noc.transportation.basic.post');
        Route::post('noc-transportation-applicant-post', [TransportationNocController::class, 'addTransportationApplicantDetails'])->name('noc.transportation.applicant.post');
        Route::post('noc-transportation-organizing-post', [TransportationNocController::class, 'addTransportationOrganizingDetails'])->name('noc.transportation.organizing.post');
        Route::post('noc-transportation-organizer-post', [TransportationNocController::class, 'addTransportationOrganizerDetails'])->name('noc.transportation.organizer.post');
        Route::post('noc-transportation-erector-post', [TransportationNocController::class, 'addTransportationErectorDetails'])->name('noc.transportation.erector.post');
        Route::post('noc-transportation-coordinator-post', [TransportationNocController::class, 'addTransportationCoordinatorDetails'])->name('noc.transportation.coordinator.post');
        Route::post('noc-transportation-project-post', [TransportationNocController::class, 'addTransportationProjectDetails'])->name('noc.transportation.project.post');
        Route::post('noc-transportation-attachments-post', [TransportationNocController::class, 'addTransportationAttachmentsDetails'])->name('noc.transportation.attachments.post');
        
        // Common AJAX Routes for Citizens
        Route::post('citizen/noc/checkNoc', [NocController::class, 'checkNoc'])->name('citizen.checkNoc');
        Route::post('/noc-pre.operational.post', [NocController::class, 'preOprationalPost'])->name('noc.pre.operational.post');
        Route::post('/noc-extension', [NocController::class, 'nocExtension'])->name('noc.extension.post');
        Route::post('/operational-noc', [NocController::class, 'nocOperational'])->name('noc.operational.post');
        
        // NOC Download and Preview
        Route::get('/download-noc/{id}', [NocController::class, 'downloadApplication'])->name('noc.download');
        Route::get('/preview-noc/{id}', [NocController::class,'previewNoc'])->name('citizen.preview.noc');
        
    }); // End of Citizen Middleware
    
    // ==================== COMMON AJAX ROUTES (Any authenticated user) ====================
    
    // Common AJAX endpoints for dropdowns
    Route::post('getCategoryByProject', [CommonController::class, 'getCategoryByProject'])->name('getCategoryByProject');
    Route::post('getSubcategoryByCategory', [CommonController::class, 'getSubcategoryByCategory'])->name('getSubcategoryByCategory');
    Route::post('getTypeBySubcategory', [CommonController::class, 'getTypeBySubcategory'])->name('getTypeBySubcategory');
    Route::post('getTehsilByDistrict', [CommonController::class, 'getTehsilByDistrict'])->name('getTehsilByDistrict');
    Route::post('getUrbanBodyByTehsil', [CommonController::class, 'getUrbanBodyByTehsil'])->name('getUrbanBodyByTehsil');
    Route::post('getWardByUrbanBody', [CommonController::class, 'getWardByUrbanBody'])->name('getWardByUrbanBody');
    Route::post('getBlockByDistrict', [CommonController::class, 'getBlockByDistrict'])->name('getBlockByDistrict');
    Route::post('getPanchayatByBlock', [CommonController::class, 'getPanchayatByBlock'])->name('getPanchayatByBlock');
    Route::post('getSubCategoryByProject', [CommonController::class, 'getSubCategoryByProject'])->name('getSubCategoryByProject');
    Route::post('getCategoryBySubCategory', [CommonController::class, 'getCategoryBySubCategory'])->name('getCategoryBySubCategory');
    Route::post('/get-sub-categories-by-project', [CommonController::class, 'getSubCategoriesByProject'])->name('getSubCategoriesByProject');
    Route::post('/get-categories-by-subcategory', [CommonController::class, 'getCategoriesBySubCategory'])->name('getCategoriesBySubCategory');
    Route::post('/get-occupancy-input-type', [CommonController::class, 'getOccupancyInputType'])->name('getOccupancyInputType');
    
}); // End of auth.check middleware group