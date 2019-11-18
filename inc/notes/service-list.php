<?php

//service - add note
require_once $_SERVER['DOCUMENT_ROOT'] . '/notes/formService/note-add.php';
if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'AddItemNote') NewNoteAdd();

//service - edit note
require_once $_SERVER['DOCUMENT_ROOT'] . '/notes/formService/note-edit.php';
if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'EditItemNote') ItemNoteEdit();

//service - delete note
require_once $_SERVER['DOCUMENT_ROOT'] . '/notes/formService/note-delete.php';
if (isset($_POST['modalForm']) && $_POST['modalForm'] == 'DeleteItemNote') ItemNoteDelete();