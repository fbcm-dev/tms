<?php

namespace TMS\Http\Controllers\Auth;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use TMS\Http\Requests\RecordRequest as StoreRequest;
use TMS\Http\Requests\RecordRequest as UpdateRequest;
use TMS\Http\Requests\RecordRequest as DestroyRequest;

class RecordCrudController extends CrudController
{

    public function setUp()
    {

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('TMS\Models\Record');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/record');
        $this->crud->setEntityNameStrings('record', 'records');
        $this->crud->enableAjaxTable();

        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */

        //$this->crud->setFromDb();
        $this->crud->addFields([
            [
                'label' => "Member Name",
                'type' => 'select2',
                'name' => 'member_id', // the db column for the foreign key
                'entity' => 'records', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'allows_null' => true,
                'model' => 'TMS\Models\Member' // foreign key model
            ],

            /*[
                // 1-n relationship
                'label' => "End", // Table column heading
                'type' => "select2_from_ajax",
                'name' => 'member_id', // the column that contains the ID of that connected entity
                'entity' => 'records', // the method that defines the relationship in your Model
                'attribute' => "name", // foreign key attribute that is shown to user
                'model' => "TMS\Models\Member", // foreign key model
                'data_source' => url("api/member"), // url to controller search function (with /{id} should return model)
                'placeholder' => "Select a category", // placeholder for the select
                'minimum_input_length' => 1, // minimum characters to type before querying results
            ],*/

            [
                'name'  => 'service_type',
                'label' => 'Worship Service Type',
                'type'  => 'enum'
            ], [
                'name'  => 'for_date',
                'label' => 'Worship Service Date',
                'type' => 'datetime_picker',
                'datetime_picker_options' => [
                    'format' => 'MM/DD/YYYY',
                    'language' => 'en'
                ]
            ], [
                'name'  => 'status',
                'label' => 'Status',
                'type' => 'text',
            ], [
                'name'  => 'tithe_amnt',
                'label' => 'Tithe Amount',
                'type' => 'number',
                'prefix' => "&#8369",
                'suffix' => ".00",
            ], [
                'name'  => 'faith_amnt',
                'label' => 'Faith Amount',
                'type' => 'number',
                'prefix' => "&#8369",
                'suffix' => ".00",
            ], [
                'name'  => 'love_amnt',
                'label' => 'Love Amount',
                'type' => 'number',
                'prefix' => "&#8369",
                'suffix' => ".00",
            ], [
                'name'  => 'special_offering',
                'label' => 'Special Offering Amount',
                'type' => 'number',
                'prefix' => "&#8369",
                'suffix' => ".00",
            ], [
                'name'  => 'special_offering_details',
                'label' => 'Special Offering Details',
                'type' => 'text',
            ]
        ]);

        $this->crud->addColumn([
            'name' => 'id', // The db column name
            'label' => "Record ID", // Table column heading
            'type' => 'Text'
        ]);

        $this->crud->addColumn([
            'name' => 'member_id', // The db column name
            'label' => "Member ID", // Table column heading
            'type' => 'Text'
        ]);

        $this->crud->addColumn([
            'name' => 'service_type', // The db column name
            'label' => "Service", // Table column heading
            'type' => 'Text'
        ]);

        $this->crud->addColumn([
            'name' => 'for_date', // The db column name
            'label' => "Date", // Table column heading
            'type' => 'Text'
        ]);

        $this->crud->addColumn([
            'name' => 'status', // The db column name
            'label' => "Status", // Table column heading
            'type' => 'Text'
        ]);

        $this->crud->addColumn([
            'name' => 'encoded_by', // The db column name
            'label' => "Encoded by", // Table column heading
            'type' => 'Text'
        ]);

        $this->crud->addColumn([
            'name' => 'encoded_at', // The db column name
            'label' => "Date Encoded", // Table column heading
            'type' => 'Text'
        ]);

        $this->crud->addColumn([
            'name' => 'verified_by', // The db column name
            'label' => "Verified by", // Table column heading
            'type' => 'Text'
        ]);

        $this->crud->addColumn([
            'name' => 'verified_at', // The db column name
            'label' => "Date Verified", // Table column heading
            'type' => 'Text'
        ]);


        // ------ CRUD FIELDS
        // $this->crud->addField($options, 'update/create/both');
        // $this->crud->addFields($array_of_arrays, 'update/create/both');
        // $this->crud->removeField('name', 'update/create/both');
        // $this->crud->removeFields($array_of_names, 'update/create/both');

        // ------ CRUD COLUMNS
        // $this->crud->addColumn(); // add a single column, at the end of the stack
        // $this->crud->addColumns(); // add multiple columns, at the end of the stack
        // $this->crud->removeColumn('column_name'); // remove a column from the stack
        // $this->crud->removeColumns(['column_name_1', 'column_name_2']); // remove an array of columns from the stack
        // $this->crud->setColumnDetails('column_name', ['attribute' => 'value']); // adjusts the properties of the passed in column (by name)
        // $this->crud->setColumnsDetails(['column_1', 'column_2'], ['attribute' => 'value']);

        // ------ CRUD BUTTONS
        // possible positions: 'beginning' and 'end'; defaults to 'beginning' for the 'line' stack, 'end' for the others;
        // $this->crud->addButton($stack, $name, $type, $content, $position); // add a button; possible types are: view, model_function
        // $this->crud->addButtonFromModelFunction($stack, $name, $model_function_name, $position); // add a button whose HTML is returned by a method in the CRUD model
        // $this->crud->addButtonFromView($stack, $name, $view, $position); // add a button whose HTML is in a view placed at resources\views\vendor\backpack\crud\buttons
        // $this->crud->removeButton($name);
        // $this->crud->removeButtonFromStack($name, $stack);

        // ------ CRUD ACCESS
        // $this->crud->allowAccess(['list', 'create', 'update', 'reorder', 'delete']);
        // $this->crud->denyAccess(['list', 'create', 'update', 'reorder', 'delete']);

        // ------ CRUD REORDER
        // $this->crud->enableReorder('label_name', MAX_TREE_LEVEL);
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('reorder');

        // ------ CRUD DETAILS ROW
        // $this->crud->enableDetailsRow();
        // NOTE: you also need to do allow access to the right users: $this->crud->allowAccess('details_row');
        // NOTE: you also need to do overwrite the showDetailsRow($id) method in your EntityCrudController to show whatever you'd like in the details row OR overwrite the views/backpack/crud/details_row.blade.php

        // ------ REVISIONS
        // You also need to use \Venturecraft\Revisionable\RevisionableTrait;
        // Please check out: https://laravel-backpack.readme.io/docs/crud#revisions
        // $this->crud->allowAccess('revisions');

        // ------ AJAX TABLE VIEW
        // Please note the drawbacks of this though:
        // - 1-n and n-n columns are not searchable
        // - date and datetime columns won't be sortable anymore
        // $this->crud->enableAjaxTable();

        // ------ DATATABLE EXPORT BUTTONS
        // Show export to PDF, CSV, XLS and Print buttons on the table view.
        // Does not work well with AJAX datatables.
        // $this->crud->enableExportButtons();

        // ------ ADVANCED QUERIES
        // $this->crud->addClause('active');
        // $this->crud->addClause('type', 'car');
        // $this->crud->addClause('where', 'name', '==', 'car');
        // $this->crud->addClause('whereName', 'car');
        // $this->crud->addClause('whereHas', 'posts', function($query) {
        //     $query->activePosts();
        // });
        // $this->crud->addClause('withoutGlobalScopes');
        // $this->crud->addClause('withoutGlobalScope', VisibleScope::class);
        // $this->crud->with(); // eager load relationships
        // $this->crud->orderBy();
        // $this->crud->groupBy();
        // $this->crud->limit();
    }

    public function store(StoreRequest $request)
    {
        $this->crud->hasAccessOrFail('create');
        $redirect_location = parent::storeCrud();
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud();
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }
}
