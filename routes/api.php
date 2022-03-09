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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::middleware('auth:sanctum')->get('/user', function (Request $request){
    return $request->user();
});
// register route
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
// login and logout
Route::group(['middleware' => 'api'], function ($router){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
});
//Authentication
// Route::post('/login', [AuthController::class,'login']);


// Route::middleware('auth:sanctum')->group(function() {
//     Route::get('/logged', [AuthController::class,'logged']);
//     Route::get('/logout', [AuthController::class,'logout']);
// });






//Users routes
Route::get('/user', [UserController::class,'getUser']);
Route::get('/user/{id}', [UserController::class,'getUserById']);
Route::post('/add-user', [UserController::class,'addUser']);
Route::put('/update-user/{id}', [UserController::class,'updateUser']);
Route::delete('/delete-user/{id}', [UserController::class,'deleteUser']);

//Auto Ecole routes
Route::get('/all-auto-ecole/{user_id}', [AutoEcole::class,'getAutoEcole']);
Route::get('/auto-ecole/{id}', [AutoEcole::class,'getAutoEcoleById']);
Route::post('/add-auto-ecole/{user_id}', [AutoEcole::class,'addAutoEcole']);
Route::put('/update-auto-ecole/{id}', [AutoEcole::class,'updateAutoEcole']);
Route::delete('/delete-auto-ecole/{id}', [AutoEcole::class,'deleteAutoEcole']);


//Vehicule routes
Route::get('/auto-ecole/{ecole_id}/vehicule', [VehiculeController::class,'getVehicule']);
Route::get('/vehicule/{id}', [VehiculeController::class,'getVehiculeById']);
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
Route::get('/auto-ecole/{ecole_id}/moniteur-pratique', [MoniteurPratiqueController::class,'getMoniteurp']);
Route::get('/moniteur-pratique/{id}', [MoniteurPratiqueController::class,'getMoniteurpById']);
Route::post('/add-moniteur-pratique/{ecole_id}', [MoniteurPratiqueController::class,'addMoniteurp']);
Route::put('/update-moniteur-pratique/{id}', [MoniteurPratiqueController::class,'updateMoniteurp']);
Route::delete('/delete-moniteur-pratique/{id}', [MoniteurPratiqueController::class,'deleteMoniteurp']);


//Candidat routes
Route::get('/auto-ecole/{ecole_id}/candidat', [CandidatController::class,'getCandidat']);
Route::get('/candidat/{id}', [CandidatController::class,'getCandidatById']);
Route::post('/add-candidat/{ecole_id}', [CandidatController::class,'addCandidat']);
Route::put('/update-candidat/{id}', [CandidatController::class,'updateCandidat']);
Route::delete('/delete-candidat/{id}', [CandidatController::class,'deleteCandidat']);


//Categorie depence routes
Route::get('/auto-ecole/{ecole_id}/categorie-depence', [CategorieDepenceController::class,'getCategorieDepence']);
Route::get('/categorie-depence/{id}', [CategorieDepenceController::class,'getCategorieDepenceById']);
Route::post('/add-categorie-depence/{ecole_id}', [CategorieDepenceController::class,'addCategorieDepence']);
Route::put('/update-categorie-depence/{id}', [CategorieDepenceController::class,'updateCategorieDepence']);
Route::delete('/delete-categorie-depence/{id}', [CategorieDepenceController::class,'deleteCategorieDepence']);


//Depence routes
Route::get('/auto-ecole/{ecole_id}/depence', [DepenceController::class,'getDepence']);
Route::get('/depence/{id}', [DepenceController::class,'getDepenceById']);
Route::post('/add-depence/{ecole_id}', [DepenceController::class,'addDepence']);
Route::put('/update-depence/{id}', [DepenceController::class,'updateDepence']);
Route::delete('/delete-depence/{id}', [DepenceController::class,'deleteDepence']);


//Facture
Route::get('/auto-ecole/{ecole_id}/facture', [FactureController::class,'getFacture']);
Route::get('/facture/{id}', [FactureController::class,'getFactureById']);
Route::post('/add-facture/{ecole_id}', [FactureController::class,'addFacture']);
Route::put('/update-facture/{id}', [FactureController::class,'updateFacture']);
Route::delete('/delete-facture/{id}', [FactureController::class,'deleteFacture']);


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

//Paiement
Route::get('/auto-ecole/{ecole_id}/paiement', [PaiementController::class,'getPaiement']);
Route::get('/paiement/{id}', [PaiementController::class,'getPaiementById']);
Route::post('/add-paiement/{ecole_id}', [PaiementController::class,'addPaiement']);
Route::put('/update-paiement/{id}', [PaiementController::class,'updatePaiement']);
Route::delete('/delete-paiement/{id}', [PaiementController::class,'deletePaiement']);


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
Route::get('/examen/{id}', [ExamenController::class,'getExamenById']);
Route::post('/add-examen/{ecole_id}', [ExamenController::class,'addExamen']);
Route::put('/update-examen/{id}', [ExamenController::class,'updateExamen']);
Route::delete('/delete-examen/{id}', [ExamenController::class,'deleteExamen']);


//Moniteurs routes
Route::get('/auto-ecole/{ecole_id}/moniteur-theorique', [MoniteurController::class,'getMoniteurt']);
Route::get('/moniteur-theorique/{id}', [MoniteurController::class,'getMoniteurtById']);
Route::post('/add-moniteur-theorique/{ecole_id}', [MoniteurController::class,'addMoniteurt']);
Route::put('/update-moniteur-theorique/{id}', [MoniteurController::class,'updateMoniteurt']);
Route::delete('/delete-moniteur-theorique/{id}', [MoniteurController::class,'deleteMoniteurt']);

Route::get('/auto-ecole/{ecole_id}/moniteur-pratique', [MoniteurController::class,'getMoniteurp']);
Route::get('/moniteur-pratique/{id}', [MoniteurController::class,'getMoniteurpById']);
Route::post('/add-moniteur-pratique/{ecole_id}', [MoniteurController::class,'addMoniteurp']);
Route::put('/update-moniteur-pratique/{id}', [MoniteurController::class,'updateMoniteurp']);
Route::delete('/delete-moniteur-pratique/{id}', [MoniteurController::class,'deleteMoniteurp']);


//Rroduits routes
Route::get('/auto-ecole/{ecole_id}/produit', [ProduitController::class,'getProduit']);
Route::get('/produit/{id}', [ProduitController::class,'getProduitById']);
Route::post('/add-produit/{ecole_id}', [ProduitController::class,'addProduit']);
Route::put('/update-produit/{id}', [ProduitController::class,'updateProduit']);
Route::delete('/delete-produit/{id}', [ProduitController::class,'deleteProduit']);


//Cours routes
Route::get('/auto-ecole/{ecole_id}/cour-theorique', [CourController::class,'getcourT']);
Route::get('/cour-theorique/{id}', [CourController::class,'getcourTById']);
Route::post('/add-cour-theorique/{ecole_id}', [CourController::class,'addcourT']);
Route::put('/update-cour-theorique/{id}', [CourController::class,'updatecourT']);
Route::delete('/delete-cour-theorique/{id}', [CourController::class,'deletecourT']);

Route::get('/auto-ecole/{ecole_id}/cour-pratique', [CourController::class,'getcourP']);
Route::get('/cour-pratique/{id}', [CourController::class,'getcourPById']);
Route::post('/add-cour-pratique/{ecole_id}', [CourController::class,'addcourP']);
Route::put('/update-cour-pratique/{id}', [CourController::class,'updatecourP']);
Route::delete('/delete-cour-pratique/{id}', [CourController::class,'deletecourP']);




