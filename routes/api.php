<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutoEcole;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\CandidatController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\MoniteurPratiqueController;
use App\Http\Controllers\CategorieDepenceController;
use App\Http\Controllers\DepenceController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\SalaireController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\CategoriePermisController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\ControleController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\RapportController;
use App\Http\Controllers\ExamenController;
use App\Http\Controllers\MoniteurController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\PaimentCandidatController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\Depense_localController;
use App\Http\Controllers\Depense_vehiculeController;
use App\Http\Controllers\AutoEcoleController; 
use App\Http\Controllers\ProduitAdminController; 
use App\Http\Controllers\BlogController; 
use App\Http\Controllers\AbonnementController; 
use App\Http\Controllers\MoniteurJobController; 
use App\Http\Controllers\AutoEcoleVendreController; 
use App\Http\Controllers\NotesMinisterielleController; 
use App\Http\Controllers\SuperAdminController; 
use App\Http\Controllers\VerifieEmailController;   
use App\Http\Controllers\ForgotPasswordController;   
use App\Http\Controllers\ResetPasswordController; 
use App\Http\Controllers\AbsenceTheoriqueMoniteurController; 
use App\Http\Controllers\AbsencePratiqueMoniteurController; 
use App\Http\Controllers\ResetEmailController; 
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\VerificationController;
use App\Http\Middleware\VerifyEmail;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});
Route::group(['middleware' => 'api'], function($router) {
   // register route
    Route::post('register', [AuthController::class, 'register']);
    Route::match(['get', 'post'], '/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class,'logout']);

});
// you need to log in to access this route with jwt token
Route::middleware('jwt.verify')->group(function() {
    // login and logout 
    Route::get('/logged', [AuthController::class,'logged']);
});

Route::get('/auto-ecole/{ecole_id}/vehicule', [VehiculeController::class,'getVehicule']);
Route::post('/resend/email/token', [AuthController::class, 'resendPin'])->name('resendPin');
Route::middleware('auth:sanctum')->group(function () {
        Route::post('email/verify',[AuthController::class, 'verifyEmail']);
});
Route::post(
    '/forgot-password', 
    [ForgotPasswordController::class, 'forgotPassword'] 
);
Route::post(
    '/verify/pin', 
    [ForgotPasswordController::class, 'verifyPin']
);
Route::post(
    '/reset-password', 
    [ResetPasswordController::class, 'resetPassword']
);
// endpoint for user is logged into their account

Route::put(
    '/reset-email', 
    [ResetEmailController::class, 'resetemail']
);
//
Route::middleware('auth:sanctum')->group(function ($route) {
    $route->post(
        '/email/verify/{id}/{token}',
        [App\Http\Controllers\RegisterController::class, 'verifyEmail']
    );
    // endpoint for resend email verification don't change the method sendVerificationEmail;
    // this endpoint need to user to be authenticated as we have middleware auth:sanctum apply on it
    $route->post('/email/verification-notification', [VerifieEmailController::class, 'sendVerificationEmail'])->name('verification.send');
});
// this endpoint not require from user to be authenticated
Route::get('/email/verify/{id}/{hash}', [VerifieEmailController::class, 'send_email'])->middleware(['signed'])->name('verification.verify');





//Users routes
Route::get('/user', [UserController::class,'getUser']);
Route::get('/user/{id}', [UserController::class,'getUserById']);
Route::post('/add-user', [UserController::class,'addUser']);
Route::put('/update-user/{id}', [UserController::class,'updateUser']);
Route::delete('/delete-user/{id}', [UserController::class,'deleteUser']);

//Auto Ecole routes
Route::get('/all-auto-ecole/{user_id}', [AutoEcole::class,'getAutoEcole']);
Route::get('/all-auto-ecole-admin', [AutoEcoleController::class,'getAutoEcoles']);
Route::get('/get-auto-ecoles-approuve', [AutoEcoleController::class,'getAutoEcolesApprouve']);
Route::get('/auto-ecole/{id}', [AutoEcoleController::class,'getAutoEcoleById']);
Route::put('/modifier-auto-ecole/{id}', [AutoEcoleController::class,'updateAutoEcole']);
Route::get('/get-auto-ecole-deleted/{id}', [AutoEcoleController::class,'getAutoEcoleByIdDeleted']); 
Route::get('/auto-ecole-user/{id}', [AutoEcoleController::class,'getAutoEcoleByIdUser']);
Route::get('/archive-auto-ecole', [AutoEcole::class,'getArchiveAutoEcole']);
Route::post('/recuperer-auto-ecole/{id}', [AutoEcole::class,'recupererAutoEcole']);
Route::post('/add-auto-ecole/{user_id}', [AutoEcole::class,'addAutoEcole']);
Route::put('/update-auto-ecole/{id}', [AutoEcole::class,'updateAutoEcole']);
Route::delete('/delete-auto-ecole/{id}', [AutoEcole::class,'deleteAutoEcole']);
// approver auto ecole
Route::put('/approver-auto-ecole/{id}', [AutoEcole::class,'approverAutoEcole']);
// Desapprover  auto ecole
Route::put('/desapprover-auto-ecole/{id}', [AutoEcole::class,'desapproverAutoEcole']);


Route::get('/vehicule/{id}', [VehiculeController::class,'getVehiculeById']);
Route::get('/auto-ecole/{ecole_id}/vidange', [VehiculeController::class,'getVidanges']);
Route::post('/add-vehicule/{ecole_id}', [VehiculeController::class,'addVehicule']);
Route::put('/update-vehicule/{id}', [VehiculeController::class,'updateVehicule']);
Route::delete('/delete-vehicule/{id}', [VehiculeController::class,'deleteVehicule']);


//Employe routes
Route::get('/auto-ecole/{ecole_id}/employe', [EmployeController::class,'getEmploye']);
Route::get('/employe/{id}', [EmployeController::class,'getEmployeById']);
Route::get('/employe/{role}/{ecole_id}', [EmployeController::class,'getEmployeByRole']);
Route::post('/add-employe/{ecole_id}', [EmployeController::class,'addEmploye']);
Route::put('/update-employe/{id}', [EmployeController::class,'updateEmploye']);
Route::delete('/delete-employe/{id}', [EmployeController::class,'deleteEmploye']);

//Moniteur routes
// Route::get('/auto-ecole/{ecole_id}/moniteur-pratique', [MoniteurPratiqueController::class,'getMoniteurP']);
// Route::get('/moniteur-pratique/{id}', [MoniteurPratiqueController::class,'getMoniteurpById']);
// Route::post('/add-moniteur-pratique/{ecole_id}', [MoniteurPratiqueController::class,'addMoniteurp']);
// Route::put('/update-moniteur-pratique/{id}', [MoniteurPratiqueController::class,'updateMoniteurp']);
// Route::delete('/delete-moniteur-pratique/{id}', [MoniteurPratiqueController::class,'deleteMoniteurp']);

// /auto-ecole/listCandidat/'+list_candidat
//Candidat routes http://127.0.0.1:8000/api/auto-ecole/'+id_auto_ecole+'/candidat
Route::get('/auto-ecole/{ecole_id}/candidatTrash', [CandidatController::class,'getCandidat']);
Route::get('/auto-ecole/{ecole_id}/getCandidatsBasic', [CandidatController::class,'getCandidatsBasic']);
Route::get('/auto-ecole/{ecole_id}/getCandidatsSupplementaire', [CandidatController::class,'getCandidatsSupplementaire']);
Route::get('/auto-ecole/{ecole_id}/getCandidats', [CandidatController::class,'getCandidats']);
Route::get('/auto-ecole/listCandidat/{list_candidat}', [CandidatController::class,'getlistCandidat']);
Route::get('/auto-ecole/{ecole_id}/historiquecandidat', [CandidatController::class,'historiquecandidat']);
Route::get('/auto-ecole/{ecole_id}/archivecandidat', [CandidatController::class,'getarchivecandidat']);
Route::get('/candidat/{id}', [CandidatController::class,'getCandidatById']);
Route::post('/add-candidat/{ecole_id}', [CandidatController::class,'addCandidat']);
Route::put('/update-candidat/{id}', [CandidatController::class,'updateCandidat']);
Route::delete('/delete-candidat/{id}', [CandidatController::class,'deleteCandidat']);
Route::post('/desactiver-candidat/{id}', [CandidatController::class,'desactiverCandidat']);
Route::post('/activer-candidat/{id}', [CandidatController::class,'activerCandidat']);
Route::post('/recuperer-candidat/{id}', [CandidatController::class,'recupererCandidat']);
// 
//Categorie depence routes
Route::get('/auto-ecole/{ecole_id}/categorie-depence', [CategorieDepenceController::class,'getCategorieDepence']);
Route::get('/categorie-depence/{id}', [CategorieDepenceController::class,'getCategorieDepenceById']);
Route::post('/add-categorie-depence/{ecole_id}', [CategorieDepenceController::class,'addCategorieDepence']);
Route::put('/update-categorie-depence/{id}', [CategorieDepenceController::class,'updateCategorieDepence']);
Route::delete('/delete-categorie-depence/{id}', [CategorieDepenceController::class,'deleteCategorieDepence']);


//Depence routes personnel
Route::get('/auto-ecole/{ecole_id}/depence', [DepenceController::class,'getDepence']);
Route::get('/depence/{id}', [DepenceController::class,'getDepenceById']);
Route::post('/add-depence/{ecole_id}', [DepenceController::class,'addDepence']);
Route::put('/update-depence/{id}', [DepenceController::class,'updateDepence']);
Route::delete('/delete-depence/{id}', [DepenceController::class,'deleteDepence']);

// depense local 
Route::get('/auto-ecole/{ecole_id}/depence-local', [Depense_localController::class,'getDepencelocal']);
Route::get('/auto-ecole/{ecole_id}/depence-local/month/{id}', [Depense_localController::class,'getDepencelocalbyMonth']);
Route::get('/depence-local/{id}', [Depense_localController::class,'getDepencelocalById']);
Route::post('/add-depence-local/{ecole_id}', [Depense_localController::class,'addDepencelocal']);
Route::put('/update-depence-local/{id}', [Depense_localController::class,'updateDepencelocal']);
Route::delete('/delete-depence-local/{id}', [Depense_localController::class,'deleteDepencelocal']);
// depense vehicule

Route::get('/auto-ecole/{ecole_id}/depence-vehicule', [Depense_vehiculeController::class,'getDepencevehicule']);
Route::get('/auto-ecole/{ecole_id}/depence-general', [Depense_vehiculeController::class,'getDepences']);
Route::get('/depence-vehicule/{id}', [Depense_vehiculeController::class,'getDepencevehiculeById']);
Route::post('/add-depence-vehicule/{ecole_id}', [Depense_vehiculeController::class,'addDepencevehicule']);
Route::put('/update-depence-vehicule/{id}', [Depense_vehiculeController::class,'updateDepencevehicule']);
Route::delete('/delete-depence-vehicule/{id}', [Depense_vehiculeController::class,'deleteDepencevehicule']);
//Facture 
Route::get('/auto-ecole/{ecole_id}/get-factures', [FactureController::class,'getFacture']);
Route::get('/facture/{id}', [FactureController::class,'getFactureById']);
Route::post('/add-facture/{ecole_id}', [FactureController::class,'addFacture']);
Route::put('/update-facture/{id}', [FactureController::class,'updateFacture']);
Route::delete('/delete-facture/{id}', [FactureController::class,'deleteFacture']);

// add-devis
Route::post('/add-devis/{ecole_id}', [DevisController::class,'addDevis']);

// /add-notes/
Route::post('/add-notes/{ecole_id}', [NoteController::class,'addNote']);
// 
//Recette
Route::get('/auto-ecole/{ecole_id}/recette', [RecetteController::class,'getFacture']);
Route::get('/recette/{id}', [RecetteController::class,'getFactureById']);
Route::post('/add-recette/{ecole_id}', [RecetteController::class,'addFacture']);
Route::put('/update-recette/{id}', [FactureController::class,'updateFacture']);
Route::delete('/delete-recette/{id}', [FactureController::class,'deleteFacture']);


//Salaire
Route::get('/auto-ecole/{ecole_id}/salaire', [SalaireController::class,'getSalaire']);
Route::get('/salaire/{id}', [SalaireController::class,'getSalaireById']);
Route::post('/add-salaire/{ecole_id}', [SalaireController::class,'addSalaire']);
Route::put('/update-salaire/{id}', [SalaireController::class,'updateSalaire']);
Route::delete('/delete-salaire/{id}', [SalaireController::class,'deleteSalaire']);


//Absence
Route::get('/auto-ecole/{ecole_id}/absence', [AbsenceController::class,'getAbsence']);
Route::get('/auto-ecole/{ecole_id}/absence/{employe_id}', [AbsenceController::class,'getAbsenceByEmploye']);
Route::get('/absence/{id}', [AbsenceController::class,'getAbsenceById']);
Route::post('/add-absence/{ecole_id}', [AbsenceController::class,'addAbsence']);
Route::put('/update-absence/{id}', [AbsenceController::class,'updateAbsence']);
Route::delete('/delete-absence/{id}', [AbsenceController::class,'deleteAbsence']);
// absence moniteur theorique 
Route::get('/auto-ecole/{ecole_id}/absence-moniteur-theorique', [AbsenceTheoriqueMoniteurController::class,'getAbsence']);
Route::get('/absence-moniteur-theorique/{id}', [AbsenceTheoriqueMoniteurController::class,'getAbsenceById']);
Route::post('/add-absence-moniteur-theorique/{ecole_id}', [AbsenceTheoriqueMoniteurController::class,'addAbsence']);
Route::put('/update-absence-moniteur-theorique/{id}', [AbsenceTheoriqueMoniteurController::class,'updateAbsence']);
Route::delete('/delete-absence-moniteur-theorique/{id}', [AbsenceTheoriqueMoniteurController::class,'deleteAbsence']);
// absence moniteur pratique 
Route::get('/auto-ecole/{ecole_id}/absence-moniteur-pratique', [AbsencePratiqueMoniteurController::class,'getAbsence']);
Route::get('/absence-moniteur-pratique/{id}', [AbsencePratiqueMoniteurController::class,'getAbsenceById']);
Route::post('/add-absence-moniteur-pratique/{ecole_id}', [AbsencePratiqueMoniteurController::class,'addAbsence']);
Route::put('/update-absence-moniteur-pratique/{id}', [AbsencePratiqueMoniteurController::class,'updateAbsence']);
Route::delete('/delete-absence-moniteur-pratique/{id}', [AbsencePratiqueMoniteurController::class,'deleteAbsence']);
//Paiement
Route::get('/auto-ecole/{ecole_id}/paiement', [PaiementController::class,'getPaiement']);
Route::get('/paiement/{id}', [PaiementController::class,'getPaiementById']);
Route::post('/add-paiement/{ecole_id}', [PaiementController::class,'addPaiement']);
Route::put('/update-paiement/{id}', [PaiementController::class,'updatePaiement']);
Route::delete('/delete-paiement/{id}', [PaiementController::class,'deletePaiement']);

// paiment candidat '/api/auto-ecole/'+auto_ecole_id +'/add-paiementCandidat/' + id_candidat
Route::post('/auto-ecole/{ecole_id}/add-paiementCandidat/{id_candidat}', [PaimentCandidatController::class,'addPaiementCandidat']);
Route::get('/auto-ecole/{ecole_id}/get-paiementCandidat/{id_candidat}', [PaimentCandidatController::class,'getPaiementCandidat']);
Route::get('/auto-ecole/{ecole_id}/paiementCandidat', [PaimentCandidatController::class,'getPaiementCandidats']);
Route::get('/paiementCandidat/{id}', [PaimentCandidatController::class,'getPaiementCandidatById']);
Route::put('/update-paiment-candidat/{id}', [PaimentCandidatController::class,'updatePaiementCandidat']);
Route::delete('/delete-paiment-candidat/{id}', [PaimentCandidatController::class,'deletePaiementCandidat']);

//Categorie permis routes
Route::get('/auto-ecole/{ecole_id}/categorie-permis', [CategoriePermisController::class,'getCategoriePermis']);
Route::get('/categorie-permis/{id}', [CategoriePermisController::class,'getCategoriePermisById']);
Route::post('/add-categorie-permis/{ecole_id}', [CategoriePermisController::class,'addCategoriePermis']);
Route::put('/update-categorie-permis/{id}', [CategoriePermisController::class,'updateCategoriePermis']);
Route::delete('/delete-categorie-permis/{id}', [CategoriePermisController::class,'deleteCategoriePermis']);



//Fournisseurs routes
Route::get('/auto-ecole/{ecole_id}/fournisseur', [FournisseurController::class,'getFournisseur']);
Route::get('/fournisseur/{id}', [FournisseurController::class,'getFournisseurById']);
Route::post('/add-fournisseur/{ecole_id}', [FournisseurController::class,'addFournisseur']);
Route::put('/update-fournisseur/{id}', [FournisseurController::class,'updateFournisseur']);
Route::delete('/delete-fournisseur/{id}', [FournisseurController::class,'deleteFournisseur']);


//Ventes routes
Route::get('/auto-ecole/{ecole_id}/vente', [VenteController::class,'getVente']);
Route::get('/auto-ecole/{ecole_id}/get-produit-candidats', [VenteController::class,'getProduitCandidats']);
Route::get('/vente/{id}', [VenteController::class,'getVenteById']);
Route::post('/add-vente/{ecole_id}', [VenteController::class,'addVente']);
Route::put('/update-vente/{id}', [VenteController::class,'updateVente']);
Route::delete('/delete-vente/{id}', [VenteController::class,'deleteVente']);


//Controles routes
Route::get('/auto-ecole/{ecole_id}/controle', [ControleController::class,'getControle']);
Route::get('/controle/{id}', [ControleController::class,'getControleById']);
Route::post('/add-controle/{ecole_id}', [ControleController::class,'addControle']);
Route::put('/update-controle/{id}', [ControleController::class,'updateControle']);
Route::delete('/delete-controle/{id}', [ControleController::class,'deleteControle']);


//Dossiers routes
Route::get('/auto-ecole/{ecole_id}/dossier', [DossierController::class,'getDossier']);
Route::get('/dossier/{id}', [DossierController::class,'getDossierById']);
Route::post('/add-dossier/{ecole_id}', [DossierController::class,'addDossier']);
Route::put('/update-dossier/{id}', [DossierController::class,'updateDossier']);
Route::delete('/delete-dossier/{id}', [DossierController::class,'deleteDossier']);


//Rapports routes
Route::get('/auto-ecole/{ecole_id}/rapport', [RapportController::class,'getRapport']);
Route::get('/rapport/{id}', [RapportController::class,'getRapportById']);
Route::post('/add-rapport/{ecole_id}', [RapportController::class,'addRapport']);
Route::put('/update-rapport/{id}', [RapportController::class,'updateRapport']);
Route::delete('/delete-rapport/{id}', [RapportController::class,'deleteRapport']);


//Rapports routes
Route::get('/auto-ecole/{ecole_id}/examen', [ExamenController::class,'getExamen']);
Route::get('/auto-ecole/{ecole_id}/candidat-reussi', [ExamenController::class,'getCandidatReussi']);
Route::get('/auto-ecole/{ecole_id}/candidat-Noreussi', [ExamenController::class,'getCandidatNoreussi']);
Route::get('/examen/{id}', [ExamenController::class,'getExamenById']);
Route::post('/add-examen/{ecole_id}', [ExamenController::class,'addExamen']);
Route::post('/add-note-candidat/{id}', [ExamenController::class, 'addNoteCandidat']); 
Route::put('/update-examen/{id}', [ExamenController::class,'updateExamen']);
Route::delete('/delete-examen/{id}', [ExamenController::class,'deleteExamen']);


//Moniteurs routes
Route::get('/auto-ecole/{ecole_id}/moniteur-theorique', [MoniteurController::class,'getMoniteurT']);
Route::get('/moniteur-theorique/{id}', [MoniteurController::class,'getMoniteurtById']);
Route::post('/add-moniteur-theorique/{ecole_id}', [MoniteurController::class,'addMoniteurt']);
Route::put('/update-moniteur-theorique/{id}', [MoniteurController::class,'updateMoniteurT']);
Route::delete('/delete-moniteur-theorique/{id}', [MoniteurController::class,'deleteMoniteurt']); 

Route::get('/auto-ecole/{ecole_id}/moniteur-pratiquetrash', [MoniteurController::class,'getMoniteurPtrash']);
Route::get('/auto-ecole/{ecole_id}/moniteur-pratique', [MoniteurController::class,'getMoniteurP']);
Route::get('/moniteur-pratique/{id}', [MoniteurController::class,'getMoniteurpById']);
Route::post('/add-moniteur-pratique/{ecole_id}', [MoniteurController::class,'addMoniteurp']);
Route::put('/update-moniteur-pratique/{id}', [MoniteurController::class,'updateMoniteurp']);
Route::delete('/delete-moniteur-pratique/{id}', [MoniteurController::class,'deleteMoniteurp']);


//Produits routes
Route::get('/auto-ecole/{ecole_id}/produit', [ProduitController::class,'getProduit']);
Route::get('/produit/{id}', [ProduitController::class,'getProduitById']);
Route::post('/add-produit/{ecole_id}', [ProduitController::class,'addProduit']);
Route::put('/update-produit/{id}', [ProduitController::class,'updateProduit']);
Route::delete('/delete-produit/{id}', [ProduitController::class,'deleteProduit']);


//Cours routes http://127.0.0.1:8000/auto-ecole/1/cour-theorique
Route::get('/auto-ecole/{ecole_id}/cour-theorique', [CourController::class,'getcourT']);
Route::get('/cour-theorique/{id}', [CourController::class,'getcourTById']);
Route::post('/add-cour-theorique/{ecole_id}', [CourController::class,'addcourT']);
Route::put('/auto-ecole/{auto_id}/update-cour-theorique/{id}', [CourController::class,'updatecourT']);
Route::delete('/delete-cour-theorique/{id}', [CourController::class,'deletecourT']);

// 
Route::get('/auto-ecole/{ecole_id}/cour-pratique', [CourController::class,'getcourP']);
Route::get('/cour-pratique/{id}', [CourController::class,'getcourPById']);
Route::post('/add-cour-pratique/{ecole_id}', [CourController::class,'addcourP']);
Route::put('/auto-ecole/{auto_id}/update-cour-pratique/{id}', [CourController::class,'updatecourP']);
Route::delete('/delete-cour-pratique/{id}', [CourController::class,'deletecourP']);


// presence route cour pratique
Route::get('/auto-ecole/{ecole_id}/presence-cour-pratique', [PresenceController::class,'getPresencecourP']);
Route::get('/presence-cour-pratique/{id}', [PresenceController::class,'getPresencecourPById']);
Route::get('/auto-ecole/{auto_id}/get-presence-cour-pratiqueByCour/{id}', [PresenceController::class,'getPresencecourPByIdCour']);
Route::post('/add-cour-presence-pratique/{id}', [PresenceController::class,'addPresencecourP']);
Route::put('/update-cour-presence-pratique/{id}', [PresenceController::class,'updateCourPresenceP']);
Route::get('/auto-ecole/{auto_id}/get-presence-cour-pratique', [PresenceController::class,'getPresencecourP']);
Route::delete('/delete-presence-cour-pratique/{id}', [PresenceController::class,'deletePresencecourPById']);
// add-cour-presence-
// presence route cour theorique
Route::get('/auto-ecole/{auto_id}/presence-cour-theorique', [PresenceController::class,'getPresencecourT']);
Route::get('/get-presence-cour-theorique/{id}', [PresenceController::class,'getPresencecourTById']);
Route::get('/auto-ecole/{auto_id}/get-presence-cour-theoriqueByCour/{id}', [PresenceController::class,'getPresencecourTByIdCour']);
Route::post('/add-presence-cour-theorique/{id}', [PresenceController::class,'addPresencecourT']);//
Route::put('/auto-ecole/{auto_id}/update-presence-cour-theorique/{id}', [CourController::class,'updatecourT']);
Route::delete('/delete-presence-cour-theorique/{id}', [PresenceController::class,'deletePresencecourTById']);

Route::put('/update-presence-cour-theorique/{id}', [PresenceController::class,'updateCourPresenceT']);

// 
// note route
Route::get('/auto-ecole/{auto_id}/get-notes', [NoteController::class,'getNotes']);
Route::delete('/delete-note-categorie/{id}', [NoteController::class, 'deleteExamen']);
Route::get('/get-note-categorie/{id}', [NoteController::class,'getNoteById']);
Route::put('/update-note/{id}', [NoteController::class,'updateNote']);


// email verification
Route::post('email/verification-notification', [VerifieEmailController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::post('verify-email/{id}/{hash}', [VerifieEmailController::class, 'verify'])->middleware('auth:sanctum');

//  set logo
// /api/auto-ecole/{id}/set-auto-ecol
Route::put('/auto-ecole/{id}/set-auto-ecole-logo', [AuthController::class,'setlogo']);
Route::put('/auto-ecole/{id}/set-user-pass', [AuthController::class,'setpass']);
Route::put('/auto-ecole/{id_user}/set-user-email', [AuthController::class,'setemail']);

Route::get('/auto-ecole/{auto_id}/logo-auto-ecole', [AuthController::class,'getLogo']);
// '/api'
Route::get('/get-produit-admin', [ProduitAdminController::class,'getAllProduitAdmin']);
Route::get('/get-produit-by-id/{id}', [ProduitAdminController::class,'getProduitAdminById']);
Route::get('/get-boutique', [ProduitAdminController::class,'getboutique']);
Route::get('/get-vehicule-occassion', [ProduitAdminController::class,'getvehiculeOccassion']);
Route::get('/superadmin/data', [SuperAdminController::class,'getdataSuper']);
Route::get('/superadmin/auto-ecoles-en-attente', [SuperAdminController::class,'getautoecolesEnattente']);
Route::put('/auto-ecole/produit-admin/{id}', [ProduitAdminController::class,'updateProduitAdmin']); 
Route::post('/new-produit', [ProduitAdminController::class,'newProduit']);
Route::delete('/delete-produit-admin/{id}', [ProduitAdminController::class, 'deleteProduit']);

// 
// route blog
Route::get('/get-blogs', [BlogController::class,'getBlog']);
Route::get('/get-blogId/{id}', [BlogController::class,'getBlogById']);
Route::put('/update-blog-admin/{id}', [BlogController::class,'updateBlogAdmin']);
Route::post('/new-blog', [BlogController::class,'newBlog']);
Route::delete('/delete-blog/{id}', [BlogController::class, 'deletBlog']);

// route abonnement
Route::get('/get-abonnement-auto-ecoles', [AbonnementController::class,'getAbonnements']);
Route::get('/get-abonnement/{id}', [AbonnementController::class,'getAbonnementById']);
Route::get('/get-abonnement-autoEcole-id-autoEcole/{id}', [AbonnementController::class,'getabonnementByIdAUtoEcole']);
Route::get('/get-id-abonnement-auto-ecole/{auto_id}', [AbonnementController::class,'getIdabonnement']);

Route::get('/get-abonnement-auto-ecole/{id}', [AbonnementController::class,'getAbonnementAutoEcolesById']);
Route::put('/update-abonnement-auto-ecole/{id}', [AbonnementController::class,'updateAbonnementAutoEcole']);
Route::post('/auto-ecole/{auto_id}/abonnement', [AbonnementController::class,'newAbonnement']);
Route::delete('/delete-Abonnement/{id}', [AbonnementController::class, 'deletAbonnement']);

// router for moniteur available for job       
Route::get('/get-moniteurJob-admin/{id}', [MoniteurJobController::class,'getMoniteurJobById']);
Route::get('/get-moniteursJob-admin', [MoniteurJobController::class,'getMoniteurJob']);
Route::put('/update-moniteurJob-admin/{id}', [MoniteurJobController::class,'updateMoniteurJob']);
Route::post('/add-moniteursJob-admin', [MoniteurJobController::class,'addMoniteurJob']);
Route::delete('/delete-moniteurJob-admin/{id}', [MoniteurJobController::class, 'deleteMoniteurJob']);

// router for auto ecole a voundre     
Route::get('/get-autoecole-vendre-admin/{id}', [AutoEcoleVendreController::class,'getAutoecoleVendreById']);
Route::get('/get-autoecole-vendre-admin', [AutoEcoleVendreController::class,'getAutoecoleVendre']);
Route::put('/update-autoecole-vendre-admin/{id}', [AutoEcoleVendreController::class,'updateAutoecoleVendre']);
Route::post('/add-autoecole-vendre-admin', [AutoEcoleVendreController::class,'addAutoecoleVendre']);
Route::delete('/delete-autoecole-vendre-admin/{id}', [AutoEcoleVendreController::class, 'deleteAutoecoleVendre']);

// router for note Ministerielle     
Route::get('/get-note-ministerielle/{id}', [NotesMinisterielleController::class,'getNoteMinisterielleById']);
Route::get('/get-note-ministerielle', [NotesMinisterielleController::class,'getNoteMinisterielle']);
Route::put('/update-note-ministerielle/{id}', [NotesMinisterielleController::class,'updateNoteMinisterielle']);
Route::post('/add-note-ministerielle', [NotesMinisterielleController::class,'addNoteMinisterielle']);
Route::delete('/delete-note-ministerielle/{id}', [NotesMinisterielleController::class, 'deleteNoteMinisterielle']);
