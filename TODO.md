# TODO: Remove sisa_cuti_n, sisa_cuti_n_1, sisa_cuti_n_2 from cuti table

## Migration

-   [x] Create migration to drop columns from cuti table

## Model

-   [x] Update app/Models/Cuti.php: remove from fillable

## Controller

-   [x] Update app/Http/Controllers/CutiController.php: remove validation, data assignment, add with('sisaCuti')

## Views

-   [x] Update resources/views/cuti/index.blade.php: remove table columns
-   [x] Update resources/views/cuti/create.blade.php: remove form fields
-   [x] Update resources/views/cuti/edit.blade.php: remove form fields
-   [x] Update resources/views/cuti/show.blade.php: remove or update display
-   [x] Update resources/views/cuti/rekap.blade.php: change to relationship access

## Followup

-   [ ] Run migration
-   [ ] Test application
