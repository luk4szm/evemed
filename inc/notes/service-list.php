<?php

//service - add note
require_once __MDIR__ . '/notes/formService/note-add.php';
if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'AddItemNote') NewNoteAdd();

//service - edit note
require_once __MDIR__ . '/notes/formService/note-edit.php';
if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'EditItemNote') ItemNoteEdit();

//service - delete note
require_once __MDIR__ . '/notes/formService/note-delete.php';
if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'DeleteItemNote') ItemNoteDelete();